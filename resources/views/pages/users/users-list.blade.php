@extends('main')
@section('header')
    {{-- <link rel="stylesheet" href="{{asset('app-assets/vendors/css/forms/select/select2.min.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
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

                            <form action="{{ route('pages.add.user') }}" method="POST" class=" ajaxForm">
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
                                            <label for="basicInput">Full name</label>
                                            <input type="text" name="name" class="form-control" id="basicInput"
                                                placeholder="Enter full name">
                                            <small class="w-100 help-block text-danger error-name mb-2"></small><br />
                                            <label for="basicInput">Username</label>
                                            <input type="text" name="username" class="form-control" id="basicInput"
                                                placeholder="Enter username">
                                            <small class="w-100 help-block text-danger error-username mb-2"></small><br />

                                            <label for="basicInput">Roles</label>
                                            <select name="roles[]" class="js-example-basic-multiple select2"
                                                data-placeholder="Select One or more" multiple="multiple" id="roles-form">
                                                @forelse ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @empty

                                                @endforelse
                                            </select>
                                            <small class="w-100 help-block text-danger error-roles mb-2"></small><br />


                                            <label for="basic-default-password1">Password</label>
                                            <div class="input-group input-group-merge form-password-toggle">
                                                <input type="password" name="password" class="form-control"
                                                    id="basic-default-password1" placeholder="Your Password"
                                                    aria-describedby="basic-default-password1" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text cursor-pointer"><i
                                                            data-feather="eye"></i></span>
                                                </div>
                                            </div>
                                            <small class="w-100 help-block text-danger error-password mb-2"></small><br />

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
                                <th>full name</th>
                                <th>username</th>
                                <th>created at</th>
                                <th> ACTION roles</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>

                                    <td>{{ $user->name }}</td>

                                    <td><span class="badge badge-pill badge-light-info">{{ $user->username }}</span>
                                    </td>
                                    <td>
                                        {{ $user->created_at->format('Y-m-d') }}
                                    </td>

                                    <td>
                                        <form class="ajaxForm"
                                            action="{{ route('pages.update.user', ['user_id' => $user->id]) }}"
                                            method="post" id="form-{{ $user->id }}">
                                            @csrf
                                            <select name="roles[]" multiple="multiple"
                                                class="js-example-basic-multipl select2" id="roles-loop-{{ $user->id }}"
                                                for="form-{{ $user->id }}" data-placeholder="Select One or more">

                                                @forelse ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ in_array($role->id, (array) $user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                        {{ $role->name }}</option>
                                                @empty

                                                @endforelse
                                            </select>
                                            <button type="submit" class="btn btn-relief-success"
                                                for="form-{{ $user->id }}"><i class="fas fa-edit"></i></button>

                                        </form>
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
    {{-- <script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script> --}}
    {{-- <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>

    <script src="{{ asset('app-assets/js/scripts/forms/form-select2.js') }}"></script>
    <script src="">
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

    </script> --}}

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
    <script>
        $('select').selectpicker();

    </script>
@stop
