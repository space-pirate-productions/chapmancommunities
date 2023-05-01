{{-- @if (get_the_post_thumbnail($post->ID, 'featured-image') && !(is_archive() || is_home()))
<section class="cc-hero container d-flex justify-content-center">
  {!! get_the_post_thumbnail($post->ID, 'featured-image', ['class' => 'img-fluid']) !!}
</section>
@endif --}}