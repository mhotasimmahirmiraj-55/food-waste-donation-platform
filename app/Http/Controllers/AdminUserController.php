<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    /**
     * Display users.
     *
     * Supports filtering by:
     * - role_id
     * - status
     */
    public function index(Request $request)
    {
        $query = User::with('role');

        // Filter by role
        if ($request->filled('role_id')) {
            $query->where('role_id', $request->role_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $users = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', [
            'users' => $users,
        ]);
    }


    /**
     * Show edit form.
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }


    /**
     * Update user's role.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update([
            'role_id' => $request->role_id,
        ]);

        return redirect()
            ->route('admin.users')
            ->with('success', 'User role updated successfully.');
    }


    /**
     * Toggle user's active/blocked status.
     */
    public function toggleStatus(User $user)
    {
        // Prevent an admin from blocking themselves
        if ($user->id === Auth::id()) {
            return redirect()
                ->route('admin.users')
                ->with('error', 'You cannot block your own account.');
        }

        $user->status = $user->status === 'active'
            ? 'blocked'
            : 'active';

        $user->save();

        return redirect()
            ->route('admin.users')
            ->with('success', 'User status updated successfully.');
    }
}