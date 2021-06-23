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
            var recipient = button.data('pi_id')
            
            var modal = $(this)
            
            modal.find('.modal-body input[type="hidden"]').val(recipient)
        })
        $('#exampleModalProducts').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var recipient = button.data('pi_id')
            
            var modal = $(this)
            
            modal.find('.modal-body input[type="hidden"]').val(recipient)
        })
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var recipient = button.data('pi_id')
            
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
                    <a href="{{ route('pages.pi.create') }}" class="btn btn-outline-primary waves-effect"
                        data-target="#addpis">
                        <i data-feather='plus-square'></i> <span>add a new Pi</span>
                    </a>

                </div>


                <div class="table-responsive responsive-overflow">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>code</th>
                                {{-- <th>PI Issued</th>
                                <th>PI Confirmed</th>
                                <th>Item Producing</th>
                                <th>Trucks loading from factory</th> --}}
                                <th>Customer</th>
                                <th>add Products</th>
                                <th> ACTION </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pis as $pi)
                                <tr id="item-row-{{ $pi->id }}">
                                    <td>{{ $pi->code }}</td>
                                    {{-- <td>{{ $pi->issud_at }}</td>

                                    <td>{{ $pi->confirm_at }}</td>
                                    <td>{{ $pi->producing }}</td>
                                    <td>{{ $pi->trucks_factory }}</td> --}}
                                    <td>
                                        {{ $pi->customer->name }}
                                    </td>
                                    <td>
                                        <button class="btn btn-flat-danger waves-effect btn-sm" data-toggle="modal" data-target="#exampleModal" data-pi_id="{{$pi->id}}">
                                            <i class="fas fa-plus"></i> add products
                                        </button>
                                    </td>

                                    <td>

                                        <a href="{{ route('pages.pi.show', ['id' => $pi->id]) }}" 
                                            class="btn btn-flat-success waves-effect p-0" for="form-{{ $pi->id }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                                
                                        <a href="{{ route('pages.pi.edit', ['pi_id' => $pi->id]) }}"
                                            class="btn btn-flat-info waves-effect p-0" for="form-{{ $pi->id }}"><i
                                                class="fas fa-edit"></i></a>
                                                
                                        <span onclick="deleteRow('{{ route('pages.pi.remove.pi', ['id' => $pi->id]) }}', '{{$pi->id}}')" href=""
                                            class="btn btn-flat-danger waves-effect p-0" for="form-{{ $pi->id }}"><i
                                                class="fas fa-trash"></i></span>
                                                
                                        <input type="checkbox" class="custom-control-input" 
                                            name="actived_at" id="active" {{($pi->actived_at) ? 'checked' : ''}}>
                                            
                                            <span class="custom-control- custom-switch  custom-switch-success mr-2 mb-1">
                                                <input type="checkbox" class="custom-control-input" name="actived_at" id="checkbox{{$pi->id}}" {{ $pi->actived_at ? 'checked' : ''}} onchange="changeStatus('{{route('pages.pi.change.status', ['id'=>$pi->id])}}', this)">
                                                <label class="custom-control-label" for="checkbox{{$pi->id}}">
                                                    <span class="switch-text-left">✔</span>
                                                    <span class="switch-text-right">✘</span>
                                                </label>
                                            </span>
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
                                <td colspan="8">{{ $pis->appends($_GET)->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('pages.pi.add.customers.products') }}" class="ajaxForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Products</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <input type="hidden" name="pi_id" value="">
                            <div class="form-group">                            
                                <label for="basicInput">Products</label>
                                <div class="col-12">
                                    <select name="products[]" class="js-example-basic-multiple select2"
                                        data-placeholder="Select One or more" multiple="multiple" id="products-form">
                                        @forelse ($products as $product)
                                            <option value="{{ $product->id }}" {{($product->pis->count() > 0) ? 'selected' : ''}}>{{ $product->name }}</option>
                                        @empty
    
                                        @endforelse
                                    </select>
                                </div>
                                <small class="w-100 help-block text-danger error-products"></small><br />
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="exampleModalCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCustomerLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('pages.pi.add.customers.products') }}" class="ajaxForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCustomerLabel">Add Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <input type="hidden" name="pi_id" value="">
                            <div class="form-group">                            
                                <label for="basicInput">Customers</label>
                                <select name="customers[]" class="js-example-basic-multiple select2"
                                    data-placeholder="Select One or more" multiple="multiple" id="customers-form">
                                    @forelse ($customers as $customer)
                                        <option value="{{ $customer->id }}" {{($customer->pis->count() > 0) ? 'selected' : ''}}>{{ $customer->name }}</option>
                                    @empty

                                    @endforelse
                                </select>
                                <small class="w-100 help-block text-danger error-customers"></small><br />
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalProducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalProductsLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('pages.pi.add.customers.products') }}" class="ajaxForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalProductsLabel">Add Products</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <input type="hidden" name="pi_id" value="">
                            <div class="form-group">                            
                                <label for="basicInput">Products</label>
                                <select name="products[]" class="js-example-basic-multiple select2"
                                    data-placeholder="Select One or more" multiple="multiple" id="products-form">
                                    @forelse ($products as $product)
                                        <option value="{{ $product->id }}" {{($product->pis->count() > 0) ? 'selected' : ''}}>{{ $product->name }}</option>
                                    @empty

                                    @endforelse
                                </select>
                                <small class="w-100 help-block text-danger error-products"></small><br />
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add </button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

@stop
