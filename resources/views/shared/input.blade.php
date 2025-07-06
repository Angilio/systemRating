@php
    $class ??= null;
    $type ??= 'text';
    $name ??= '';
    $value ??= '';
    $label ??= ucfirst($name);
@endphp
<div @class(["form-group", $class])>
    <label for="{{ $name }}"> {{ $label }} :</label>
    @if ($type == 'textarea')
        <textarea type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" class="form-control @error($name) is-invalid @enderror" value="">{{ old($name, $food->description ?? '') }}</textarea>
    @else
        <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" class="form-control @error($name) is-invalid @enderror" value="{{ old($name,$value) }}" {{ isset($accept) ? 'accept='.$accept : '' }}>
    @endif
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
