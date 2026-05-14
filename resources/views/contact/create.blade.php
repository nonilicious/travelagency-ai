<x-layouts.public title="{{ __('Contact') }} · Servizi ITS">
    <div class="split">
        <section class="panel" style="display:grid;gap:18px">
            <div>
                <p class="muted" style="font-weight:800;text-transform:uppercase">{{ __('Travel request') }}</p>
                <h1>{{ __('Tell us what your perfect trip should feel like.') }}</h1>
                <p>{{ __('The assistant turns your wishes into a clear request for the agency. You can edit everything before sending it.') }}</p>
            </div>

            @if (session('status'))
                <div class="item" style="border-color:#b9d8ca;background:#eef8f2;color:#145c3c;font-weight:800">
                    {{ session('status') }}
                </div>
            @endif

            <div class="chat-assistant" data-contact-assistant>
                <div class="chat-log" data-chat-log>
                    <div class="message bot">{{ __('Hi, I can help prepare your travel request. Choose what fits, then send it to the agency.') }}</div>
                </div>
                <div class="quick-options" aria-label="{{ __('Travel ideas') }}">
                    <button type="button" data-destination="Italy coast" data-message="{{ __('We are interested in a relaxed premium trip with beautiful hotels, good food and coastal views.') }}">{{ __('Italy coast') }}</button>
                    <button type="button" data-destination="Japan" data-message="{{ __('We would like a calm culture and food journey with boutique hotels and smooth transfers.') }}">{{ __('Japan') }}</button>
                    <button type="button" data-destination="Spain" data-message="{{ __('We want a sunny city and beach trip with design hotels, restaurants and time to relax.') }}">{{ __('Spain') }}</button>
                    <button type="button" data-destination="Custom" data-message="{{ __('We are open to suggestions and would like the agency to recommend destinations based on our wishes.') }}">{{ __('Surprise us') }}</button>
                </div>
            </div>
        </section>

        <section class="panel">
            <form method="POST" action="{{ route('contact.store') }}">
                @csrf

                <label>
                    {{ __('Name') }}
                    <input name="name" value="{{ old('name') }}" required>
                    @error('name') <span class="error">{{ $message }}</span> @enderror
                </label>

                <label>
                    {{ __('Email') }}
                    <input name="email" type="email" value="{{ old('email') }}" required>
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </label>

                <label>
                    {{ __('Phone') }}
                    <input name="phone" value="{{ old('phone') }}">
                    @error('phone') <span class="error">{{ $message }}</span> @enderror
                </label>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
                    <label>
                        {{ __('Travelers') }}
                        <input name="travelers" type="number" min="1" max="30" value="{{ old('travelers', 2) }}" required>
                        @error('travelers') <span class="error">{{ $message }}</span> @enderror
                    </label>

                    <label>
                        {{ __('Budget') }}
                        <input name="budget" type="number" min="0" step="100" value="{{ old('budget') }}">
                        @error('budget') <span class="error">{{ $message }}</span> @enderror
                    </label>
                </div>

                <label>
                    {{ __('Destination interest') }}
                    <input name="destination_interest" data-destination-input value="{{ old('destination_interest') }}">
                    @error('destination_interest') <span class="error">{{ $message }}</span> @enderror
                </label>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
                    <label>
                        {{ __('Start date') }}
                        <input name="preferred_start_date" type="date" value="{{ old('preferred_start_date') }}">
                        @error('preferred_start_date') <span class="error">{{ $message }}</span> @enderror
                    </label>

                    <label>
                        {{ __('End date') }}
                        <input name="preferred_end_date" type="date" value="{{ old('preferred_end_date') }}">
                        @error('preferred_end_date') <span class="error">{{ $message }}</span> @enderror
                    </label>
                </div>

                <label>
                    {{ __('Message') }}
                    <textarea name="message" data-message-input required>{{ old('message') }}</textarea>
                    @error('message') <span class="error">{{ $message }}</span> @enderror
                </label>

                <button class="button" type="submit">{{ __('Send request') }}</button>
            </form>
        </section>
    </div>

    <script>
        const assistant = document.querySelector('[data-contact-assistant]');
        const log = document.querySelector('[data-chat-log]');
        const destinationInput = document.querySelector('[data-destination-input]');
        const messageInput = document.querySelector('[data-message-input]');

        assistant?.addEventListener('click', (event) => {
            const button = event.target.closest('button[data-message]');

            if (!button) {
                return;
            }

            destinationInput.value = button.dataset.destination;
            messageInput.value = button.dataset.message;
            log.insertAdjacentHTML('beforeend', `<div class="message user">${button.textContent}</div>`);
            log.insertAdjacentHTML('beforeend', `<div class="message bot">{{ __('Great. I prepared a first draft in the form. Add dates, budget and contact details before sending.') }}</div>`);
        });
    </script>
</x-layouts.public>
