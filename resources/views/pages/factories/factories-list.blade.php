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
                        data-target="#addFactory">
                        <i data-feather='plus-square'></i> <span>add a new factory</span>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade text-left" id="addFactory" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog" role="document">

                            <form action="{{ route('pages.add.factory') }}" method="POST" class=" ajaxForm">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel1">Add factory</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control " id="name"
                                                placeholder="Enter Name">
                                            <small class="w-100 help-block text-danger error-name"></small><br />

                                            <label for="name">code</label>
                                            <input type="text" name="code" class="form-control " id="code"
                                                placeholder="Enter code">
                                            <small class="w-100 help-block text-danger error-code"></small><br />

                                            <label for="country_id">country_id</label>
                                            <select name="country_id" class="form-control" id="country_id" >
                                                <option value="">--- please select coutnry ---</option>
                                                @forelse ($countries as $country)
                                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                                @empty
                                                    
                                                @endforelse
                                            </select>

                                            <small class="w-100 help-block text-danger error-country_id"></small><br />
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
                                <th>name</th>
                                <th>code</th>
                                <th>country</th>
                                <th>created at</th>
                                <th> ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($factories as $factory)

                                <form class="ajaxForm"
                                    action="{{ route('pages.update.factory', ['factory_id' => $factory->id]) }}"
                                    id="form-{{ $factory->id }}" method="post">
                                    @csrf
                                    <tr>
                                        <td><input type="text" class="form-control" name="name"
                                                value="{{ $factory->name }}"></td>
                                        <td><input type="text" class="form-control" name="code"
                                                value="{{ $factory->code }}"></td>
                                        <td>
                                            <select name="country_id" class="form-control" >
                                                <option value="">--- please select coutnry ---</option>
                                                @forelse ($countries as $country)
                                                    <option value="{{$country->id}}" {{($country->id == $factory->country_id) ? 'selected' : ''}}>{{$country->name}}</option>
                                                @empty
                                                    
                                                @endforelse
                                            </select>
                                        </td>
                                        <td>
                                            {{ $factory->created_at->format('Y-m-d') }}
                                        </td>

                                        <td>
                                            <button type="submit" class="btn btn-relief-success"
                                                for="form-{{ $factory->id }}"><i class="fas fa-edit"></i></button>
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
        $('#addFactory').modal('show')


</script>
@stop
