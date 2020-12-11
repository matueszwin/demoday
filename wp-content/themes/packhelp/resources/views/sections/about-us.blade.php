<article class="grid-container">
    <div class="grid-x grid-margin-x">
        <div class="medium-6 cell small-order-2 medium-order-1">
            <h2>{{ $home_about->section_title }}</h2>
            <p>{!! $home_about->text !!}</p>
        </div>
        <div class="medium-6 cell small-order-1 medium-order-2">
            <img class="thumbnail" src="https://placehold.it/750x350">
        </div>
    </div>

    <div class="grid-x grid-margin-x">
        @foreach( $home_about->Columns as $column )
            <div class="medium-4 cell">
                <h3>{{ $column->title }}</h3>
                <p>{!! $column->text !!}</p>
            </div>
        @endforeach
    </div>

    <hr>

    <div class="row column">
        <ul class="vertical medium-horizontal menu expanded text-center">
            @foreach( $home_about->Numbers as $number )
                <div class="medium-4 cell">
                    <li>
                        <a href="#">
                            <div class="stat">{{ $number->number }}</div>
                            <span>{{ $number->subtitle }}</span>
                        </a>
                    </li>
                </div>
            @endforeach
        </ul>
    </div>
</article>