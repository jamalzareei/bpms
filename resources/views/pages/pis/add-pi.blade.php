@extends('main')
@section('header')

<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/pickers/form-pickadate.min.css')}}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@stop

@section('footer')
<script src="{{asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
<script>
    $(".selector").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });
</script>
@stop

@section('content')

  <!-- Basic multiple Column Form section start -->
  <section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">PI Create</h4>
                </div>
                <div class="card-body">
                    <form class="form ajaxForm" accept="{{ route('pages.pi.create.post') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="code">PI Code</label>
                                    <input type="text" id="code"   class="form-control" placeholder="PI Code" name="code" />
                                    <small class="w-100 help-block text-danger error-code"></small>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="issud_at">PI Issud</label>
                                    <input type="date" id="issud_at"   class="form-control selector" placeholder="PI Issud" name="issud_at" />
                                    <small class="w-100 help-block text-danger error-issud_at"></small>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="confirm_at">PI confirmed</label>
                                    <input type="date" id="confirm_at"   class="form-control selector" placeholder="PI confirmed" name="confirm_at" />
                                    <small class="w-100 help-block text-danger error-confirm_at"></small>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="producing">Itam producing </label>
                                    <input type="text" id="producing" class="form-control" placeholder="Itam producing " name="producing" />
                                    <small class="w-100 help-block text-danger error-producing"></small>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="stock">Item in Stock</label>
                                    <input type="text" id="stock" class="form-control" placeholder="Item in Stock" name="stock" />
                                    <small class="w-100 help-block text-danger error-stock"></small>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="booking">Trucks booking</label>
                                    <input type="text" id="booking" class="form-control" placeholder="Trucks booking" name="booking" />
                                    <small class="w-100 help-block text-danger error-booking"></small>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="trucks_factory">Trucks loading from factory</label>
                                    <input type="text" id="trucks_factory" class="form-control" placeholder="Trucks loading from factory" name="trucks_factory" />
                                    <small class="w-100 help-block text-danger error-trucks_factory"></small>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="trucks_on_way">Truck on the way</label>
                                    <input type="text" id="trucks_on_way" class="form-control" placeholder="Truck on the way" name="trucks_on_way" />
                                    <small class="w-100 help-block text-danger error-trucks_on_way"></small>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="trucks_on_border">Trucks on the border/part</label>
                                    <input type="text" id="trucks_on_border" class="form-control" placeholder="Trucks on the border/part" name="trucks_on_border" />
                                    <small class="w-100 help-block text-danger error-trucks_on_border"></small>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="trucks_vend_on_way">Trucks on vend on the way</label>
                                    <input type="text" id="trucks_vend_on_way" class="form-control" placeholder="Trucks on the border/part" name="trucks_vend_on_way" />
                                    <small class="w-100 help-block text-danger error-trucks_vend_on_way"></small>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-info mr-1">Submit</button>
                                <button type="reset" class="btn btn-outline-info waves-effect">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Basic Floating Label Form section end -->

@stop
