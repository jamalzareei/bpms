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
                        data-target="#addSaletype">
                        <i data-feather='plus-square'></i> <span>add a new sale type</span>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade text-left" id="addSaletype" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog" role="document">

                            <form action="{{ route('pages.add.saletype') }}" method="POST" class=" ajaxForm">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel1">Add sale type</h4>
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
                                <th>created at</th>
                                <th> ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($saletypes as $saletype)

                                <form class="ajaxForm"
                                    action="{{ route('pages.update.saletype', ['saletype_id' => $saletype->id]) }}"
                                    id="form-{{ $saletype->id }}" method="post">
                                    @csrf
                                    <tr id="item-row-{{ $saletype->id }}">
                                        <td><input type="text" class="form-control" name="name"
                                                value="{{ $saletype->name }}"></td>
                                        <td>
                                            {{ $saletype->created_at->format('Y-m-d') }}
                                        </td>

                                        <td>
                                            <button type="submit" class="btn p-0" for="form-{{ $saletype->id }}">
                                                <i class="fas fa-edit text-info"></i>
                                            </button>
                                        
                                            <button class="btn p-0" onclick="deleteRow('{{ route('pages.remove.saletype', ['saletype_id' => $saletype->id]) }}', '{{$saletype->id}}')" >
                                                <i class="fas fa-trash text-danger" ></i>
                                            </button>
                                        </td>
                                    </tr>
                                </form>
                            @empty

                            <tr>
                                <td colspan="3">Not Item for show</td>
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
        $('#addSaletype').modal('show')


</script>
@stop
