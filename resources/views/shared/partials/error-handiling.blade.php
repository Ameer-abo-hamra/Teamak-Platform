<div class="toast-container">

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="toast toast-error">
                <span>{{ $error }}</span>
            </div>
        @endforeach
    @endif

    @if (session('error'))
        <div class="toast toast-error">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="toast toast-success">
            {{ session('success') }}
        </div>
    @endif

</div>
