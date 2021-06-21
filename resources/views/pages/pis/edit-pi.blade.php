@extends('main')
@section('header')

    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css/plugins/forms/pickers/form-pickadate.min.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@stop

@section('footer')
    <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
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
        // $(document).on('change', '#date', function(e) {
        $("#date").flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            onChange: function(selectedDates, dateStr, instance) {
                
                let ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(selectedDates[0]);
                let mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(selectedDates[0]);
                let da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(selectedDates[0]);

                $('.date-code').text(mo+''+da);
            },
            
            defaultDate: "{{ $pi->date }}"
            // $('.date-code').text($(this).val());
        });

        $(document).on('change', '#customer_id', function(e) {
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
                beforeSend: function() {},
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



        $(document).on('change', '#factory_id', function(e) {
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
                beforeSend: function() {},
                success: function(response) {
                    console.info(response);

                    $('.factory-code').text(response?.factory?.code);
                },
                error: function(request, status, error) {

                }
            })
        })


        $(document).on('change', '#currency_id', function(e) {
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
                beforeSend: function() {},
                success: function(response) {
                    console.info(response);

                    $('#currency_rate').val(response?.currency?.rate);
                },
                error: function(request, status, error) {

                }
            })
        })

        $(document).on('keyup', '#extra_code', function(e) {
            $('.extra-code').text(e.target.value);
        })


        ///////////////////////////

        function uploadFile(url, row) {

            var file = $(".file-upload")[0].files[0];
            var title_file = $("#title_file").val();
            var formData = new FormData();
            formData.append("fileUpload", file);
            formData.append("title_file", title_file);

            $.ajax({
                url: url,
                method: 'POST',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();

                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            
                            $("#progressbar-file").show();
                            $("#progressbar-file").html(percentComplete + '%');
                            $("#progressbar-file").css({width:percentComplete+"%" })
                            $("#progressbar-file").prop('aria-valuenow', percentComplete)

                            console.log(percentComplete);
                        }
                    }, false);

                    return xhr;
                },
                success: function(response){
                    $('#load-file').html(response.view)
                }
            });

        }

    </script>
@stop

@section('content')

    <!-- Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">PI Update {{ $pi->code }}</h4>
                    </div>
                    {{-- <img src="http://localhost/bpms_cp/images/logo.svg" alt=""> --}}
                    <div class="card-body">
                        <form class="form ajaxForm" action="{{ route('pages.pi.update', ['pi_id' => $pi->id]) }}"
                            method="POST">
                            @csrf
                            <div class="row">

                                <div class="col-10">
                                    <label for="#">&nbsp;</label>
                                    <div class="form-group">
                                        <label for="date">PI code : </label>
                                        <span class="badge badge-dark">
                                            <span class="country-code">{{ $code[0] ?? '' }}</span> -
                                            <span class="customer-code">{{ $code[1] ?? '' }}</span> -
                                            <span class="factory-code">{{ $code[2] ?? '' }}</span> -
                                            <span class="date-code">{{ $code[3] ?? '' }}</span> -
                                            <span class="extra-code">{{ $code[4] ?? '' }}</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="#">enter extra code</label>
                                        <input type="text" id="extra_code" class="form-control" placeholder="extra_code"
                                            name="extra_code" value="{{ $code[4] ?? '' }}" />
                                        <small class="w-100 help-block text-danger error-extra_code"></small>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="customer_id">customer</label>
                                        <select name="customer_id" class="form-control" id="customer_id">
                                            <option value="">--- please select customer ---</option>
                                            @forelse ($customers as $customer)
                                                <option value="{{ $customer->id }}"
                                                    {{ $pi->customer_id == $customer->id ? 'selected' : '' }}>
                                                    {{ $customer->name }}</option>
                                            @empty

                                            @endforelse
                                        </select>
                                        <small class="w-100 help-block text-danger error-customer_id"></small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="factory_id">factory</label>
                                        <select name="factory_id" class="form-control" id="factory_id">
                                            <option value="">--- please select factory ---</option>
                                            @forelse ($factories as $factory)
                                                <option value="{{ $factory->id }}"
                                                    {{ $pi->factory_id == $factory->id ? 'selected' : '' }}>
                                                    {{ $factory->name }}</option>
                                            @empty

                                            @endforelse
                                        </select>
                                        <small class="w-100 help-block text-danger error-factory_id"></small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="date">date</label>
                                        <input type="text" id="date" class="form-control selector" placeholder="date"
                                            name="date" value="{{ $pi->date }}" data-value="{{ $pi->date }}" />
                                        <small class="w-100 help-block text-danger error-date"></small>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="saletype_id">sale type</label>
                                        <select name="saletype_id" class="form-control" id="saletype_id">
                                            <option value="">--- please select sale type ---</option>
                                            @forelse ($saletypes as $saletype)
                                                <option value="{{ $saletype->id }}"
                                                    {{ $pi->sale_type_id == $saletype->id ? 'selected' : '' }}>
                                                    {{ $saletype->name }}</option>
                                            @empty

                                            @endforelse
                                        </select>
                                        <small class="w-100 help-block text-danger error-saletype_id"></small>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="currency_id">currency</label>
                                        <select name="currency_id" class="form-control" id="currency_id">
                                            <option value="">--- please select currency ---</option>
                                            @forelse ($currencies as $currency)
                                                <option value="{{ $currency->id }}"
                                                    {{ $pi->currency_id == $currency->id ? 'selected' : '' }}>
                                                    {{ $currency->name }}</option>
                                            @empty

                                            @endforelse
                                        </select>
                                        <small class="w-100 help-block text-danger error-currency_id"></small>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="currency_rate">currency rate</label>
                                        <input type="text" id="currency_rate" class="form-control"
                                            placeholder="currency rate" name="currency_rate"
                                            value="{{ round($pi->currency_rate) }}" />
                                        <small class="w-100 help-block text-danger error-currency_rate"></small>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="delivery_location">delivery_location</label>
                                        <input type="text" id="delivery_location" class="form-control"
                                            placeholder="delivery_location" name="delivery_location"
                                            value="{{ $pi->delivery_location }}" />
                                        <small class="w-100 help-block text-danger error-delivery_location"></small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="validity_date">validity date</label>
                                        <input type="text" id="validity_date" class="form-control selector"
                                            placeholder="validity date" name="validity_date"
                                            value="{{ $pi->validity_date }}" />
                                        <small class="w-100 help-block text-danger error-validity_date"></small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="quantity">quantity</label>
                                        <input type="text" id="quantity" class="form-control" placeholder="quantity" name="quantity" value="{{ $pi->quantity }}" />
                                        <small class="w-100 help-block text-danger error-quantity"></small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="pallet">pallet</label>
                                        <input type="number" id="pallet" class="form-control" placeholder="pallet" name="pallet" value="{{ $pi->pallet }}" />
                                        <small class="w-100 help-block text-danger error-pallet"></small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="truck">truck</label>
                                        <input type="number" id="truck" class="form-control" placeholder="truck" name="truck" value="{{ $pi->truck }}" />
                                        <small class="w-100 help-block text-danger error-truck"></small>
                                    </div>
                                </div>


                                <div class="row w-100 border border-warning m-1">
                                </div>

                                <div class="col-md-12 col-12">
                                    <input type="hidden" name="row-upload-file" value="1">
                                    <div class="row row-upload-1">
                                        <div class="col-5">
                                            <label for="title_file">Title file</label>
                                            <input type="text" id="title_file" class="form-control "
                                                placeholder="Title file" name="title_file" id="titleFile"/>
                                            <small class="w-100 help-block text-danger error-title_file"></small>
                                        </div>
                                        <div class="col-5">
                                            <label for="title_file">file</label>
                                            <input type="file" name="file" class="form-control file-upload" id="file">
                                        </div>
                                        <div class="col-2">
                                            <label for="title_file" class="w-100">&nbsp;</label>
                                            <span class="btn btn-icon rounded-circle btn-gradient-primary"
                                                onclick="uploadFile('{{ route('pages.pi.upload.file', ['id' => $pi->id]) }}', 1)">
                                                <i class="fas fa-plus"></i>
                                            </span>
                                        </div>
                                        <div class="col-12">
                                            <div class="progress my-1">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" style="display: none"
                                                    role="progressbar" id="progressbar-file" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: 0%">0%</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="load-file">
                                        @include('pages/pis/files/files-uploaded', ['filesPi' => $pi->files])
                                    </div>
                                </div>


                                {{-- <div class="row w-100 border border-warning m-1">
                                </div>


                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="issud_at">PI Issued</label>
                                        <input type="text" id="issud_at" class="form-control selector"
                                            placeholder="PI Issued" name="issud_at" value="{{ $pi->issud_at }}" />
                                        <small class="w-100 help-block text-danger error-issud_at"></small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="confirm_at">PI confirmed</label>
                                        <input type="text" id="confirm_at" class="form-control selector"
                                            placeholder="PI confirmed" name="confirm_at" value="{{ $pi->confirm_at }}" />
                                        <small class="w-100 help-block text-danger error-confirm_at"></small>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="producing">Producing Item </label>
                                        <input type="text" id="producing" class="form-control" placeholder="Producing Item "
                                            name="producing" value="{{ $pi->producing }}" />
                                        <small class="w-100 help-block text-danger error-producing"></small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="stock">Item in Stock</label>
                                        <input type="text" id="stock" class="form-control" placeholder="Item in Stock"
                                            name="stock" value="{{ $pi->stock }}" />
                                        <small class="w-100 help-block text-danger error-stock"></small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="booking">Trucks booking</label>
                                        <input type="text" id="booking" class="form-control" placeholder="Trucks booking"
                                            name="booking" value="{{ $pi->booking }}" />
                                        <small class="w-100 help-block text-danger error-booking"></small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="trucks_factory">Trucks loading from factory</label>
                                        <input type="text" id="trucks_factory" class="form-control"
                                            placeholder="Trucks loading from factory" name="trucks_factory"
                                            value="{{ $pi->trucks_factory }}" />
                                        <small class="w-100 help-block text-danger error-trucks_factory"></small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="trucks_on_way">Truck on the way</label>
                                        <input type="text" id="trucks_on_way" class="form-control"
                                            placeholder="Truck on the way" name="trucks_on_way"
                                            value="{{ $pi->trucks_on_way }}" />
                                        <small class="w-100 help-block text-danger error-trucks_on_way"></small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="trucks_on_border">Trucks on the border/port</label>
                                        <input type="text" id="trucks_on_border" class="form-control"
                                            placeholder="Trucks on the border/port" name="trucks_on_border"
                                            value="{{ $pi->trucks_on_border }}" />
                                        <small class="w-100 help-block text-danger error-trucks_on_border"></small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="trucks_vend_on_way">Trucks on vend on the way</label>
                                        <input type="text" id="trucks_vend_on_way" class="form-control"
                                            placeholder="Trucks on vend on the way" name="trucks_vend_on_way"
                                            value="{{ $pi->trucks_vend_on_way }}" />
                                        <small class="w-100 help-block text-danger error-trucks_vend_on_way"></small>
                                    </div>
                                </div> --}}

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
