@props(['name', 'class' => 'size-5'])

<svg {{ $attributes->merge(['class' => $class]) }}
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="1.75"
    stroke-linecap="round"
    stroke-linejoin="round"
    aria-hidden="true"
    focusable="false">
    @switch($name)
        @case('pencil')
            <path d="M12 20h9"/>
            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"/>
            @break
        @case('trash')
            <path d="M3 6h18"/>
            <path d="M8 6V4h8v2"/>
            <path d="m19 6-1 14H6L5 6"/>
            <path d="M10 11v5M14 11v5"/>
            @break
        @case('restore')
            <path d="M3 12a9 9 0 1 0 3-6.7"/>
            <path d="M3 4v5h5"/>
            <path d="M12 8v4l3 2"/>
            @break
        @case('ellipsis-vertical')
            <circle cx="12" cy="5" r="1"/>
            <circle cx="12" cy="12" r="1"/>
            <circle cx="12" cy="19" r="1"/>
            @break
    @endswitch
</svg>
