@extends('layouts.app')

@section('content')
    @include('partials.page-header')
    @while(have_posts()) @php the_post() @endphp
        @include('sections.hero-section')
        @include('sections.about-us')
        @include('sections.products-list')
    @endwhile
@endsection
