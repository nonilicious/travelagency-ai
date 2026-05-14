<x-layouts.public title="{{ $package->title }} · Servizi ITS">
    <article style="display:grid;gap:30px">
        <header class="panel" style="display:grid;grid-template-columns:1fr .75fr;gap:28px;align-items:center">
            <div>
                <a class="muted" href="{{ route('packages.index') }}">{{ __('All packages') }}</a>
                <p class="muted" style="font-weight:800;text-transform:uppercase;margin-top:24px">
                    {{ $package->destination?->name }} · {{ $package->destination?->country }}
                </p>
                <h1>{{ $package->title }}</h1>
                <p style="font-size:20px">{{ $package->teaser }}</p>
                <div style="display:flex;flex-wrap:wrap;gap:12px;margin-top:22px">
                    <span class="button secondary">{{ $package->duration_days }} {{ __('days') }}</span>
                    <span class="button secondary">{{ __('From') }} {{ number_format((float) $package->price_from, 0, ',', '.') }} {{ $package->currency }}</span>
                </div>
            </div>
            @if ($package->imageUrl())
            <img src="{{ $package->imageUrl() }}" alt="{{ $package->title }}" style="width:100%;aspect-ratio:4/3;object-fit:cover;border-radius:8px">
            @endif
        </header>

        <div class="split">
            <section class="panel" style="font-size:17px;line-height:1.8">
                <h2>{{ __('About this journey') }}</h2>
                {!! $package->description ?: '<p>'.$package->teaser.'</p>' !!}
            </section>

            <aside class="list">
                <section class="panel">
                    <h2>{{ __('Included services') }}</h2>
                    @if ($package->included_services)
                    <div style="display:grid;gap:10px">
                        @foreach ($package->included_services as $service)
                        <div class="item">{{ $service }}</div>
                        @endforeach
                    </div>
                    @else
                    <p>{{ __('Services will be added soon.') }}</p>
                    @endif
                </section>

                <section class="panel">
                    <h2>{{ __('Travel style') }}</h2>
                    @if ($package->travel_styles)
                    <div style="display:flex;flex-wrap:wrap;gap:10px">
                        @foreach ($package->travel_styles as $style)
                        <span class="button secondary">{{ $style }}</span>
                        @endforeach
                    </div>
                    @else
                    <p>{{ __('Travel styles will be added soon.') }}</p>
                    @endif
                </section>
            </aside>
        </div>

        @if ($relatedPackages->isNotEmpty())
        <section style="display:grid;gap:16px">
            <h2>{{ __('More packages') }}</h2>
            <div class="list">
                @foreach ($relatedPackages as $relatedPackage)
                <a class="item" href="{{ route('packages.show', $relatedPackage) }}">
                    <strong>{{ $relatedPackage->title }}</strong>
                    <p>{{ $relatedPackage->teaser }}</p>
                </a>
                @endforeach
            </div>
        </section>
        @endif
    </article>
</x-layouts.public>