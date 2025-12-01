@props([
    'idprop' => null,
    'labelprop' => null,
    'model' => null,
    'options' => [], // bisa array atau collection dari model
])

<label for="{{ $idprop }}" class="form-label">
    {{ $labelprop }}
</label>

<select name="{{ $idprop }}" id="{{ $idprop }}" class="form-select @error($idprop) is-invalid @enderror">
    <option value="">-- pilih {{ strtolower($labelprop) }} --</option>

    @foreach ($options as $item)
        @php
            // Jika item adalah array: ['id' => 1, 'name' => 'A']
            // Jika item adalah object: $item->id dan $item->name
            $value = is_array($item) ? $item['id'] : $item->id;
            $label = is_array($item) ? $item['name'] : $item->name;
        @endphp

        <option value="{{ $value }}" @selected(old($idprop, $model?->{$idprop}) == $value)>
            {{ $label }}
        </option>
    @endforeach
</select>

@error($idprop)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

@if ($model ?? null)
    @pushOnce('footerscripts')
        <script>
            document.getElementById("{{ $idprop }}").value = "{{ $model?->{$idprop} }}"
        </script>
    @endPushOnce
@endif
