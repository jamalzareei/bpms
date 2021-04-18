@extends('main')
@section('header')

@stop
@section('content')

    <!-- Hoverable rows start -->
    <div class="row" id="table-hover-row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$title}}</h4>
                    <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal"
                        data-target="#adduser">
                        <i data-feather='plus-square'></i> <span>add a new role</span>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade text-left" id="adduser" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog" role="document">

                            <form action="{{ route('pages.add.role') }}" method="POST" class=" ajaxForm">
                            @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel1">Add user</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="basicInput">role name</label>
                                            <input type="text" name="name" class="form-control mb-2" id="basicInput" placeholder="Enter role name">
                                            <small class="w-100 help-block text-danger error-name"></small><br />
                                            
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-relief-success">َAdd</button>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>


                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>slug</th>
                                <th>users count</th>
                                <th>created at</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                                <tr>

                                    <td>{{$role->name}}</td>

                                    <td><span class="badge badge-pill badge-light-info">{{$role->slug}}</span></td>
                                    <td>{{$role->users_count}}</td>
                                    <td>
                                        {{($role->created_at)->format('Y-m-d')}}
                                    </td>
                                </tr>
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
@stop
