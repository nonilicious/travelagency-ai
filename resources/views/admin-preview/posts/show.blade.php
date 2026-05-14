<x-layouts.public title="Preview · {{ $post->title }} · Servizi ITS">
    <article style="display:grid;gap:30px">
        <section class="panel" style="border-color:#b78a33">
            <p class="muted" style="font-weight:800;text-transform:uppercase">Admin preview</p>
            <h1 style="font-size:clamp(32px,4vw,52px)">Review before publishing</h1>
            <div style="display:flex;flex-wrap:wrap;gap:10px;margin-top:16px">
                <span class="button secondary">{{ $post->status }}</span>
                @if ($post->ai_generated)
                <span class="button secondary">AI generated</span>
                @endif
                @if ($post->reviewer)
                <span class="button secondary">Reviewed by {{ $post->reviewer->name }}</span>
                @endif
            </div>
            @if ($post->ai_prompt || $post->ai_notes)
            <div style="display:grid;gap:10px;margin-top:18px">
                @if ($post->ai_prompt)
                <p><strong>AI prompt:</strong> {{ $post->ai_prompt }}</p>
                @endif
                @if ($post->ai_notes)
                <p><strong>AI notes:</strong> {{ $post->ai_notes }}</p>
                @endif
            </div>
            @endif
        </section>

        <header style="display:grid;gap:18px">
            <p class="muted">{{ $post->published_at?->format('d.m.Y') ?: 'Not published yet' }} · {{ $post->author?->name }}</p>
            <h1>{{ $post->title }}</h1>
            <p style="font-size:20px">{{ $post->excerpt }}</p>
        </header>

        @if ($post->imageUrl())
        <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" style="width:100%;aspect-ratio:16/8;object-fit:cover;border-radius:8px;border:1px solid var(--line)">
        @endif

        <div class="panel" style="font-size:18px;line-height:1.8">
            {!! $post->body !!}
        </div>
    </article>
</x-layouts.public>