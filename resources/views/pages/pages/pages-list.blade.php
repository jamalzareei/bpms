@extends('main')
@section('header')

<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<link rel="stylesheet" type="text/css" href="{{('app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
@stop


@section('footer')
    <script src="{{ asset('app-assets/vendors/js/extensions/dataTables.checkboxes.min.js')}}"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
    <script>
        $('select').selectpicker();
        $('#exampleModalCustomer').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var recipient = button.data('page_id')
            
            var modal = $(this)
            
            modal.find('.modal-body input[type="hidden"]').val(recipient)
        })
        $('#exampleModalProducts').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var recipient = button.data('page_id')
            
            var modal = $(this)
            
            modal.find('.modal-body input[type="hidden"]').val(recipient)
        })
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var recipient = button.data('page_id')
            
            var modal = $(this)
            
            modal.find('.modal-body input[type="hidden"]').val(recipient)
        })
    </script>
@stop


@section('content')

    <!-- Hoverable rows start -->
    <div class="row" id="table-hover-row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $title }}</h4>
                    <a href="{{ route('pages.page.create') }}" class="btn btn-outline-primary waves-effect">
                        <i data-feather='plus-square'></i> <span>add a new Page</span>
                    </a>

                </div>


                <div class="table-responsive responsive-overflow">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>title</th>
                                <th>active</th>
                                <th> ACTION </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pages as $page)
                                <tr id="item-row-{{ $page->id }}">
                                    <td>
                                        {{ $page->title ?? '' }}
                                    </td>
                                    
                                    <td>
                                        <input type="checkbox" class="custom-control-input" 
                                            name="actived_at" id="active" {{($page->actived_at) ? 'checked' : ''}}>
                                            
                                        <span class="custom-control- custom-switch  custom-switch-success mr-2 mb-1">
                                            <input type="checkbox" class="custom-control-input" name="actived_at" id="checkbox{{$page->id}}" {{ $page->actived_at ? 'checked' : ''}} onchange="changeStatus('{{route('pages.pi.change.status', ['id'=>$page->id])}}', this)">
                                            <label class="custom-control-label" for="checkbox{{$page->id}}">
                                                <span class="switch-text-left">✔</span>
                                                <span class="switch-text-right">✘</span>
                                            </label>
                                        </span>
                                    </td>

                                    <td>
                                                
                                        <a href="{{ route('pages.page.edit', ['page_id' => $page->id]) }}"
                                            class="btn btn-flat-info waves-effect p-0" for="form-{{ $page->id }}"><i
                                                class="fas fa-edit"></i></a>
                                                
                                        <span onclick="deleteRow('{{ route('pages.page.remove.page', ['id' => $page->id]) }}', '{{$page->id}}')" href=""
                                            class="btn btn-flat-danger waves-effect p-0" for="form-{{ $page->id }}"><i
                                                class="fas fa-trash"></i></span>
                                                
                                        
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Not Item for show</td>
                                </tr>
                            @endforelse

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8">{{ $pages->appends($_GET)->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
