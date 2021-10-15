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
                        <h4 class="card-title"> Member List</h4>
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
                                    <th>Username</th>
                                    <th>sender-full-name</th>
                                    <th>receiver-full-name</th>
                                    <th>status</th>
                                    <th>Action</th>                    
                                </thead>
                                <tbody>
                                 @foreach($members as $key=> $member)
                                 @php $now = \Carbon\Carbon::now()->month; 
                                 $exp1 = date('m',strtotime($member->doc_expiry1));
                                 $exp2 = date('m',strtotime($member->doc_expiry2));
                                 $exp1  = intval($exp1);
                                 $exp2  = intval($exp2);
                                
                               @endphp
                                 <tr>
                                     <td>{{ ($key+1) + ($members->currentPage() - 1)*$members->perPage() }}</td>
                                     <td> <p class="@if($now == $exp1 || $now == $exp2){{ 'text-danger' }} @endif">{{__($member->name)}}</p></td>
                                     <td>{{date('d M Y',strtotime($member->date))  
                                      }}</td>
                                     <td>{{ $member->user->name}}</td>
                                     <td>{{__($member->sender_full_name)}}</td>
                                     <td>{{__($member->receiver_full_name)}}</td>
                                     <td>
                                        <a class="btn btn-@if($member->approval==0){{'warning'}} @elseif($member->approval==1){{'success'}}@else{{'danger'}}@endif">@if($member->approval==0){{'Pending'}} @elseif($member->approval==1){{'Approved'}}@else{{'Rejected'}}@endif</a></td>
                                      <td><a href="{{route('showmember',$member->id)}}" class="btn btn-info">Show Details</a></td>
                                </tr>
                                @endforeach   
                               </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
@endsection