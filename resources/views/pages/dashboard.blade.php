@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'dashboard'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-globe text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Today Exchange rate</p>
                                    <p class="card-title">{{ \App\Models\ExchangeRate::first()->exchange_rate ?? '' }}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-money"></i>
                        </div>
                    </div>
                </div>
            </div> 
            @if (\Auth::user()->role == 1)
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-money-coins text-success"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Verified Users</p>
                                        <p class="card-title">{{ \App\Models\User::where('is_verified',1)->get()->count() ?? '' }}
                                            <p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-user-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
           <!--  <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-vector text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Errors</p>
                                    <p class="card-title">23
                                        <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-clock-o"></i> In the last hour
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-favourite-28 text-primary"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Followers</p>
                                    <p class="card-title">+45K
                                        <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-refresh"></i> Update now
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="row">
             @if (\Auth::user()->role == 1)
                <div class="col-md-6">
                    <div class="card ">
                        <div class="card-header ">
                            <h5 class="card-title">Recent Verified Users</h5>
                        </div>
                        <div class="card-body ">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <tr>                                
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Verified Date</th>    
                                    </tr>
                                    </thead>
                                    <tbody>
                                     @foreach ((\App\Models\User::orderBy('created_at','desc'))->where('is_verified',1)->limit(5)->get() as $key => $user)
                                        <tr>
                                         <td>{{$user->name}}</td>
                                         <td>{{$user->email}}</td>
                                         <td>{{$user->updated_at}}</td>
                                        </tr>
                                     @endforeach                               
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer ">
                        </div>
                    </div>
                </div>
            @else
                <div class="col-md-6">
                    <div class="card ">
                        <div class="card-header ">
                            <h5 class="card-title">Recent Beneficiary</h5>
                        </div>
                        <div class="card-body ">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <tr>                                
                                        <th>membership-Number</th>
                                        <th>Username</th>
                                        <th>Created_at</th>    
                                    </tr>
                                    </thead>
                                    <tbody>
                                     @foreach ((\App\Models\Beneficiary::orderBy('created_at','desc'))->where('user_id',Auth::user()->id)->limit(5)->get() as $key => $beneficary)
                                        <tr>
                                         <td>{{$beneficary->membership_number}}</td>
                                         <td>{{$beneficary->user->name }}</td>
                                         <td>{{$beneficary->created_at}}</td>
                                        </tr>
                                     @endforeach                               
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer ">
                        </div>
                    </div>
                </div>
            @endif
                <div class="col-md-6">
                    <div class="card ">
                        <div class="card-header ">
                            <h5 class="card-title">Recent Transaction</h5>
                        </div>
                        <div class="card-body ">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <tr>                                
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Date</th>    
                                    </tr>
                                    </thead>
                                    <tbody>
                                     <tr>
                                         <td></td>
                                         <td></td>
                                         <td></td>
                                    </tr>                               
                                   </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer ">
                        </div>
                    </div>
                </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            demo.initChartsPages();
        });
    </script>
@endpush