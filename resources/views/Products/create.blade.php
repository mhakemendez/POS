@extends('templates.navbar')

@section('content')

    <div class="container mt-5 pt-4">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card text-white bg-dark">
                    <div class="card-header">
                        <h4 class="float-left"> Add New Product</h4>
                        <a href="" class="btn btn-warning float-right">Back to Product List</a>
                    </div>
                    <div class="card-body">
                        <form id="product_insert" action="{{ route('product.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 border pt-1 pb-1 text-center">
                                        <label for="ProductName" class="font-weight-bold mt-2">Product Name:
                                            <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <div class="col-md-8 border pt-1 pb-1">
                                        <input type="text" name="product_name" class="form-control" id="ProductName">
                                        @error('product_name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 border pt-1 pb-1 text-center">
                                        <label for="Description" class="font-weight-bold mt-2">Description:
                                            <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <div class="col-md-8 border pt-1 pb-1">
                                        <input type="text" name="description" class="form-control" id="Description">
                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 border pt-1 pb-1 text-center">
                                        <label for="Price" class="font-weight-bold mt-2">Price:
                                            <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <div class="col-md-8 border pt-1 pb-1">
                                        <input type="text" name="price" class="form-control" id="Price">
                                        @error('price')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 border pt-1 pb-1 text-center">
                                        <label for="Category" class="font-weight-bold mt-2">Category:
                                            <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <div class="col-md-8 border pt-1 pb-1">
                                        <select name="category" class="form-control" id="Category">
                                            <option value=""> Select Category </option>
                                            @foreach ($category as $categories)
                                                <option value="{{ $categories->id }}"> {{ $categories->name }} </option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 border pt-1 pb-1 text-center">
                                        <label for="Stacks" class="font-weight-bold mt-2">Stacks:
                                            <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <div class="col-md-8 border pt-1 pb-1">
                                        <input type="text" name="stacks" class="form-control" id="Stacks">
                                        @error('stacks')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-warning btn-block">Save</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-image">
                <div class="card text-white bg-dark">
                    <div class="card-header">
                        <h4>Upload Image</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group text-center">
                            <img id="previewImg" class="mb-2" src="{{ asset('images/products/dafault.png') }}"
                                alt="Placeholder">
                            <input id="image" type="file" name="image" onchange="previewFile(this);">
                        </div>
                    </div>
                    </form>
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
