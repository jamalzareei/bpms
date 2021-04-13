@extends('main')
@section('header')

@stop
@section('content')

    <!-- Hoverable rows start -->
    <div class="row" id="table-hover-row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Users List</h4>
                    <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal"
                        data-target="#adduser">
                        <i data-feather='plus-square'></i> <span>add a new user</span>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade text-left" id="adduser" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel1">Basic Modal</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="basicInput">Basic Input</label>
                                        <input type="text" class="form-control mb-2" id="basicInput" placeholder="Enter email">
                                        <label for="basicInput">Basic Input</label>
                                        <input type="text" class="form-control mb-2" id="basicInput" placeholder="Enter email">


                                        <label for="basic-default-password1">Password</label>
                                        <div class="input-group input-group-merge form-password-toggle mb-2">
                                            <input type="password" class="form-control" id="basic-default-password1"
                                                placeholder="Your Password" aria-describedby="basic-default-password1" />
                                            <div class="input-group-append">
                                                <span class="input-group-text cursor-pointer"><i
                                                        data-feather="eye"></i></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-relief-success" data-dismiss="modal">Accept</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>full name</th>
                                <th>username</th>
                                <th>created at</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td>amin karami</td>

                                <td><span class="badge badge-pill badge-light-info">amnkarim</span></td>
                                <td>
                                    22/9/2020
                                </td>
                            </tr>

                            <tr>

                                <td>amin karami</td>

                                <td><span class="badge badge-pill badge-light-info">amnkarim</span></td>
                                <td>
                                    22/9/2020
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@stop

@section('footer')
@stop
