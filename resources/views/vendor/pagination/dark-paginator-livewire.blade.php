<link rel="stylesheet" href="{{ asset('css/light-paginator.css') }}">

@if ($paginator->hasPages())
    <ul class="pagination justify-content-center">
            @if ($paginator->onFirstPage())
            <li><a class="disabled">&lsaquo;</a></li>
            @else
            <li><a wire:click="previousPage">&lsaquo;</a></li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                <li><a>{{ $element }}</a></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                        <li><a class="active">{{ $page }}</a></li>
                        @else
                        <li id="page-{{ $page }}"><a wire:click="gotoPage({{ $page }})">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
            <li><a wire:click="nextPage">&rsaquo;</a></li>
            @else
            <li><a class="disabled">&rsaquo;</a></li>
            @endif
    </ul>
@endif