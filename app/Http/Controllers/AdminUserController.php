<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->paginate(10);

        return view('admin.users.index',[
            'users' => $users,
        ]);
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

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
