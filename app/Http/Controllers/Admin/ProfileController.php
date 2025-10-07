<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    /**
     * Show the admin profile edit form
     */
    public function edit()
    {
        return view('admin.profile-edit-tutor', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Update the admin profile
     */
    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'current_password' => ['nullable', 'required_with:password'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        // Verify current password if changing password
        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Update password if provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->fill($data);
        $user->save();

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Show admin profile details
     */
    public function show()
    {
        return view('admin.profile-tutor', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Update cover photo
     */
    public function updateCover(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'cover_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
        ]);

        try {
            // Delete old cover photo if exists
            if ($user->cover_photo && Storage::disk('public')->exists($user->cover_photo)) {
                Storage::disk('public')->delete($user->cover_photo);
            }

            // Store new cover photo
            $path = $request->file('cover_photo')->store('covers', 'public');
            $user->cover_photo = $path;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Cover photo updated successfully!',
                'cover_url' => Storage::url($path)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating cover photo: ' . $e->getMessage()
            ], 500);
        }
    }
}
