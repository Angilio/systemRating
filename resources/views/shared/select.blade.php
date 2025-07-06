@php
    $class ??= null;
    $name ??= '';
    $label ??= ucfirst($name);
    $value ??= '';
    $options ??= [];
    $selected ??= null;
@endphp

<div @class(["form-group", $class])>
    <label for="{{ $name }}">{{ $label }}:</label>
    <select name="{{ $name }}" id="{{ $name }}" class="form-control">
        <option value="" disabled {{ is_null($selected) ? 'selected' : '' }}>Sélectionner {{ strtolower($label) }}</option>
        @foreach ($options as $key => $text)
            <option value="{{ $key }}" {{ (string) $key === (string) $selected ? 'selected' : '' }}>{{ $text }}</option>
        @endforeach
    </select>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror    
</div>

