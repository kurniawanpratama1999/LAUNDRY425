@props([
    'idprop' => null,
    'labelprop' => null,
    'model' => null,
    'rows' => 4,
])

<label for="{{ $idprop }}" class="form-label">
    {{ $labelprop }}
</label>

<textarea 
    name="{{ $idprop }}" 
    id="{{ $idprop }}" 
    rows="{{ $rows }}"
    class="form-control @error($idprop) is-invalid @enderror"
>{{ old($idprop, $model?->{$idprop} ?? '') }}</textarea>

@error($idprop)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
