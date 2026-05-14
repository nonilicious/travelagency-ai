<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class CustomerProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('customer.profile', [
            'user' => $request->user(),
            'locales' => config('app.supported_locales'),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$request->user()->id],
            'preferred_locale' => ['required', 'string', 'in:'.implode(',', array_keys(config('app.supported_locales')))],
            'phone' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:2000'],
            'avatar' => ['nullable', 'image', 'max:2048'],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        if ($request->hasFile('avatar')) {
            $data['avatar_path'] = $request->file('avatar')->store('avatars', 'public');
        }

        if (filled($data['password'] ?? null)) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        unset($data['avatar'], $data['password_confirmation']);

        $request->user()->update($data);
        session(['locale' => $data['preferred_locale']]);

        return back()->with('status', 'profile-updated');
    }
}
