<div class="row column">
    <h3>{{ $home_products->section_title }}</h3>

    <div class="grid-x grid-margin-x small-up-1 medium-up-3">
        @foreach($products as $product)
            @include('.partials.product-item')
        @endforeach
    </div>
</div>
