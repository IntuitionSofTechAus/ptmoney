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
                                <a href="{{ route('beneficiary.add') }}" class="btn btn-primary btn-round" style="float:right;">Add New</a> 
                            </div>  
                        </div>                
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
                                    <th>receiver-full-name</th>         
                                    <th>Action</th>                                   
                                </thead>
                                <tbody>
                                @foreach($beneficiary as $key=> $member)
                                <tr>
                                     <td>{{ ($key+1) + ($beneficiary->currentPage() - 1)*$beneficiary->perPage() }}</td>
                                     <td>{{__($member->name)}}</td>
                                     <td>{{date('d M Y',strtotime($member->date))}}</td>
                                     <td>{{$member->user->name}}</td>                           
                                     <td>{{__($member->receiver_full_name)}}</td>
                                     <td><a href="{{route('showbeneficiary',$member->id)}}" class="btn btn-info btn-round"><i class="fa fa-info-circle" aria-hidden="true"></i></a> 
                                        @if(\App\Models\Transaction::where('receiver_id',$member->id)->count() <= 0)
                                        <a href="{{route('transaction.usernew',$member->id)}}" class="btn btn-danger btn-round"><i class="fa fa-exchange" aria-hidden="true"></i></a>
                                        @else
                                        <a href="{{route('transaction.userview',$member->id)}}" class="btn btn-danger btn-round"><i class="fa fa-money" aria-hidden="true"></i></a>
                                        @endif
                                    </td>
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