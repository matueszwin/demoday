@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (!have_posts())
    <div class="alert alert-warning">
      {{ __('Sorry, no results were found.', 'sage') }}
    </div>
    {!! get_search_form(false) !!}
  @endif


  <section class = "posts_list card-columns">
    @while (have_posts()) @php the_post() @endphp
      @include('partials.content-'.get_post_type())
    @endwhile
  </section>
  <button class = "posts_list__item__button--loadmore" data-page="1">Load more</button>

  {!! get_the_posts_navigation() !!}
@endsection
