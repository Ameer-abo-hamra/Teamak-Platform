@props(['name', 'label', 'type' => 'text'])

<div class="form-group">
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="form-control"
        placeholder="{{ $label }}">

    <label for="{{ $name }}" class="error-label">
        {{ $label }}
    </label>
    {{-- @error($name)
        <span class="input-error">
            {{ $message }}
        </span>
    @enderror --}}
</div>
