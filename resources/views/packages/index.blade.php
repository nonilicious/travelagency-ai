<x-layouts.public title="{{ __('Packages') }} · Servizi ITS">
    <div style="display:grid;gap:28px">
        <div>
            <p class="muted" style="font-weight:800;text-transform:uppercase">{{ __('Travel packages') }}</p>
            <h1>{{ __('Packages') }}</h1>
            <p>{{ __('Curated journeys with duration, budget guidance, services and destination context.') }}</p>
        </div>

        <div class="list">
            @forelse ($packages as $package)
            <article class="item" style="display:grid;grid-template-columns:260px 1fr;gap:22px;align-items:stretch">
                @if ($package->imageUrl())
                <img src="{{ $package->imageUrl() }}" alt="{{ $package->title }}" style="width:100%;height:180px;object-fit:cover;border-radius:8px">
                @else
                <div style="height:180px;border-radius:8px;background:#d9eef1"></div>
                @endif
                <div>
                    <p class="muted">{{ $package->destination?->name }} · {{ $package->duration_days }} {{ __('days') }}</p>
                    <h2><a href="{{ route('packages.show', $package) }}">{{ $package->title }}</a></h2>
                    <p>{{ $package->teaser }}</p>
                    <strong>{{ __('From') }} {{ number_format((float) $package->price_from, 0, ',', '.') }} {{ $package->currency }}</strong>
                    <p><a class="button secondary" href="{{ route('packages.show', $package) }}">{{ __('View package') }}</a></p>
                </div>
            </article>
            @empty
            <div class="panel">
                <h2>{{ __('No packages yet') }}</h2>
                <p>{{ __('Create published travel packages in the admin panel and they will appear here.') }}</p>
            </div>
            @endforelse
        </div>
    </div>
</x-layouts.public>