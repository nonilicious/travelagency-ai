<x-layouts.public title="{{ __('Dashboard') }} · Travelcraft AI">
    <div class="split">
        <div>
            <h1>{{ __('Your travel desk') }}</h1>
            <p>{{ __('Welcome back, :name. This area will collect documents, itineraries and booking notes.', ['name' => auth()->user()->name]) }}</p>
            <p><a class="button secondary" href="{{ route('customer.profile.edit') }}">{{ __('Edit profile') }}</a></p>
        </div>
        <div class="list">
            <section class="panel">
                <h2>{{ __('Documents') }}</h2>
                @forelse ($documents as $document)
                    <div class="item">
                        <strong>{{ $document->title }}</strong>
                        <p>{{ $document->description }}</p>
                    </div>
                @empty
                    <p>{{ __('No documents assigned yet.') }}</p>
                @endforelse
            </section>

            <section class="panel">
                <h2>{{ __('Itineraries') }}</h2>
                @forelse ($itineraries as $itinerary)
                    <div class="item">
                        <strong>{{ $itinerary->title }}</strong>
                        <p>{{ $itinerary->summary ?: __('Draft itinerary in progress.') }}</p>
                        <span class="muted">{{ ucfirst($itinerary->status) }}</span>
                    </div>
                @empty
                    <p>{{ __('No itineraries assigned yet.') }}</p>
                @endforelse
            </section>
        </div>
    </div>
</x-layouts.public>
