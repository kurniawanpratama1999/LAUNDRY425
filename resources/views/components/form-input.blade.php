@props([
    'idprop' => null,
    'typeprop' => 'text',
    'labelprop' => null,
    'model' => null,
])

<label for="{{ $idprop }}" class="form-label">
    {{ $labelprop }}
</label>

<input type="{{ $typeprop }}" name="{{ $idprop }}" id="{{ $idprop }}"
    class="form-control @error($idprop) is-invalid @enderror" value="{{ old($idprop, $model?->{$idprop} ?? '') }}"
    {{ $attributes }}>

@error($idprop)
    <span class="invalid-feedback">{{ $message }}</span>
@enderror
