<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\ResetPasswordMail;
use Carbon\Carbon;

class PasswordResetController extends Controller
{
    /**
     * Show forgot password form
     */
    public function showForgotForm()
    {
        return view('forgot');
    }

    /**
     * Send reset password link to email
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.exists' => 'Email tidak terdaftar dalam sistem'
        ]);

        // Generate token
        $token = Str::random(64);

        // Delete old tokens for this email
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Insert new token
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        // Get user
        $user = User::where('email', $request->email)->first();

        // Send email
        try {
            Mail::to($request->email)->send(new ResetPasswordMail($token, $user));
            
            return back()->with('success', 'Link reset password telah dikirim ke email Anda. Silakan cek inbox atau folder spam.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }

    /**
     * Show reset password form
     */
    public function showResetForm($token)
    {
        // Verify token exists and not expired (1 hour)
        $tokenData = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->first();

        if (!$tokenData) {
            return redirect()->route('auth.login')->with('error', 'Token reset password tidak valid.');
        }

        // Check if token expired (1 hour = 60 minutes)
        $createdAt = Carbon::parse($tokenData->created_at);
        if ($createdAt->addHour()->isPast()) {
            DB::table('password_reset_tokens')->where('token', $token)->delete();
            return redirect()->route('auth.login')->with('error', 'Token reset password telah kadaluarsa. Silakan request ulang.');
        }

        return view('reset-password', ['token' => $token, 'email' => $tokenData->email]);
    }

    /**
     * Process reset password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ], [
            'email.required' => 'Email harus diisi',
            'email.exists' => 'Email tidak terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok'
        ]);

        // Verify token
        $tokenData = DB::table('password_reset_tokens')
            ->where('token', $request->token)
            ->where('email', $request->email)
            ->first();

        if (!$tokenData) {
            return back()->with('error', 'Token tidak valid atau email tidak cocok.');
        }

        // Check expiration
        $createdAt = Carbon::parse($tokenData->created_at);
        if ($createdAt->addHour()->isPast()) {
            DB::table('password_reset_tokens')->where('token', $request->token)->delete();
            return back()->with('error', 'Token telah kadaluarsa. Silakan request ulang.');
        }

        // Update password
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('auth.login')->with('success', 'Password berhasil direset! Silakan login dengan password baru.');
    }
}
