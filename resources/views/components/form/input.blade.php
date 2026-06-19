@props([
    'name',
    'label' => '',
    'type' => 'text',
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'hidden' => false,
    'class' => '',
])
@if ($type === 'hidden')
    <input type="hidden" name="{{ $name }}" value="{{ $value }}">
@else
    <div {{ $attributes->merge(['class' => 'form-group']) }}>

        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            class="form-control {{ $class }}" placeholder="{{ $placeholder ?: $label }}"
            value="{{ old($name, $value) }}" @required($required) @disabled($disabled) @readonly($readonly)
            @if ($hidden) hidden @endif>

        @unless ($type === 'hidden' || $hidden)
            <label for="{{ $name }}" class="error-label">
                {{ $label }}
            </label>
        @endunless
        @if ($type === 'password')
            <button type="button" class="show-password" onclick="togglePassword('{{ $name }}')">
                👁
            </button>
        @endif
    </div>
@endif
<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    }
</script>

<style>
    .input-wrapper {
        position: relative;
    }

    .show-password {
        position: absolute;
        right: 10px;
        font-size: 26px !important;
        top: 32%;
        transform: translateY(-23%);
        background: none;
        margin-right: 20%;
        color: gold;
        border: none;
        cursor: pointer;

    }
</style>
