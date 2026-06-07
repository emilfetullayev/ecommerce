@extends('admin.layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4>Edit Translation</h4>
            </div>

            <div class="card-body">

                <form method="POST"
                      action="{{ route('admin.translations.update', [$group, $key]) }}">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>AZ</label>
                        <input name="value_az"
                               class="form-control"
                               value="{{ $translations['az']->value ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label>EN</label>
                        <input name="value_en"
                               class="form-control"
                               value="{{ $translations['en']->value ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label>RU</label>
                        <input name="value_ru"
                               class="form-control"
                               value="{{ $translations['ru']->value ?? '' }}">
                    </div>

                    <button class="btn btn-primary">
                        Update
                    </button>

                </form>

            </div>
        </div>
    </div>

@endsection
