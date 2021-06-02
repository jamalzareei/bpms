@extends('main')
@section('header')
 
@stop

@section('footer')
 
@stop
@section('content')

    <!-- Hoverable rows start -->
    <div class="row" id="table-hover-row">
        <div class="col-12">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>PI Code</span>
                        <span class="badge badge-dark">{{$pi->code}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>issued at</span>
                        <span class="badge badge-dark">{{$pi->issud_at}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>confirm at</span>
                        <span class="badge badge-dark">{{$pi->confirm_at}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Item Producing</span>
                        <span class="badge badge-dark">{{$pi->producing}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Item In Stock</span>
                        <span class="badge badge-dark">{{$pi->stock}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Trucks Booking</span>
                        <span class="badge badge-dark">{{$pi->booking}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Trucks loading from factory</span>
                        <span class="badge badge-dark">{{$pi->trucks_factory}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Trucks on the way</span>
                        <span class="badge badge-dark">{{$pi->trucks_on_way}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Trucks on the border/pars/statims</span>
                        <span class="badge badge-dark">{{$pi->trucks_on_border}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Trucks or vend on the way</span>
                        <span class="badge badge-dark">{{$pi->trucks_vend_on_way}}</span>
                    </li>
                </ul>

                <div class="p-2">
                    
                    <div class="row">
                        @forelse ($pi->files as $file)
                        <div class="col-md-2 row-upload-1 border border-3 p-3 text-center">
                            <a href="{{ route('pages.pi.download.file', ['id'=>$file->id]) }}">
                                <i class="fas fa-download font-large-2 w-100"></i>
                                <label class="w-100 mt-50">{{$file->title}}</label>
                            </a>
                        </div>
                        @empty
                        
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

