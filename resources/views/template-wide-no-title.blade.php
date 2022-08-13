{{--
Template Name: Wide (No Title)
Template Post Type: page
--}}

@extends('layouts.wide')

@section('content')
@while(have_posts()) @php(the_post())
{{-- @include('partials.page-header') --}}
@include('partials.content-page')
@endwhile
@endsection
