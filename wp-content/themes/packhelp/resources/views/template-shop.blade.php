{{--
  Template Name: Shop Page Template
--}}

@extends('layouts.app')

@section('content')
    @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-page')
    @endphp
    @endwhile
  @endsection
