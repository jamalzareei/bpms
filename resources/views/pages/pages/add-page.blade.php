@extends('main')
@section('header')

<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/pickers/form-pickadate.min.css')}}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@stop

@section('footer')

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
    <script>
        $('select').selectpicker();

    </script>
    
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
                    <h4 class="card-title">{{$title}}</h4>
                </div>
                <div class="card-body">
                    <form class="form ajaxForm" action="{{ route('pages.page.create.post') }}" method="POST">
                        @csrf
                        <div class="row">
                            
                            
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="quantity">title</label>
                                    <input type="text" id="title" class="form-control" placeholder="title" name="title" />
                                    <small class="w-100 help-block text-danger error-title"></small>
                                </div>
                            </div>
                            
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="quantity">content</label>
                                    <textarea name="content" class="form-control" id="content" cols="30" rows="10">

                                    </textarea>
                                    <small class="w-100 help-block text-danger error-content"></small>
                                </div>
                            </div>

                            <div class="col-md-12 col-12">
                                <label for="actived_at">active</label>
                                <input type="checkbox" class="custom-control-input" name="actived_at" id="actived_at">
                                    
                                <span class="custom-control- custom-switch  custom-switch-success mr-2 mb-1">
                                    <input type="checkbox" class="custom-control-input" name="actived_at" id="checkbox-active" />
                                    <label class="custom-control-label" for="checkbox-active">
                                        <span class="switch-text-left">✔</span>
                                        <span class="switch-text-right">✘</span>
                                    </label>
                                </span>
                            </div>

                            
                            <div class="col-12 my-1">
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
