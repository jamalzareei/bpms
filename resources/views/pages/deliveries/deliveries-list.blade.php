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
                        data-target="#addDeliveryLocation">
                        <i data-feather='plus-square'></i> <span>add a new delivery location</span>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade text-left" id="addDeliveryLocation" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog" role="document">

                            <form action="{{ route('pages.add.delivery.location') }}" method="POST" class=" ajaxForm">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel1">Add delivery location</h4>
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

                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="customer_id">customer</label>
                                                <select name="customer_id" class="form-control" id="customer_id"  data-live-search="true">
                                                    <option value="">--- please select customer ---</option>
                                                    @forelse ($customers as $customer)
                                                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                    @empty
                                                        
                                                    @endforelse
                                                </select>
                                                <small class="w-100 help-block text-danger error-customer_id"></small>
                                            </div>
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
                                <th>customer</th>
                                <th>created at</th>
                                <th> ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($deliveries as $delivery)

                                <form class="ajaxForm" action="{{ route('pages.update.delivery.location', ['deliverylocation_id' => $delivery->id]) }}"
                                    id="form-{{ $delivery->id }}" method="post">
                                    @csrf
                                    <tr id="item-row-{{ $delivery->id }}">
                                        <td>
                                            <input type="text" class="form-control" name="name" value="{{ $delivery->name }}">
                                        </td>
                                        <td>
                                            <select name="customer_id" class="form-control" id="customer_id"  data-live-search="true">
                                                <option value="">--- please select customer ---</option>
                                                @forelse ($customers as $customer)
                                                    <option value="{{$customer->id}}" {{$customer->id == $delivery->customer_id ? 'selected' : ''}}>{{$customer->name}}</option>
                                                @empty
                                                    
                                                @endforelse
                                            </select>
                                        </td>

                                        <td>
                                            {{ $delivery->created_at->format('Y-m-d') }}
                                        </td>

                                        <td>
                                            <button type="submit" class="btn p-0" for="form-{{ $delivery->id }}"><i class="fas fa-edit text-info"></i></button>
                                            
                                            <button type="submit" class="btn p-0">
                                                <i onclick="deleteRow('{{ route('pages.remove.delivery.location', ['deliverylocation_id' => $delivery->id]) }}', '{{$delivery->id}}')" 
                                                    class="fas fa-trash text-danger" ></i>
                                            </button>
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
        $('#addDeliveryLocation').modal('show')


</script>
@stop
