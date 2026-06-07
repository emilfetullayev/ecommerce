@extends('admin.layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row">

            <!-- CREATE PRODUCT -->
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

                            <!-- NAME -->
                            <input type="text"
                                   name="name"
                                   class="form-control mb-2"
                                   placeholder="Ad">

                            <!-- DESCRIPTION -->
                            <textarea name="description"
                                      class="form-control mb-2"
                                      placeholder="Açıqlama"></textarea>

                            <!-- PRICE -->
                            <input type="number"
                                   name="price"
                                   class="form-control mb-2"
                                   placeholder="Qiymət">

                            <!-- CATEGORY -->
                            <select name="category_id"
                                    class="form-select mb-2">

                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">
                                        {{ $cat->name }}
                                    </option>
                                @endforeach

                            </select>

                            <!-- STATUS -->
                            <select name="status"
                                    class="form-select mb-2">

                                <option value="pending">Pending</option>
                                <option value="active">Active</option>

                            </select>

                            <!-- IMAGES -->
                            <div class="mb-3">

                                <label class="form-label">Şəkillər</label>

                                <input type="file"
                                       name="images[]"
                                       id="images"
                                       class="form-control"
                                       multiple
                                       accept="image/*">

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
                                <th>Images</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($products as $product)

                                <tr>

                                    <td>{{ $product->id }}</td>

                                    <td>
                                        <strong>{{ $product->name }}</strong>
                                    </td>

                                    <td>
                                        {{ $product->category->name ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $product->price }} ₼
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
