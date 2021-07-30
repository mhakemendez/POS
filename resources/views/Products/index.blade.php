@extends('templates.navbar')

@section('content')

    <div class="container mt-5 pt-4">
        <div class="card text-white bg-dark">
            <div class="card-header">
                <h4 class="float-left"> {{ __('Product List') }} </h4>
                <a href=" {{ route('product.create') }} " class="btn btn-warning float-right">Add New Product</a>

            </div>
            <div class="card-body">
                <table id="myTable" class="table table-bordered text-center bg-light">
                    <thead>
                        <tr>
                            <thead class="bg-warning">
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Stacks</th>
                                <th>Action</th>
                            </thead>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $num = 0;
                        @endphp
                        @foreach ($product as $products)
                            <tr>
                                <td> {{ $product->firstItem() + $num++ }} </td>
                                <td> {{ $products->product_name }} </td>
                                <td>
                                    <img src="{{ $products->product_image }}" alt="" height="50px" width="80px">
                                </td>
                                <td> {{ $products->description }} </td>
                                <td> {{ $products->price }} </td>
                                <td> {{ $products->name }} </td>
                                <td> {{ $products->stacks }} </td>
                                <td>
                                    <a href="{{ route('product.edit', $products->id) }}" class="btn btn-primary btn-sm"><i
                                            class="fas fa-edit"></i></a>
                                    <a onclick="return confirm('Are You Sure want to delete?')"
                                        href=" {{ route('product.delete', $products->id) }} "
                                        class="btn btn-danger delete btn-sm"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $product->links() }}
            </div>
        </div>
    </div>
    <footer class="bg-dark">
        @include('templates.footer')
    </footer>
@endsection()

<style>
    footer {
        height: 50px;
        padding: 0;
        margin-top: 10px
    }

    .container .card .card-body .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color: #ffed4a;
        border-color: #f0ad4e;
    }

</style>

@section('script')

    @if (Session::has('inserted'))
        <script>
            swal("", "{!! Session::get('inserted') !!}", "success", {
                button: "OK",
            });
        </script>
    @endif

    @if (Session::has('updated'))
        <script>
            swal("", "{!! Session::get('updated') !!}", "success", {
                button: "OK",
            });
        </script>
    @endif

    @if (Session::has('deleted'))
        <script>
            swal("", "{!! Session::get('deleted') !!}", "success", {
                button: "OK",
            });
        </script>
    @endif

    @if (Session::has('errorUpdate'))
        <script>
            swal("", "{!! Session::get('errorUpdate') !!}", "success", {
                button: "OK",
            });
        </script>
    @endif

@endsection()
