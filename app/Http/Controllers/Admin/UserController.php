<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required|in:admin,teacher,student',
            'password' => 'nullable|min:6',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        ActionLog::create([
            'admin_id' => auth()->id(),
            'target_user_id' => $user->id,
            'action' => "Updated user {$user->email} (role: {$user->role})",
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        $email = $user->email;
        $user->delete();

        ActionLog::create([
            'admin_id' => auth()->id(),
            'target_user_id' => null,
            'action' => "Deleted user {$email}",
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User deleted!');
    }
}
