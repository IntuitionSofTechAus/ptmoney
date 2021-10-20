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
                                <h4 class="card-title">Payment List  </h4> 
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-6" style="float: right;">
                                    <div class="form-group">
                                        <select class="form-control" name="status" onchange="getPaymentList(this.value);">
                                            <option value="">All Transaction</option>
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
                            <table class="table" id="transaction_table">
                                <thead class=" text-primary">
                                    <th>#No</th>
                                    <th>Trans No.</th>
                                    <th>Agent Ref.</th>
                                    <th>Sender</th>
                                    <th>Receiver</th>
                                    <th>Account No.</th>
                                    <th>Bank</th>
                                    <th>Sent</th>
                                    <th>Rate</th>
                                    <th>Received</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Action</th>                    
                                </thead>
                                <tbody>
                                    @if(count($transaction) > 0)
                                        @foreach($transaction as $k=>$t)
                                            <tr>
                                                <td>{{$k+1}}</td>
                                                <td>{{$t->transaction_id}}</td>
                                                <td>{{$t->aganet_ref}}</td>
                                                <td>{{$t->sender->sender_full_name}}</td>
                                                <td>{{$t->receiver->receiver_full_name}}</td>
                                                <td>{{$t->receiver->accont_number}}</td>
                                                <td>{{$t->receiver->bank_name}}</td>
                                                <td class="text-success"><b><i class="fa fa-dollar"></i> {{$t->amount}}</b></td>
                                                <td>{{$t->rate}}</td>
                                                <td class="text-danger"><b> ฿ {{$t->receivable_amount}}</b></td>
                                                <td @if($t->status == 'waiting') class="text-info" @elseif($t->status == 'processing') class="text-danger" @elseif($t->status == 'transfering') class="text-primary" @elseif($t->status == 'completed') class="text-muted" @endif><b>{{$t->status}}</b></td>
                                                <td>{{date('d M Y', strtotime($t->created_at))}}</td>
                                                <td><a href="{{route('transaction.userview',$t->id)}}" class="btn btn-danger btn-round"><i class="fa fa-money" aria-hidden="true"></i></a> <a href="{{route('transaction.userview',$t->id)}}" class="btn btn-info btn-round"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
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
@section('javascript')
<script type="text/javascript">
    $(document).ready( function () {
        $('#transaction_table').DataTable();
    });

    function getPaymentList(value){
        $.ajax({
            url : "{{url('admin/list-transaction')}}/"+value,
            type : 'get',
            success: function(res){
                $("#transaction_table").html('');
                $("#transaction_table").html(res);
            }
        })
    }
</script>
@endsection