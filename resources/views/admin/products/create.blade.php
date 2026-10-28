@extends('admin.layouts.app')

@section('content')

    @php
        $locales = ['az' => 'AZ', 'en' => 'EN', 'ru' => 'RU', 'zh' => 'ZH'];
    @endphp

    <div class="container-fluid">

        <div class="row">

            <!-- CREATE PRODUCT -->
            <div class="col-lg-4">

                <div class="card">

                    <div class="card-header">
                        <h4>Product əlavə et</h4>
                    </div>

                    <div class="card-body">

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('products.store') }}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf

                            <!-- LANGUAGE TABS -->
                            <ul class="nav nav-pills mb-2" role="tablist">
                                @foreach($locales as $code => $label)
                                    <li class="nav-item">
                                        <button type="button"
                                                class="nav-link py-1 px-3 {{ $loop->first ? 'active' : '' }}"
                                                data-bs-toggle="tab"
                                                data-bs-target="#lang-{{ $code }}">
                                            {{ $label }}@if($code === 'az')<span class="text-danger">*</span>@endif
                                        </button>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content">
                                @foreach($locales as $code => $label)
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                         id="lang-{{ $code }}">

                                        <!-- NAME -->
                                        <input type="text"
                                               name="translations[{{ $code }}][name]"
                                               value="{{ old("translations.$code.name") }}"
                                               class="form-control mb-2"
                                               placeholder="Ad ({{ $label }})">

                                        <!-- DESCRIPTION -->
                                        <textarea name="translations[{{ $code }}][description]"
                                                  class="form-control mb-2"
                                                  rows="3"
                                                  placeholder="Açıqlama ({{ $label }})">{{ old("translations.$code.description") }}</textarea>

                                    </div>
                                @endforeach
                            </div>

                            <!-- CODE -->
                            <label class="form-label mb-1">Məhsul kodu</label>
                            <input type="text"
                                   name="code"
                                   value="{{ old('code') }}"
                                   class="form-control mb-2"
                                   placeholder="Məs: PRD-001">

                            <!-- PRICES -->
                            <label class="form-label mb-1">Pərakəndə qiymət (₼)</label>
                            <input type="number"
                                   step="0.01"
                                   min="0"
                                   name="retail_price"
                                   value="{{ old('retail_price') }}"
                                   class="form-control mb-2"
                                   placeholder="0.00">

                            <label class="form-label mb-1">Topdansatış qiymət (₼)</label>
                            <input type="number"
                                   step="0.01"
                                   min="0"
                                   name="wholesale_price"
                                   value="{{ old('wholesale_price') }}"
                                   class="form-control mb-2"
                                   placeholder="0.00">

                            <label class="form-label mb-1">Endirim qiyməti (₼)</label>
                            <input type="number"
                                   step="0.01"
                                   min="0"
                                   name="discount_price"
                                   value="{{ old('discount_price') }}"
                                   class="form-control mb-2"
                                   placeholder="Boş qoyula bilər">

                            <!-- STOCK -->
                            <label class="form-label mb-1">Stok sayı</label>
                            <input type="number"
                                   name="stock"
                                   min="0"
                                   step="1"
                                   value="{{ old('stock') }}"
                                   class="form-control mb-2"
                                   placeholder="Məs: 50 (0 = stokda yoxdur)">

                            <!-- CATEGORY -->
                            <label class="form-label mb-1">Kateqoriya</label>
                            <select name="category_id"
                                    class="form-select mb-2">

                                <option value="">-- Seçin --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->translations?->firstWhere('locale', 'az')?->name ?? $cat->name }}
                                    </option>
                                @endforeach

                            </select>

                            <!-- STATUS -->
                            <label class="form-label mb-1">Status</label>
                            <select name="status"
                                    class="form-select mb-2">

                                <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>

                            </select>

                            <!-- SORT ORDER -->
                            <label class="form-label mb-1">Sıralama</label>
                            <input type="number"
                                   name="sort_order"
                                   value="{{ old('sort_order', 0) }}"
                                   class="form-control mb-2">

                            <!-- FEATURED / DISCOUNTED -->
                            <div class="form-check mb-1">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="is_featured"
                                       id="is_featured"
                                       value="1"
                                        {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">
                                    Ana səhifə slayderində göstər
                                </label>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="is_discounted"
                                       id="is_discounted"
                                       value="1"
                                        {{ old('is_discounted') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_discounted">
                                    Endirimli məhsul
                                </label>
                            </div>

                            <!-- IMAGES -->
                            <div class="mb-3">

                                <label class="form-label">Şəkillər</label>

                                <input type="file"
                                       name="images[]"
                                       id="images"
                                       class="form-control"
                                       multiple
                                       accept="image/jpeg,image/png,image/webp">

                                <small class="text-muted">jpg, png, webp — max 1 MB, 300x300 – 2000x2000</small>

                                <!-- PREVIEW -->
                                <div id="preview"
                                     class="d-flex flex-wrap gap-2 mt-2"></div>

                            </div>

                            <button class="btn btn-primary w-100">
                                Save Product
                            </button>

                        </form>

                    </div>

                </div>

            </div>

            <!-- PRODUCT LIST -->
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
                                <th>Stock</th>
                                <th>Images</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($products as $product)

                                <tr>

                                    <td>{{ $product->id }}</td>

                                    <td>
                                        <strong>
                                            {{ $product->translations->firstWhere('locale', 'az')?->name ?? $product->name ?? '-' }}
                                        </strong>
                                        @if($product->is_featured)
                                            <span class="badge bg-info">Featured</span>
                                        @endif
                                        @if($product->is_discounted)
                                            <span class="badge bg-warning text-dark">Endirim</span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $product->category?->translations?->firstWhere('locale', 'az')?->name ?? $product->category->name ?? '-' }}
                                    </td>

                                    <td>
                                        {{ number_format($product->retail_price, 2) }} ₼
                                        @if($product->discount_price)
                                            <br><small class="text-danger">{{ number_format($product->discount_price, 2) }} ₼</small>
                                        @endif
                                    </td>

                                    <td>
                                        @if((int) $product->stock <= 0)
                                            <span class="badge bg-danger">Stokda bitib</span>
                                        @else
                                            <span class="badge bg-success">{{ $product->stock }} əd.</span>
                                        @endif
                                    </td>

                                    <td class="d-flex gap-1">

                                        @foreach($product->images as $img)
                                            <img src="{{ asset('storage/'.$img->image) }}"
                                                 width="40"
                                                 height="40"
                                                 style="object-fit:cover;border-radius:5px;">
                                        @endforeach

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

    <!-- IMAGE PREVIEW SCRIPT -->
    <script>
        document.getElementById('images').addEventListener('change', function (event) {

            let preview = document.getElementById('preview');
            preview.innerHTML = '';

            Array.from(event.target.files).forEach(file => {

                let reader = new FileReader();

                reader.onload = function (e) {

                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '70px';
                    img.style.height = '70px';
                    img.style.objectFit = 'cover';
                    img.style.borderRadius = '8px';
                    img.style.border = '1px solid #ddd';

                    preview.appendChild(img);
                };

                reader.readAsDataURL(file);
            });
        });
    </script>

@endsection