@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'typography'
])
<style type="text/css">
label{
       margin-top: 10px;
}
.reds{color: red;}
canvas#signature {
  border: 2px solid black;
}
.required{ color:red; }
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
	                    <p>{!! \Session::get('success') !!}</p>
	                    </div>
	                    @endif
	                    <h3 style="text-align: center;">New Transaction</h3>
	                    <form action="{{route('transaction.store')}}" method="post" enctype="multipart/form-data">
	                        @csrf
	                        <h5>Customer</h5>
	                        <input type="hidden" name="reference_id" value="{{$member->id}}">
	                        <input type="hidden" name="reference_table" value="customers">
	                        <div class="row">
	                            <div class="col-md-3">
	                                <div class="form-group">
	                                    <label>Customer<sup class="required">*</sup></label>
	                                </div>
	                            </div>
	                            <div class="col-md-9">
	                                <div class="form-group">
	                                <input type="text"  name="sender_full_name" value="{{ $member->sender_full_name }}"  class="form-control" readonly>
	                                @error('sender_full_name')  
	                                    <span class="reds">{{ $message }}</span>
	                                @enderror
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row" >
	                            <div class="col-md-3">
	                                <div class="form-group">
	                                    <label>Residential Address*<sup class="required">*</sup></label>
	                                </div>
	                            </div>
	                            <div class="col-md-9">
	                                <div class="form-group">
	                                <input type="text" name="sender_address" value="{{ $member->sender_address }}"  class="form-control" readonly>
	                                @error('sender_address')
	                                  <span class="reds">{{ $message }}</span>   
	                                @enderror
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row" >
	                            <div class="col-md-3">
	                                <div class="form-group">
	                                    <label>Phone*<sup class="required">*</sup></label>
	                                </div>
	                            </div>
	                            <div class="col-md-9">
	                                <div class="form-group">
	                                <input type="text" name="telephone" value="{{ $member->telephone }}"  class="form-control" readonly>
	                                @error('telephone')
	                                  <span class="reds">{{ $message }}</span>   
	                                @enderror
	                                </div>
	                            </div>
	                        </div>
	                        
	                        <hr>
	                        <h5>Receiver Detail (In Thiland):</h5>
	                        <div class="row" >
	                            <div class="col-lg-3">
	                                <div class="form-group">
	                                    <label>Full Name<sup class="required">*</sup></label>
	                                </div>
	                            </div>
	                             <div class="col-md-9">
	                                <div class="form-group">
	                                <input type="text" name="receiver_full_name" value="{{ $member->receiver_full_name }}" class="form-control" readonly>
	                                @error('receiver_full_name')
	                                  <span class="reds">{{ $message }}</span>   
	                                @enderror
	                                </div>
	                             </div>
	                        </div>
	                        <div class="row" >
	                            <div class="col-lg-3">
	                                <div class="form-group">
	                                    <label>Residential Address*<sup class="required">*</sup></label>
	                                </div>
	                            </div>
	                            <div class="col-md-9">
	                                <div class="form-group">
	                                <input type="text" name="receiver_address" value="{{ $member->receiver_address }}"  class="form-control" readonly>
	                                @error('receiver_address')
	                                   <span class="reds">{{ $message }}</span>   
	                                @enderror
	                                </div>
	                            </div>
	                        </div>
	                        <hr>
	                        <h5>Transaction Detail:</h5>
	                        <div class="row" >
	                            <div class="col-lg-3">
	                                <div class="form-group">
	                                    <label>Send Amount*<sup class="required">*</sup></label>
	                                </div>
	                            </div>
	                            <div class="col-md-3">
	                                <div class="form-group">
	                                <input type="text" name="amount" value="{{old('amount')}}" id="amount"  class="form-control">
	                                @error('amount')
	                                   <span class="reds">{{ $message }}</span>   
	                                @enderror
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row" >
	                            <div class="col-lg-3">
	                                <div class="form-group">
	                                    <label>Rate*<sup class="required">*</sup></label>
	                                </div>
	                            </div>
	                            <div class="col-md-3">
	                                <div class="form-group">
	                                <input type="text" name="rate" value="{{ $rate->exchange_rate }}"  class="form-control" readonly>
	                                @error('rate')
	                                   <span class="reds">{{ $message }}</span>   
	                                @enderror
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row" >
	                            <div class="col-lg-3">
	                                <div class="form-group">
	                                    <label>Fee*<sup class="required">*</sup></label>
	                                </div>
	                            </div>
	                            <div class="col-md-3">
	                                <div class="form-group">
	                                <input type="text" name="fee" id="fee" value="{{ old('fee') }}"  class="form-control" onchange="getTotalPayable()">
	                                @error('fee')
	                                   <span class="reds">{{ $message }}</span>   
	                                @enderror
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row" >
	                            <div class="col-lg-3">
	                                <div class="form-group">
	                                    <label>Total Payable*<sup class="required">*</sup></label>
	                                </div>
	                            </div>
	                            <div class="col-md-3">
	                                <div class="form-group">
	                                <input type="text" name="total_payable" value="{{ old('total_payable') }}" id="total_payable"  class="form-control" readonly>
	                                @error('total_payable')
	                                   <span class="reds">{{ $message }}</span>   
	                                @enderror
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row" >
	                            <div class="col-lg-3">
	                                <div class="form-group">
	                                    <label>Receivable Amount*<sup class="required">*</sup></label>
	                                </div>
	                            </div>
	                            <div class="col-md-3">
	                                <div class="form-group">
	                                <input type="text" name="receivable_amount" value="{{ old('receivable_amount') }}"  class="form-control" >
	                                @error('receivable_amount')
	                                   <span class="reds">{{ $message }}</span>   
	                                @enderror
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row" >
	                            <div class="col-lg-3">
	                                <div class="form-group">
	                                    <label>Agent Reference*<sup class="required">*</sup></label>
	                                </div>
	                            </div>
	                            <div class="col-md-3">
	                                <div class="form-group">
	                                <input type="text" name="aganet_ref" value="{{ old('aganet_ref') }}"  class="form-control" >
	                                @error('aganet_ref')
	                                   <span class="reds">{{ $message }}</span>   
	                                @enderror
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row" >
	                            <div class="col-lg-3">
	                                <div class="form-group">
	                                    <label>Purpose of Transfer*<sup class="required">*</sup></label>
	                                </div>
	                            </div>
	                            <div class="col-md-9">
	                                <div class="form-group">
	                                <input type="text" name="purpose" value="{{ old('purpose') }}"  class="form-control" >
	                                @error('purpose')
	                                   <span class="reds">{{ $message }}</span>   
	                                @enderror
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-md-12">
	                            <div class="form-group">  
	                             <input type="submit" name="submit" value="SUBMIT" class="btn btn-success" style="float: right;">
	                        </div>   
	                    <form>    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
<script type="text/javascript" src="{{asset('paper')}}/js/signature/jquery-ui.min.js"></script>
<script type="text/javascript" src="{{asset('paper')}}/js/signature/jquery.signature.js"></script>
<script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });

    function getTotalPayable(){
    	var amount = $("#amount").val();
    	var fee = $("#fee").val();

    	if(amount != '' && fee != ''){
    		var total = parseInt(amount) + parseInt(fee);
    		$("#total_payable").val(total);
    	}
    }
</script>
@endsection