<!-- Pagination -->
@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination border-rounded">

            {{-- Tombol "Previous" --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">
                        <span class="mdi mdi-chevron-left"></span>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <span class="mdi mdi-chevron-left"></span>
                    </a>
                </li>
            @endif

            {{-- Nomor halaman --}}
            @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            {{-- Tombol "Next" --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <span class="mdi mdi-chevron-right"></span>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">
                        <span class="mdi mdi-chevron-right"></span>
                    </span>
                </li>
            @endif

        </ul>
    </nav>
@endif
