@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'tables'
])
@section('content')
<style type="text/css">
    th { white-space: nowrap; }
    .bold{
        font-weight: bold;
    }
    table.dataTable tfoot th, table.dataTable tfoot td {
        padding: 10px 6px;
    }
   
</style>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-5">
                                <h4 class="card-title">Payment List  </h4> 
                            </div>
                            <div class="col-md-7" style="float: right;">
                                <form method="post" action="{{route('transaction.export')}}">
                                    @csrf
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Select Status</label>
                                                    <select class="form-control" name="status" onchange="getPaymentList(this.value);" required>
                                                        <option value="all">All Transaction</option>
                                                        <option value="waiting">Wait For Payment</option>
                                                        <option value="processing">Processing</option>
                                                        <option value="transferring">Transferring</option>
                                                        <option value="completed">Completed</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Transaction from</label>
                                                    <input type="date" name="from_date" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Transaction To</label>
                                                    <input type="date" name="to_date" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-info">Export</button>
                                                </div>
                                            </div>
                                        </div>
                                </form>
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
                        <div class="table-responsive" id="table_div">
                            <table class="table" id="transaction_table">
                                <thead class=" text-primary">
                                    <th>#No</th>
                                    <th>Trans No.</th>
                                    <th>Agent Ref.</th>
                                    <th>Sender</th>
                                    <th>Receiver</th>
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
                                                <td class="text-success bold">${{$t->amount}}</td>
                                                <td>{{$t->rate}}</td>
                                                <td class="text-danger bold">???{{$t->receivable_amount}}</td>
                                                <td @if($t->status == 'waiting') class="text-info" @elseif($t->status == 'processing') class="text-danger" @elseif($t->status == 'transfering') class="text-primary" @elseif($t->status == 'completed') class="text-muted" @endif><b>{{$t->status}}</b></td>
                                                <td>{{date('d M Y', strtotime($t->created_at))}}</td>
                                                <td><a href="{{route('transaction.mail',$t->id)}}" @if($t->is_sent == 1) class="btn btn-danger btn-round" @else class="btn btn-info btn-round" @endif ><i class="fa fa-envelope" aria-hidden="true"></i></a> <a href="{{route('transaction.detail',$t->id)}}" class="btn btn-success btn-round"><i class="fa fa-money" aria-hidden="true"></i></a> <a href="{{route('transaction.edit',$t->id)}}" class="btn btn-danger btn-round"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4"></th>
                                        <th>Total:</th>
                                        <th ></th>
                                        <th></th>
                                        <th ></th>
                                        <th colspan="3"></th>
                                    </tr>
                                </tfoot>
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
        $('#transaction_table').DataTable({
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
                console
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$\???,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
     
                // Total over all pages
                total = api
                    .column( 5 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
     
                // Total over this page
                pageTotal = api
                    .column( 5, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
     
                // Update footer
                $( api.column(5 ).footer() ).html(
                    '<span class="text-success">$'+pageTotal +'</span>'
                );

                total = api
                    .column( 7 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
     
                // Total over this page
                pageTotal = api
                    .column(7, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
     
                // Update footer
                $( api.column( 7 ).footer() ).html(
                    '<span class="text-danger">???'+pageTotal +'</span>'
                );
            }
        });
    });
    function getPaymentList(value){
        $.ajax({
            url : "{{url('admin/list-transaction')}}/"+value,
            type : 'get',
            success: function(res){
                $("#table_div").html('');
                $("#table_div").html(res);
            }
        })
    }
</script>
@endsection