<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Show the instructor profile edit form.
     */
    public function edit()
    {
        return view('instructor.profile.edit', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Update the instructor's profile.
     */
    public function update(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'skill' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'display_name' => ['required', 'string', 'max:255'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'cover_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $user = Auth::user();
        $data = $request->only(['first_name', 'last_name', 'phone', 'skill', 'bio', 'display_name']);

        try {
            // Handle profile photo
            if ($request->hasFile('profile_photo')) {
                $file = $request->file('profile_photo');
                if ($file->isValid()) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $path = $file->move(public_path('storage/profile-photos'), $fileName);
                    if ($path) {
                        $data['profile_photo'] = 'profile-photos/' . $fileName;
                    }
                }
            }

            // Handle cover photo
            if ($request->hasFile('cover_photo')) {
                $file = $request->file('cover_photo');
                if ($file->isValid()) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $path = $file->move(public_path('storage/cover-photos'), $fileName);
                    if ($path) {
                        $data['cover_photo'] = 'cover-photos/' . $fileName;
                    }
                }
            }

            DB::table('users')
                ->where('id', $user->id)
                ->update($data);

            return back()->with('status', 'Profile updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update profile: ' . $e->getMessage());
        }
    }
}
