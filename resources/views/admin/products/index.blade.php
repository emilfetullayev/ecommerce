@extends('admin.layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row">

            {{-- LEFT: CREATE --}}
            <div class="col-lg-4">

                <div class="card">

                    <div class="card-header">
                        <h4>Product əlavə et</h4>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('products.store') }}"
                              method="POST"
                              enctype="multipart/form-data">

                            @csrf

                            {{-- MULTILANGUAGE INPUTS --}}
                            <div class="mb-3">

                                <ul class="nav nav-tabs">

                                    <li class="nav-item">
                                        <button type="button" class="nav-link active" data-bs-toggle="tab" data-bs-target="#az">AZ</button>
                                    </li>

                                    <li class="nav-item">
                                        <button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#en">EN</button>
                                    </li>

                                    <li class="nav-item">
                                        <button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#ru">RU</button>
                                    </li>

                                    <li class="nav-item">
                                        <button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#zh">Çin</button>
                                    </li>

                                </ul>

                                <div class="tab-content pt-3">

                                    {{-- AZ --}}
                                    <div class="tab-pane fade show active" id="az">
                                        <input name="translations[az][name]" class="form-control mb-1" placeholder="Ad (AZ)">
                                        @error('translations.az.name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        <textarea name="translations[az][description]" class="form-control" placeholder="Açıqlama (AZ)"></textarea>
                                        @error('translations.az.description')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- EN --}}
                                    <div class="tab-pane fade" id="en">
                                        <input name="translations[en][name]" class="form-control mb-1" placeholder="Name (EN)">
                                        @error('translations.en.name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        <textarea name="translations[en][description]" class="form-control" placeholder="Description (EN)"></textarea>
                                        @error('translations.en.description')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- RU --}}
                                    <div class="tab-pane fade" id="ru">
                                        <input name="translations[ru][name]" class="form-control mb-1" placeholder="Название (RU)">
                                        @error('translations.ru.name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        <textarea name="translations[ru][description]" class="form-control" placeholder="Описание (RU)"></textarea>
                                        @error('translations.ru.description')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- ZH --}}
                                    <div class="tab-pane fade" id="zh">
                                        <input name="translations[zh][name]" class="form-control mb-1" placeholder="姓名 (Zh)">
                                        @error('translations.zh.name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        <textarea name="translations[zh][description]" class="form-control" placeholder="描述 (Zh)"></textarea>
                                        @error('translations.zh.description')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>

                            </div>

                            {{-- CODE --}}
                            <input type="text" name="code" class="form-control mb-1" placeholder="Code">
                            @error('code')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                            {{-- PRICES --}}
                            <input type="text" name="retail_price" class="form-control mb-1" placeholder="Retail price">
                            @error('retail_price')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <input type="text" name="wholesale_price" class="form-control mb-1" placeholder="Wholesale price">
                            @error('wholesale_price')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <input type="text" name="discount_price" class="form-control mb-1" placeholder="Discount price">


                            {{-- CATEGORY --}}
                            <select required name="category_id" class="form-select mb-1">
                                <option value="">Category</option>

                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->translations->firstWhere('locale', app()->getLocale())?->name
                                            ?? $category->translations->firstWhere('locale', 'az')?->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                            {{-- STATUS --}}
                            <select name="status" class="form-select mb-2">
                                <option value="pending">Pending</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>

                                <input type="number" name="sort_order" class="form-control"
                                       placeholder="Sıra (0, 1, 2...)"
                                       value="{{ old('sort_order', $product->sort_order ?? 0) }}">
                                <label>Seçilmiş (önə çıxar)</label>


                            {{-- FEATURED --}}
                            <div class="form-check mb-1">
                                <input type="checkbox" name="is_featured" value="1" class="form-check-input" id="featured">
                                <label for="featured">Featured</label>
                            </div>


                            <div class="form-check mb-2">
                                <input type="checkbox" name="is_discounted" value="1" class="form-check-input" id="discounted">
                                <label for="discounted">Endirimdədir</label>
                            </div>

                            {{-- IMAGES --}}
                            <input type="file" name="images[]" class="form-control mb-1" multiple>
                            @error('images.*')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <button class="btn btn-primary w-100 mt-2">
                                Save Product
                            </button>

                        </form>

                    </div>

                </div>

            </div>

            {{-- RIGHT: LIST (UNCHANGED) --}}
            <div class="col-lg-8">

                <div class="card">

                    <div class="card-header">
                        <h4>Product list</h4>
                    </div>

                    <div class="card-body">

                        <table class="table align-middle">

                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Images</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($products as $product)

                                @php
                                    $translation = $product->translations
                                        ->firstWhere('locale', app()->getLocale())
                                        ?? $product->translations->firstWhere('locale', 'az');
                                @endphp

                                <tr>

                                    <td>{{ $product->id }}</td>

                                    <td>
                                        <strong>
                                            {{ $translation->name ?? '' }}

                                            @if($product->is_featured)
                                                <span class="badge bg-warning text-dark">Featured</span>
                                            @endif
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $product->category?->translations
                                            ->firstWhere('locale', app()->getLocale())?->name
                                            ?? $product->category?->translations->firstWhere('locale', 'az')?->name }}
                                    </td>

                                    <td>{{ $product->retail_price }} ₼</td>

                                    <td>
                                        <span class="badge bg-info">{{ $product->status }}</span>
                                    </td>

                                    <td>
                                        <div class="d-flex gap-1">
                                            @foreach($product->images->take(3) as $img)
                                                <img src="{{ asset('storage/'.$img->image) }}"
                                                     style="width:35px;height:35px;object-fit:cover;border-radius:6px;">
                                            @endforeach
                                        </div>
                                    </td>

                                    <td>
                                        <a href="{{ route('products.edit', $product) }}"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('products.destroy', $product) }}"
                                              method="POST"
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

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
