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
    @endphp

    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-4">

                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">Category edit</h4>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('categories.update', $category) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- ================= TAB NAV ================= --}}
                            <ul class="nav nav-tabs" role="tablist">

                                @foreach($locales as $key => $label)

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link @if($loop->first) active @endif"
                                                data-bs-toggle="tab"
                                                data-bs-target="#tab-{{ $key }}"
                                                type="button">
                                            {{ $label }}
                                        </button>
                                    </li>

                                @endforeach

                            </ul>

                            {{-- ================= TAB CONTENT ================= --}}
                            <div class="tab-content mt-3">

                                @foreach($locales as $key => $label)

                                    @php
                                        $translation = $category->translations->firstWhere('locale', $key);
                                    @endphp

                                    <div class="tab-pane fade @if($loop->first) show active @endif"
                                         id="tab-{{ $key }}">

                                        <div class="mb-3">

                                            <label class="form-label">Ad ({{ $label }})</label>

                                            <input type="text"
                                                   class="form-control"
                                                   name="translations[{{ $key }}][name]"
                                                   value="{{ $translation?->name }}">
                                        </div>

                                    </div>

                                @endforeach

                            </div>

                            {{-- ================= PARENT CATEGORY ================= --}}
                            <div class="mt-3">

                                <label class="form-label">Parent Category</label>

                                <select name="parent_id" class="form-select">

                                    <option value="">Ana Category</option>

                                    @foreach($allCategories as $cat)

                                        @php
                                            $catName = $cat->translations
                                                ->firstWhere('locale', $locale)
                                                ?->name
                                                ?? $cat->translations->firstWhere('locale', 'az')?->name;
                                        @endphp

                                        <option value="{{ $cat->id }}"
                                            @selected($category->parent_id == $cat->id)>
                                            {{ $catName }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            <button class="btn btn-primary mt-3">
                                Yenilə
                            </button>

                        </form>

                    </div>

                </div>

            </div>

            {{-- ================= INFO ================= --}}
            <div class="col-lg-8">

                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">Category info</h4>
                    </div>

                    <div class="card-body">

                        <p><strong>ID:</strong> {{ $category->id }}</p>

                        <p><strong>Name:</strong>
                            {{ $category->translations->firstWhere('locale', $locale)?->name }}
                        </p>

                        <p><strong>Parent:</strong>
                            {{ $category->parent?->translations->firstWhere('locale', $locale)?->name ?? 'Ana category' }}
                        </p>

                        <p><strong>Subcategories:</strong></p>

                        @forelse($category->children as $child)

                            <span class="badge bg-primary">
                            {{ $child->translations->firstWhere('locale', $locale)?->name }}
                        </span>

                        @empty
                            <span class="text-muted">Subcategory yoxdur</span>
                        @endforelse

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
