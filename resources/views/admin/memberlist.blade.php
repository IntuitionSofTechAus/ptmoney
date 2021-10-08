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
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>#No</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Username</th>
                                    <th>sender-full-name</th>
                                    <th>receiver-full-name</th>                                   
                                </thead>
                                <tbody>
                                 @foreach($members as $key=> $member)
                                     <td>{{ ($key+1) + ($members->currentPage() - 1)*$members->perPage() }}</td>
                             <td>{{__($member->name)}}</td>
                             <td>{{__($member->date)}}</td>
                             <td>{{$member->user->name}}</td>
                             <td>{{__($member->sender_full_name)}}</td>
                              <td>{{__($member->receiver_full_name)}}</td>
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