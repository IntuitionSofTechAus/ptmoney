@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'typography'
])
<style type="text/css">
p{
       margin-top: 10px;
}
.reds{color: red;}
canvas#signature {
  border: 2px solid black;
}
.required{ color:red; }
</style>

  
    <style>
        .kbw-signature { width: 100%; height: 200px;}
        #sig canvas{
            width: 100% !important;
            height: auto;
        }
    </style>
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                    @if (\Session::has('success'))
                    <div class="alert alert-success">
                    <ul>
                    <li>{!! \Session::get('success') !!}</li>
                    </ul>
                    </div>
                    @endif
                     @if($beneficiary) 
                        <h3>Sender Detail:</h3><br>
                        <div class="row" >
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Full Name</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <P>{{$beneficiary->sender_full_name}}</P>
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                        <label>Date Of Birth</label>
                                </div>
                            </div>
                            <div class="col-md-3">                                    
                                <div class="form-group">
                                      <P>{{$beneficiary->dob}}</P>                            
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label>Membership Number</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group"> 
                                     <P>{{$beneficiary->membership_number}}</P>
                                    </div>
                                </div>
                        </div>
                             
                        <hr>
                         <h3>Receiver Detail:</h3>
                        <div class="row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Full Name</label>
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                               <P>{{$beneficiary->receiver_full_name}}</P>
                                </div>
                             </div>
                             <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Residential Address</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <P>{{$beneficiary->receiver_address}}</P>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Proviece</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                               <P>{{$beneficiary->provinces->name ?? ''}}</P>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                   <label>State</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <P>{{$beneficiary->receiver_state ?? ''}}</P>                    
                                </div>
                            </div>
                        </div>  
                        <div class="row" >
                            <div class="col-md-3">
                                <div class="form-group">
                                     <label>Postcode</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <P>{{$beneficiary->receiver_postcode}}</P>               
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Bank Name</label>
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                <P>{{$beneficiary->bank_name}}</P>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Account Number</label>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                 <P>{{$beneficiary->accont_number}}</P>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Branch</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                               <P>{{$beneficiary->branch}}</P>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Contact Number</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                 <P>{{$beneficiary->contact_number}}</P>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="mt-4" for="">Sign:</label>
                            </div>  
                            <div class="col-md-3">
                                <div id="siga" >
                                      @if(File::exists(public_path('upload/beneficiary/'.$beneficiary->signed)))
                                    <img src="{{asset('upload/beneficiary/'.$beneficiary->signed)}}" width="300">
                                    @endif
                                </div>
                                <br/>
                            </div>                      
                        </div>
                       @endif     
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
