<article @php(post_class())>

  <div class="cc-hero">
    {!! get_the_post_thumbnail($post_id, 'featured-image', ['class' => 'img-fluid']) !!}
  </div>

  <header class="post-header">
    <h1 class="entry-title h2">
      {!! $title !!}
    </h1>

    @include('partials.entry-meta')
  </header>

  <div class="entry-content">
    @php(the_content())
  </div>

  <footer>
    {!! wp_link_pages([
        'echo' => 0,
        'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'),
        'after' => '</p></nav>',
    ]) !!}
  </footer>

  {{-- @php(comments_template()) --}}
</article>
