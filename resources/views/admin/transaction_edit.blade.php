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
                       <h3> Transaction Details</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('transaction.update')}}" method="POST">
                            @csrf
                            @if (\Session::has('success'))
                            <div class="alert alert-success">
                            {!! \Session::get('success') !!}
                            </div>
                            @endif
                            @if(!empty($transactions))
                                @foreach($transactions as $transaction)
                                <input type="hidden" name="id" value="{{$transaction->id}}">
                                    <div class="container">
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <p></p>
                                                <p>Transaction Id</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p></p>
                                                <input class="form-control" type="text" value="{{$transaction->transaction_id}}" disabled>
                                            </div>
                                        </div> 
                                        <hr>
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <p>Sender Id</p>
                                            </div>
                                            <div class="col-md-4">
                                                 <input class="form-control" type="text" value="{{$transaction->sender->membership_number}}" disabled>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <p>Sender</p>
                                            </div>
                                            <div class="col-md-4">
                                                <input class="form-control" type="text" value="{{$transaction->sender->sender_full_name}}" disabled>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <p>Beneficiary Name</p>
                                            </div>
                                            <div class="col-md-4">
                                                 <input class="form-control" type="text" value="{{$transaction->receiver->receiver_full_name}}" disabled>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <p>Account Number</p>
                                            </div>
                                            <div class="col-md-4">
                                                 <input class="form-control" type="text" value="{{$transaction->receiver->accont_number}}" disabled>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <p>Bank</p>
                                            </div>
                                            <div class="col-md-4">
                                                 <input class="form-control" type="text" value="{{$transaction->receiver->bank_name}}" disabled>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <p>Send Amount</p>
                                            </div>
                                            <div class="col-md-4">
                                                <input class="form-control" type="text" value="AUR {{$transaction->amount}}" disabled>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <p>Rate</p>
                                            </div>
                                            <div class="col-md-4">
                                                 <input class="form-control" type="text" value="{{$transaction->rate}}" disabled>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <p>Fee</p>
                                            </div>
                                            <div class="col-md-4">
                                                <input class="form-control" type="text" value="AUR {{$transaction->fee}}" disabled>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <p>Total Payable</p>
                                            </div>
                                            <div class="col-md-4">
                                                 <input class="form-control" type="text" value="{{$transaction->total_payable}}" disabled>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <p>Receivable Amount</p>
                                            </div>
                                            <div class="col-md-4">
                                                <input class="form-control" type="text" value="AUR {{$transaction->receivable_amount}}" disabled>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <p>Status</p>
                                            </div>
                                            <div class="col-md-4">
                                                <select name="status" class="form-control">
                                                    <option value="waiting" @if($transaction->status == 'waiting') selected @endif>Waiting</option>
                                                    <option value="processing" @if($transaction->status == 'processing') selected @endif>Processing</option>
                                                    <option value="transfering" @if($transaction->status == 'transfering') selected @endif>Trasfering</option>
                                                    <option value="completed" @if($transaction->status == 'completed') selected @endif>Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <p>Created date</p>
                                            </div>
                                            <div class="col-md-4">
                                                 <input class="form-control" type="text" value="{{$transaction->created_at}}" disabled>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <p>Completed Date</p>
                                            </div>
                                            <div class="col-md-4">
                                                 <input class="form-control" type="text" value="{{$transaction->updated_at}}" disabled>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <button class="btn btn-info" type="submit"> Update </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
    