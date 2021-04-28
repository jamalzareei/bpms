@extends('main')
@section('header')
    {{-- <link rel="stylesheet" href="{{asset('app-assets/vendors/css/forms/select/select2.min.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
@stop
@section('content')

    <!-- Hoverable rows start -->
    <div class="row" id="table-hover-row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $title }}</h4>
                    <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal"
                        data-target="#addlink">
                        <i data-feather='plus-square'></i> <span>add a new Link</span>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade text-left" id="addlink" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog" role="document">

                            <form action="{{ route('pages.add.link') }}" method="POST" class=" ajaxForm">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel1">Add link</h4>
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

                                            <label for="basicInput">Roles</label>
                                            <select name="roles[]" class="js-example-basic-multiple select2" data-placeholder="Select One or more" multiple="multiple" id="roles-form" >
                                                @forelse ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @empty

                                                @endforelse
                                            </select>
                                            <small class="w-100 help-block text-danger error-roles"></small><br />

                                            <label for="place">Place</label>
                                            <select name="place" class="form-control" data-placeholder="Select One or more"
                                                id="place">
                                                <option value="MENU">MENU</option>
                                                <option value="HEADER">HEADER</option>
                                                <option value="FOOTER">FOOTER</option>
                                            </select>
                                            <small class="w-100 help-block text-danger error-Place"></small><br />

                                            <label for="icon-html">icon html</label>
                                            <input type="text" name="icon" class="form-control mb-2" id="icon-html"
                                                placeholder="Enter icon html">
                                            <small class="w-100 help-block text-danger error-icon"></small><br />

                                            <label for="slug_select">route</label>
                                            <select name="route" class="form-control" id="slug_select">
                                                @forelse ($routes as $key => $route )
                                                    <option value="{{ $route->getName() }}"
                                                        link_page="{{ $route->uri }}">
                                                        {{ $route->uri }} ({{ $route->getName() }})</option>
                                                @empty

                                                @endforelse
                                            </select>

                                            <small class="w-100 help-block text-danger error-route"></small><br />

                                            <input type="hidden" name="link_page" value="">

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


                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>full name</th>
                                <th>linkname</th>
                                <th>roles</th>
                                <th>created at</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($links as $link)
                                <form class="ajaxForm" action="{{ route('pages.update.link', ['link_id' => $link->id]) }}" method="post">
                                    @csrf
                                    <tr>
                                        <td>{{ $link->name }}</td>
                                        <td><span class="badge badge-pill badge-light-info">{{ $link->url }}</span>
                                        </td>
                                        <td>
                                            <select name="roles[]" multiple="multiple" class="js-example-basic-multipl select2"
                                                id="roles-loop-{{ $link->id }}" data-placeholder="Select One or more">

                                                @forelse ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ in_array($role->id, (array) $link->roles->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                        {{ $role->name }}</option>
                                                @empty

                                                @endforelse
                                            </select>
                                        </td>
                                        <td>
                                            {{ $link->created_at->format('Y-m-d') }}
                                        </td>

                                        <td>
                                            <button type="submit" class="btn btn-relief-success"><i
                                                    class="fas fa-edit"></i></button>
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
        $(document).on('change', '#slug_select', function() {
            let link_page = $('option:selected', this).attr('link_page');

            $('[name="link_page"]').val(link_page)
        });

    </script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>

    <script src="{{ asset('app-assets/js/scripts/forms/form-select2.js') }}"></script>
    <script src="">
        $(document).ready(function() {

            $('.js-example-basic-single').select2();
        });

    </script>

@stop
