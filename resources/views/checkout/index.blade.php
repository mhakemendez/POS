@extends(Auth::user()->is_admin == 1 ? "templates.navbar" : "templates.cashier")

@section('content')
    <div class="container mt-5 py-4">
        <div class="row">
            <div class="col-lg-7">
                <div class="card text-white bg-dark">
                    <div class="card-header">
                        <h4>Customer Information</h4>
                    </div>
                    <div class="card-body">

                        <form id="product_insert" action="{{ route('checkout.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 border pt-1 pb-1 text-center">
                                        <label for="ProductName" class="font-weight-bold mt-2">Full Name</label>
                                    </div>
                                    <div class="col-md-8 border pt-1 pb-1">
                                        <input type="text" name="name" class="form-control" id="ProductName">
                                        @error('name')
                                            <p class="text-danger"> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 border pt-1 pb-1 text-center">
                                        <label for="Address" class="font-weight-bold mt-2">Address</label>
                                    </div>
                                    <div class="col-md-8 border pt-1 pb-1">
                                        <input type="text" name="address" class="form-control" id="ProductName">
                                        @error('address')
                                            <p class="text-danger"> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 border pt-1 pb-1 text-center">
                                        <label for="Contact " class="font-weight-bold mt-2">Contact No.</label>
                                    </div>
                                    <div class="col-md-8 border pt-1 pb-1">
                                        <input type="text" name="contact" class="form-control" id="contact">
                                        @error('contact')
                                            <p class="text-danger"> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 border pt-1 pb-1 text-center">
                                        <label for="payment " class="font-weight-bold mt-2">Amount Pay:</label>
                                    </div>
                                    <div class="col-md-8 border pt-1 pb-1">
                                        <input type="text" name="payment" class="form-control" id="payment">
                                        @error('payment')
                                            <p class="text-danger"> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <input id="changed" name="changed" type="hidden" value="">

                            <button id="checkout" type="submit" class="btn btn-warning btn-block">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card text-white bg-dark">
                    <div class="card-header">
                        <h4>List of Orders</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center text-primary">
                            <thead class="bg-warning">
                                <tr>
                                    <th> # </th>
                                    <th> name </th>
                                    <th> price </th>
                                    <th> qty </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $num = 1;
                                @endphp
                                @foreach ($item as $items)
                                    <tr>
                                        <td> {{ $num++ }} </td>
                                        <td> {{ $items->name }} </td>
                                        <td> {{ $items->price }} </td>
                                        <td> {{ $items->quantity }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="float-left font-weight-bold text-danger">
                            TOTAL : &#8369;
                            <span class="total">
                                {{ number_format(Cart::session(auth()->id())->getTotal(), 2) }}
                            </span>
                            <input id="test" type="hidden" value="{{ Cart::session(auth()->id())->getTotal() }}">
                        </div>
                        <br>
                        <div class="float-left font-weight-bold text-primary">
                            CHANGE : &#8369;
                            <span class="change">

                            </span>
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
        margin-top: 20px;
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

    <script>
        $(document).ready(function() {
            $("#payment").on('keyup', function(e) {

                var total = $("#test").val() - 0;
                var payment = $(this).val() - 0;
                var change = (payment - total);
                $(".change").html(change);
                $("#changed").val(change);

                if (payment >= total) {
                    $('#checkout').prop('disabled', false);
                } else {
                    $('#checkout').prop('disabled', true);
                }
            })

            $('#checkout').prop('disabled', true);
        })
    </script>

@endsection()
