<x-layouts.public title="{{ __('Destinations') }} · Servizi ITS">
    <div style="display:grid;gap:28px">
        <div>
            <p class="muted" style="font-weight:800;text-transform:uppercase">{{ __('Destination guide') }}</p>
            <h1>{{ __('Destinations') }}</h1>
            <p>{{ __('Explore curated places, highlights and travel ideas before choosing a package.') }}</p>
        </div>

        <div class="list">
            @forelse ($destinations as $destination)
            <article class="item" style="display:grid;grid-template-columns:260px 1fr;gap:22px;align-items:stretch">
                @if ($destination->imageUrl())
                <img src="{{ $destination->imageUrl() }}" alt="{{ $destination->name }}" style="width:100%;height:180px;object-fit:cover;border-radius:8px">
                @else
                <div style="height:180px;border-radius:8px;background:#d9eef1"></div>
                @endif
                <div>
                    <p class="muted">{{ $destination->country }}{{ $destination->region ? ' · '.$destination->region : '' }}</p>
                    <h2><a href="{{ route('destinations.show', $destination) }}">{{ $destination->name }}</a></h2>
                    <p>{{ $destination->summary }}</p>
                    <a class="button secondary" href="{{ route('destinations.show', $destination) }}">{{ __('Explore destination') }}</a>
                </div>
            </article>
            @empty
            <div class="panel">
                <h2>{{ __('No destinations yet') }}</h2>
                <p>{{ __('Create published destinations in the admin panel and they will appear here.') }}</p>
            </div>
            @endforelse
        </div>
    </div>
</x-layouts.public>