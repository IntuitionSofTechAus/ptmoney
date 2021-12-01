@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'typography'
])
<style type="text/css">
label{
       margin-top: 10px;
}
.reds{color: red;}
canvas#signature {
  border: 2px solid black;
}
.required{ color:red; }
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
                    <p>{!! \Session::get('success') !!}</p>
                    </div>
                    @endif
                    <form action="{{route('member.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$member->id}}">
                        <input type="hidden" name="receiver_id" value="{{$member->receiver_id}}">
                        <input type="hidden" name="approval" value="0">
                        
                        <h3>Sender Detail:</h3><br>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Full Name<sup class="required">*</sup></label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                <input type="text"  name="sender_full_name" value="{{$member->sender_full_name }}"  class="form-control" readonly>
                                @error('sender_full_name')  
                                    <span class="reds">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                                <div class="col-md-3">
                                    <div class="form-group">
                                            <label>Date Of Birth<sup class="required">*</sup></label>
                                        </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                 <input type="date"  max="{{date('Y-m-d')}}" name="dob" value="{{ $member->dob }}"  class="form-control" readonly>
                                            @error('dob')
                                               <span class="reds">{{ $message }}</span>   
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                              <center><label >Telephone<sup class="required">*</sup></label></center>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group"> 
                                             <input type="number"  name="telephone" value="{{ $member->telephone}}"  class="form-control" >
                                            @error('telephone')
                                                <span class="reds">{{ $message }}</span>   
                                            @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Residential Address*<sup class="required">*</sup></label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                <input type="text" name="sender_address" value="{{$member->sender_address}}"  class="form-control" >
                                @error('sender_address')
                                  <span class="reds">{{ $message }}</span>   
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                           <label>Suburb<sup class="required">*</sup></label> 
                                            <input type="text" name="sender_suburb" value="{{ $member->sender_suburb }}"  class="form-control" >
                                            @error('sender_suburb')
                                               <span class="reds">{{ $message }}</span>   
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> 
                                            <label>State<sup class="required">*</sup></label>
                                        <select name="sender_state" class="form-control">
                                            @foreach($states as $state) 
                                            <option value="{{$state->id}}"@if($member->sender_state==$state->id){{'selected'}} @endif>{{$state->name}}</option>
                                            @endforeach
                                        </select>
                                           @error('sender_state')
                                             <span class="reds">{{ $message }}</span>   
                                           @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> 
                                          <label>Postcode<sup class="required">*</sup></label>
                                          <input type="number" name="sender_postcode" value="{{$member->sender_postcode}}"  class="form-control" >
                                          @error('sender_postcode')
                                            <span class="reds">{{ $message }}</span>   
                                          @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Occupation*<sup class="required">*</sup></label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                <input type="text" name="occupation" value="{{ $member->occupation}}"  class="form-control" >
                                @error('occupation')
                                    <span class="reds">{{ $message }}</span>   
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Are You A Politically Exposed Person?*<sup class="required">*</sup></label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                   <input type="hidden" name="political" value="{{$member->political}}">
                                  <input type="radio" id="html" name="political" value="Yes" disabled @if($member->political=='Yes'){{'checked'}} @endif >
                                        &nbsp;&nbsp;&nbsp;
                                        <label for="yes">Yes</label>&nbsp;&nbsp;&nbsp;
                                        <input type="radio" id="css" name="political" disabled value="No" @if($member->political=='No'){{'checked'}} @endif>&nbsp;&nbsp;&nbsp;
                                        <label for="no">No</label> 
                                        @error('political')
                                    <span class="reds">{{ $message }}</span>   
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p>(AUSTRAC Defines ‘Politically Exposed Persons’ As Individuals Who Are , Or Have Been Entrusted With Prominent Functions In A Foreign Country. For Example: Heads Of State Or Of Government, Senior Politicians, Senior Government, Judicial Or Military Officials, Senior Executives Of State Owned Corporations Or Important Political Party Officials.)
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Do You Have A Presence In Any Sanctioned Jurisdiction?*<sup class="required">*</sup></label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="hidden" name="presence" value="{{$member->presence}}">
                                    <input type="radio" id="html" name="presence" value="Yes" disabled @if($member->presence =='Yes'){{'checked'}} @endif>
                                        &nbsp;&nbsp;&nbsp;
                                        <label for="yes">Yes</label>&nbsp;&nbsp;&nbsp;
                                        <input type="radio" id="css" name="presence" value="No" disabled  @if($member->presence == 'No'){{'checked'}} @endif>&nbsp;&nbsp;&nbsp;
                                        <label for="no">No</label>     @error('presence')
                                    <span class="reds">{{ $message }}</span>   
                                @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h3>Receiver Detail:</h3>
                        <div class="row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Full Name<sup class="required">*</sup></label>
                                </div>
                            </div>
                             <div class="col-md-9">
                                <div class="form-group">
                                <input type="text" name="receiver_full_name" value="{{$member->receiver_full_name}}" class="form-control" readonly>
                                @error('receiver_full_name')
                                  <span class="reds">{{ $message }}</span>   
                                @enderror
                                </div>
                             </div>
                        </div>
                        <div class="row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Residential Address*<sup class="required">*</sup></label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                <input type="text" name="receiver_address" value="{{ $member->receiver_address}}"  class="form-control" >
                                @error('receiver_address')
                                   <span class="reds">{{ $message }}</span>   
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-lg-3">
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Province*<sup class="required">*</sup></label>
                                            <select name="province" id="province" onchange="getdistrict(this.value)" class="form-control">
                                                @foreach($provinces as $province) 
                                                <option value="{{$province->id}}"@if($member->province==$province->id){{'selected'}} @endif>{{$province->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('province')
                                               <span class="reds">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group"> 
                                              <label>State<sup class="required">*</sup></label>

                                               <select id="receiver_state" name="receiver_state" class="form-control" onchange="getstate(this.value)">
                                               <option value="{{$member->receiver_state}}">{{$member->receiver_state}}</option></select>
                                                @error('receiver_state')
                                                   <span class="reds">{{ $message }}</span>   
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group"> 
                                          <label>Postcode<sup class="required">*</sup></label>
                                            <select id="receiver_postcode" name="receiver_postcode" class="form-control">
                                               <option value="">Select District</option>
                                            </select>   
                                            @error('receiver_postcode')
                                                <span class="reds">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Bank Name*<sup class="required">*</sup></label>
                                </div>
                            </div>
                             <div class="col-md-9">
                                <div class="form-group">           
                                 <select readOnly disabled name="bank_name" class="form-control"> 
                                     @foreach($banks as $bank)
                                     <option value="{{$bank->id}} @if( $member->id== $bank->id){{'selected'}} @endif">{{$bank->name}}</option>
                                     @endforeach</select>
                                  @error('bank_name')
                                   <span class="reds">{{ $message }}</span>
                                  @enderror
                                </div>
                             </div>
                        </div>
                        <div class="row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Account Number*<sup class="required">*</sup></label>
                                </div>
                            </div>
                             <div class="col-md-9">
                                <div class="form-group">
                                <input type="number" name="accont_number" value="{{ $member->accont_number}}"  class="form-control"  readonly>
                                @error('accont_number')
                                   <span class="reds">{{ $message }}</span>   
                                @enderror
                                </div>
                             </div>
                        </div>
                        <div class="row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Branch<sup class="required">*</sup></label>
                                </div>
                               
                            </div>
                             <div class="col-md-9">
                                <div class="form-group">
                                <input type="text" name="branch" value="{{ $member->branch }}"  class="form-control" readonly>
                                @error('branch')
                                   <span class="reds">{{ $message }}</span>   
                                @enderror
                                </div>
                             </div>
                        </div>
                        <div class="row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Contact Number*<sup class="required">*</sup></label>
                                </div>
                            </div>
                             <div class="col-md-9">
                                <div class="form-group">
                                <input type="number" name="contact_number" value="{{ $member->contact_number }}"  class="form-control">
                                 @error('contact_number')
                                    <span class="reds">{{ $message }}</span>   
                                @enderror
                                </div>
                             </div>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <strong>Condition of Money Transfer</strong><br><br>
                            <p>
                                Pt Money Transfer Is An Austrac Registered Company, Any Information Given May Be Access By Austrac Or Its Registered Agent If Requested. All Transaction(S) Made By You Will Be Kept On Record And Will Be Made Available If Requested Under The Australian Laws. By Making A Payment Using The Service From PT Money Transfer, You Confirm That You Have Read And Understood Our Terms And Conditions And Agree To Be Bound By Them And To Comply With All Applicable Laws And Regulations.
                            </p><br>
                            <strong>Important information</strong><br><br>
                            <p>
                                Please Check Your Account Balance As Soon As Possible, Pt Money Transfer Will Only Keep Transfer Record For 60days From The Date Of Your Transfer. All Incorrect Transactions Must Be Notified Within 7days From The Transaction Date. Pt Money Transfer Will Not Be Liable For Any Incorrect Transaction That Had Not Been Reported Within 7days From The Date Of Transaction.
                                By Signing This Form You Represent And Warrant To Us That The Details That You Have Provided (Including The Details About The Recipient) Are True And Correct In All Aspect.
                            </p><br><br>
                        </div>
                        <div class="row">
                            <div class="col-md-1">
                                <label class="" for="">Sign:<sup class="required">*</sup></label>
                            </div>
                            <div class="col-md-5">
                                <div id="sig" ></div>
                                 @error('signed')
                                   <span class="reds">{{ $message }}</span>   
                                @enderror
                                <br/>
                                <button id="clear" class="btn btn-default">Clear</button>
                                <textarea id="signature64" name="signed" style="display: none"></textarea>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Name*<sup class="required">*</sup></label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                        <input type="text" name="name" value="{{ $member->name }}"  class="form-control" readonly>
                                          @error('name')
                                            <span class="reds">{{ $message }}</span>   
                                          @enderror
                                        </div>
                                    </div>
                                </div>                            
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Date*<sup class="required">*</sup></label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                        <input type="date" name="date" max="{{date('Y-m-d')}}"  value="{{$member->date}}"  class="form-control" readonly>
                                          @error('date')
                                           <span class="reds">{{ $message }}</span>   
                                          @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <div class="form-group">  
                             <input type="checkbox" name="acceptance" value="1" @if($member->acceptance == 1){{'checked'}} @endif>&nbsp;&nbsp;&nbsp;&nbsp;<label>I Accept The Above <a href="{{url('terms-and-condition')}}" target="_blank">Terms & Conditions</a></label>
                               @error('acceptance')
                                   <span class="reds">{{ $message }}</span>   
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div>
                            <h3>Upload Documents:</h3>
                            <p>
                                You must provide  <span style="color: #ff0000; text-decoration: underline;">Two documents</span> from the following list with your completed form to confirm your identity. 
                            </p>
                            <ul style="margin-bottom: 40px;">
                                <li>Current Australian passport(not expired)</li>
                                <li>International Passport (not expired)</li>
                                <li>Australian Driver's License</li>
                                <li>Proof of Age Card (Government Issued)</li>
                            </ul>
                        </div>
                            <div class="row" >
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Document 1:<sup class="required">*</sup></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <select name="document1" class="form-control">
                                        <option value="Australia_Drivers_License">Australia Drivers License
                                        </option>
                                        <option value="Australia_Photo_ID" @if($member->document1 == 'Australia_Photo_ID'){{'selected'}} @endif>Australia Photo ID</option>
                                        <option value="Passport"@if($member->document1 =='Passport'){{'selected'}} @endif>Passport</option>
                                        <option value="Thai_National_ID" @if($member->document1 == 'Thai_National_ID'){{'selected'}}@endif>Thai National ID</option>
                                        <option value="Others"@if($member->document1 == 'Others'){{'selected'}} @endif> Others</option>
                                    </select>
                                    @error('document1')
                                      <span class="reds">{{ $message }}</span>   
                                    @enderror
                                    <br>                               
                                    </div>
                                    <img width="100" src="{{asset($member->docfile1)}}" ><br><br>
                                    <input type="hidden" name="docfile1" value="{{$member->docfile1}}">
                                    <input type="file" name="docfile1" size="40" class="" accept=".jpg,.jpeg,.png,.gif,.pdf">
                                    
                                </div>
                                 <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Document 2:<sup class="required">*</sup></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <select name="document2" class="form-control">
                                       <option value="Australia_Drivers_License">Australia Drivers License
                                        </option>
                                        <option value="Australia_Photo_ID" @if($member->document2 == 'Australia_Photo_ID'){{'selected'}} @endif>Australia Photo ID</option>
                                        <option value="Passport"@if($member->document2 =='Passport'){{'selected'}} @endif>Passport</option>
                                        <option value="Thai_National_ID" @if($member->document2 == 'Thai_National_ID'){{'selected'}}@endif>Thai National ID</option>
                                        <option value="Others"@if($member->document2 == 'Others'){{'selected'}} @endif> Others</option>
                                    </select>
                                      @error('document2')
                                       <span class="reds">{{ $message }}</span>   
                                      @enderror
                                    <br>                              
                                    </div>
                                    <img width="100" src="{{asset($member->docfile2)}}" ><br><br>
                                    <input type="hidden" name="docfile2" value="{{$member->docfile2}}">
                                    <input type="file" name="docfile2" size="40" class="" accept=".jpg,.jpeg,.png,.gif,.pdf">
                                   
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Doc Expiry Date1<sup class="required">*</sup></label>
                                    </div>                                   
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="date" name="doc_expiry1" placeholder="Select Expiry date" class="form-control" value="{{$member->doc_expiry1}}"><br>
                                        @error('doc_expiry1')
                                           <span class="reds">{{ $message }}</span>   
                                        @enderror           
                                    </div>                                     
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Doc Expiry Date2:<sup class="required">*</sup></label>
                                    </div>                                   
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="date" name="doc_expiry2" placeholder="Select Expiry date" class="form-control" value="{{$member->doc_expiry2}}"><br>
                                        @error('doc_expiry2')
                                           <span class="reds">{{ $message }}</span>   
                                        @enderror           
                                    </div>                                     
                                </div>  
                            </div>
                        <div class="col-md-12">
                            <div class="form-group">  
                             <input type="submit" name="submit" value="SUBMIT" class="btn btn-primary" style="float: right;">
                        </div>   
                        <form>
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
    $(document).ready(function(){
     var pro = $('#province').val();
     var getdistrict = $('#receiver_state').val();
     $.ajax({
        url:"{{route('geteditdistrict')}}",
        method:"POST",
        data:{_token:"{{csrf_token()}}",id:pro,state:getdistrict},
        success:function(data){
           $('#receiver_state').html(data);
        }
       })
     getstate(getdistrict);
    
 })
      function getdistrict(id)
    {
       $.ajax({
        url:"{{route('getdistrict')}}",
        method:"POST",
        data:{_token:"{{csrf_token()}}",id:id},
        success:function(data){
           $('#receiver_state').html(data);
        }
       })
         var ids = $('#receiver_state').val();
         if(ids){
         getstate(ids);
     }

    }

    function getstate(id)
    {
       $.ajax({
        url:"{{route('getstate')}}",
        method:"POST",
        data:{_token:"{{csrf_token()}}",id:id},
        success:function(data){
           $('#receiver_postcode').html(data);
        }
       })
    }

</script>

@endsection