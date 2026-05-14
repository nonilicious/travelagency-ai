<?php

namespace App\Http\Controllers;

use App\Mail\CustomerInquiryConfirmation;
use App\Mail\CustomerInquiryReceived;
use App\Models\CustomerInquiry;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactInquiryController extends Controller
{
    public function create(): View
    {
        return view('contact.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:80'],
            'destination_interest' => ['nullable', 'string', 'max:255'],
            'travelers' => ['required', 'integer', 'min:1', 'max:30'],
            'preferred_start_date' => ['nullable', 'date'],
            'preferred_end_date' => ['nullable', 'date', 'after_or_equal:preferred_start_date'],
            'budget' => ['nullable', 'numeric', 'min:0', 'max:999999.99'],
            'message' => ['required', 'string', 'max:6000'],
        ]);

        $inquiry = CustomerInquiry::create($data + ['status' => 'new']);
        $agencyEmail = User::query()->where('role', 'admin')->value('email') ?? config('mail.from.address');

        Mail::to($agencyEmail)->send(new CustomerInquiryReceived($inquiry));
        Mail::to($inquiry->email)->send(new CustomerInquiryConfirmation($inquiry));

        return redirect()
            ->route('contact.create')
            ->with('status', __('Your request has been sent. We will get back to you soon.'));
    }
}
