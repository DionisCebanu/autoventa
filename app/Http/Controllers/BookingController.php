<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Booking;
use Illuminate\Support\Facades\Storage;
use App\Mail\BookingConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class BookingController extends Controller
{


    /**
     * Perform your actions (schedule, bookings, etc)
     */
    public function home() {
        return view('administration.bookings.home');
    }

    /**
     * Get available solts
     */
    public function getAvailableSlots(Request $request)
    {
        $date = $request->query('date');

        if (!$date) {
            return response()->json(['error' => 'Date is required'], 400);
        }

        // Step 1: Get all booked times for this date
        $bookedTimes = Booking::where('date', $date)
            ->pluck('start_time')
            ->map(fn($time) => substr($time, 0, 5)) // trim to "HH:MM"
            ->toArray();

        // Step 2: Get scheduled available slots for this date
        $slots = Schedule::where('date', $date)
            ->select('start_time', 'end_time')
            ->orderBy('start_time')
            ->get()
            ->flatMap(function ($slot) use ($bookedTimes) {
                // break each slot into 30-min intervals
                $start = substr($slot->start_time, 0, 5);
                $end = substr($slot->end_time, 0, 5);

                return $this->generateIntervals($start, $end)
                    ->filter(fn($time) => !in_array($time, $bookedTimes))
                    ->map(fn($time) => ['start' => $time]);
            })
            ->values();

        return response()->json($slots);
    }


    /**
     * Generate intevals
     */
    private function generateIntervals($start, $end)
    {
        $intervals = collect();

        [$startHour, $startMinute] = explode(':', $start);
        [$endHour, $endMinute] = explode(':', $end);

        $startHour = (int) $startHour;
        $startMinute = (int) $startMinute;
        $endHour = (int) $endHour;
        $endMinute = (int) $endMinute;

        while ($startHour < $endHour || ($startHour === $endHour && $startMinute <= $endMinute)) {
            $formatted = sprintf('%02d:%02d', $startHour, $startMinute);
            $intervals->push($formatted);

            $startMinute += 30;
            if ($startMinute >= 60) {
                $startMinute = 0;
                $startHour++;
            }
        }

        return $intervals;
    }


    /**
     * Store the booking
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|string|max:30',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
        ]);

        $booking = Booking::create($validated);

        $htmlMessage = $this->emailBookingTemplate(
            $booking->name,
            $booking->date,
            $booking->start_time,
            $booking->car->make ?? 'N/A',
            $booking->car->model ?? 'N/A',
            $booking->car->year ?? 'N/A',
            $booking->car->id ?? 1
        );
        

        // PHPMailer email
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'luxurycarbookingg@gmail.com';
            $mail->Password = 'iotqgwawtlesytlt';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('luxurycarbookingg@gmail.com', 'Autoventa');
            $mail->addAddress($booking->email, $booking->name);

            $mail->isHTML(true);
            $mail->Subject = 'Booking Confirmation';
            $mail->Body = $htmlMessage;

            $mail->send();

        } catch (Exception $e) {
            logger('PHPMailer error: ' . $mail->ErrorInfo);
        }

        return redirect()->back()->with('success', 'Booking confirmed! A confirmation email has been sent.');
    }


    /**
     * Email Template
     */
    private function emailBookingTemplate($name, $date, $start_time, $carMake, $carModel, $carYear, $carId)
    {
        $carLink = url("https://autoventa.dioniscode.com/car/{$carId}");
    
        return '
            <div style="font-family: Arial, sans-serif; background-color: #f3f4f6; padding: 30px; text-align: center; color: #333;">
                <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 40px; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.05);">
                    
                    <img src="https://autoventa.dioniscode.com/img/logo/autoventa-logo.png" alt="Autoventa Logo" style="max-width: 180px; margin-bottom: 20px;" />

                    <h2 style="color: #2d3748; margin-bottom: 20px;">Hello <span style="color: #5a67d8;">' . htmlspecialchars($name) . '</span>,</h2>
                    <p style="font-size: 16px; margin-bottom: 30px;">Your booking has been <strong style="color: #38a169;">successfully confirmed</strong>! 🎉</p>

                    <div style="font-size: 16px; line-height: 1.6; margin-bottom: 20px;">
                        <p><strong>Date:</strong> <span style="color: #3182ce; font-weight: bold;">' . htmlspecialchars($date) . '</span></p>
                        <p><strong>Time:</strong> <span style="color: #3182ce; font-weight: bold;">' . htmlspecialchars($start_time) . '</span></p>
                    </div>

                    <div style="font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                        <p><strong>Car:</strong> <span style="color: #805ad5; font-weight: bold;">' . htmlspecialchars($carMake) . ' ' . htmlspecialchars($carModel) . ' (' . htmlspecialchars($carYear) . ')</span></p>
                        <a href="' . $carLink . '" style="display:inline-block; margin-top: 12px; background-color: #667eea; color: white; text-decoration: none; padding: 10px 18px; border-radius: 6px; font-weight: bold;">View Car</a>
                    </div>

                    <hr style="margin: 40px 0; border: none; border-top: 1px solid #e2e8f0;" />

                   <p style="font-size: 14px; color: #555;">
                        📞 <a href="tel:+12211211212" style="color: #3182ce; text-decoration: none;">+1 221 121 1212</a><br>
                        ✉️ <a href="mailto:autoventa@contact.ca" style="color: #3182ce; text-decoration: none;">autoventa@contact.ca</a><br>
                    </p>

                    <p style="font-size: 13px; color: #999; margin-top: 20px;">
                        &copy; ' . date('Y') . ' Autoventa. All rights reserved.
                    </p>
                </div>
            </div>
        ';
    }
    


    /**
     * Get bookings by date
     */
    public function getBookingsByDate(Request $request)
    {
        $date = $request->query('date');

        if (!$date) {
            return response()->json(['error' => 'Date is required'], 400);
        }

        $bookings = Booking::with('car')
            ->whereDate('date', $date)
            ->orderBy('start_time')
            ->get();

        return response()->json($bookings);
    }

    /**
     * List the bookings
     */
    public function listBookings()
    {
        $bookings = Booking::with('car')->latest()->get();

        return view('administration.bookings.index', compact('bookings'));
    }

    /**
     * Get Booked dates
     */
    public function getBookedDates()
    {
        $dates = Booking::select('date')
            ->distinct()
            ->orderBy('date')
            ->pluck('date');

        return response()->json($dates);
    }

}


?>