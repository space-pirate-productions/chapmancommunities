@if (get_the_post_thumbnail(get_the_ID(), 'homepage-hero'))
<section class="cc-hero cc-container cc-container--wide d-flex justify-content-center">
  {!! get_the_post_thumbnail(get_the_ID(), 'homepage-hero', ['class' => 'img-fluid']) !!}
</section>
@endif
