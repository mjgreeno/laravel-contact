<?php

namespace App\Http\Controllers;

use App\Inquires;
use App\Mail\InquiryNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function submit(Request $request): JsonResponse
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/',
            'inquiry' => 'required',
        ]);
        // we have a valid response lets save it
        Inquires::create($request->all());
        // lets send it to our mailer
        Mail::to($request->email)->send(new InquiryNotification($request->all()));
       // did this response to send a custom message
        return response()->json('data sent', 200);
    }
}
