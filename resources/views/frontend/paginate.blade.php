@if ($paginator->hasPages())
<div class="bottom-pagination">
  <nav>
    <ul class="pagination">
      @if ($paginator->onFirstPage())

      @else
        <li>
        <a href="{{ $paginator->previousPageUrl() }}" aria-label="Sau">
          <span aria-hidden="true">Sau</span>
        </a>
      </li>
      @endif
       @foreach ($elements as $element)

            @if (is_string($element))
             <li class="active"><a href="#">{{ $element }}</a></li>
            @endif
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
               <li class="active"><a href="#">{{ $page }}</a></li>
            @else
            <li><a href="{{ $url }}">{{ $page }}</a></li>
            @endif
            @endforeach
            @endif
       @endforeach

       @if ($paginator->hasMorePages())

            <li>
        <a href="{{ $paginator->nextPageUrl() }}" aria-label="Tiếp">
          <span aria-hidden="true">Tiếp</span>
        </a>
      </li>
        @else

        @endif

    </ul>
  </nav>
</div>
@endif
