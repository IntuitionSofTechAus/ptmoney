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
                     @if($member) 
                        <form action="{{route('approval')}}" method="post" >
                            @csrf
                        <h3>Sender Detail:</h3><br>
                        <div class="col-md-12 row" >
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Full Name<sup class="required">*</sup></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <P>{{$member->sender_full_name}}</P>
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                        <label>Date Of Birth<sup class="required">*</sup></label>
                                </div>
                            </div>
                            <div class="col-md-3">                                    
                                <div class="form-group">
                                      <P>{{$member->dob}}</P>                            
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 row" >
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label >Telephone<sup class="required">*</sup></label></center>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group"> 
                                     <P>{{$member->telephone}}</P>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Residential Address*<sup class="required">*</sup></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                     <P>{{$member->sender_address}}</P>                           
                                    </div>
                                </div>
                        </div>
                             <div class="col-md-12 row" >
                                <div class="col-md-3">
                                    <div class="form-group">
                                          <label>Suburb<sup class="required">*</sup></label> 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                       <P>{{$member->sender_suburb}}</P>                              
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="form-group">
                                       <label>State<sup class="required">*</sup></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <P>{{$member->stateSender->name ?? ''}}</P>                    
                                    </div>
                                </div>
                            </div>
                              <div class="col-md-12 row" >
                                <div class="col-md-3">
                                    <div class="form-group">
                                         <label>Postcode<sup class="required">*</sup></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <P>{{$member->sender_postcode}}</P>               
                                    </div>
                                </div>
                                  <div class="col-md-3">
                                <div class="form-group">
                                    <label>Occupation*<sup class="required">*</sup></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <P>{{$member->occupation}}</P>
                                </div>
                            </div>
                            </div>
                        <div class="col-md-12 row" >
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Are You A Politically Exposed Person?*<sup class="required">*</sup></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                  <P>{{$member->political}}</P>                                   
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Do You Have A Presence In Any Sanctioned Jurisdiction?*<sup class="required">*</sup></label>
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
                        <div class="col-md-12 row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Full Name<sup class="required">*</sup></label>
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                               <P>{{$member->receiver_full_name}}</P>
                                </div>
                             </div>
                             <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Residential Address*<sup class="required">*</sup></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <P>{{$member->receiver_address}}</P>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 row" >
                            <div class="col-md-3">
                                <div class="form-group">
                                 <label>Suburb<sup class="required">*</sup></label> 
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                   <P>{{$member->receiver_suburb}}</P>                        
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                   <label>State<sup class="required">*</sup></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <P>{{$member->stateReceiver->name ?? ''}}</P>                    
                                </div>
                            </div>
                        </div>  
                        <div class="col-md-12 row" >
                            <div class="col-md-3">
                                <div class="form-group">
                                     <label>Postcode<sup class="required">*</sup></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <P>{{$member->receiver_postcode}}</P>               
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Bank Name*<sup class="required">*</sup></label>
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                <P>{{$member->bank_name}}</P>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Account Number*<sup class="required">*</sup></label>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                 <P>{{$member->accont_number}}</P>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Branch<sup class="required">*</sup></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                               <P>{{$member->branch}}</P>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Contact Number*<sup class="required">*</sup></label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                 <P>{{$member->contact_number}}</P>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12 row">
                            <div class="col-md-3">
                                <label class="mt-4" for="">Sign:<sup class="required">*</sup></label>
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
                            <div class="col-md-12 row" >
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Document 1:<sup class="required">*</sup></label>
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
                                        <label>Document 2:<sup class="required">*</sup></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                     <p>{{str_replace("_"," ",$member->document2)}}</p>                                                           
                                    </div>                                  
                                </div>
                            </div>
                            <div class="col-md-12 row" >
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Docfile 1:<sup class="required">*</sup></label>
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
                                        <label>Docfile 2:<sup class="required">*</sup></label>
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
                          
                        <div class="col-md-12">
                            <div class="form-group">  
                            <input type="hidden" name="id" value="{{$member->id}}">    
                            <input type="submit" name="approved" value="Approved" class="btn btn-success" style="float: center;"> 
                             <input type="submit" name="decline" value="Decline" class="btn btn-danger" style="float: center;">
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