<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's basic profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Upload or change user avatar.
     */
    public function uploadAvatar(Request $request): RedirectResponse
{
    $request->validate([
        'avatar' => 'required|image|max:2048'
    ]);

    $user = Auth::user();

    // Delete old avatar from storage
    if ($user->avatar && \Storage::disk('public')->exists('avatars/' . $user->avatar)) {
        \Storage::disk('public')->delete('avatars/' . $user->avatar);
    }

    // Save new avatar to storage/app/public/avatars
    $filename = time() . '.' . $request->avatar->extension();
    $request->avatar->storeAs('avatars', $filename, 'public');

    // Update user
    $user->avatar = $filename;
    $user->save();

    return back()->with('status', 'avatar-updated');
}


    /**
     * Delete user avatar.
     */
    public function deleteAvatar(Request $request): RedirectResponse
{
    $user = Auth::user();

    if ($user->avatar && \Storage::disk('public')->exists('avatars/' . $user->avatar)) {
        \Storage::disk('public')->delete('avatars/' . $user->avatar);
    }

    $user->avatar = null;
    $user->save();

    return back()->with('status', 'avatar-deleted');
}


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
