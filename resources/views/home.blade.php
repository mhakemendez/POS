@extends('templates.cashier')

@section('content')
    <div class="container mt-5 pt-3">
        <div class="row">
            <div class="col-md-4 mt-2">
                <div class="card">
                    <div class="card-header text-center text-warning bg-dark">
                        <h4>USERS</h4>
                        <i class="fas fa-user icons menu-icons"></i>
                    </div>
                    <div class=" card-body text-center">
                        <h2 class="dashboard-count"> {{ $users }} </h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-2 mb-2 ">
                <div class="card">
                    <div class="card-header text-center text-warning bg-dark">
                        <h4>PRODUCTS</h4>
                        <i class="fas fa-hamburger icons menu-icons"></i>
                    </div>
                    <div class=" card-body text-center">
                        <h2 class="dashboard-count"> {{ $products }} </h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-2 mb-2 ">
                <div class="card">
                    <div class="card-header text-center text-warning bg-dark">
                        <h4>CATEGORIES</h4>
                        <i class="fas fa-square icons menu-icons"></i>
                    </div>
                    <div class=" card-body text-center">
                        <h2 class="dashboard-count"> {{ $categories }} </h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-2 mb-2 ">
                <div class="card">
                    <div class="card-header text-center text-warning bg-dark">
                        <h4>CUSTOMERS</h4>
                        <i class="fas fa-users icons menu-icons"></i>
                    </div>
                    <div class=" card-body text-center">
                        <h2 class="dashboard-count"> {{ $customers }} </h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-2 mb-2">
                <div class="card">
                    <div class="card-header text-center text-warning bg-dark">
                        <h4>ORDERS</h4>
                        <i class="fas fa-shopping-cart icons menu-icons"></i>
                    </div>
                    <div class="card-body text-center">
                        <h2 class="dashboard-count"> {{ $orders }} </h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-2 mb-2 ">
                <div class="card">
                    <div class="card-header text-center text-warning bg-dark">
                        <h4>SALES</h4>
                        <i class="fas fa-money-bill-alt icons menu-icons"></i>
                    </div>
                    <div class=" card-body text-center">
                        <h2 class="dashboard-count"> &#8369;{{ number_format($sum) }} </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-dark mt-2">
        @include('templates.footer')
    </footer>

    @if (session()->has('flash_notification.success'))
        <div class="alert alert-success">{!! session('flash_notification.success') !!}</div>
    @endif
@endsection



<style>
    @import url('https://fonts.googleapis.com/css2?family=Rubik+Mono+One&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .menu-icons {
        font-size: 50px;
    }

    .dashboard-count {
        font-family: 'Rubik Mono One', sans-serif;
        font-size: 50px
    }

    footer {
        height: 50px;
        padding: 0;
    }

</style>
