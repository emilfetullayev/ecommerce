@extends('admin.layouts.app')

@section('content')

    @php
        $locale = app()->getLocale();

        $locales = [
            'az' => 'AZ',
            'en' => 'EN',
            'ru' => 'RU',
            'zh' => 'ZH',
        ];

        $getName = function ($model) use ($locale) {
            return $model->translations
                ->firstWhere('locale', $locale)
                ?->name
                ?? $model->translations->firstWhere('locale', 'az')?->name;
        };

        // RECURSIVE FUNCTION
        $renderTree = function ($categories, $level = 0) use (&$renderTree, $getName) {
            foreach ($categories as $category) {

                echo '<tr>';

                echo '<td>'.$category->id.'</td>';

                echo '<td>';
                echo '<div style="padding-left:'.($level * 30).'px;">';
                echo '↳ '.$getName($category);
                echo '</div>';
                echo '</td>';

                echo '<td></td>';

                echo '<td>';

                echo '<a href="'.route('categories.edit', $category).'" class="btn btn-sm btn-warning">Edit</a> ';

                echo '<form action="'.route('categories.destroy', $category).'" method="POST" class="d-inline">';
                echo csrf_field();
                echo method_field('DELETE');
                echo '<button class="btn btn-sm btn-danger">Delete</button>';
                echo '</form>';

                echo '</td>';

                echo '</tr>';

                if ($category->children && $category->children->count()) {
                    $renderTree($category->children, $level + 1);
                }
            }
        };
    @endphp

    <div class="container-fluid">

        <div class="row">

            {{-- ================= ADD CATEGORY ================= --}}
            <div class="col-lg-4">

                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">Category əlavə et</h4>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('categories.store') }}" method="POST">
                            @csrf

                            {{-- TABS --}}
                            <ul class="nav nav-tabs">

                                @foreach($locales as $key => $label)

                                    <li class="nav-item">
                                        <button class="nav-link @if($loop->first) active @endif"
                                                data-bs-toggle="tab"
                                                data-bs-target="#add-{{ $key }}"
                                                type="button">
                                            {{ $label }}
                                        </button>
                                    </li>

                                @endforeach

                            </ul>

                            {{-- TAB CONTENT --}}
                            <div class="tab-content mt-3">

                                @foreach($locales as $key => $label)

                                    <div class="tab-pane fade @if($loop->first) show active @endif"
                                         id="add-{{ $key }}">

                                        <label>Ad ({{ $label }})</label>

                                        <input type="text"
                                               class="form-control"
                                               name="translations[{{ $key }}][name]">

                                    </div>

                                @endforeach

                            </div>

                            {{-- PARENT --}}
                            <div class="mt-3">

                                <label>Parent Category</label>

                                <select name="parent_id" class="form-select">

                                    <option value="">Ana Category</option>

                                    @foreach($allCategories as $category)

                                        <option value="{{ $category->id }}">
                                            {{ $getName($category) }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            <button class="btn btn-primary mt-3">
                                Əlavə et
                            </button>

                        </form>

                    </div>

                </div>

            </div>

            {{-- ================= LIST ================= --}}
            <div class="col-lg-8">

                <div class="card">

                    <div class="card-header">
                        <h4>Category list</h4>
                    </div>

                    <div class="card-body">

                        <table class="table align-middle">

                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ad</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            @php
                                $renderTree($categories, 0);
                            @endphp

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
