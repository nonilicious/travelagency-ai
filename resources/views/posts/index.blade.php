<x-layouts.public title="{{ __('Posts') }} · Travelcraft AI">
    <div style="display:grid;gap:28px">
        <div>
            <p class="muted" style="font-weight:800;text-transform:uppercase">{{ __('Travel journal') }}</p>
            <h1>{{ __('Posts') }}</h1>
            <p>{{ __('Ideas, planning notes and destination insight for better journeys.') }}</p>
        </div>

        <div class="list">
            @forelse ($posts as $post)
                <article class="item" style="display:grid;grid-template-columns:220px 1fr;gap:22px;align-items:stretch">
                    @if ($post->imageUrl())
                        <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" style="width:100%;height:160px;object-fit:cover;border-radius:8px">
                    @else
                        <div style="height:160px;border-radius:8px;background:#d9eef1"></div>
                    @endif
                    <div>
                        <p class="muted">{{ $post->published_at?->format('d.m.Y') }} · {{ $post->author?->name }}</p>
                        <h2><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
                        <p>{{ $post->excerpt }}</p>
                        <a class="button secondary" href="{{ route('posts.show', $post) }}">{{ __('Read article') }}</a>
                    </div>
                </article>
            @empty
                <div class="panel">
                    <h2>{{ __('No posts yet') }}</h2>
                    <p>{{ __('Published posts will appear here.') }}</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.public>
