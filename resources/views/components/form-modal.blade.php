@props([
    'title' => null,
    'action' => null,
    'method' => null, 
])


<div class="modal fade @if ($errors->any()) show @endif" 
    data-bs-backdrop="static"
    id="formModal" 
    tabindex="-1"
    aria-hidden="true"
    @if ($errors->any()) style="display:block" @endif>
     
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($method ?? false) @method($method) @endif

                <div class="modal-header">
                    <h5 class="modal-title">{{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row row-gap-3">
                        {{ $slot }}
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>