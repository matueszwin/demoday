<div class="cell">
    <img class="thumbnail" src="{{ $product->image }}">
    <h5>{{ $product->title }} <small>${{ $product->price }}</small></h5>
    <p>{!! $product->content !!}</p>
    <a href="{{$product->url}}" class="button hollow expanded">Buy Now</a>
</div>