<?php

namespace App\Http\Controllers\Reporter\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class ReporterVerificationController extends Controller
{
    public function notice()
    {
        return view('reporter.auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('reporter.dashboard')->with('success', 'Your email has been verified!');
    }

    public function resend(Request $request)
    {
        $request->user('reporter')->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
