<x-layouts.public title="{{ __('Register') }} · Travelcraft AI">
    <div class="split">
        <div>
            <h1>{{ __('Create customer account') }}</h1>
            <p>{{ __('Use the portal for proposals, PDFs and shared itinerary planning.') }}</p>
        </div>
        <div class="panel">
            <form method="POST" action="{{ route('register.store') }}">
                @csrf
                <label>
                    {{ __('Name') }}
                    <input name="name" value="{{ old('name') }}" required autofocus>
                    @error('name') <span class="error">{{ $message }}</span> @enderror
                </label>
                <label>
                    {{ __('Email') }}
                    <input name="email" type="email" value="{{ old('email') }}" required>
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </label>
                <label>
                    {{ __('Password') }}
                    <input name="password" type="password" required>
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </label>
                <label>
                    {{ __('Confirm password') }}
                    <input name="password_confirmation" type="password" required>
                </label>
                <button class="button" type="submit">{{ __('Register') }}</button>
            </form>
        </div>
    </div>
</x-layouts.public>
