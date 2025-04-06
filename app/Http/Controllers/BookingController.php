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
            $mail->Body = "
                <h2>Hello {$booking->name},</h2>
                <p>Your booking on <strong>{$booking->date}</strong> at <strong>{$booking->start_time}</strong> is confirmed.</p>
                <p>Thank you for booking with Autoventa.</p>
            ";

            $mail->send();

        } catch (Exception $e) {
            logger('PHPMailer error: ' . $mail->ErrorInfo);
        }

        return redirect()->back()->with('success', 'Booking confirmed! A confirmation email has been sent.');
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