<article @php(post_class(array( 'entry' , 'd-flex' , 'justify-content-center' )))>

  <div class="entry-wrap">
    <div class="entry-image">
      <a href="{{ get_permalink() }}">
        {!! get_the_post_thumbnail( get_the_ID(), 'blog-index' ) !!}
      </a>
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
