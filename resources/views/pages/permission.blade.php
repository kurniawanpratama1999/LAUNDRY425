@extends('layout')

@section('title', 'permission')

@section('content')
    <section class="container">
        <div class="mt-3">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between gap-3">
                    <div>
                        <select onchange="clickLevel(event)" name="level" id="level" class="form-select">
                            @foreach ($levels as $levelItem)
                                <option value="{{ $levelItem->id }}">{{ $levelItem->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if (Auth::user()->level_id !== 1 || $id !== Auth::user()->level_id)
                        <button type="button" class="btn btn-success" onclick="simpan()">Simpan</button>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-hover">
                            <thead class="table-borderless">
                                <tr>
                                    <th>Check</th>
                                    <th>Link</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menus as $key => $menuItem)
                                    <tr>
                                        <td class="align-middle">
                                            <div>
                                                <label for="check-{{ $menuItem->id }}">
                                                    @if ($id !== 1)
                                                        <input onchange="clickMenu(event,{{ $menuItem->id }})"
                                                            type="checkbox" name="check-{{ $menuItem->id }}"
                                                            id="check-{{ $menuItem->id }}" class="form-check-input"
                                                            autocomplete="off">
                                                    @else
                                                        <input type="checkbox" name="check-{{ $menuItem->id }}"
                                                            id="check-{{ $menuItem->id }}" class="form-check-input"
                                                            disabled>
                                                    @endif
                                                    <span>{{ $menuItem->name }}</span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $menuItem->link }}
                                        </td>
                                        <td>
                                            {{ $menuItem->description }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    note
                </div>
            </div>
        </div>
    </section>
@endsection

@pushOnce('footerscripts')
    <script>
        const level_id = {{ $id }}
        const levelMenus = {{ Js::from($levelMenus) }}
        const sendData = {
            value: []
        };

        function clickLevel(event) {
            location.href = `/permission/${event.target.value}`
        }

        async function simpan() {
            const datas = sendData.value.filter(v => v.isChecked)
            const API = await fetch(`/permission/${level_id}`, {
                method: 'put',
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                },
                body: JSON.stringify({
                    datas
                })
            })

            const res = await API.json();
            if (res.success) {
                location.href = res.redirect;
            } else {
                console.log(res.message)
            }
        }


        function checklistWhenLoad() {
            const checks = document.querySelectorAll('input[id^=check-]')
            checks.forEach(c => {
                if (level_id == 1) {
                    c.checked = true
                }

                for (let index = 0; index < levelMenus.length; index++) {
                    const {
                        menu_id
                    } = levelMenus[index];


                    const [label, inputID] = c.id.split('-')
                    if (menu_id == inputID) {
                        sendData.value.push({
                            level_id,
                            menu_id,
                            isChecked: true
                        })

                        c.checked = true;
                    }
                }
            })

            console.log(sendData.value)
        }

        window.addEventListener('DOMContentLoaded', () => {
            checklistWhenLoad()
            document.getElementById('level').value = level_id
        })
    </script>
@endPushOnce

@if ($id !== 1)
    @pushOnce('footerscripts')
        <script>
            async function clickMenu(event, menu_id) {
                const isChecked = event.target.checked
                const index = sendData.value.findIndex(v => v.menu_id == menu_id)
                if (index === -1) {
                    sendData.value.push({
                        level_id,
                        menu_id,
                        isChecked
                    })
                } else {
                    sendData.value[index].menu_id = menu_id
                    sendData.value[index].isChecked = isChecked
                }

            }
        </script>
    @endPushOnce
@endif
