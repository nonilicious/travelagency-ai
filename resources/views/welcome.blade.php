<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Travelcraft AI</title>
    <style>
        :root {
            color-scheme: light;
            --ink: #17211f;
            --muted: #61716d;
            --line: #dce5df;
            --paper: #f7faf7;
            --white: #ffffff;
            --jade: #0f6b5f;
            --coral: #d9604a;
            --gold: #b78a33;
            --sky: #d9eef1;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--paper);
            color: var(--ink);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            letter-spacing: 0;
        }

        a,
        button,
        summary,
        [role="button"],
        .button,
        .card-link {
            cursor: pointer;
        }

        a { color: inherit; text-decoration: none; }

        .shell {
            width: min(1180px, calc(100% - 32px));
            margin: 0 auto;
        }

        .nav {
            position: sticky;
            top: 0;
            z-index: 10;
            border-bottom: 1px solid rgba(23, 33, 31, .08);
            background: rgba(247, 250, 247, .88);
            backdrop-filter: blur(18px);
        }

        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 72px;
            gap: 24px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            font-size: 19px;
        }

        .brand-mark {
            display: grid;
            place-items: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--ink);
            color: white;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 18px;
            color: var(--muted);
            font-size: 14px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0 18px;
            border-radius: 999px;
            border: 1px solid var(--ink);
            background: var(--ink);
            color: white;
            font-weight: 700;
        }

        .button.secondary {
            background: transparent;
            color: var(--ink);
        }

        .language-switch {
            position: relative;
        }

        .language-switch summary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 40px;
            padding: 0 12px;
            border: 1px solid var(--line);
            border-radius: 999px;
            background: rgba(255, 255, 255, .72);
            color: var(--ink);
            cursor: pointer;
            list-style: none;
            font-weight: 800;
        }

        .language-switch summary::-webkit-details-marker { display: none; }
        .language-switch svg { width: 17px; height: 17px; }

        .language-menu {
            position: absolute;
            right: 0;
            top: calc(100% + 8px);
            display: grid;
            min-width: 92px;
            padding: 8px;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: white;
            box-shadow: 0 18px 50px rgba(23, 33, 31, .14);
        }

        .language-menu a {
            padding: 9px 10px;
            border-radius: 6px;
            color: var(--muted);
            font-weight: 700;
        }

        .language-menu a.active {
            background: var(--paper);
            color: var(--jade);
        }

        .hero {
            min-height: calc(100vh - 72px);
            display: grid;
            align-items: center;
            padding: 54px 0 36px;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.02fr) minmax(340px, .78fr);
            gap: 42px;
            align-items: center;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--jade);
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
        }

        h1 {
            margin: 18px 0 20px;
            max-width: 820px;
            font-size: clamp(48px, 7vw, 92px);
            line-height: .95;
            letter-spacing: 0;
        }

        .lead {
            max-width: 680px;
            color: var(--muted);
            font-size: 20px;
            line-height: 1.7;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 30px;
        }

        .hero-panel {
            overflow: hidden;
            min-height: 560px;
            border: 1px solid var(--line);
            border-radius: 8px;
            background:
                linear-gradient(135deg, rgba(15,107,95,.28), rgba(217,96,74,.16)),
                url('{{ $settings->imageUrl('hero_image_path') }}') center/cover;
            position: relative;
        }

        .panel-strip {
            position: absolute;
            left: 22px;
            right: 22px;
            bottom: 22px;
            display: grid;
            gap: 10px;
            padding: 18px;
            border-radius: 8px;
            background: rgba(255, 255, 255, .88);
            backdrop-filter: blur(14px);
        }

        .panel-strip strong { font-size: 18px; }
        .panel-strip span { color: var(--muted); line-height: 1.5; }

        .metrics {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-top: 44px;
            max-width: 760px;
        }

        .metric {
            border-top: 1px solid var(--line);
            padding-top: 16px;
        }

        .metric strong {
            display: block;
            font-size: 28px;
            color: var(--jade);
        }

        .metric span {
            color: var(--muted);
            font-size: 14px;
        }

        section {
            padding: 76px 0;
            border-top: 1px solid var(--line);
        }

        .section-head {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 28px;
        }

        h2 {
            margin: 0;
            max-width: 720px;
            font-size: clamp(34px, 4vw, 58px);
            line-height: 1.02;
        }

        .section-head p {
            max-width: 390px;
            margin: 0;
            color: var(--muted);
            line-height: 1.6;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .card {
            overflow: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100%;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: var(--white);
        }

        .card-link {
            color: inherit;
            transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
        }

        .card-link:hover {
            transform: translateY(-2px);
            border-color: rgba(15, 107, 95, .42);
            box-shadow: 0 18px 42px rgba(23, 33, 31, .12);
        }

        .card-image {
            position: relative;
            aspect-ratio: 16 / 11;
            width: 100%;
            background: var(--sky);
            flex: 0 0 auto;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
        }

        .card-image .tag {
            position: absolute;
            left: 16px;
            top: 16px;
            padding: 8px 10px;
            border-radius: 999px;
            background: rgba(255, 255, 255, .9);
            backdrop-filter: blur(10px);
        }

        .card-body {
            display: flex;
            flex: 1;
            flex-direction: column;
            padding: 24px;
        }

        .card .tag {
            color: var(--coral);
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .card h3 {
            margin: 14px 0 12px;
            font-size: 25px;
        }

        .card p {
            color: var(--muted);
            line-height: 1.65;
        }

        .price {
            margin-top: auto;
            padding-top: 22px;
            color: var(--jade);
            font-weight: 800;
        }

        .assistant-band {
            background: var(--ink);
            color: white;
        }

        .assistant-band p { color: #c9d8d4; }

        .assistant-grid {
            display: grid;
            grid-template-columns: .9fr 1.1fr;
            gap: 36px;
            align-items: center;
        }

        .assistant-box {
            border: 1px solid rgba(255,255,255,.16);
            border-radius: 8px;
            background: rgba(255,255,255,.06);
            padding: 24px;
        }

        .prompt {
            border-left: 3px solid var(--gold);
            padding-left: 16px;
            color: #eef5f3;
            line-height: 1.65;
        }

        footer {
            padding: 34px 0;
            color: var(--muted);
        }

        @media (max-width: 860px) {
            .nav-links { display: none; }
            .hero-grid,
            .assistant-grid,
            .grid {
                grid-template-columns: 1fr;
            }

            .hero { padding-top: 34px; }
            .hero-panel { min-height: 380px; }
            .metrics { grid-template-columns: 1fr; }
            .section-head { align-items: start; flex-direction: column; }
        }
    </style>
</head>
<body>
    <nav class="nav">
        <div class="shell nav-inner">
            <a href="/" class="brand" aria-label="Travelcraft AI Startseite">
                <span class="brand-mark">TA</span>
                <span>Travelcraft AI</span>
            </a>
            <div class="nav-links" aria-label="Hauptnavigation">
                <a href="{{ route('destinations.index') }}">{{ __('Destinations') }}</a>
                <a href="{{ route('packages.index') }}">{{ __('Packages') }}</a>
                <a href="{{ route('posts.index') }}">{{ __('Posts') }}</a>
                <a href="#assistant">{{ __('AI Assistant') }}</a>
                <a href="/admin" class="button secondary">{{ __('Admin') }}</a>
                @auth
                    <a href="{{ route('customer.dashboard') }}" class="button secondary">{{ __('Dashboard') }}</a>
                @else
                    <a href="{{ route('login') }}" class="button secondary">{{ __('Customer Login') }}</a>
                @endauth
                <details class="language-switch">
                    <summary aria-label="Language">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <circle cx="12" cy="12" r="9"></circle>
                            <path d="M3 12h18M12 3c2.3 2.6 3.5 5.6 3.5 9S14.3 18.4 12 21M12 3C9.7 5.6 8.5 8.6 8.5 12S9.7 18.4 12 21"></path>
                        </svg>
                        {{ strtoupper(app()->getLocale()) }}
                    </summary>
                    <div class="language-menu">
                        @foreach (config('app.supported_locales') as $locale => $label)
                            <a class="{{ app()->getLocale() === $locale ? 'active' : '' }}" href="{{ route('language.switch', $locale) }}">{{ $label }}</a>
                        @endforeach
                    </div>
                </details>
            </div>
        </div>
    </nav>

    <main>
        <header class="hero">
            <div class="shell hero-grid">
                <div>
                    <span class="eyebrow">{{ __($settings->hero_eyebrow) }}</span>
                    <h1>{{ __($settings->hero_title) }}</h1>
                    <p class="lead">
                        {{ __($settings->hero_body) }}
                    </p>
                    <div class="hero-actions">
                        <a class="button" href="/admin">{{ __($settings->primary_button_label) }}</a>
                        <a class="button secondary" href="{{ route('login') }}">{{ __($settings->secondary_button_label) }}</a>
                        <a class="button secondary" href="{{ route('packages.index') }}">{{ __($settings->tertiary_button_label) }}</a>
                    </div>
                    <div class="metrics" aria-label="Projektmodule">
                        <div class="metric"><strong>{{ $settings->metric_one_value }}</strong><span>{{ __($settings->metric_one_label) }}</span></div>
                        <div class="metric"><strong>{{ $settings->metric_two_value }}</strong><span>{{ __($settings->metric_two_label) }}</span></div>
                        <div class="metric"><strong>{{ $settings->metric_three_value }}</strong><span>{{ __($settings->metric_three_label) }}</span></div>
                    </div>
                </div>
                <div class="hero-panel" aria-label="Premium travel imagery">
                    <div class="panel-strip">
                        <strong>{{ __($settings->hero_panel_title) }}</strong>
                        <span>{{ __($settings->hero_panel_body) }}</span>
                    </div>
                </div>
            </div>
        </header>

        <section id="destinations">
            <div class="shell">
                <div class="section-head">
                    <h2>{{ __($settings->destinations_heading) }}</h2>
                    <p>{{ __($settings->destinations_intro) }}</p>
                </div>
                <div class="grid">
                    @forelse ($destinations as $destination)
                        <a class="card card-link" href="{{ route('destinations.show', $destination) }}" aria-label="{{ $destination->name }}">
                            <div class="card-image">
                                @if ($destination->imageUrl())
                                    <img src="{{ $destination->imageUrl() }}" alt="{{ $destination->name }}" loading="lazy">
                                @endif
                                <span class="tag">{{ $destination->country }}</span>
                            </div>
                            <div class="card-body">
                                <h3>{{ $destination->name }}</h3>
                                <p>{{ $destination->summary }}</p>
                            </div>
                        </a>
                    @empty
                        <article class="card">
                            <div class="card-body">
                                <span class="tag">Draft</span>
                                <h3>{{ __('No destinations yet') }}</h3>
                                <p>{{ __('Create published destinations in the admin panel and they will appear here.') }}</p>
                            </div>
                        </article>
                    @endforelse
                </div>
            </div>
        </section>

        <section id="packages">
            <div class="shell">
                <div class="section-head">
                    <h2>{{ __($settings->packages_heading) }}</h2>
                    <p>{{ __($settings->packages_intro) }}</p>
                </div>
                <div class="grid">
                    @forelse ($packages as $package)
                        <a class="card card-link" href="{{ route('packages.show', $package) }}" aria-label="{{ $package->title }}">
                            <div class="card-image">
                                @if ($package->imageUrl())
                                    <img src="{{ $package->imageUrl() }}" alt="{{ $package->title }}" loading="lazy">
                                @endif
                                <span class="tag">{{ $package->destination?->name ?? 'Custom' }}</span>
                            </div>
                            <div class="card-body">
                                <h3>{{ $package->title }}</h3>
                                <p>{{ $package->teaser }}</p>
                                <div class="price">
                                    {{ __('From') }} {{ number_format((float) $package->price_from, 0, ',', '.') }} {{ $package->currency }} · {{ $package->duration_days }} {{ __('days') }}
                                </div>
                            </div>
                        </a>
                    @empty
                        <article class="card">
                            <div class="card-body">
                                <span class="tag">Draft</span>
                                <h3>{{ __('No packages yet') }}</h3>
                                <p>{{ __('Create published travel packages in the admin panel and they will appear here.') }}</p>
                            </div>
                        </article>
                    @endforelse
                </div>
            </div>
        </section>

        <section id="assistant" class="assistant-band">
            <div class="shell assistant-grid">
                <div>
                    <span class="eyebrow">{{ __($settings->assistant_eyebrow) }}</span>
                    <h2>{{ __($settings->assistant_heading) }}</h2>
                    <p class="lead">
                        {{ __($settings->assistant_body) }}
                    </p>
                </div>
                <div class="assistant-box">
                    <div class="prompt">
                        "{{ __($settings->assistant_prompt) }}"
                    </div>
                </div>
            </div>
        </section>

        <section id="posts">
            <div class="shell">
                <div class="section-head">
                    <h2>{{ __('Latest travel notes.') }}</h2>
                    <p>{{ __('Published articles can become inspiration, SEO content and briefing material for the assistant.') }}</p>
                </div>
                <div class="grid">
                    @forelse ($posts as $post)
                        <article class="card">
                            <div class="card-image">
                                @if ($post->imageUrl())
                                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" loading="lazy">
                                @endif
                                <span class="tag">{{ $post->published_at?->format('d.m.Y') }}</span>
                            </div>
                            <div class="card-body">
                                <h3>{{ $post->title }}</h3>
                                <p>{{ $post->excerpt }}</p>
                                <div class="price"><a href="{{ route('posts.show', $post) }}">{{ __('Read article') }}</a></div>
                            </div>
                        </article>
                    @empty
                        <article class="card">
                            <div class="card-body">
                                <span class="tag">Draft</span>
                                <h3>{{ __('No posts yet') }}</h3>
                                <p>{{ __('Published posts will appear here.') }}</p>
                            </div>
                        </article>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="shell">Travelcraft AI · {{ __('Laravel, Filament and an agent-ready travel workflow.') }}</div>
    </footer>
</body>
</html>
