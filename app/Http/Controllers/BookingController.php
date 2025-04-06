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

        $htmlMessage = $this->emailBookingTemplate($booking->name, $booking->date, $booking->start_time);

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
    function emailBookingTemplate($name, $date, $start_time)
    {
        return '
            <div style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 30px; text-align: center; color: #333;">
                <div style="max-width: 600px; margin: 0 auto; background-color: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 0 15px rgba(0,0,0,0.05);">
                    <h2 style="color: #4a4a4a; margin-bottom: 20px;">Hello <span style="color: #5a67d8; font-weight: bold;">' . htmlspecialchars($name) . '</span>,</h2>
                    <p style="font-size: 16px; margin-bottom: 30px;">Your booking has been <strong style="color: #38a169;">successfully confirmed</strong>! 🎉</p>

                    <div style="font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                        <p><strong>Date:</strong> <span style="color: #3182ce; font-weight: bold;">' . htmlspecialchars($date) . '</span></p>
                        <p><strong>Time:</strong> <span style="color: #3182ce; font-weight: bold;">' . htmlspecialchars($start_time) . '</span></p>
                    </div>

                    <p style="font-size: 16px;">Thank you for choosing <strong style="color: #5a67d8;">Autoventa</strong> 🚗</p>
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