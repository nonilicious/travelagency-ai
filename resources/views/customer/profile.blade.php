<x-layouts.public title="{{ __('Profile') }} · Travelcraft AI">
    <div class="split">
        <div>
            <h1>{{ __('Profile') }}</h1>
            <p>{{ __('Manage your photo, contact details and personal default language.') }}</p>
            @if ($user->avatar_path)
                <img src="{{ Storage::url($user->avatar_path) }}" alt="{{ $user->name }}" style="width:120px;height:120px;border-radius:999px;object-fit:cover;border:1px solid var(--line);">
            @endif
        </div>
        <div class="panel">
            @if (session('status') === 'profile-updated')
                <p style="color:#0f6b5f;font-weight:800">{{ __('Profile saved.') }}</p>
            @endif

            <form method="POST" action="{{ route('customer.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <label>
                    {{ __('Profile photo') }}
                    <input name="avatar" type="file" accept="image/*">
                    @error('avatar') <span class="error">{{ $message }}</span> @enderror
                </label>

                <label>
                    {{ __('Name') }}
                    <input name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name') <span class="error">{{ $message }}</span> @enderror
                </label>

                <label>
                    {{ __('Email') }}
                    <input name="email" type="email" value="{{ old('email', $user->email) }}" required>
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </label>

                <label>
                    {{ __('Default language') }}
                    <select name="preferred_locale" required style="min-height:48px;border:1px solid var(--line);border-radius:8px;padding:0 14px;font:inherit;background:white">
                        @foreach ($locales as $locale => $label)
                            <option value="{{ $locale }}" @selected(old('preferred_locale', $user->preferred_locale) === $locale)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('preferred_locale') <span class="error">{{ $message }}</span> @enderror
                </label>

                <label>
                    {{ __('Phone') }}
                    <input name="phone" value="{{ old('phone', $user->phone) }}">
                    @error('phone') <span class="error">{{ $message }}</span> @enderror
                </label>

                <label>
                    {{ __('Company') }}
                    <input name="company" value="{{ old('company', $user->company) }}">
                    @error('company') <span class="error">{{ $message }}</span> @enderror
                </label>

                <label>
                    {{ __('Bio') }}
                    <textarea name="bio" rows="4" style="border:1px solid var(--line);border-radius:8px;padding:14px;font:inherit">{{ old('bio', $user->bio) }}</textarea>
                    @error('bio') <span class="error">{{ $message }}</span> @enderror
                </label>

                <label>
                    {{ __('New password') }}
                    <input name="password" type="password">
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </label>

                <label>
                    {{ __('Confirm password') }}
                    <input name="password_confirmation" type="password">
                </label>

                <button class="button" type="submit">{{ __('Save profile') }}</button>
            </form>
        </div>
    </div>
</x-layouts.public>
