@extends(Auth::user()->is_admin == 1 ? "templates.navbar" : "templates.cashier")

@section('content')
    <div class="container mt-5 pt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-dark">
                    <div class="card-header text-white">
                        <h4>Sales</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered bg-light" id="myTable">
                            <thead class="bg-warning">
                                <tr>
                                    <th>#</th>
                                    <th>Total Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $num = 0;
                                @endphp
                                @foreach ($sales as $sale)
                                    <tr>
                                        <td> {{ $sales->firstItem() + $num++ }} </td>
                                        <td> &#8369; {{ number_format($sale->total_amount, 2) }} </td>
                                        <td> {{ $sale->created_at }} </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="font-weight-bold">TOTAL SALES</td>
                                    <td class="font-weight-bold"> &#8369; {{ number_format($sum, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        {{ $sales->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection()

<style>
    .container .card .card-body .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color: #ffed4a;
        border-color: #f0ad4e;
    }

</style>
