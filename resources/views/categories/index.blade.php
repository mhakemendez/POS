@extends('templates.navbar')

@section('content')
    <div class="container mt-5 pt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-white bg-dark">
                    <div class="card-header">
                        <h4 class="float-left">CATEGORIES</h4>
                        <button type="button" class="btn btn-warning float-right" data-toggle="modal"
                            data-target="#exampleModal">
                            New Category
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered bg-light">
                            <thead class="bg-warning">
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $num = 0;
                                @endphp
                                @foreach ($category as $categories)
                                    <tr>
                                        <td> {{ $category->firstItem() + $num++ }} </td>
                                        <td> {{ $categories->name }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $category->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form action="{{ route('category.store') }}">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 border pt-1 pb-1 text-center">
                                            <label for="category " class="font-weight-bold mt-2">Category:</label>
                                        </div>
                                        <div class="col-md-8 border pt-1 pb-1">
                                            <input type="text" name="category" class="form-control" id="category">

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-warning">Save changes</button>
                                </div>
                            </form>
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
    footer {
        height: 50px;
        margin-top: 95px;
    }

</style>

@section('script')

    @error('category')
        <script>
            swal("", "{{ $message }}", "error", {
                button: "OK",
            });
        </script>
    @enderror

    @if (Session::has('addcategory'))
        <script>
            swal("", "{!! Session::get('addcategory') !!}", "success", {
                button: "OK",
            });
        </script>
    @endif

@endsection
