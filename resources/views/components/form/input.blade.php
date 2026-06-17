@props(['name', 'label' => '', 'type' => 'text', 'placeholder'])

<div {{ $attributes->merge(['class' => 'form-group']) }}>

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="form-control"
        placeholder="{{ $placeholder??$label }}">

    <label for="{{ $name }}" class="error-label">
        {{ $label }}
    </label>

</div>
