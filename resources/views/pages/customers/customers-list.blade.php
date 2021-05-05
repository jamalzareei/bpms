@extends('main')
@section('header')

@stop


@section('footer')

    <script>
        var field = 'create';
        var url = window.location.href;
        let exists = false
        if (url.indexOf('?' + field + '=') != -1 || url.indexOf('&' + field + '=') != -1)
            $('#addcustomers').modal('show')


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
                        data-target="#addcustomers">
                        <i data-feather='plus-square'></i> <span>add a new Customer</span>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade text-left" id="addcustomers" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog" role="document">

                            <form action="{{ route('pages.customer.create') }}" method="POST" class=" ajaxForm">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel1">Add a customer</h4>
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

                                            <label for="tell">tell</label>
                                            <input type="text" name="tell" class="form-control mb-2" id="tell"
                                                placeholder="Enter tell">
                                            <small class="w-100 help-block text-danger error-tell"></small><br />

                                            <label for="address">address</label>
                                            <textarea name="address" id="address" class="form-control mb-2" cols="30"
                                                rows="5" placeholder="Enter address"></textarea>
                                            <small class="w-100 help-block text-danger error-address"></small><br />

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-relief-success">create a customer</button>
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
                                <th>tell</th>
                                <th>created at</th>
                                <th> ACTION </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($customers as $customer)
                                <form class="ajaxForm"
                                    action="{{ route('pages.customer.update', ['customer_id' => $customer->id]) }}"
                                    method="post" id="form-{{ $customer->id }}">
                                    @csrf
                                    <tr>

                                        <td><input type="text" name="name" class="form-control"
                                                value="{{ $customer->name }}"></td>

                                        <td><input type="text" name="code" class="form-control"
                                                value="{{ $customer->code }}"></span>
                                        </td>
                                        <td><input type="text" name="tell" class="form-control"
                                                value="{{ $customer->tell }}"></td>
                                        <td>
                                            {{ $customer->created_at->format('Y-m-d') }}
                                        </td>

                                        <td>

                                            <button type="submit" class="btn btn-relief-success"
                                                for="form-{{ $customer->id }}"><i class="fas fa-edit"></i></button>

                                        </td>
                                    </tr>
                                </form>
                            @empty

                            <tr>
                                <td colspan="5">Not Item for show</td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    {{ $customers->appends($_GET)->links() }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>


@stop
