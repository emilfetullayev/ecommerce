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

                        <form action="{{ route('products.update', $product) }}"
                              method="POST"
                              enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <!-- 🌍 TRANSLATIONS -->
                            <div class="mb-3">

                                <ul class="nav nav-tabs">

                                    @foreach(['az','en','ru','zh'] as $lang)

                                        <li class="nav-item">
                                            <button class="nav-link @if($loop->first) active @endif"
                                                    data-bs-toggle="tab"
                                                    data-bs-target="#{{ $lang }}"
                                                    type="button">
                                                {{ strtoupper($lang) }}
                                            </button>
                                        </li>

                                    @endforeach

                                </ul>

                                <div class="tab-content pt-3">

                                    @foreach(['az','en','ru','zh'] as $lang)

                                        @php
                                            $t = $product->translations->where('locale', $lang)->first();
                                        @endphp

                                        <div class="tab-pane fade @if($loop->first) show active @endif"
                                             id="{{ $lang }}">

                                            <input type="text"
                                                   name="translations[{{ $lang }}][name]"
                                                   class="form-control mb-2"
                                                   value="{{ $t->name ?? '' }}"
                                                   placeholder="Name">

                                            <textarea name="translations[{{ $lang }}][description]"
                                                      class="form-control"
                                                      placeholder="Description">{{ $t->description ?? '' }}</textarea>

                                        </div>

                                    @endforeach

                                </div>

                            </div>

                            <input type="text"
                                   name="code"
                                   class="form-control mb-2"
                                   value="{{ $product->code }}"
                                   placeholder="Code">
                            <!-- PRICES -->
                            <input type="number"
                                   name="retail_price"
                                   class="form-control mb-2"
                                   value="{{ $product->retail_price }}"
                                   placeholder="Retail price">


                            <input type="number"
                                   name="wholesale_price"
                                   class="form-control mb-2"
                                   value="{{ $product->wholesale_price }}"
                                   placeholder="Wholesale price">

                            <input type="number"
                                   name="discount_price"
                                   class="form-control mb-2"
                                   value="{{ $product->discount_price }}"
                                   placeholder="Discount price">



                            <select name="price_type" class="form-select mb-2">

                                <option value="retail" @selected($product->price_type == 'retail')>
                                    Retail
                                </option>

                                <option value="wholesale" @selected($product->price_type == 'wholesale')>
                                    Wholesale
                                </option>

                            </select>

                            <!-- COMPANY -->


                            <!-- CATEGORY -->
                            <select name="category_id" class="form-select mb-2">

                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        @selected($product->category_id == $cat->id)>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach

                            </select>

                            <!-- STATUS -->
                            <select name="status" class="form-select mb-2">

                                <option value="pending" @selected($product->status=='pending')>Pending</option>
                                <option value="active" @selected($product->status=='active')>Active</option>
                                <option value="inactive" @selected($product->status=='inactive')>Inactive</option>

                            </select>

                            <!-- FEATURED -->
                            <div class="form-check mb-2">

                                <input type="checkbox"
                                       name="is_featured"
                                       value="1"
                                       class="form-check-input"
                                    @checked($product->is_featured)>

                                <label class="form-check-label">
                                    Featured (banner)
                                </label>

                            </div>

                            <!-- FEATURED -->
                            <div class="form-check mb-2">
                                <input type="checkbox"
                                       name="is_discounted"
                                       value="1"
                                       class="form-check-input"
                                    @checked($product->is_discounted)>

                                <label class="form-check-label">
                                    Endirimde
                                </label>
                            </div>

                            <!-- NEW IMAGES -->
                            <div class="mb-3">

                                <input type="file"
                                       name="images[]"
                                       id="images"
                                       class="form-control"
                                       multiple>

                                <div id="preview" class="d-flex gap-2 flex-wrap mt-2"></div>

                            </div>

                            <!-- removed images -->
                            <input type="hidden" name="removed_images" id="removed_images">

                            <button class="btn btn-primary w-100">
                                Update Product
                            </button>

                        </form>

                    </div>

                </div>

            </div>

            <!-- RIGHT: IMAGES -->
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
                                            data-id="{{ $img->id }}"
                                            style="
                                        position:absolute;
                                        top:-8px;
                                        right:-8px;
                                        width:22px;
                                        height:22px;
                                        border-radius:50%;
                                        border:none;
                                        background:red;
                                        color:white;
                                        font-size:12px;
                                        cursor:pointer;">
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

    <!-- PREVIEW -->
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

    <!-- REMOVE IMAGES -->
    <script>
        let removedImages = [];

        document.querySelectorAll('.remove-image').forEach(btn => {

            btn.addEventListener('click', function () {

                removedImages.push(this.dataset.id);

                document.getElementById('removed_images').value = removedImages.join(',');

                this.closest('.img-box').remove();

            });

        });
    </script>

@endsection
