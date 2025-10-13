<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('instructor.profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('instructor.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string|max:500',
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $data = $request->only([
            'name', 'email', 'phone', 'date_of_birth', 'gender', 'address', 'bio'
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $avatar = $request->file('avatar');
            $avatarName = 'avatar-' . $user->id . '-' . time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = $avatar->storeAs('avatars', $avatarName, 'public');
            $data['avatar'] = $avatarPath;
        }

        // Handle password change
        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
            }
            $data['password'] = Hash::make($request->password);
        }

        try {
            // Update user data using DB::table for better compatibility
            DB::table('users')
                ->where('id', $user->id)
                ->update($data);

            return redirect()->route('instructor.profile.show')
                ->with('success', 'Profil berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal memperbarui profil: ' . $e->getMessage()]);
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        /** @var User $user */
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        try {
            DB::table('users')
                ->where('id', $user->id)
                ->update(['password' => Hash::make($request->password)]);

            return redirect()->route('instructor.profile.show')
                ->with('success', 'Password berhasil diubah!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengubah password: ' . $e->getMessage()]);
        }
    }

    public function deleteAvatar()
    {
        /** @var User $user */
        $user = Auth::user();

        try {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            DB::table('users')
                ->where('id', $user->id)
                ->update(['avatar' => null]);

            return redirect()->route('instructor.profile.show')
                ->with('success', 'Avatar berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus avatar: ' . $e->getMessage()]);
        }
    }

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
            
            DB::table('users')
                ->where('id', $user->id)
                ->update(['cover_photo' => $path]);

            return response()->json([
                'success' => true,
                'message' => 'Cover photo updated successfully!',
                'cover_url' => asset('storage/' . $path)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating cover photo: ' . $e->getMessage()
            ], 500);
        }
    }
}