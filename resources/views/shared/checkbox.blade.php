@isset($food)
    @php $class ??= null; @endphp
    <div @class(["form-check form-switch", $class])>
        <input type="hidden" name="disponibility" value="0">
        <input
            type="checkbox"
            name="disponibility"
            id="disponibility"
            value="1"
            @checked(old('disponibility', $food->disponibility == 1))
            class="form-check-input @error('disponibility') is-invalid @enderror"
            role="switch"
        >
        <label class="form-check-label" for="disponibility">Disponible ?</label>
        @error('disponibility')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
@endisset
