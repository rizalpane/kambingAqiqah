<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        return view('login');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
            
            return redirect()->intended('/user/dashboard');
        }

        return redirect()->back()
            ->withErrors(['email' => 'Email atau password tidak valid'])
            ->withInput();
    }

    /**
     * Show register form
     */
    public function showRegister()
    {
        return view('register');
    }

    /**
     * Handle register
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user', // Default role adalah user
            ]);

            // Auto login setelah register
            Auth::login($user);
            
            return redirect()->intended('/user/dashboard');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Gagal membuat akun'])
                ->withInput();
        }
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }

    /**
     * Show editable profile form
     */
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    /**
     * Update user profile, including avatar and password
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|min:8|confirmed',
        ];

        $request->validate($rules);

        // Handle password change
        if ($request->filled('new_password')) {
            if (!\Illuminate\Support\Facades\Hash::check($request->input('current_password', ''), $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Password saat ini tidak cocok.'])->withInput();
            }
            $user->password = \Illuminate\Support\Facades\Hash::make($request->new_password);
        }

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $path = $file->store('avatars', 'public');

            // delete old avatar if exists
            if ($user->avatar) {
                try {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($user->avatar);
                } catch (\Exception $e) {
                    // ignore
                }
            }

            $user->avatar = $path;
        }

        // Update other fields
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
