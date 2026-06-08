@extends('admin.layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">

            {{-- CREATE --}}
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Translation əlavə et</h4>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('admin.translations.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label>Group</label>
                                <input name="group" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Key</label>
                                <input name="key" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>AZ</label>
                                <input name="value_az" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>EN</label>
                                <input name="value_en" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>RU</label>
                                <input name="value_ru" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>ZH</label>
                                <input name="value_zh" class="form-control">
                            </div>

                            <button class="btn btn-primary">Save</button>
                        </form>

                    </div>
                </div>
            </div>

            {{-- LIST --}}
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Translations</h4>
                    </div>

                    <div class="card-body">

                        @foreach($translations as $group => $items)
                            <h5 class="mt-3">{{ $group }}</h5>

                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Key</th>
                                    <th>AZ</th>
                                    <th>EN</th>
                                    <th>RU</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($items as $key => $rows)
                                    <tr>
                                        <td>{{ $key }}</td>

                                        <td>{{ $rows->where('locale','az')->first()?->value }}</td>
                                        <td>{{ $rows->where('locale','en')->first()?->value }}</td>
                                        <td>{{ $rows->where('locale','ru')->first()?->value }}</td>
                                        <td>{{ $rows->where('locale','zh')->first()?->value }}</td>

                                        <td>
                                            <a class="btn btn-warning btn-sm"
                                               href="{{ route('admin.translations.edit', [$group, $key]) }}">
                                                Edit
                                            </a>

                                            <form method="POST"
                                                  action="{{ route('admin.translations.destroy', [$group, $key]) }}"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger btn-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
