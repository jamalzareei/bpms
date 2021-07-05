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

                                            
                                            <label for="name">phone number</label>
                                            <input type="text" name="phone_number" class="form-control " id="phone_number"
                                                placeholder="Enter phone_number">
                                            <small class="w-100 help-block text-danger error-phone_number"></small><br />

                                            
                                            <label for="name">address</label>
                                            <input type="text" name="address" class="form-control " id="address"
                                                placeholder="Enter address">
                                            <small class="w-100 help-block text-danger error-address"></small><br />

                                            {{-- <label for="country_id">country_id</label>
                                            <select name="country_id" class="form-control" id="country_id" >
                                                <option value="">--- please select coutnry ---</option>
                                                @forelse ($countries as $country)
                                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                                @empty
                                                    
                                                @endforelse
                                            </select> --}}

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
                                <th>tell</th>
                                <th>created at</th>
                                <th> ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($factories as $factory)

                                <form class="ajaxForm"
                                    action="{{ route('pages.update.factory', ['factory_id' => $factory->id]) }}"
                                    id="form-{{ $factory->id }}" method="post" >
                                    @csrf
                                    <tr id="item-row-{{ $factory->id }}">
                                        <td><input type="text" class="form-control" name="name"
                                                value="{{ $factory->name }}"></td>
                                        <td><input type="text" class="form-control" name="code"
                                                value="{{ $factory->code }}"></td>
                                        <td><input type="text" class="form-control" name="phone_number"
                                                    value="{{ $factory->phone_number }}"></td>
                                        <td>
                                            {{ $factory->created_at->format('Y-m-d') }}
                                        </td>

                                        <td>                                            
                                            <button type="submit" class="btn p-0" for="form-{{ $factory->id }}">
                                                <i class="fas fa-edit text-info"></i>
                                            </button>
                                        
                                            <button class="btn p-0" onclick="deleteRow('{{ route('pages.remove.factory', ['factory_id' => $factory->id]) }}', '{{$factory->id}}')" 
                                                >
                                                <i class="fas fa-trash text-danger" ></i>
                                            </button>
                                        </td>
                                    </tr>
                                </form>
                            @empty

                            <tr>
                                <td colspan="5">Not Item for show</td>
                            </tr>
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
