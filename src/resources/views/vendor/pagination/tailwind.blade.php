@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation" class="pagination-nav">
    <div class="pagination-wrapper">

        {{-- 前へ --}}
        @if ($paginator->onFirstPage())
        <span class="pagination-button disabled">&lt;</span>
        @else
        <a href="{{ $paginator->previousPageUrl() }}" class="pagination-button">&lt;</a>
        @endif

        {{-- ページ番号 --}}
        @foreach ($elements as $element)
        @if (is_string($element))
        <span class="pagination-button disabled">{{ $element }}</span>
        @endif

        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <span class="pagination-button active">{{ $page }}</span>
        @else
        <a href="{{ $url }}" class="pagination-button">{{ $page }}</a>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- 次へ --}}
        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="pagination-button">&gt;</a>
        @else
        <span class="pagination-button disabled">&gt;</span>
        @endif

    </div>
</nav>
@endif