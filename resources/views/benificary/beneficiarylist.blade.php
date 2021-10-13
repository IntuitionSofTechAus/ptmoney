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
                                <h4 class="card-title">Beneficary List</h4> 
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('beneficiary.add') }}" class="btn btn-primary btn-round" style="float:right;">Create</a> 
                            </div>  
                        </div>                
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
                                    <th>Action</th>                                   
                                </thead>
                                <tbody>
                                 @foreach($beneficiary as $key=> $member)
                                 <tr>
                                     @php $myDateTime = DateTime::createFromFormat('Y-m-d',$member->date); @endphp
                                     <td>{{ ($key+1) + ($beneficiary->currentPage() - 1)*$beneficiary->perPage() }}</td>
                             <td>{{__($member->name)}}</td>
                             <td>{{ $myDateTime->format('d M Y')}}</td>
                             <td>{{$member->user->name}}</td>
                             <td>{{__($member->sender_full_name)}}</td>
                             <td>{{__($member->receiver_full_name)}}</td>
                             <td><a href="{{route('showbeneficiary',$member->id)}}" class="btn btn-info btn-round">Show Details</a></td>
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