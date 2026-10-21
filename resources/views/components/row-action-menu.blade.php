@props([
    'label',
    'editUrl' => null,
    'deleteUrl' => null,
    'deleteMessage' => null,
    'deleteAction' => 'Delete',
    'deleteTitle' => 'Delete record?',
    'requireConfirmationText' => false,
])

<div class="relative">
    <button type="button"
        data-row-action-menu
        aria-label="Actions for {{ $label }}"
        aria-expanded="false"
        class="inline-flex size-11 items-center justify-center rounded-md text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        title="Actions">
        <x-icon name="ellipsis-vertical" />
    </button>
    <div data-row-action-popup class="fixed z-[120] hidden w-40 rounded-lg border border-gray-200 bg-white p-1 shadow-lg" role="menu">
        @if ($editUrl)
            <a href="{{ $editUrl }}" role="menuitem" class="flex min-h-11 items-center gap-2 rounded-md px-3 py-2 text-sm leading-5 text-indigo-700 hover:bg-indigo-50 focus:bg-indigo-50 focus:outline-none">
                <x-icon name="pencil" class="size-4 shrink-0" />
                <span class="whitespace-nowrap">Edit</span>
            </a>
        @endif
        @if ($deleteUrl)
            <form method="POST" action="{{ $deleteUrl }}" data-confirm="{{ $deleteMessage }}" data-confirm-name="{{ $label }}" data-confirm-title="{{ $deleteTitle }}" data-confirm-action="{{ $deleteAction }}" data-confirm-variant="danger" @if($requireConfirmationText) data-confirm-require="confirm" @endif>
                @csrf
                @method('DELETE')
                <button type="submit" role="menuitem" class="flex min-h-11 w-full items-center gap-2 rounded-md px-3 py-2 text-left text-sm leading-5 text-red-700 hover:bg-red-50 focus:bg-red-50 focus:outline-none">
                    <x-icon name="trash" class="size-4 shrink-0" />
                    <span class="whitespace-nowrap">Delete</span>
                </button>
            </form>
        @endif
    </div>
</div>
