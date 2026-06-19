@extends('admin.layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row">

            <!-- LEFT: FORM -->
            <div class="col-lg-4">

                <div class="card">

                    <div class="card-header">
                        <h4>Product edit</h4>
                    </div>

                    <div class="card-body">

                        {{-- GLOBAL ERRORS --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('products.update', $product) }}"
                              method="POST"
                              enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <!-- TRANSLATIONS -->
                            <div class="mb-3">

                                <ul class="nav nav-tabs">

                                    @foreach(['az','en','ru','zh'] as $lang)

                                        <li class="nav-item">
                                            <button type="button"
                                                    class="nav-link @if($loop->first) active @endif"
                                                    data-bs-toggle="tab"
                                                    data-bs-target="#{{ $lang }}">
                                                {{ strtoupper($lang) }}
                                            </button>
                                        </li>

                                    @endforeach

                                </ul>

                                <div class="tab-content pt-3">

                                    @foreach(['az','en','ru','zh'] as $lang)

                                        @php
                                            $t = $product->translations->firstWhere('locale', $lang);
                                        @endphp

                                        <div class="tab-pane fade @if($loop->first) show active @endif"
                                             id="{{ $lang }}">

                                            <!-- NAME -->
                                            <input type="text"
                                                   name="translations[{{ $lang }}][name]"
                                                   class="form-control mb-1 @error('translations.'.$lang.'.name') is-invalid @enderror"
                                                   value="{{ old("translations.$lang.name", $t->name ?? '') }}"
                                                   placeholder="Name">

                                            @error('translations.'.$lang.'.name')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror

                                            <!-- DESCRIPTION -->
                                            <textarea name="translations[{{ $lang }}][description]"
                                                      class="form-control mb-2"
                                                      placeholder="Description">{{ old("translations.$lang.description", $t->description ?? '') }}</textarea>

                                        </div>

                                    @endforeach

                                </div>

                            </div>

                            <!-- CODE -->
                            <input type="text"
                                   name="code"
                                   class="form-control mb-1 @error('code') is-invalid @enderror"
                                   value="{{ old('code', $product->code) }}"
                                   placeholder="Code">

                            @error('code')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <!-- RETAIL -->
                            <input type="text"
                                   name="retail_price"
                                   class="form-control mb-1 @error('retail_price') is-invalid @enderror"
                                   value="{{ old('retail_price', $product->retail_price) }}"
                                   placeholder="Retail price">

                            @error('retail_price')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <!-- WHOLESALE -->
                            <input type="text"
                                   name="wholesale_price"
                                   class="form-control mb-1 @error('wholesale_price') is-invalid @enderror"
                                   value="{{ old('wholesale_price', $product->wholesale_price) }}"
                                   placeholder="Wholesale price">

                            @error('wholesale_price')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <!-- DISCOUNT -->
                            <input type="text"
                                   name="discount_price"
                                   class="form-control mb-1 @error('discount_price') is-invalid @enderror"
                                   value="{{ old('discount_price', $product->discount_price) }}"
                                   placeholder="Discount price">

                            @error('discount_price')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <!-- CATEGORY -->
                            <select name="category_id"
                                    class="form-select mb-1 @error('category_id') is-invalid @enderror">

                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        @selected($product->category_id == $cat->id)>
                                        {{ $cat->translations->firstWhere('locale', app()->getLocale())?->name
                                            ?? $cat->translations->firstWhere('locale', 'az')?->name }}
                                    </option>
                                @endforeach

                            </select>

                            @error('category_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <!-- STATUS -->
                            <select name="status" class="form-select mb-2">

                                <option value="pending" @selected($product->status=='pending')>Pending</option>
                                <option value="active" @selected($product->status=='active')>Active</option>
                                <option value="inactive" @selected($product->status=='inactive')>Inactive</option>

                            </select>

                            <!-- CHECKBOX -->
                            <div class="form-check mb-2">
                                <input type="checkbox"
                                       name="is_featured"
                                       value="1"
                                       class="form-check-input"
                                    @checked($product->is_featured)>
                                <label>Featured</label>
                            </div>

                            <div class="form-check mb-2">
                                <input type="checkbox"
                                       name="is_discounted"
                                       value="1"
                                       class="form-check-input"
                                    @checked($product->is_discounted)>
                                <label>Discounted</label>
                            </div>

                            <!-- IMAGES -->
                            <input type="file"
                                   name="images[]"
                                   id="images"
                                   class="form-control mb-1"
                                   multiple>

                            @error('images.*')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <div id="preview" class="d-flex gap-2 flex-wrap mt-2"></div>

                            <input type="hidden" name="removed_images" id="removed_images">

                            <button class="btn btn-primary w-100 mt-3">
                                Update Product
                            </button>

                        </form>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="col-lg-8">

                <div class="card">

                    <div class="card-header">
                        <h4>Product images</h4>
                    </div>

                    <div class="card-body">

                        <div class="d-flex gap-2 flex-wrap">

                            @foreach($product->images as $img)

                                <div class="img-box" style="position:relative;">

                                    <img src="{{ asset('storage/'.$img->image) }}"
                                         width="80"
                                         height="80"
                                         style="object-fit:cover;border-radius:8px;border:1px solid #ddd;">

                                    <button type="button"
                                            class="remove-image"
                                            data-url="{{ route('products.image.delete', $img->id) }}"
                                            style="position:absolute;top:-8px;right:-8px;width:22px;height:22px;border-radius:50%;border:none;background:red;color:white;">
                                        ×
                                    </button>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>
        document.addEventListener('click', function (e) {

            if (e.target.classList.contains('remove-image')) {

                let btn = e.target;
                let url = btn.dataset.url;

                if (!url) {
                    alert('URL tapılmadı');
                    return;
                }

                if (!confirm('Şəkli silmək istəyirsən?')) {
                    return;
                }

                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                    .then(async (res) => {

                        if (!res.ok) {
                            throw new Error('Server error: ' + res.status);
                        }

                        return res.json();
                    })
                    .then(data => {

                        if (data.success) {
                            btn.closest('.img-box').remove();
                        } else {
                            alert(data.message ?? 'Silinmədi');
                        }

                    })
                    .catch(err => {
                        console.log(err);
                        alert('Xəta baş verdi');
                    });

            }

        });
    </script>

@endsection
