<article class="grid-container">
  <div class="grid-x grid-margin-x">
    <div class="medium-6 cell">
      {!!  wp_get_attachment_image(get_post_thumbnail_id(get_the_ID()), 'full') !!}
    </div>
    <div class="medium-6 large-5 cell large-offset-1">
      <h3>{{ the_title() }}</h3>
      <p>{!! the_content() !!}</p>

      @php
        if ( is_plugin_active( 'calculator/calculator.php' ) ) {
          echo do_shortcode('[calculator]');
        }
      @endphp

      <label>Size
        <select>
          @foreach ($sizes as $size)
            <option value="{{ $size->multiplier }}">{{ $size->name }}</option>
          @endforeach
        </select>
      </label>

      <div class="grid-x">
        <div class="small-3 cell">
          <label for="middle-label" class="middle">Quantity</label>
        </div>
        <div class="small-9 cell">
          <input type="number" id="middle-label" placeholder="One fish two fish">
        </div>
      </div>

      <h4>Product price: <strong>{{ $product_calculator->product_price }}$</strong></h4>

      <a href="#" class="button large expanded">Buy Now</a>

      <h6>Share this product:</h6>
      <div class="small secondary expanded button-group">
        <a href="https://www.facebook.com/sharer.php?u={{the_permalink()}}" class="button">Facebook</a>
        <a href="https://twitter.com/intent/tweet?url={{ the_permalink() }}" class="button">Twitter</a>
      </div>
    </div>
  </div>
</article>
