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
                                <h4 class="card-title">Walk-in members </h4> 
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('customer.new') }}" class="btn btn-primary btn-round" style="float:right;">Add New</a> 
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
                                    <th>Name</th>
                                    <th>Date</th>
                                    
                                    <th>sender-full-name</th>
                                    <th>receiver-full-name</th>
                                    <!-- <th>status</th> -->
                                    <th>Action</th>                    
                                </thead>
                                <tbody>
                                    @if(count($members) > 0)
                                        @foreach($members as $key=> $member)
                                            @php $now = \Carbon\Carbon::now()->month; 
                                                 $exp1 = date('m',strtotime($member->doc_expiry1));
                                                 $exp2 = date('m',strtotime($member->doc_expiry2));
                                                 $exp1  = intval($exp1);
                                                 $exp2  = intval($exp2);
                                            @endphp
                                            <tr>
                                                 <td>{{ ($key+1) + ($members->currentPage() - 1)*$members->perPage() }}</td>
                                                 <td>{{__($member->name)}}</td>
                                                 <td>{{ date('d M Y',strtotime($member->date))  
                                                  }}</td>
                                                 <td>{{__($member->sender_full_name)}}</td>
                                                 <td>{{__($member->receiver_full_name)}}</td>
                                                 <td><a href="{{route('showcustomer',$member->id)}}" class="btn btn-info"><i class="fa fa-info-circle" aria-hidden="true"></i></a> <a href="{{route('show.receivers',$member->id)}}" class="btn btn-danger"><i class="fa fa-users" aria-hidden="true"></i></a></td>
                                            </tr>
                                        @endforeach 
                                    @else
                                        <tr>
                                            <td>No Record Found!!</td>
                                        </tr>  
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