@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-end">
            {{-- Primeira página --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">&laquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
                </li>
            @endif

            {{-- Itens da página --}}
            @php
                $currentPage = $paginator->currentPage();
                $totalPages = $paginator->lastPage();
                $maxVisible = 5;
                $halfVisible = floor($maxVisible / 2);
                $start = max($currentPage - $halfVisible, 1);
                $end = min($currentPage + $halfVisible, $totalPages);

                // Ajusta o início e o fim se há mais páginas do que o máximo visível
                if ($totalPages > $maxVisible) {
                    if ($start <= 1) {
                        $end = min($start + $maxVisible - 1, $totalPages);
                    } elseif ($end >= $totalPages) {
                        $start = max($totalPages - $maxVisible + 1, 1);
                    }
                }
            @endphp

            {{-- Páginas de 1 até $start - 1 --}}
            @if ($start > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
                </li>
                @if ($start > 2)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
            @endif

            {{-- Páginas atuais --}}
            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $currentPage)
                    <li class="page-item active" aria-current="page">
                        <span class="page-link">{{ $i }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor

            {{-- Páginas de $end + 1 até $totalPages --}}
            @if ($end < $totalPages)
                @if ($end < $totalPages - 1)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url($totalPages) }}">{{ $totalPages }}</a>
                </li>
            @endif

            {{-- Última página --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">&raquo;</span>
                </li>
            @endif

            {{-- Dropdown para páginas adicionais --}}
            @if ($totalPages > $maxVisible)
                <li class="page-item dropdown">
                    <a class="page-link dropdown-toggle" href="#" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @for ($i = 1; $i <= $totalPages; $i++)
                            @if ($i < $start || $i > $end)
                                <li>
                                    <a class="dropdown-item" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                                </li>
                            @endif
                        @endfor
                    </ul>
                </li>
            @endif
        </ul>
    </nav>
@endif
