<article class="news_block">
    <div class="news_block__info">
        <div class="news_block__info__categories_list">@php echo get_the_term_list(get_the_ID(), 'category', '', '', '') @endphp</div>
        <div class="news_block__info__date">
            <time datetime="{{ get_post_time('c', true) }}">{{ ucwords(get_the_date('j F Y')) }}</time>
        </div>
        <h3 class="news_block__info__title">
            <a href="{{ get_permalink() }}">{!! get_the_title() !!}</a>
        </h3>
    </div>
    @if (has_post_thumbnail())
        <a href="{{ get_permalink() }}" class="news_block__thumbnail">
            {!! wp_get_attachment_image(get_post_thumbnail_id(get_the_ID()), 'full') !!}
        </a>
    @endif
</article>