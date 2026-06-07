@extends('admin.layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-4">

                <div class="card">

                    <div class="card-header">
                        <h4>Edit Company</h4>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('companies.update', $company) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <select name="price_type" class="form-select mb-2">
                                <option value="retail" @selected($company->price_type == 'retail')>
                                    Pərakəndə qiymət
                                </option>

                                <option value="wholesale" @selected($company->price_type == 'wholesale')>
                                    Topdan qiymət
                                </option>
                            </select>

                            <input type="text" name="company_name"
                                   value="{{ $company->company_name }}"
                                   class="form-control mb-2">

                            <input type="text" name="name"
                                   value="{{ $company->name }}"
                                   class="form-control mb-2">

                            <input type="email" name="email"
                                   value="{{ $company->email }}"
                                   class="form-control mb-2">

                            <input type="text" name="phone"
                                   value="{{ $company->phone }}"
                                   class="form-control mb-2">

                            <input type="password" name="password"
                                   class="form-control mb-2"
                                   placeholder="New password">

                            <select name="status" class="form-select mb-2">
                                <option value="active" @selected($company->status=='active')>Active</option>
                                <option value="inactive" @selected($company->status=='inactive')>Inactive</option>
                            </select>



                            <button class="btn btn-primary">Yenilə</button>

                        </form>

                    </div>

                </div>

            </div>

            <div class="col-lg-8">

                <div class="card">

                    <div class="card-header">
                        <h4>Company info</h4>
                    </div>

                    <div class="card-body">

                        <p><strong>ID:</strong> {{ $company->id }}</p>
                        <p><strong>Company:</strong> {{ $company->company_name }}</p>
                        <p><strong>Name:</strong> {{ $company->name }}</p>
                        <p><strong>Email:</strong> {{ $company->email }}</p>
                        <p><strong>Phone:</strong> {{ $company->phone }}</p>
                        <p><strong>Status:</strong> {{ $company->status }}</p>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
