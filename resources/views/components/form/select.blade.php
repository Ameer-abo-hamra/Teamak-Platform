@props(['name', 'label' => '', 'options' => []])



    @if ($label)
        <label for="{{ $name }}">
            {{ $label }}
        </label>
    @endif

    <select name="{{ $name }}" id="{{ $name }}"
        {{ $attributes->merge([
            'class' => 'select',
        ]) }}>

        @foreach ($options as $value => $text)
            <option value="{{ $value }}">{{ $text }}</option>
        @endforeach

    </select>


