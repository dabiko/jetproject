@props(['sortBy', 'sortAsc', 'sortField'])

@if($sortBy == $sortField)
    @if($sortAsc)
        <x-asc-sort-icon />
    @endif

    @if(!$sortAsc)
        <x-desc-sort-icon />
    @endif
@endif