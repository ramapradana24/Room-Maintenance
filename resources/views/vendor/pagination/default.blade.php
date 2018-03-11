@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" style="padding: 0 10px; margin-top: 7px;"><span class="fa fa-chevron-left"></span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="fa fa-chevron-left"></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class=""><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active orange darken-1" style="padding: 0 10px; color: #fff;"><span style="margin-top: 10px;">{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}" class="waves-effect">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next" class="fa fa-chevron-right"></a></li>
        @else
            <li class="disabled" style="padding: 0 10px; margin-top: 7px;"><span class="fa fa-chevron-right"></span></li>
        @endif
    </ul>
@endif
