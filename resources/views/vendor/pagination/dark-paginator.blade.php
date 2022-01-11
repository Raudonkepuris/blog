<link rel="stylesheet" href="{{ asset('css/dark-paginator.css') }}">

@if ($paginator->hasPages())
    <ul class="pagination">
            @if ($paginator->onFirstPage())
            <li><a class="disabled" href="">&lsaquo;</a></li>
            @else
            <li><a href="{{ $paginator->previousPageUrl() }}">&lsaquo;</a></li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                <li><a>{{ $element }}</a></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                        <li><a class="active" href="">{{ $page }}</a></li>
                        @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}">&rsaquo;</a></li>
            @else
            <li><a class="disabled" href="">&rsaquo;</a></li>
            @endif
    </ul>
@endif