@if ($paginator->hasPages())
<nav aria-label="Page navigation example">
    <ul class="pagination">

        @if($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" tabindex="-1" aria-disabled="true" aria-label="@lang('pagination.previous')">Previous</a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" tabindex="-1">Previous</a>
            </li>
        @endif
       
        @foreach ($elements as $element)

            @if (is_string($element))
                <li class="page-item disabled"><a class="page-link" aria-disabled="true">{{ $page }}</a></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><a class="page-link" aria-current="page">{{ $page }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}"  rel="next" aria-label="@lang('pagination.next')" tabindex="-1">Next</a>
            </li>
        @else
            <li class="page-item disabled">
                <a class="page-link" tabindex="-1" aria-disabled="true" aria-label="@lang('pagination.next')">Next</a>
            </li>
        @endif

    </ul>
</nav>
@endif