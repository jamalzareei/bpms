@extends('main')
@section('header')

@stop
@section('content')

    <!-- Hoverable rows start -->
    <div class="row" id="table-hover-row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $title }}</h4>
                    <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal"
                        data-target="#addCountry">
                        <i data-feather='plus-square'></i> <span>add a new country</span>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade text-left" id="addCountry" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog" role="document">

                            <form action="{{ route('pages.add.country') }}" method="POST" class=" ajaxForm">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel1">Add country</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control mb-2" id="name"
                                                placeholder="Enter Name">
                                            <small class="w-100 help-block text-danger error-name"></small><br />

                                            <label for="name">code</label>
                                            <input type="text" name="code" class="form-control mb-2" id="code"
                                                placeholder="Enter code">
                                            <small class="w-100 help-block text-danger error-code"></small><br />

                                            <label for="name">area_code</label>
                                            <input type="text" name="area_code" class="form-control mb-2" id="area_code"
                                                placeholder="Enter area code (+98, 0098 , ...)">
                                            <small class="w-100 help-block text-danger error-area_code"></small><br />

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-relief-success">Add</button>
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
                                <th>code</th>
                                <th>name</th>
                                <th>area code</th>
                                <th>created at</th>
                                <th> ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($countries as $country)

                                <form class="ajaxForm"
                                    action="{{ route('pages.update.country', ['country_id' => $country->id]) }}"
                                    id="form-{{ $country->id }}" method="post">
                                    @csrf
                                    <tr>
                                        <td><input type="text" class="form-control" name="code"
                                                value="{{ $country->code }}"></td>
                                        <td><input type="text" class="form-control" name="name"
                                                value="{{ $country->name }}"></td>
                                        <td><input type="text" class="form-control" name="area_code"
                                                value="{{ $country->area_code }}"></td>

                                        <td>
                                            {{ $country->created_at->format('Y-m-d') }}
                                        </td>

                                        <td>
                                            <button type="submit" class="btn btn-relief-success"
                                                for="form-{{ $country->id }}"><i class="fas fa-edit"></i></button>
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

@section('footer')

<script>
    var field = 'create';
    var url = window.location.href;
    let exists = false
    if (url.indexOf('?' + field + '=') != -1 || url.indexOf('&' + field + '=') != -1)
        $('#addCountry').modal('show')


</script>
@stop
