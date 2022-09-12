@extends('layouts.app')

@section('content')

@if (! have_posts())
<div class="chapman-404-message text-center">
  <h1 class="chapman-404-message__title">{!! __('404', 'sage' ) !!}</h1>
  <h2 class="chapman-404-message__sub-title">{!! __('Page Not Found','sage' ) !!}</h2>
  <x-alert type="warning">
    {!! __('Sorry, but the page you are trying to view does not exist.', 'sage') !!}
  </x-alert>

  {!! get_search_form(false) !!}
</div>
@endif
@endsection
