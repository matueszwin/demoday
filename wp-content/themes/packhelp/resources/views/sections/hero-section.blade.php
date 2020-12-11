<div class="callout large">
    <div class="row column text-center">
        <h1> {{ $home_hero->section_title }} </h1>
        <p class="lead"> {!! $home_hero->text !!} </p>
        @foreach( $home_hero->buttons as $button )
            <a href="{{ $button->button_link }}" class="button large">{{ $button->button_text }}</a>
        @endforeach
    </div>
</div>