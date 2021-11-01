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
.btn.btn-light {
    color: black;
    background: lightgrey;
    margin: 0;
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
	                    <h3 style="text-align: center;">New Transaction</h3>
	                    <form action="{{route('transaction.store')}}" method="post" enctype="multipart/form-data">
	                        @csrf
	                        <h5>Customer</h5>
	                        <div class="row">
	                        	<div class="col-md-6">
	                        		<div class="row">
	                        		<div class="col-md-6">
	                        			<div class="form-group">
		                                    <label>Member Id</label>
		                                </div>
	                        		</div>
	                        		<div class="col-md-6">
	                        			<div class="form-group">
	                        				<input type="text" name="member_id" id="membership_number" disabled value="" class="form-control">
	                        			</div>
	                        		</div>
	                        	</div>
	                        	</div>
	                        	<div class="col-md-6">
	                        		<div class="row">
	                        		<div class="col-md-3">
	                        			<div class="form-group">
		                                    <label>Expiry Date</label>
		                                </div>
	                        		</div>
	                        		<div class="col-md-9">
	                        			<div class="form-group">
	                        				<input type="text" name="exp_date"  id="doc_expiry1" disabled value="" class="form-control">
	                        			</div>
	                        		</div>
	                        	</div>
	                        	</div>

	                        </div>
	                        <div class="row">
	                            <div class="col-md-3">
	                                <div class="form-group">
	                                    <label>Customer<sup class="required">*</sup></label>
	                                </div>
	                            </div>
	                            <div class="col-md-9">
	                                <div class="form-group">
	                                	<select class="form-control" name="sender_id" onchange="getreceiverList(this.value);">
	                                		@if(count($sender) > 0)
	                                			<option value="">Select Sender</option>
	                                			@foreach($sender as $s)
	                                				<option value="{{$s->id}}">{{$s->sender_full_name}}</option>
	                                			@endforeach
	                                		@else
	                                			<option>Select Sender</option>
	                                		@endif
	                                	</select>
		                                @error('sender_id')  
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
	                                <input type="text" name="sender_address" id="sender_address" value=""  class="form-control" readonly>
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
	                                <input type="text" name="telephone" id="telephone" value=""  class="form-control" readonly> 
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
	                             	<div class="row">
	                             		<div class="col-md-11">
			                                <div class="form-group">
			                                <select class="form-control" id="receiver_id" name="receiver_id" onchange="getreceiverDetail(this.value,'receiver_address');">
			                                	<option>Select Receiver</option>
			                                </select>
			                                @error('receiver_id')
			                                  <span class="reds">{{ $message }}</span>   
			                                @enderror
			                                </div>
			                            </div>
			                            <div class="col-md-1">
			                            	<a href="#" id="receiver_btn" class="btn btn-light" target="_blank">+</a>
			                            </div>
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
	                                <input type="text" name="receiver_address" id="receiver_address" value=""  class="form-control" readonly>
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
	                                <input type="text" name="amount" value="{{old('amount')}}" id="amount"  class="form-control" onchange="getTotalPayable()">
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
	                                <input type="text" name="rate" id="rate" value="{{ $rate->exchange_rate }}"  class="form-control" readonly>
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
	                                <input type="text" id="receivable_amount" name="receivable_amount" value="{{ old('receivable_amount') }}"  class="form-control" readonly>
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
    	var range = $("#rate").val();
    	if(amount != ''){
    		var total = parseInt(amount) * parseInt(range);
    		$("#receivable_amount").val(total);
    	}
    	if(amount != '' && fee != ''){
    		var total = parseInt(amount) + parseInt(fee);
    		$("#total_payable").val(total);
    	}
    }

    function getreceiverList(id){
    	if(id != ''){
    		getsenderDetail(id,'sender_address');
    		getsenderDetail(id,'telephone');
    		getsenderDetail(id,'membership_number');
    		getsenderDetail(id,'doc_expiry1');
    		$("#receiver_btn").attr('href', '{{url("admin/beneficiary-form")}}/'+id);
    		$.ajax({
    			url : '{{url("get-receiver")}}/'+id,
    			type : "GET",
    			success : function(res){
    				$("#receiver_id").html(res);
    			}
    		})
    	}else{
    		$('#receiver_id').html('');
    	}
    }

    function getreceiverDetail(id,value){
    	if(id != ''){
    		$.ajax({
    			url : '{{url("get-receiver-detail")}}/'+id+'/'+value,
    			type : "GET",
    			success : function(res){
    				$("#"+value).val(res);
    			}
    		})
    	}else{
    		$('#receiver_id').val('');
    	}
    }

    function getsenderDetail(id,value){
    	if(id != ''){
    		$.ajax({
    			url : '{{url("get-sender-detail")}}/'+id+'/'+value,
    			type : "GET",
    			success : function(res){
    				$("#"+value).val(res);
    			}
    		})
    	}else{
    		$('#'+value).val('');
    	}
    }
</script>
@endsection