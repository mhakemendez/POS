@extends('templates.navbar')

@section('content')

    <div class="container mt-5 pt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-dark text-white">
                    <div class="card-header">
                        <h4 class="float-left"> USERS </h4>
                        <a href=" {{ route('users.create') }} " class="btn btn-warning float-right"> New Users </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered bg-light">
                            <thead class="bg-warning">
                                <tr>
                                    <th> # </th>
                                    <th> Name </th>
                                    <th> Email </th>
                                    <th> Role </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $num = 1;
                                @endphp
                                @foreach ($user as $users)
                                    <tr>
                                        <td> {{ $num++ }} </td>
                                        <td> {{ $users->name }} </td>
                                        <td> {{ $users->email }} </td>
                                        <td>
                                            @if ($users->is_admin == 1)
                                                {{ __('admin') }}
                                            @else
                                                {{ __('Cashier') }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href=" {{ route('users.edit', $users->id) }} " class="btn btn-warning"><i
                                                    class="fas fa-edit"></i></a>
                                            <a onclick="return confirm('Are you sure want to delete')"
                                                href=" {{ route('users.delete', $users->id) }} " class="btn btn-danger"><i
                                                    class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection()

    <style>


    </style>

    @section('script')

        @if (Session::has('usersuccess'))
            <script>
                swal("", "{!! Session::get('usersuccess') !!}", "success", {
                    button: "OK",
                });
            </script>
        @endif

        @if (Session::has('usererror'))
            <script>
                swal("", "{!! Session::get('usererror') !!}", "error", {
                    button: "OK",
                });
            </script>
        @endif

        @if (Session::has('updatesuccess'))
            <script>
                swal("", "{!! Session::get('updatesuccess') !!}", "success", {
                    button: "OK",
                });
            </script>
        @endif

        @if (Session::has('updateerror'))
            <script>
                swal("", "{!! Session::get('updateerror') !!}", "error", {
                    button: "OK",
                });
            </script>
        @endif

        @if (Session::has('deletesuccess'))
            <script>
                swal("", "{!! Session::get('deletesuccess') !!}", "success", {
                    button: "OK",
                });
            </script>
        @endif

        @if (Session::has('deleterror'))
            <script>
                swal("", "{!! Session::get('deleterror') !!}", "error", {
                    button: "OK",
                });
            </script>
        @endif


    @endsection()
