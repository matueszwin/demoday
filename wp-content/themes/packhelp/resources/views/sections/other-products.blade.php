<h3>Other products:</h3>
<div class="grid-x grid-margin-x medium-up-2 large-up-4">
    @foreach($related_products as $product)
        @include('.partials.product-item')
    @endforeach
</div>