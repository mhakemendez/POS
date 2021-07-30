@extends(Auth::user()->is_admin == 1 ? "templates.navbar" : "templates.cashier")

@section('content')
    <div class="container mt-5 pt-4">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card bg-dark receipt-area">
                    <div class="card-header text-center text-white">
                        <h4 class="float-left">Receipt of payment</h4>
                        <a href=" " class="btn btn-warning float-right print"><i class="fas fa-print"></i></a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered bg-light">
                            <thead class="bg-warning">
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data as $datas)
                                    <tr>
                                        <td> {{ $datas->product_name }} </td>
                                        <td> {{ $datas->qty }} </td>
                                        <td> {{ $datas->price }} </td>
                                        <td> {{ $datas->sub_total }} </td>
                                    </tr>
                                @endforeach
                                <table class="table bg-secondary bg-light">

                                    <tr>
                                        <td class="font-weight-bold">Customer Name</td>
                                        <td> {{ $data[0]->customer_name }} </td>
                                    </tr>

                                    <tr>
                                        <td class="font-weight-bold"> Total Amount </td>
                                        <td> {{ $data[0]->total_amount }} </td>
                                    </tr>

                                    <tr>
                                        <td class="font-weight-bold"> Total Amount Pay </td>
                                        <td> {{ $data[0]->total_amount_pay }} </td>
                                    </tr>

                                    <tr>
                                        <td class="font-weight-bold"> Changed </td>
                                        <td> {{ $data[0]->change }} </td>
                                    </tr>

                                </table>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('script')

    @if (Session::has('placeorder'))
        <script>
            swal("", "{!! Session::get('placeorder') !!}", "success", {
                button: "OK",
            });
        </script>
    @endif

    <script>
        $('.print').click(function() {
            window.print();
        });
    </script>


@endsection()
