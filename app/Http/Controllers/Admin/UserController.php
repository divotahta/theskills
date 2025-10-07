<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Role filter
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('email', 'like', "%{$searchTerm}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            if ($request->status === 'verified') {
                $query->whereNotNull('email_verified_at');
            } elseif ($request->status === 'unverified') {
                $query->whereNull('email_verified_at');
            }
        }

        $users = $query->withCount(['enrollments', 'courses'])->latest()->paginate(15);
        $userStats = [
            'total' => User::count(),
            'students' => User::where('role', 'student')->count(),
            'instructors' => User::where('role', 'instructor')->count(),
            'admins' => User::where('role', 'admin')->count(),
        ];

        return view('admin.users-tutor', compact('users', 'userStats'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        return view('admin.users-create-tutor');
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:student,instructor,admin',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'skill' => 'nullable|string|max:255',
            'display_name' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['email_verified_at'] = now(); // Auto verify for admin created users

        User::create($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully!');
    }

    /**
     * Display the specified user
     */
    public function show(User $user)
    {
        $user->loadCount(['enrollments', 'courses']);
        return view('admin.users-show-tutor', compact('user'));
    }

    /**
     * Show the form for editing the user
     */
    public function edit(User $user)
    {
        return view('admin.users-edit-tutor', compact('user'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id)
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:student,instructor,admin',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'skill' => 'nullable|string|max:255',
            'display_name' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string',
        ]);

        $data = $request->except('password');
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user
     */
    public function destroy(User $user)
    {
        // Prevent admin from deleting themselves
        if ($user->id === Auth::user()->id) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account!');
        }

        // Check if user has courses or enrollments
        if ($user->courses()->count() > 0 || $user->enrollments()->count() > 0) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Cannot delete user that has courses or enrollments. Please handle them first.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully!');
    }

    /**
     * Toggle user verification status
     */
    public function toggleVerification(User $user)
    {
        $user->update([
            'email_verified_at' => $user->email_verified_at ? null : now()
        ]);

        $status = $user->email_verified_at ? 'verified' : 'unverified';
        return redirect()->route('admin.users.index')
            ->with('success', "User {$status} successfully!");
    }

    /**
     * Show students only
     */
    public function students(Request $request)
    {
        $request->merge(['role' => 'student']);
        return $this->index($request);
    }

    /**
     * Show instructors only
     */
    public function instructors(Request $request)
    {
        $request->merge(['role' => 'instructor']);
        return $this->index($request);
    }
}
