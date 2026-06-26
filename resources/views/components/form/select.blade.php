@props(['name', 'label' => '', 'options' => [], 'placeholder' => '', 'selected' => null])

@if ($label)
    <label for="{{ $name }}">
        {{ $label }}
    </label>
@endif

<select name="{{ $name }}" id="{{ $attributes->get('id', $name) }}"
    {{ $attributes->merge([
        'class' => 'select',
    ]) }}>
    @if ($placeholder)
        <option value="">{{ $placeholder }}</option>
    @endif
    @foreach ($options as $value => $text)
        <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>{{ $text }}
        </option>
    @endforeach

</select>
