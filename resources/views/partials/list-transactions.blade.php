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
                    <td class="text-success bold">${{$t->amount}}</td>
                    <td>{{$t->rate}}</td>
                    <td class="text-danger bold">฿{{$t->receivable_amount}}</td>
                    <td @if($t->status == 'waiting') class="text-info" @elseif($t->status == 'processing') class="text-danger" @elseif($t->status == 'transfering') class="text-primary" @elseif($t->status == 'completed') class="text-muted" @endif><b>{{$t->status}}</b></td>
                    <td>{{date('d M Y', strtotime($t->created_at))}}</td>
                    <td><a href="{{route('transaction.detail',$t->id)}}" class="btn btn-success btn-round"><i class="fa fa-money" aria-hidden="true"></i></a> <a href="{{route('transaction.edit',$t->id)}}" class="btn btn-info btn-round"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <th colspan="6"></th>
            <th>Total:</th>
            <th ></th>
            <th></th>
            <th ></th>
            <th colspan="3"></th>
        </tr>
    </tfoot>
</table>
<script type="text/javascript">
    $(document).ready( function () {
        $('#transaction_table').DataTable({
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
                console
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$\฿,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
     
                // Total over all pages
                total = api
                    .column( 7 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
     
                // Total over this page
                pageTotal = api
                    .column( 7, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
     
                // Update footer
                $( api.column( 7 ).footer() ).html(
                    '<span class="text-success">$'+pageTotal +'</span>'
                );

                total = api
                    .column( 9 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
     
                // Total over this page
                pageTotal = api
                    .column( 9, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
     
                // Update footer
                $( api.column( 9 ).footer() ).html(
                    '<span class="text-danger">฿'+pageTotal +'</span>'
                );
            }
        });
    });
</script>