@if (get_the_post_thumbnail(get_the_ID(), 'featured-image'))
<section class="cc-hero container d-flex justify-content-center">
  {!! get_the_post_thumbnail(get_the_ID(), 'featured-image', ['class' => 'img-fluid']) !!}
</section>
@endif
