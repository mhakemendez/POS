@extends(Auth::user()->is_admin == 1 ? "templates.navbar" : "templates.cashier")

@section('content')
    <div class="container mt-5 pt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-dark">
                    <div class="card-header text-white">
                        <h4>CUSTOMERS LIST</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered bg-light text-center">
                            <thead class="bg-warning">
                                <tr>
                                    <th>#</th>
                                    <th>Customer Name</th>
                                    <th>Address</th>
                                    <th>Phone Number</th>
                                    <th>Date and Time</th>
                                    <th>Receipt</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $num = 0;
                                @endphp
                                @foreach ($customer as $customers)
                                    <tr>
                                        <td> {{ $customer->firstItem() + $num++ }} </td>
                                        <td> {{ $customers->customer_name }} </td>
                                        <td> {{ $customers->address }} </td>
                                        <td> {{ $customers->contact_number }} </td>
                                        <td> {{ $customers->created_at }} </td>
                                        <td> <a href=" {{ route('checkout.show', $customers->id) }} "
                                                class="btn btn-warning"><i class="fas fa-receipt"></i></a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $customer->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .container .card .card-body .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color: #ffed4a;
        border-color: #f0ad4e;
    }

</style>
