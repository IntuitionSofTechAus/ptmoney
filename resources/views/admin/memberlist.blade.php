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
                    <ul>
                    <li>{!! \Session::get('success') !!}</li>
                    </ul>
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
                                 @php $myDateTime = DateTime::createFromFormat('Y-m-d',$member->date); @endphp
                                 <tr>
                                     <td>{{ ($key+1) + ($members->currentPage() - 1)*$members->perPage() }}</td>
                                     <td>{{__($member->name)}}</td>
                                     <td>{{  $myDateTime->format('d M Y')}}</td>
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