<x-layouts.public title="{{ $destination->name }} · Travelcraft AI">
    <article style="display:grid;gap:34px">
        <header class="panel" style="display:grid;grid-template-columns:1fr .75fr;gap:28px;align-items:center">
            <div>
                <a class="muted" href="{{ route('destinations.index') }}">{{ __('All destinations') }}</a>
                <p class="muted" style="font-weight:800;text-transform:uppercase;margin-top:24px">
                    {{ $destination->country }}{{ $destination->region ? ' · '.$destination->region : '' }}
                </p>
                <h1>{{ $destination->name }}</h1>
                <p style="font-size:20px">{{ $destination->summary }}</p>
                <div style="display:flex;flex-wrap:wrap;gap:12px;margin-top:22px">
                    <a class="button" href="#packages">{{ __('View matching packages') }}</a>
                    <a class="button secondary" href="{{ route('login') }}">{{ __('Plan a custom trip') }}</a>
                </div>
            </div>
            @if ($destination->imageUrl())
                <img src="{{ $destination->imageUrl() }}" alt="{{ $destination->name }}" style="width:100%;aspect-ratio:4/3;object-fit:cover;border-radius:8px">
            @endif
        </header>

        @if ($destination->galleryImageUrls())
            <section style="display:grid;gap:16px">
                <h2>{{ __('Gallery') }}</h2>
                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px">
                    @foreach ($destination->galleryImageUrls() as $imageUrl)
                        <img src="{{ $imageUrl }}" alt="{{ $destination->name }}" style="width:100%;aspect-ratio:4/3;object-fit:cover;border-radius:8px;border:1px solid var(--line)">
                    @endforeach
                </div>
            </section>
        @endif

        <div class="split">
            <section class="panel" style="font-size:17px;line-height:1.8">
                <h2>{{ __('About this destination') }}</h2>
                {!! $destination->description ?: '<p>'.$destination->summary.'</p>' !!}
            </section>

            <aside class="list">
                <section class="panel">
                    <h2>{{ __('What to do') }}</h2>
                    @if ($destination->highlights)
                        <div style="display:grid;gap:10px">
                            @foreach ($destination->highlights as $highlight)
                                <div class="item">{{ $highlight }}</div>
                            @endforeach
                        </div>
                    @else
                        <p>{{ __('Activities will be added soon.') }}</p>
                    @endif
                </section>
            </aside>
        </div>

        <section id="packages" style="display:grid;gap:16px">
            <h2>{{ __('Matching packages') }}</h2>
            @if ($destination->travelPackages->where('is_published', true)->isNotEmpty())
                <div class="list">
                    @foreach ($destination->travelPackages->where('is_published', true) as $package)
                        <a class="item" href="{{ route('packages.show', $package) }}">
                            <strong>{{ $package->title }}</strong>
                            <p>{{ $package->teaser }}</p>
                            <span class="muted">{{ $package->duration_days }} {{ __('days') }} · {{ __('From') }} {{ number_format((float) $package->price_from, 0, ',', '.') }} {{ $package->currency }}</span>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="panel">
                    <p>{{ __('No packages connected yet.') }}</p>
                </div>
            @endif
        </section>

        @if ($relatedDestinations->isNotEmpty())
            <section style="display:grid;gap:16px">
                <h2>{{ __('More destinations') }}</h2>
                <div class="list">
                    @foreach ($relatedDestinations as $relatedDestination)
                        <a class="item" href="{{ route('destinations.show', $relatedDestination) }}">
                            <strong>{{ $relatedDestination->name }}</strong>
                            <p>{{ $relatedDestination->summary }}</p>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </article>
</x-layouts.public>
