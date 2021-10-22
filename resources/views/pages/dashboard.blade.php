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
                            <div class="col-4 col-md-3">
                                <div class="icon-big text-center icon-warning">
                                    <!-- <i class="nc-icon nc-globe text-warning"></i> -->
                                    <i class="fa fa-dollar text-warning"></i>
                                </div>
                            </div>
                            <div class="col-8 col-md-9">
                                <div class="numbers">
                                    <p class="card-category">Exchange rate</p>
                                    <p class="card-title">{{ \App\Models\ExchangeRate::first()->exchange_rate ?? '' }}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <!-- <hr> -->
                        <div class="stats" style="text-align: right;">
                            <!-- <a href="#">View</a> -->
                            <p></p>
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
                                        <i class="fa fa-users text-success"></i>
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
                        <!-- <hr> -->
                        <div class="stats" style="text-align: right;">
                            <!-- <a href="#">View</a> -->
                            <p></p>
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
                                        <i class="fa fa-list text-danger"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Members Count</p>
                                        <p class="card-title">{{ \App\Models\Sender::where('user_id','!=',Auth::user()->id)->get()->count() ?? '' }}
                                            <p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                        <!-- <hr> -->
                        <div class="stats" style="text-align: right;">
                            <!-- <a href="#">View</a> -->
                            <p></p>
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
                                        <i class="fa fa-user text-dark"></i>

                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Walkin Users</p>
                                        <p class="card-title">{{\App\Models\Sender::where('user_id','=',Auth::user()->id)->get()->count() ?? ''}}
                                            <p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                        <!-- <hr> -->
                        <div class="stats" style="text-align: right;">
                            <!-- <a href="#">View</a> -->
                            <p></p>
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
                                        <i class="fa fa-pause text-info"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Waiting Transaction</p>
                                        <p class="card-title">{{ \App\Models\Transaction::where('status','waiting')->get()->count() ?? '' }}<p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                        <!-- <hr> -->
                        <div class="stats" style="text-align: right;">
                            <!-- <a href="#">View</a> -->
                            <p></p>
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
                                        <i class="fa fa-spinner text-danger"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Processing Transaction</p>
                                        <p class="card-title">{{ \App\Models\Transaction::where('status','processing')->get()->count() ?? '' }}
                                            <p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                        <!-- <hr> -->
                        <div class="stats" style="text-align: right;">
                            <!-- <a href="#">View</a> -->
                            <p></p>
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
                                        <i class="fa fa-exchange text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Transferring Transaction</p>
                                        <p class="card-title">{{ \App\Models\Transaction::where('status','transfering')->get()->count() ?? '' }}
                                            <p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                        <!-- <hr> -->
                        <div class="stats" style="text-align: right;">
                            <!-- <a href="#">View</a> -->
                            <p></p>
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
                                        <i class="fa fa-money text-muted"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Completed Transaction</p>
                                        <p class="card-title">{{ \App\Models\Transaction::where('status','completed')->get()->count() ?? '' }}
                                            <p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                        <!-- <hr> -->
                        <div class="stats" style="text-align: right;">
                            <!-- <a href="#">View</a> -->
                            <p></p>
                        </div>
                    </div>
                    </div>
                </div>
            @else
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="fa fa-pause text-info"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Waiting Transaction</p>
                                        <p class="card-title">{{ \App\Models\Transaction::join('senders','senders.id','=','transactions.sender_id')->where('senders.user_id',Auth::user()->id)->where('status','waiting')->get()->count() ?? '' }}<p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                        <!-- <hr> -->
                        <div class="stats" style="text-align: right;">
                            <!-- <a href="#">View</a> -->
                            <p></p>
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
                                        <i class="fa fa-spinner text-danger"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Processing Transaction</p>
                                        <p class="card-title">{{\App\Models\Transaction::join('senders','senders.id','=','transactions.sender_id')->where('senders.user_id',Auth::user()->id)->where('status','processing')->get()->count() ?? '' }}
                                            <p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                        <!-- <hr> -->
                        <div class="stats" style="text-align: right;">
                            <!-- <a href="#">View</a> -->
                            <p></p>
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
                                        <i class="fa fa-exchange text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Transferring Transaction</p>
                                        <p class="card-title">{{ \App\Models\Transaction::join('senders','senders.id','=','transactions.sender_id')->where('senders.user_id',Auth::user()->id)->where('status','transfering')->get()->count() ?? '' }}
                                            <p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                        <!-- <hr> -->
                        <div class="stats" style="text-align: right;">
                            <!-- <a href="#">View</a> -->
                            <p></p>
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
                                        <i class="fa fa-money text-muted"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Completed Transaction</p>
                                        <p class="card-title">{{ \App\Models\Transaction::join('senders','senders.id','=','transactions.sender_id')->where('senders.user_id',Auth::user()->id)->where('status','completed')->get()->count() ?? '' }}
                                        <p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                        <!-- <hr> -->
                        <div class="stats" style="text-align: right;">
                            <!-- <a href="#">View</a> -->
                            <p></p>
                        </div>
                    </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="card col-md-12">
                <div class="card-header ">
                    <h5 class="card-title">Recent Transactions</h5>
                </div>
                <div class="card-body ">
                    <div class="table-responsive">
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
                                @if(\Auth::user()->role == 1)
                                    @php $transaction = \App\Models\Transaction::orderBy('created_at','desc')->get(); @endphp
                                @else
                                    @php $transaction = \App\Models\Transaction::join('senders','senders.id','=','transactions.sender_id')->where('senders.user_id',\Auth::user()->id)->orderBy('transactions.created_at','desc')->limit(5)->get(); @endphp
                                @endif
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
                                            <td class="text-success bold"><b>${{$t->amount}}</b></td>
                                            <td>{{$t->rate}}</td>
                                            <td class="text-danger bold"><b>฿{{$t->receivable_amount}}</b></td>
                                            <td @if($t->status == 'waiting') class="text-info" @elseif($t->status == 'processing') class="text-danger" @elseif($t->status == 'transfering') class="text-primary" @elseif($t->status == 'completed') class="text-muted" @endif><b>{{$t->status}}</b></td>
                                            <td>{{date('d M Y', strtotime($t->created_at))}}</td>
                                            <td><a href="{{route('transaction.detail',$t->id)}}" class="btn btn-success btn-round"><i class="fa fa-money" aria-hidden="true"></i></a></td>
                                        </tr>
                                    @endforeach
                                <!-- @endif -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
             @if (\Auth::user()->role == 1)
                <div class="card col-md-12">
                    
                        <div class="card-header ">
                            <h5 class="card-title">Recent Verified Users</h5>
                        </div>
                        <div class="card-body ">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <tr>          
                                        <th>Id</th>                      
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Created Date</th>    
                                    </tr>
                                    </thead>
                                    <tbody>
                                     @foreach ((\App\Models\User::orderBy('created_at','desc'))->where('is_verified',1)->limit(5)->get() as $key => $user)
                                        <tr>
                                            <td>{{$k+1}}</td>
                                         <td>{{$user->name}}</td>
                                         <td>{{$user->email}}</td>
                                         <td>Verified</td>
                                         <td>{{date_format($user->created_at,"d M Y, H:i A")}}</td>
                                        </tr>
                                     @endforeach                               
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    
                </div>
            @endif

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