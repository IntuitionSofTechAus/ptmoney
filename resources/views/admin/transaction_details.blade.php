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
    @media print
    {
        #non-printable { display: none; }
    }
</style>
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card" id="printable">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                               <h3> Transaction Details</h3>
                            </div>
                            <div class="col-md-6">
                                <button onclick="printDiv('printable');" class="btn btn-success btn-round" style="float: right;" id="non-printable">Print</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(!empty($transactions))
                            @foreach($transactions as $transaction)
                                <div class="container" >
                                    <div class="row alert-info" @if($transaction->status == 'waiting') class="alert-info row" @elseif($transaction->status == 'processing') class="alert-danger row" @elseif($transaction->status == 'transfering') class="alert-primary row" @elseif($transaction->status == 'completed row') class="alert-muted" @endif>
                                        <div class="col-md-4">
                                            <p></p>
                                            <p>Transaction Id</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p></p>
                                            <p>{{$transaction->transaction_id}}</p>
                                        </div>
                                    </div> 
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Sender Id</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>{{$transaction->sender->membership_number}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Sender</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>{{$transaction->sender->sender_full_name}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Beneficiary Name</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>{{$transaction->receiver->receiver_full_name}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Account Number</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>{{$transaction->receiver->accont_number}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Bank</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>{{$transaction->receiver->bank_name}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Send Amount</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>AUR {{$transaction->amount}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Rate</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>{{$transaction->rate}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Fee</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>AUR {{$transaction->fee}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Total Payable</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>{{$transaction->total_payable}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Receivable Amount</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>AUR {{$transaction->receivable_amount}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Status</p>
                                        </div>
                                        <div @if($transaction->status == 'waiting') class="text-info col-md-4" @elseif($transaction->status == 'processing') class="text-danger col-md-4" @elseif($transaction->status == 'transfering') class="text-primary col-md-4" @elseif($transaction->status == 'completed col-md-4') class="text-muted" @endif>
                                            <p><b>{{$transaction->status}}</b></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Created date</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>{{$transaction->created_at}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>Completed Date</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>{{$transaction->updated_at}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
    
@section('javascript')
<script type="text/javascript">
    function printDiv(divName) {
         var printContents = document.getElementById(divName).innerHTML;
         var originalContents = document.body.innerHTML;

         document.body.innerHTML = printContents;

         window.print();

         document.body.innerHTML = originalContents;
    }
</script>
@endsection