@extends('main')
@section('header')

@stop
@section('content')


    <div class="card">
        @include('components/chart')
    </div>

    <div class="row">
        <div class="col-md-3 col-12 ">
            <div class="card card-company-table">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>sappliam</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>novin ceram</td>
                            </tr>
                            <tr>
                                <td>ceram negar</td>
                            </tr>
                            <tr></tr>
                            <tr></tr>
                        </tbody>
                    </table>
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
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Reserved:</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>novin ceram</td>
                            </tr>
                            <tr>
                                <td>ceram negar</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-6">
            <div class="card card-company-table">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>loading:</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>novin ceram</td>
                            </tr>
                            <tr>
                                <td>ceram negar</td>
                            </tr>
                        </tbody>
                    </table>
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
            <form class="needs-validation" novalidate>
                <div class="form-row">
                    <div class="col-md-4 col-12 mb-3">

                    </div>
                    <div class="col-md-4 col-12 mb-3">
                        <input type="text" class="form-control" id="validationTooltip01" placeholder="First name"
                            value="Mark" required />
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
@stop
