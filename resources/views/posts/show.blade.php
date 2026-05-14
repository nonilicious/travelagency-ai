<x-layouts.public title="{{ $post->title }} · Servizi ITS">
    <article style="display:grid;gap:30px">
        <header style="display:grid;gap:18px">
            <a class="muted" href="{{ route('posts.index') }}">{{ __('All posts') }}</a>
            <p class="muted">{{ $post->published_at?->format('d.m.Y') }} · {{ $post->author?->name }}</p>
            <h1>{{ $post->title }}</h1>
            <p style="font-size:20px">{{ $post->excerpt }}</p>
        </header>

        @if ($post->imageUrl())
        <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" style="width:100%;aspect-ratio:16/8;object-fit:cover;border-radius:8px;border:1px solid var(--line)">
        @endif

        <div class="panel" style="font-size:18px;line-height:1.8">
            {!! $post->body !!}
        </div>

        @if ($relatedPosts->isNotEmpty())
        <section style="display:grid;gap:16px">
            <h2>{{ __('More posts') }}</h2>
            <div class="list">
                @foreach ($relatedPosts as $relatedPost)
                <a class="item" href="{{ route('posts.show', $relatedPost) }}">
                    <strong>{{ $relatedPost->title }}</strong>
                    <p>{{ $relatedPost->excerpt }}</p>
                </a>
                @endforeach
            </div>
        </section>
        @endif
    </article>
</x-layouts.public>