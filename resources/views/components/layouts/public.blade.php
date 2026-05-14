<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Servizi ITS' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --ink: #17211f;
            --muted: #61716d;
            --line: #dce5df;
            --paper: #f7faf7;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

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
        .item {
            cursor: pointer;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .shell {
            width: min(980px, calc(100% - 32px));
            margin: 0 auto;
        }

        .nav {
            border-bottom: 1px solid var(--line);
            background: rgba(247, 250, 247, .9);
            backdrop-filter: blur(18px);
        }

        .nav-inner {
            min-height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
        }

        .brand {
            font-size: 19px;
            font-weight: 800;
        }

        .links {
            display: flex;
            gap: 14px;
            align-items: center;
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
            background: white;
            color: var(--ink);
            cursor: pointer;
            list-style: none;
            font-weight: 800;
        }

        .language-switch summary::-webkit-details-marker {
            display: none;
        }

        .language-switch svg {
            width: 17px;
            height: 17px;
        }

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
            z-index: 20;
        }

        .language-menu a {
            padding: 9px 10px;
            border-radius: 6px;
            color: var(--muted);
            font-weight: 700;
        }

        .language-menu a.active {
            background: var(--paper);
            color: #0f6b5f;
        }

        .page {
            padding: 64px 0;
        }

        .panel {
            border: 1px solid var(--line);
            border-radius: 8px;
            background: var(--white);
            padding: 28px;
        }

        h1 {
            margin: 0 0 14px;
            font-size: clamp(36px, 5vw, 64px);
            line-height: 1;
            letter-spacing: 0;
        }

        h2 {
            margin: 0 0 12px;
            font-size: 24px;
        }

        p {
            color: var(--muted);
            line-height: 1.65;
        }

        label {
            display: grid;
            gap: 8px;
            color: var(--ink);
            font-weight: 700;
        }

        input,
        textarea {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 13px 14px;
            font: inherit;
            background: white;
        }

        input {
            min-height: 48px;
        }

        textarea {
            min-height: 150px;
            resize: vertical;
        }

        form {
            display: grid;
            gap: 16px;
        }

        .error {
            color: #b42318;
            font-size: 14px;
        }

        .split {
            display: grid;
            grid-template-columns: .8fr 1.2fr;
            gap: 24px;
            align-items: start;
        }

        .list {
            display: grid;
            gap: 14px;
        }

        .item {
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 18px;
            background: white;
        }

        .chat-assistant {
            display: grid;
            gap: 16px;
        }

        .chat-log {
            display: grid;
            gap: 10px;
        }

        .message {
            max-width: 88%;
            border-radius: 8px;
            padding: 13px 15px;
            line-height: 1.5;
        }

        .message.bot {
            justify-self: start;
            background: #eef4f0;
            color: var(--ink);
        }

        .message.user {
            justify-self: end;
            background: var(--ink);
            color: white;
        }

        .quick-options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .quick-options button {
            min-height: 40px;
            border: 1px solid var(--line);
            border-radius: 999px;
            padding: 0 14px;
            background: white;
            color: var(--ink);
            font: inherit;
            font-weight: 800;
            cursor: pointer;
        }

        .muted {
            color: var(--muted);
        }

        @media (max-width: 760px) {
            .split {
                grid-template-columns: 1fr;
            }

            .links {
                display: none;
            }
        }
    </style>
</head>

<body>
    <nav class="nav">
        <div class="shell nav-inner">
            <a class="brand" href="{{ route('home') }}">Servizi ITS</a>
            <div class="links">
                <a href="{{ route('home') }}">{{ __('Home') }}</a>
                <a href="{{ route('destinations.index') }}">{{ __('Destinations') }}</a>
                <a href="{{ route('packages.index') }}">{{ __('Packages') }}</a>
                <a href="{{ route('contact.create') }}">{{ __('Contact') }}</a>
                <a href="/admin">{{ __('Admin') }}</a>
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

    <main class="page">
        <div class="shell">
            {{ $slot }}
        </div>
    </main>

    <div id="vanessa-travel-assistant"></div>
</body>

</html>
