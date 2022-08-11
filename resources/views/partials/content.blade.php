<article @php(post_class(array( 'col-md-6' , 'd-flex' , 'justify-content-center' , )))>

  <div class="entry-wrap">
    <div class="entry-image">
      {!! get_the_post_thumbnail( $post_id, 'blog-index' ) !!}
    </div>

    <header>
      <h2 class="entry-title h4">
        <a href="{{ get_permalink() }}">
          {!! $title !!}
        </a>
      </h2>

      @include('partials.entry-meta')
    </header>

    <div class="entry-summary cc-copy--large cc-copy--spaced">
      @php(the_excerpt())
    </div>
  </div>
</article>
