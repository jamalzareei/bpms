@extends('main')
@section('header')

@stop
@section('content')


    <div class="card">
        @include('components/chart', ['data' => $chartData,'chartCategory' => $chartCategory])
    </div>

    <div class="row">
        <div class="col-md-3 col-12 ">
            <div class="card card-company-table">
                <div class="table-responsive">
                    <div class="list-group">
                        <a class="list-group-item active">Customers </a>
                        @forelse ($customers as $customer)

                            <a onclick="getPis('{{ route('pages.dashboard.get.pis') }}','{{ $customer->id }}')"
                                class="list-group-item list-group-item-action">{{ $customer->name }}</a>
                        @empty

                        @endforelse
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-md-1  d-none d-md-flex">
            <div class="card icon-card cursor-pointer text-center mb-2 mx-50 active"
                style="position: absolute;top: calc(50% - 40px);" data-toggle="tooltip" data-placement="top" title="--"
                data-icon="">

                <div class="card-body">
                    <div class="icon-wrapper">
                        <i data-feather='shuffle'></i>
                    </div>

                </div>
            </div>




        </div>
        <div class="col-md-4 col-6">
            <div class="card card-company-table">
                <div class="table-responsive">
                    <div class="list-group">
                        <a class="list-group-item active">Reserved </a>
                        <section id="loadReserved">
                            <a class="list-group-item list-group-item-action">Please select one of the Customers</a>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-6">
            <div class="card card-company-table">
                <div class="table-responsive">
                    <div class="list-group">
                        <a class="list-group-item active">loading </a>
                        <section id="loadLoading">
                            <a class="list-group-item list-group-item-action">Please select one of the Customers</a>
                        </section>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="card ">
        <div class="card-header m-auto">
            <h4 class="card-title text-center">PI folowing</h4>
        </div>
        <div class="card-body">
            <p class="text-center">
                put your PI number to folow the situations
            </p>
            <form class="needs-validation ajaxForm" action="{{ route('pages.dashboard.load.pi') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="col-md-4 col-12 mb-3">

                    </div>
                    <div class="col-md-4 col-12 mb-3">
                        <input type="text" class="form-control" id="validationTooltip01" placeholder="PI code" name="code"
                            required />
                        <small class="w-100 help-block text-danger error-code"></small>
                    </div>
                    <div class="col-md-4 col-12 mb-3">
                        <button class="btn btn-info" type="submit">Submit</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('footer')
<script>
    function getPis(url, customer_id) {
        $.ajax({
            url: url,
            type: 'get',
            url: url,
            data: {
                customer_id: customer_id
            },
            beforeSend: function() {
                $('#loadReserved').html('loading...');
                $('#loadLoading').html('loading...');
            },
            success: function(response) {
                let dataLoading = response.pisLoading
                let dataReserved = response.pisReserved
                console.info(dataLoading);

                if(dataLoading.length > 0){
                    htmlLoading = '';
                    for (i = 0; i < dataLoading.length; i++) {
                        htmlLoading += `<a class="list-group-item list-group-item-action">${dataLoading[i].code}</a>`;
                    }
                    $('#loadLoading').html(htmlLoading);
                }else{
                    $('#loadLoading').html('<a class="list-group-item list-group-item-action text-danger">Not Item for show</a>');
                }

                if(dataReserved.length > 0){
                    htmlReserved = '';
                    for (i = 0; i < dataReserved.length; i++) {
                        htmlReserved += `<a class="list-group-item list-group-item-action">${dataReserved[i].code}</a>`;
                    }
                    $('#loadReserved').html(htmlReserved);
                }else{
                    $('#loadReserved').html('<a class="list-group-item list-group-item-action text-danger">Not Item for show</a>');
                }

            },
            error: function(request, status, error) {

            }



        })
    }

</script>
@stop
