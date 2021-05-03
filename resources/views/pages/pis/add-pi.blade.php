@extends('main')
@section('header')

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
                    <form class="form">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">PI Issud</label>
                                    <input type="text" id="first-name-column" class="form-control" placeholder="PI Issud" name="fname-column" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="last-name-column">PI Conlimed</label>
                                    <input type="text" id="last-name-column" class="form-control" placeholder="PI Conlimed" name="lname-column" />
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">Itam producing </label>
                                    <input type="text" id="first-name-column" class="form-control" placeholder="Itam producing " name="fname-column" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="last-name-column">Item in Stock</label>
                                    <input type="text" id="last-name-column" class="form-control" placeholder="Item in Stock" name="lname-column" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">Trucks booking</label>
                                    <input type="text" id="first-name-column" class="form-control" placeholder="Trucks booking" name="fname-column" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="last-name-column">Trucks loading from factory</label>
                                    <input type="text" id="last-name-column" class="form-control" placeholder="Trucks loading from factory" name="lname-column" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">Truck on the way</label>
                                    <input type="text" id="first-name-column" class="form-control" placeholder="Truck on the way" name="fname-column" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="last-name-column">Trucks on the border/part</label>
                                    <input type="text" id="last-name-column" class="form-control" placeholder="Trucks on the border/part" name="lname-column" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="last-name-column">Trucks on vend on the way</label>
                                    <input type="text" id="last-name-column" class="form-control" placeholder="Trucks on the border/part" name="lname-column" />
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <button type="reset" class="btn btn-info mr-1">Submit</button>
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

@section('footer')
@stop
