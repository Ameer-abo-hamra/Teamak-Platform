@props(['id', 'title' => 'Modal'])

<div id="{{ $id }}" class="modal">
    <div class="modal-content">

        <div class="modal-header">
            <h2>{{ $title }}</h2>

            <button type="button" data-close-modal >
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div class="modal-body">
            {{ $slot }}
        </div>

    </div>
</div>
