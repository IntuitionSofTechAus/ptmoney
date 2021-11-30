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
                    {!! \Session::get('success') !!}
                    </div>
                    @endif
                     @if($member) 
                        <form action="{{route('approval')}}" method="post" >
                            @csrf
                        <h5>Sender Detail:<span style="float: right;"><a href="{{route('edit.member',$member->id)}}" class="btn btn-info btn-round"><i class="fa fa-pencil"></i></a></span></h5><br>
                        <div class="row" >
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Membership Number</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <P>{{$member->membership_number}}</P>
                                </div>
                            </div>                            
                        </div>
                        <div class="row" >
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Full Name</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <P>{{$member->sender_full_name}}</P>
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                        <label>Date Of Birth</label>
                                </div>
                            </div>
                            <div class="col-md-3">                                    
                                <div class="form-group">
                                    <P>{{date('d M Y',strtotime($member->dob))
                                       }}</P>                      
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label >Telephone</label></center>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group"> 
                                     <P>{{$member->telephone}}</P>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Residential Address</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                     <P>{{$member->sender_address}}</P>                           
                                    </div>
                                </div>
                        </div>
                             <div class="row" >
                                <div class="col-md-3">
                                    <div class="form-group">
                                          <label>Suburb</label> 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                       <P>{{$member->sender_suburb}}</P>                              
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="form-group">
                                       <label>State</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <P>{{$member->stateSender->name ?? ''}}</P>                    
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
                                        <P>{{$member->sender_postcode}}</P>               
                                    </div>
                                </div>
                                  <div class="col-md-3">
                                <div class="form-group">
                                    <label>Occupation*</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <P>{{$member->occupation}}</P>
                                </div>
                            </div>
                            </div>
                        <div class="row" >
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Are You A Politically Exposed Person?</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                  <P>{{$member->political}}</P>                                   
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Do You Have A Presence In Any Sanctioned Jurisdiction?</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                 <P>{{$member->presence}}</P> 
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
                               <P>{{$member->receiver_full_name}}</P>
                                </div>
                             </div>
                             <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Residential Address</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <P>{{$member->receiver_address}}</P>
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
                               <P>{{$member->province ?? ''}}</P>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                   <label>District</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <P>{{$member->receiver_state ?? ''}}</P>                    
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
                                    <P>{{$member->receiver_postcode}}</P>               
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Bank Name</label>
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                <P>{{$member->bank_name}}</P>
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
                                 <P>{{$member->accont_number}}</P>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Branch</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                               <P>{{$member->branch}}</P>
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
                                 <P>{{$member->contact_number}}</P>
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
                                    <img src="{{asset('upload/'.$member->signed)}}" width="300">
                                </div>
                                <br/>
                            </div>                      
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label class="mt-4">I Accept The Above Terms & Conditions</label> 
                                </div> 
                             </div>
                                <div class="col-md-3">   
                                  <p class="mt-4"> {{$member->acceptance ? "Yes" : "No" }}</p>
                                </div>
                        </div>
                        <hr>
                        <div>
                            <h3>Uploaded Documents:</h3>
                        </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Document 1:</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <P>{{str_replace("_"," ",$member->document1)}}</P>
                                    <br>                               
                                    </div>                                  
                                </div>
                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Document 2:</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                     <p>{{str_replace("_"," ",$member->document2)}}</p>                                                           
                                    </div>                                  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Docfile 1:</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                      <a href="{{asset($member->docfile1)}}" download="">
                                       <img width="100" src="{{asset($member->docfile1)}}" >
                                    </a>                    
                                    </div>                                  
                                </div>
                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Docfile 2:</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                      <a href="{{asset($member->docfile2)}}" download>
                                        <img width="100"  src="{{asset($member->docfile2)}}" >
                                    </a>                                                           
                                    </div>                                  
                                </div>
                            </div>
                            @if($member->doc_expiry1)
                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Doc Expiry Date1</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">                                     
                                        <p>{{date('d M Y',strtotime($member->doc_expiry1))}}</p>                                 
                                    </div>                                  
                                </div>
                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Doc Expiry Date 2</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                     <p>{{date('d M Y',strtotime($member->doc_expiry2))}}</p>           
                                    </div>                                  
                                </div>
                            </div>
                            @endif
                        @if($member->approval == 0 && $is_customer != 1)  
                        <div class="col-md-12">
                            <div class="form-group">  
                            <input type="hidden" name="id" value="{{$member->id}}">    
                            <input type="submit" name="approved" value="Approved" class="btn btn-success" style="float: center;"> 
                             <input type="submit" name="decline" value="Decline" class="btn btn-danger" style="float: center;">
                        @endif
                        </div>   
                        <form>
                       @else 
                       <h3>Your form is submited Wait for admin Review</h3>
                       @endif     
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('javascript')
    <script type="text/javascript" src="{{asset('paper')}}/js/signature/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{asset('paper')}}/js/signature/jquery.signature.js"></script>
    <script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });

</script>
@endsection