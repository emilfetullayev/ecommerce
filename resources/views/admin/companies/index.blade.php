@extends('admin.layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row">

            {{-- ADD COMPANY --}}
            <div class="col-lg-4">

                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">Company əlavə et</h4>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('companies.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label>Company Name</label>
                                <input type="text" name="company_name" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Ad</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" class="form-select">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>

                            <button class="btn btn-primary">Əlavə et</button>

                        </form>

                    </div>

                </div>

            </div>

            {{-- LIST --}}
            <div class="col-lg-8">

                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">Company list</h4>
                    </div>

                    <div class="card-body">

                        <table class="table align-middle">

                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Company</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($companies as $company)

                                <tr>
                                    <td>{{ $company->id }}</td>
                                    <td><strong>{{ $company->company_name }}</strong></td>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td>{{ $company->phone }}</td>
                                    <td>
                                    <span class="badge bg-success">
                                        {{ $company->status }}
                                    </span>
                                    </td>

                                    <td>

                                        <a href="{{ route('companies.edit', $company) }}"
                                           class="btn btn-sm btn-warning">
                                            Edit
                                        </a>

                                        <form action="{{ route('companies.destroy', $company) }}"
                                              method="POST"
                                              class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-sm btn-danger">
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
