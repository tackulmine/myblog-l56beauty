<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactMeRequest;
use App\Mail\ContactReceived;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show the form
     *
     * @return View
     */
    public function showForm()
    {
        return view('blog.contact');
    }

    /**
     * Email the contact request
     *
     * @param ContactMeRequest $request
     * @return Redirect
     */
    public function sendContactInfo(ContactMeRequest $request)
    {
        $data = $request->only('name', 'email', 'phone');
        $data['messageLines'] = explode("\n", $request->get('message'));

        // \Mail::send('emails.contact', $data, function ($message) use ($data) {
        // Mail::queue('emails.contact', $data, function ($message) use ($data) {
        //     $message->subject('Blog Contact Form: ' . $data['name'])
        //         ->to(config('blog.contact_email'))
        //         ->replyTo($data['email']);
        // });
        \Mail::to(config('blog.contact_email'))
                ->send(new ContactReceived($data));
                // ->queue(new ContactReceived($data));

        return back()
            ->withSuccess("Thank you for your message. It has been sent.");
    }
}
