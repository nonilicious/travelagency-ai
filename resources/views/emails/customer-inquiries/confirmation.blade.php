<h1>{{ __('We received your travel request') }}</h1>

<p>{{ __('Thank you, :name. The agency received your request and will contact you soon.', ['name' => $inquiry->name]) }}</p>

<h2>{{ __('Your request') }}</h2>
<p><strong>{{ __('Destination interest') }}:</strong> {{ $inquiry->destination_interest ?: '-' }}</p>
<p><strong>{{ __('Travelers') }}:</strong> {{ $inquiry->travelers }}</p>
<p><strong>{{ __('Message') }}:</strong> {{ $inquiry->message }}</p>
