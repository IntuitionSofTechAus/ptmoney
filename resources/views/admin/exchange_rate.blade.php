@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'typography'
])
<style type="text/css">
p{
       margin-top: 10px;
}
.reds{color: red;}
canvas#signature {
  border: 2px solid black;
}
.required{ color:red; }
</style>

  
    <style>
        .kbw-signature { width: 100%; height: 200px;}
        #sig canvas{
            width: 100% !important;
            height: auto;
        }
    </style>
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                    @if (\Session::has('success'))
                    <div class="alert alert-success">
                    <ul>
                    <li>{!! \Session::get('success') !!}</li>
                    </ul>
                    </div>
                    @endif
                        <form action="{{route('exchange.rate')}}" method="post" >
                            @csrf
                            <h3>Exchange Rate:</h3><br>
                            <div class="row" >
                                <div class="col-md-3">
                                    <div class="form-group">
                                     <label>Exchange Rate<sup class="required">*</sup></label><br>
                                        <input type="text" name="exchange_rate"  class="form-control" @if(!empty($rate)) value="{{$rate->exchange_rate}}" @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="submit" name="approved" value="Update" class="btn btn-success"> 
                                </div>
                            </div>
                        <form>    
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection