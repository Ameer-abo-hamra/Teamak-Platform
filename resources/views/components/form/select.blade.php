@props(['name', 'label' => '', 'options' => [], 'placeholder' => ''])



@if ($label)
    <label for="{{ $name }}">
        {{ $label }}
    </label>
@endif

<select name="{{ $name }}" id="{{ $name }}"
    {{ $attributes->merge([
        'class' => 'select',
    ]) }}>
    @if ($placeholder)
        <option value="all">{{ $placeholder }}</option>
    @endif
    @foreach ($options as $value => $text)
        <option value="{{ $value }}">{{ $text }}</option>
    @endforeach

</select>
