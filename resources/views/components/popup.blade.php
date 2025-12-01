@props([
    'color' => 'alert-success',
    'message' => 'HELLO WORLD',
])

<div class="modal fade" id="popup" data-bs-keyboard="false" tabindex="-1" aria-labelledby="poppupLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="alert {{ $color }} w-100 text-center" role="alert">
            {{ $message }}
        </div>
    </div>
</div>
