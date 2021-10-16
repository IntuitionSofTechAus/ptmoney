@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'tables'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title">Wait for Payment List  </h4> 
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-6"></div> 
                                <div class="col-md-6" style="float: right;">
                                    <div class="form-group">
                                        <select class="form-control" name="status">
                                            <option value="waiting">Wait For Payment</option>
                                            <option value="processing">Processing</option>
                                            <option value="transferring">Transferring</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>  
                        </div>  
                        <!-- <h4 class="card-title"> Walk-in members </h4> -->
                    </div>
                    <div class="card-body">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                        {!! \Session::get('success') !!}
                        </div>
                    @endif
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>#No</th>
                                    <th>Transaction Id</th>
                                    <th>Agent Ref.</th>
                                    <th>Amount</th>
                                    <th>Rate</th>
                                    <th>Fee</th>
                                    <th>Total Payable</th>
                                    <th>Receivable Amount</th>
                                    <th>Sender Name</th>
                                    <th>Receiver Name</th>
                                    <th>Status</th>
                                    <th>Action</th>                    
                                </thead>
                                <tbody>
                                    @if(count($transaction) > 0)
                                        @foreach($transaction as $k=>$t)
                                            <tr>
                                                <td>{{$k+1}}</td>
                                                <td>{{$t->transaction_id}}</td>
                                                <td>{{$t->aganet_ref}}</td>
                                                <td>{{$t->amount}}</td>
                                                <td>{{$t->rate}}</td>
                                                <td>{{$t->fee}}</td>
                                                <td>{{$t->total_payable}}</td>
                                                <td>{{$t->receivable_amount}}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{$t->status}}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
@endsection