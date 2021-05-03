@extends('main')
@section('header')

@stop


@section('footer')

    <script>
        var field = 'create';
        var url = window.location.href;
        let exists = false
        if (url.indexOf('?' + field + '=') != -1 || url.indexOf('&' + field + '=') != -1)
            $('#addproducts').modal('show')


    </script>
@stop


@section('content')

    <!-- Hoverable rows start -->
    <div class="row" id="table-hover-row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $title }}</h4>
                    <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal"
                        data-target="#addproducts">
                        <i data-feather='plus-square'></i> <span>add a new product</span>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade text-left" id="addproducts" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog" role="document">

                            <form action="{{ route('pages.product.create') }}" method="POST" class=" ajaxForm">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel1">Add a product</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name">name</label>
                                            <input type="text" name="name" class="form-control mb-2" id="name"
                                                placeholder="Enter name">
                                            <small class="w-100 help-block text-danger error-name"></small><br />
                                            <label for="code">code</label>
                                            <input type="text" name="code" class="form-control mb-2" id="code"
                                                placeholder="Enter code">
                                            <small class="w-100 help-block text-danger error-code"></small><br />

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-relief-success">create a product</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>


                <div class="table-responsive responsive-overflow">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>code</th>
                                <th>created at</th>
                                <th> ACTION </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <form class="ajaxForm"
                                    action="{{ route('pages.product.update', ['product_id' => $product->id]) }}"
                                    method="post" id="form-{{ $product->id }}">
                                    @csrf
                                    <tr>

                                        <td><input type="text" name="name" class="form-control" value="{{ $product->name }}"></td>

                                        <td><input type="text" name="code" class="form-control" value="{{ $product->code }}"></span>
                                        </td>
                                        <td>
                                            {{ $product->created_at->format('Y-m-d') }}
                                        </td>

                                        <td>

                                            <button type="submit" class="btn btn-relief-success"
                                                for="form-{{ $product->id }}"><i class="fas fa-edit"></i></button>

                                        </td>
                                    </tr>
                                </form>
                            @empty

                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@stop
