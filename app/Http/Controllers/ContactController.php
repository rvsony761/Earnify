<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function showcontact()
    {
        return view("layouts.contact");
    }
    public function sendmail(Request $request)
    { 
        $rules=$request->validate(
            [
                "name"=> "required|string|max:255",
                "email"=> "required|email",
                'message' => 'required|string',
            ]
            );
        #return $rules;
        Mail::to('rvsony761@gmail.com')->send(new ContactMail($rules));
        return redirect()->back()->with('success','Your Enquiry send Successfully');
    }
}
