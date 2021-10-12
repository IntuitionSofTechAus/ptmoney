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
                        <h4 class="card-title"> Users List</h4>                    
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
                                 <tr>
                                    <th>#No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>created_at</th>
                                  </tr>            
                                </thead>
                                <tbody>
                                @foreach($users as $key=> $user)
                                <tr>
                                     <td>{{ ($key+1) + ($users->currentPage() - 1)*$users->perPage() }}</td>
                                     <td>{{_($user->name)}}</td>
                                     <td>{{_($user->email)}}</td>
                                     <td>@if($user->is_verified ==1)<span class="text-success">Vefified</span>@else<span class="text-danger">Pending</span>@endif</td>
                                     <td>{{($user->created_at)}}</td>
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