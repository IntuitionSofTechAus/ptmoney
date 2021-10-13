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
                                 @foreach($beneficiary as $key=> $member)
                                 <tr>
                                     <td>{{ ($key+1) + ($beneficiary->currentPage() - 1)*$beneficiary->perPage() }}</td>
                             <td>{{__($member->name)}}</td>
                             <td>{{__($member->date)}}</td>
                             <td>{{$member->user->name}}</td>
                             <td>{{__($member->sender_full_name)}}</td>
                             <td>{{__($member->receiver_full_name)}}</td>
                             <td>
                                <a class="btn btn-@if($member->approval==0){{'warning'}} @elseif($member->approval==1){{'success'}}@else{{'danger'}}@endif">@if($member->approval==0){{'Panding'}} @elseif($member->approval==1){{'Approved'}}@else{{'Rejected'}}@endif</a></td>
                              <td><a href="#" class="btn btn-info">Show Details</a></td>
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