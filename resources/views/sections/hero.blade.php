@if (get_the_post_thumbnail($post_id, 'featured-image'))
<section class="cc-hero container d-flex justify-content-center">
  {!! get_the_post_thumbnail($post_id, 'featured-image', ['class' => 'img-fluid']) !!}
</section>
@endif
