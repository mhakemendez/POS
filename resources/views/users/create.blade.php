@extends('templates.navbar')

@section('content')

    <div class="container mt-5 pt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-white bg-dark">
                    <div class="card-header">
                        <h4 class="float-left"> Add New Users</h4>
                    </div>
                    <div class="card-body">
                        <form id="product_insert" action="{{ route('users.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 border pt-1 pb-1 text-center">
                                        <label for="name" class="font-weight-bold mt-2"> Name:
                                            <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <div class="col-md-8 border pt-1 pb-1">
                                        <input type="text" name="name" class="form-control" id="Name">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 border pt-1 pb-1 text-center">
                                        <label for="email" class="font-weight-bold mt-2">Email:
                                            <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <div class="col-md-8 border pt-1 pb-1">
                                        <input type="email" name="email" class="form-control" id="email">
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 border pt-1 pb-1 text-center">
                                        <label for="Password" class="font-weight-bold mt-2">Password:
                                            <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <div class="col-md-8 border pt-1 pb-1">
                                        <input type="password" name="password" class="form-control" id="password">
                                        @error('password')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 border pt-1 pb-1 text-center">
                                        <label for="ConfirmPassword" class="font-weight-bold mt-2">Confirm Password:
                                            <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <div class="col-md-8 border pt-1 pb-1">
                                        <input type="password" name="password_confirmation" class="form-control"
                                            id="confirmpassword">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 border pt-1 pb-1 text-center">
                                        <label for="Category" class="font-weight-bold mt-2">Role:
                                            <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <div class="col-md-8 border pt-1 pb-1">
                                        <select name="isadmin" class="form-control" id="isadmin">
                                            @php
                                                $admin = 1;
                                                $cashier = 2;
                                            @endphp
                                            <option value="{{ $admin }}"> Admin </option>
                                            <option value="{{ $cashier }}"> Cashier </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-warning btn-block">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-dark mt-2">
        @include('templates.footer')
    </footer>
@endsection()

<style>
    .container .row .col-image .card img {
        width: 100%;
        height: 200px;
    }

    footer {
        height: 50px;
        padding: 0;
    }

</style>

@section('script')

    <script>
        function previewFile(input) {

            var file = $("input[type=file]").get(0).files[0];

            if (file) {

                var reader = new FileReader();

                reader.onload = function() {

                    $("#previewImg").attr("src", reader.result);
                }

                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection()
