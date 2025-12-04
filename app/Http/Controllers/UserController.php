<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of users with role 'user'.
     */
    public function index()
    {
        $users = User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.users', compact('users'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        // Only allow editing users with role 'user'
        if ($user->role !== 'user') {
            abort(403, 'Tidak dapat mengedit admin');
        }

        return view('admin.users-edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        // Only allow editing users with role 'user'
        if ($user->role !== 'user') {
            abort(403, 'Tidak dapat mengedit admin');
        }

        $rules = [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|min:8|confirmed',
        ];

        $validated = $request->validate($rules);

        // Update user data
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->address = $validated['address'];
        $user->phone = $validated['phone'];

        // Update password only if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
            
            // Log password change
            ActivityLog::create([
                'type' => 'system',
                'action' => 'update_password',
                'message' => 'Password user ' . $user->name . ' telah diubah oleh admin',
                'icon' => 'bi-shield-lock-fill',
                'related_id' => $user->id,
                'related_type' => 'user',
            ]);
        }

        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'Data user berhasil diperbarui');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Only allow deleting users with role 'user'
        if ($user->role !== 'user') {
            abort(403, 'Tidak dapat menghapus admin');
        }

        $userName = $user->name;
        $user->delete();

        // Log user deletion
        ActivityLog::create([
            'type' => 'system',
            'action' => 'delete_user',
            'message' => 'User ' . $userName . ' telah dihapus dari sistem',
            'icon' => 'bi-person-x-fill',
            'related_id' => null,
            'related_type' => 'user',
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus');
    }
}
