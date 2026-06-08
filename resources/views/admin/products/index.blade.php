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
                                        <button  type="button" class="nav-link active" data-bs-toggle="tab" data-bs-target="#az">
                                            AZ
                                        </button>
                                    </li>

                                    <li class="nav-item">
                                        <button  type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#en">
                                            EN
                                        </button>
                                    </li>

                                    <li class="nav-item">
                                        <button  type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#ru">
                                            RU
                                        </button>
                                    </li>

                                    <li class="nav-item">
                                        <button  type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#zh">
                                            Çin
                                        </button>
                                    </li>

                                </ul>

                                <div class="tab-content pt-3">

                                    <div class="tab-pane fade show active" id="az">
                                        <input name="translations[az][name]" class="form-control mb-2" placeholder="Ad (AZ)">
                                        <textarea name="translations[az][description]" class="form-control" placeholder="Açıqlama (AZ)"></textarea>
                                    </div>

                                    <div class="tab-pane fade" id="en">
                                        <input name="translations[en][name]" class="form-control mb-2" placeholder="Name (EN)">
                                        <textarea name="translations[en][description]" class="form-control" placeholder="Description (EN)"></textarea>
                                    </div>

                                    <div class="tab-pane fade" id="ru">
                                        <input name="translations[ru][name]" class="form-control mb-2" placeholder="Название (RU)">
                                        <textarea name="translations[ru][description]" class="form-control" placeholder="Описание (RU)"></textarea>
                                    </div>

                                    <div class="tab-pane fade" id="zh">
                                        <input name="translations[zh][name]" class="form-control mb-2" placeholder="姓名 (Zh)">
                                        <textarea name="translations[zh][description]" class="form-control" placeholder="描述 (Zh)"></textarea>
                                    </div>

                                </div>

                            </div>

                            {{-- PRICES --}}
                            <input type="text" name="code" class="form-control mb-2" placeholder="Code">

                            <input type="text" name="retail_price" class="form-control mb-2" placeholder="Retail price">
                            <input type="text" name="wholesale_price" class="form-control mb-2" placeholder="Wholesale price">
                            <input type="text" name="discount_price" class="form-control mb-2" placeholder="Discount price">

                            {{-- CATEGORY --}}
                            @php
                                $locale = app()->getLocale();

                                $getName = function ($category) use ($locale) {
                                    return $category->translations
                                        ->firstWhere('locale', $locale)
                                        ?->name
                                        ?? $category->translations->firstWhere('locale', 'az')?->name;
                                };
                            @endphp

                            <select required name="category_id" class="form-select mb-2">
                                <option value="">Category</option>

                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $getName($category) }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- STATUS --}}
                            <select name="status" class="form-select mb-2">
                                <option value="pending">Pending</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>


                            {{-- FEATURED --}}
                            <div class="form-check mb-2">
                                <input type="checkbox" name="is_featured" value="1" class="form-check-input" id="featured">
                                <label for="featured" class="form-check-label">Featured</label>
                            </div>

                            <div class="form-check mb-2">
                                <input type="checkbox"
                                       name="is_discounted"
                                       value="1"
                                       class="form-check-input"
                                       id="discounted">

                                <label for="discounted" class="form-check-label">
                                    Endirimdədir
                                </label>
                            </div>

                            {{-- IMAGES --}}
                            <input type="file" name="images[]" class="form-control mb-3" multiple>

                            <button class="btn btn-primary w-100">
                                Save Product
                            </button>

                        </form>

                    </div>

                </div>

            </div>

            {{-- RIGHT: LIST --}}
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

                                    {{-- NAME --}}
                                    <td>
                                        <strong>
                                            {{ $translation->name ?? $product->name }}

                                            @if($product->is_featured)
                                                <span class="badge bg-warning text-dark">Featured</span>
                                            @endif
                                        </strong>
                                    </td>
                                    {{-- COMPANY --}}

                                    {{-- CATEGORY --}}
                                    <td>{{ $product->category?->name }}</td>

                                    {{-- PRICE --}}
                                    <td>
                                        @if($product->price_type === 'retail')
                                            {{ $product->retail_price }} ₼
                                        @else
                                            {{ $product->wholesale_price }} ₼
                                        @endif
                                    </td>

                                    {{-- STATUS --}}
                                    <td>
                                    <span class="badge bg-info">
                                        {{ $product->status }}
                                    </span>
                                    </td>

                                    {{-- IMAGES --}}
                                    <td>
                                        <div class="d-flex gap-1">

                                            @foreach($product->images->take(3) as $img)
                                                <img src="{{ asset('storage/'.$img->image) }}"
                                                     style="width:35px;height:35px;object-fit:cover;border-radius:6px;">
                                            @endforeach

                                            @if($product->images->count() > 3)
                                                <div class="badge bg-dark">
                                                    +{{ $product->images->count() - 3 }}
                                                </div>
                                            @endif

                                        </div>
                                    </td>

                                    {{-- ACTION --}}
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
