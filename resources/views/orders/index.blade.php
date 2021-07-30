@extends(Auth::user()->is_admin == 1 ? "templates.navbar" : "templates.cashier")

@section('content')
    <div class="container mt-5 pt-4">
        <div class="row">
            <div class="col-lg-7 mt-2">
                <div class="card bg-dark">
                    <div class="card-header">
                        <h4 class="text-white">List of Product</h4>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            @foreach ($order as $orders)
                                <div class="col-md-4 col-sm-4 col-8 mt-1">
                                    <div class="card text-center">
                                        <img src="{{ asset($orders->product_image) }}" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $orders->product_name }}</h5>
                                            <h6 class="text-danger"> &#8369;{{ number_format($orders->price) }} </h6>
                                            <a href=" {{ route('order.create', $orders->id) }} "
                                                class="btn btn-warning btn-block"><i
                                                    class="fas fa-shopping-cart icons"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-1">
                            {{ $order->links() }}
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-5 mt-2">
                <div class="card text-white bg-dark">
                    <div class="card-header">
                        <h4>List of Orders</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center bg-light">
                            <thead class="bg-warning">
                                <tr>
                                    <th> # </th>
                                    <th> name </th>
                                    <th> price </th>
                                    <th> qty </th>
                                    <th> subtotal </th>
                                    <th> action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $num = 1;
                                @endphp
                                @foreach ($item as $key => $items)
                                    <tr>
                                        <td> {{ $num++ }} </td>
                                        <td> {{ $items->name }} </td>
                                        <td> {{ $items->price }} </td>
                                        <td>
                                            <form action=" {{ route('order.update', $items->id) }}" method="post">
                                                @csrf
                                                <input type="number" name="qty" id="qty" value="{{ $items->quantity }}">
                                                <button type="submit" class="btn btn-warning btn-sm mt-1">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td> &#8369;
                                            {{ number_format(
    Cart::session(auth()->id())->get($items->id)->getPriceSum(),
    2,
) }}
                                        </td>
                                        <td> <a onclick=" return confirm('Are you sure?') "
                                                href=" {{ route('order.delete', $items->id) }} "
                                                class="btn btn-danger"><i class="fas fa-trash-alt"></i></a> </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="float-right">
                            <a href=" {{ route('checkout.index') }} " class="btn btn-warning">Check Out</a>
                        </div>
                        <div class="float-left font-weight-bold">
                            TOTAL : {{ number_format(Cart::session(auth()->id())->getTotal(), 2) }}
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <footer class="bg-dark">
        @include('templates.footer')
    </footer>
@endsection()

<style>
    .container .row .card .card-body .row .card img {
        width: 100%;
        height: 100px;
    }

    #qty {
        width: 50px;
    }

    footer {
        height: 50px;
        margin-top: 65px;
    }

    .container .card .card-body .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color: #ffed4a;
        border-color: #f0ad4e;
    }

</style>

@section('script')

    @if (Session::has('cart'))
        <script>
            swal("", "{!! Session::get('cart') !!}", "success", {
                button: "OK",
            });
        </script>
    @endif

    @if (Session::has('cartUpdate'))
        <script>
            swal("", "{!! Session::get('cartUpdate') !!}", "success", {
                button: "OK",
            });
        </script>
    @endif

    @if (Session::has('cartdelete'))
        <script>
            swal("", "{!! Session::get('cartdelete') !!}", "success", {
                button: "OK",
            });
        </script>
    @endif

    @if (Session::has('checkout'))
        <script>
            swal("", "{!! Session::get('checkout') !!}", "success", {
                button: "OK",
            });
        </script>
    @endif

    @if (Session::has('emptycart'))
        <script>
            swal("", "{!! Session::get('emptycart') !!}", "error", {
                button: "OK",
            });
        </script>
    @endif

@endsection()
