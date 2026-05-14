<x-layouts.public title="{{ __('Customer Login') }} · Travelcraft AI">
    <div class="split">
        <div>
            <h1>{{ __('Customer login') }}</h1>
            <p>{{ __('Access your travel documents, itinerary drafts and trip notes.') }}</p>
        </div>
        <div class="panel">
            <form method="POST" action="{{ route('login.store') }}">
                @csrf
                <label>
                    {{ __('Email') }}
                    <input name="email" type="email" value="{{ old('email') }}" required autofocus>
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </label>
                <label>
                    {{ __('Password') }}
                    <input name="password" type="password" required>
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </label>
                <label style="display:flex;align-items:center;gap:10px;font-weight:600">
                    <input name="remember" type="checkbox" value="1" style="width:auto;min-height:auto">
                    {{ __('Remember me') }}
                </label>
                <button class="button" type="submit">{{ __('Login') }}</button>
                <p>{{ __('No account yet?') }} <a href="{{ route('register') }}">{{ __('Create one') }}</a></p>
            </form>
        </div>
    </div>
</x-layouts.public>
