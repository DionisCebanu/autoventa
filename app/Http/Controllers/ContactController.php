<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }


    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email',
        'phone' => 'required|string|max:30',
        'message' => 'required|string',
    ]);

    $contact = Contact::create($validated);

    // Email credentials
    $username = 'luxurycarbookingg@gmail.com';
    $password = 'iotqgwawtlesytlt';

    // ✉️ Send email to admin
    $mailToAdmin = new PHPMailer(true);
    try {
        $mailToAdmin->isSMTP();
        $mailToAdmin->Host = 'smtp.gmail.com';
        $mailToAdmin->SMTPAuth = true;
        $mailToAdmin->Username = $username;
        $mailToAdmin->Password = $password;
        $mailToAdmin->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mailToAdmin->Port = 587;

        $mailToAdmin->setFrom($username, 'Autoventa');
        $mailToAdmin->addAddress($username, 'Site Admin');

        $mailToAdmin->isHTML(true);
        $mailToAdmin->Subject = 'New Contact Form Submission';

        $mailToAdmin->Body = $this->emailContactTemplate(
            $contact->name,
            $contact->email,
            $contact->phone,
            $contact->message,
            $contact->created_at
        );

        $mailToAdmin->send();
    } catch (Exception $e) {
        logger('Admin email error: ' . $mailToAdmin->ErrorInfo);
    }

    // ✅ Send confirmation to the client
    $mailToClient = new PHPMailer(true);
    try {
        $mailToClient->isSMTP();
        $mailToClient->Host = 'smtp.gmail.com';
        $mailToClient->SMTPAuth = true;
        $mailToClient->Username = $username;
        $mailToClient->Password = $password;
        $mailToClient->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mailToClient->Port = 587;

        $mailToClient->setFrom($username, 'Autoventa');
        $mailToClient->addAddress($contact->email, $contact->name);
        $mailToClient->isHTML(true);
        $mailToClient->Subject = 'We received your message';

        $mailToClient->Body = "
            <div style='font-family: Arial, sans-serif; padding: 30px; background-color: #f9f9f9; text-align: center;'>
                <div style='max-width: 600px; background: #fff; margin: 0 auto; padding: 30px; border-radius: 8px; box-shadow: 0 0 15px rgba(0,0,0,0.05);'>
                    <h2 style='color: #333;'>Hello <span style='color: #667eea;'>{$contact->name}</span>,</h2>
                    <p style='font-size: 16px;'>We’ve received your message and will get back to you as soon as possible.</p>
                    <div style='margin-top: 20px; font-size: 14px; background: #f1f5f9; padding: 15px; border-radius: 6px;'>
                        <strong>Your message:</strong><br>" . nl2br(e($contact->message)) . "
                    </div>
                    <p style='margin-top: 30px; font-size: 13px; color: #666;'>Thanks for reaching out to <strong>Autoventa</strong>!</p>
                </div>
            </div>
        ";

        $mailToClient->send();
    } catch (Exception $e) {
        logger('Client email error: ' . $mailToClient->ErrorInfo);
    }

    return redirect()->back()->with('success', 'Thank you for contacting us! We have emailed a confirmation.');
}


    private function emailContactTemplate($name, $email, $phone, $message, $createdAt)
    {
        return '
            <div style="font-family: Arial, sans-serif; background-color: #f5f6fa; padding: 30px; text-align: left; color: #2d3748;">
                <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px 40px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.06);">
                    <h2 style="color: #4a5568;">📩 New Contact Message</h2>
                    <p style="font-size: 16px;"><strong>Name:</strong> <span style="color: #2b6cb0;">' . htmlspecialchars($name) . '</span></p>
                    <p style="font-size: 16px;"><strong>Email:</strong> <span style="color: #2b6cb0;">' . htmlspecialchars($email) . '</span></p>
                    <p style="font-size: 16px;"><strong>Phone:</strong> <span style="color: #2b6cb0;">' . htmlspecialchars($phone) . '</span></p>
                    <div style="margin-top: 20px;">
                        <p style="font-size: 16px; margin-bottom: 8px;"><strong>Message:</strong></p>
                        <div style="font-size: 15px; background-color: #f7fafc; padding: 15px; border-left: 4px solid #667eea; border-radius: 6px;">
                            ' . nl2br(e($message)) . '
                        </div>
                    </div>
                    <p style="margin-top: 30px; font-size: 13px; color: #718096;">📅 Received on: ' . $createdAt . '</p>
                </div>
            </div>
        ';
    }

}
