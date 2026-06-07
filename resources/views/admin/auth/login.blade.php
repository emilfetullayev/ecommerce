<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Login | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.ico') }}">

    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/app.min.css') }}" rel="stylesheet">

</head>

<body>

<div class="auth-page-wrapper pt-5">

    <div class="auth-one-bg-position auth-one-bg">
        <div class="bg-overlay"></div>
    </div>

    <div class="auth-page-content">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">

                    <div class="card mt-4">

                        <div class="card-body p-4">

                            <div class="text-center mb-4">
                                <h5 class="text-primary">Admin Login</h5>
                                <p class="text-muted">Sign in to your account</p>
                            </div>

                            <form method="POST" action="{{ route('admin.login') }}">
                                @csrf

                                {{-- EMAIL --}}
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email"
                                           name="email"
                                           class="form-control"
                                           placeholder="Enter email">
                                </div>

                                {{-- PASSWORD --}}
                                <div class="mb-3">
                                    <label>Password</label>
                                    <input type="password"
                                           name="password"
                                           class="form-control"
                                           placeholder="Enter password">
                                </div>

                                {{-- ERROR --}}
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        {{ $errors->first() }}
                                    </div>
                                @endif

                                <button class="btn btn-primary w-100">
                                    Login
                                </button>

                            </form>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>

    <footer class="footer">
        <div class="container text-center">
            <p class="text-muted mb-0">
                © {{ date('Y') }} Admin Panel
            </p>
        </div>
    </footer>

</div>

<script src="{{ asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
