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
        onChange: function(selectedDates, dateStr, instance) {
            
            let ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(selectedDates[0]);
            let mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(selectedDates[0]);
            let da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(selectedDates[0]);

            // $('.date-code').text(da+mo);
        },
    });
    $("#date").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        onChange: function(selectedDates, dateStr, instance) {
            
            let ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(selectedDates[0]);
            let mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(selectedDates[0]);
            let da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(selectedDates[0]);

            $('.date-code').text(mo+''+da);
        },
    });

    $(document).on('change', '#customer_id', function(e){
        e.preventDefault();
        let customer_id = $(this).val() ?? 1;
        let url = `{{ route('pages.customer.details') }}`;

        $.ajax({
            url: url,
            type: 'get',
            url: url,
            data: {
                customer_id: customer_id
            },
            beforeSend: function() {
            },
            success: function(response) {
                console.info(response);

                $('.country-code').text(response?.customer?.country?.code);
                $('.customer-code').text(response?.customer?.code);
                $('.factory-code').text(response?.customer?.factory?.code);
            },
            error: function(request, status, error) {

            }
        })
    })

    
    $(document).on('change', '#factory_id', function(e){
        e.preventDefault();
        let factory_id = $(this).val() ?? 1;
        let url = `{{ route('pages.factory.details') }}`;

        $.ajax({
            url: url,
            type: 'get',
            url: url,
            data: {
                factory_id: factory_id
            },
            beforeSend: function() {
            },
            success: function(response) {
                console.info(response);
                
                $('.factory-code').text(response?.factory?.code);
            },
            error: function(request, status, error) {

            }
        })
    })

     
    $(document).on('change', '#currency_id', function(e){
        e.preventDefault();
        let currency_id = $(this).val() ?? 1;
        let url = `{{ route('pages.currency.details') }}`;

        $.ajax({
            url: url,
            type: 'get',
            url: url,
            data: {
                currency_id: currency_id
            },
            beforeSend: function() {
            },
            success: function(response) {
                console.info(response);
                
                $('#currency_rate').val(response?.currency?.rate);
            },
            error: function(request, status, error) {

            }
        })
    })

    $(document).on('keyup', '#extra_code', function(e){
        $('.extra-code').text(e.target.value);
    })

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
                    <form class="form ajaxForm" action="{{ route('pages.pi.create.post') }}" method="POST">
                        @csrf
                        <div class="row">
                            
                            <div class="col-10">
                                <label for="#">&nbsp;</label>
                                <div class="form-group">
                                    <label for="date">PI code : </label>
                                    <span class="badge badge-dark">

                                        <span class="country-code">country code</span> -
                                        <span class="customer-code">customer code</span> -
                                        <span class="factory-code">factory code</span> -
                                        <span class="date-code">date code</span> -
                                        <span class="extra-code"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="#">enter extra code</label>
                                    <input type="text" id="extra_code" class="form-control" placeholder="extra_code" name="extra_code" />
                                    <small class="w-100 help-block text-danger error-extra_code"></small>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="customer_id">customer</label>
                                    <select name="customer_id" class="form-control" id="customer_id" >
                                        <option value="">--- please select customer ---</option>
                                        @forelse ($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                                        @empty
                                            
                                        @endforelse
                                    </select>
                                    <small class="w-100 help-block text-danger error-customer_id"></small>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="factory_id">factory</label>
                                    <select name="factory_id" class="form-control" id="factory_id" >
                                        <option value="">--- please select factory ---</option>
                                        @forelse ($factories as $factory)
                                            <option value="{{$factory->id}}">{{$factory->name}}</option>
                                        @empty
                                            
                                        @endforelse
                                    </select>
                                    <small class="w-100 help-block text-danger error-factory_id"></small>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="date">date</label>
                                    <input type="text" id="date"   class="form-control selector" placeholder="date" name="date" />
                                    <small class="w-100 help-block text-danger error-date"></small>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="saletype_id">sale type</label>
                                    <select name="saletype_id" class="form-control" id="saletype_id" >
                                        <option value="">--- please select sale type ---</option>
                                        @forelse ($saletypes as $saletype)
                                            <option value="{{$saletype->id}}">{{$saletype->name}}</option>
                                        @empty
                                            
                                        @endforelse
                                    </select>
                                    <small class="w-100 help-block text-danger error-saletype_id"></small>
                                </div>
                            </div>

                            {{-- <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="number">number</label>
                                    <input type="text" id="number"   class="form-control" placeholder="number" name="number" />
                                    <small class="w-100 help-block text-danger error-number"></small>
                                </div>
                            </div>
                            
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="address">address</label>
                                    <input type="text" id="address"   class="form-control" placeholder="address" name="address" />
                                    <small class="w-100 help-block text-danger error-address"></small>
                                </div>
                            </div> --}}
                            
                            
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="currency_id">currency</label>
                                    <select name="currency_id" class="form-control" id="currency_id" >
                                        <option value="">--- please select currency ---</option>
                                        @forelse ($currencies as $currency)
                                            <option value="{{$currency->id}}">{{$currency->name}}</option>
                                        @empty
                                            
                                        @endforelse
                                    </select>
                                    <small class="w-100 help-block text-danger error-currency_id"></small>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="currency_rate">currency rate</label>
                                    <input type="text" id="currency_rate"   class="form-control" placeholder="currency rate" name="currency_rate" />
                                    <small class="w-100 help-block text-danger error-currency_rate"></small>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="delivery_location">delivery_location</label>
                                    <input type="text" id="delivery_location"   class="form-control" placeholder="delivery_location" name="delivery_location" />
                                    <small class="w-100 help-block text-danger error-delivery_location"></small>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="validity_date">validity date</label>
                                    <input type="text" id="validity_date" class="form-control selector" placeholder="validity date" name="validity_date" />
                                    <small class="w-100 help-block text-danger error-validity_date"></small>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="quantity">quantity</label>
                                    <input type="text" id="quantity" class="form-control" placeholder="quantity" name="quantity" />
                                    <small class="w-100 help-block text-danger error-quantity"></small>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="pallet">pallet</label>
                                    <input type="number" id="pallet" class="form-control" placeholder="pallet" name="pallet" />
                                    <small class="w-100 help-block text-danger error-pallet"></small>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="truck">truck</label>
                                    <input type="number" id="truck" class="form-control" placeholder="truck" name="truck" />
                                    <small class="w-100 help-block text-danger error-truck"></small>
                                </div>
                            </div>

                            
                            <div class="row w-100 border border-warning m-1">
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
