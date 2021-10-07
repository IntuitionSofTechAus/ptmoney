@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'typography'
])
<style type="text/css">
label,h3{
       font-size: 15px!important;
    font-weight: 501!important;
    color: #000!important;
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
                        <p><strong>PT Money Transfer</strong> – Shop 18/43-47 Park rd Cabramatta NSW 2166.&nbsp;Call: 0469-321-321</p>
                        <p><b style="color:red;">** PLEASE FILL UP THE FORM IN ENGLISH LANGUAGE ONLY. **</b></p>
                    </div>
                    <div class="card-body">
                    @if (\Session::has('success'))
                    <div class="alert alert-success">
                    <ul>
                    <li>{!! \Session::get('success') !!}</li>
                    </ul>
                    </div>
                    @endif
                        <form action="{{route('member.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h3>Sender Detail:</h3>
                        <div class="col-md-12 row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Full Name<sup class="required">*</sup></label>
                                </div>
                            </div>
                             <div class="col-md-9">
                                <div class="form-group">
                                <input type="text"  name="sender_full_name" value="" class="form-control" >
                                @error('sender_full_name')                                  
                                        <strong class="reds">{{ $message }}</strong>           
                                @enderror

                                </div>
                             </div>
                        </div>
                        <div class="col-md-12 row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Date Of Birth<sup class="required">*</sup></label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                <input type="text" name="dob" value="" class="form-control" >
                                @error('dob')
                                   <strong class="reds">{{ $message }}</strong>   
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Telephone<sup class="required">*</sup></label>
                                </div>
                            </div>
                             <div class="col-md-9">
                                <div class="form-group">
                                <input type="text" name="telephone" value="" class="form-control" >
                                @error('telephone')
                                    <strong class="reds">{{ $message }}</strong>   
                                @enderror
                                </div>
                             </div>
                        </div>
                        <div class="col-md-12 row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Residential Address*<sup class="required">*</sup></label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                <input type="text" name="sender_address" value="" class="form-control" >
                                @error('sender_address')
                                  <strong class="reds">{{ $message }}</strong>   
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 row" >
                            <div class="col-lg-3">
                            </div>
                            <div class="col-md-9 row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                       <label>Suburb<sup class="required">*</sup></label> 
                                        <input type="text" name="sender_suburb" value="" class="form-control" >
                                        @error('sender_suburb')
                                           <strong class="reds">{{ $message }}</strong>   
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group"> 
                                          <label>State<sup class="required">*</sup></label>
                                          <input type="text" name="sender_state" value="" class="form-control" >
                                           @error('sender_state')
                                             <strong class="reds">{{ $message }}</strong>   
                                           @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group"> 
                                      <label>Postcode<sup class="required">*</sup></label>
                                      <input type="text" name="sender_postcode" value="" class="form-control" >
                                      @error('sender_postcode')
                                        <strong class="reds">{{ $message }}</strong>   
                                      @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Occupation*<sup class="required">*</sup></label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                <input type="text" name="occupation" value="" class="form-control" >
                                @error('occupation')
                                    <strong class="reds">{{ $message }}</strong>   
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Are You A Politically Exposed Person?*<sup class="required">*</sup></label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="radio" id="html" name="political" value="Yes">
                                        &nbsp;&nbsp;&nbsp;
                                        <label for="yes">Yes</label>&nbsp;&nbsp;&nbsp;
                                        <input type="radio" id="css" name="political" value="No">&nbsp;&nbsp;&nbsp;
                                        <label for="no">No</label><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p>                                                                         (AUSTRAC Defines ‘Politically Exposed Persons’ As Individuals Who Are , Or Have Been Entrusted With Prominent Functions In A Foreign Country. For Example: Heads Of State Or Of Government, Senior Politicians, Senior Government, Judicial Or Military Officials, Senior Executives Of State Owned Corporations Or Important Political Party Officials.)
                            </p>
                        </div>
                        <div class="col-md-12 row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Do You Have A Presence In Any Sanctioned Jurisdiction?*<sup class="required">*</sup></label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                  <input type="radio" id="html" name="presence" value="Yes">
                                        &nbsp;&nbsp;&nbsp;
                                        <label for="yes">Yes</label>&nbsp;&nbsp;&nbsp;
                                        <input type="radio" id="css" name="presence" value="No">&nbsp;&nbsp;&nbsp;
                                        <label for="no">No</label><br>
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
                             <div class="col-md-9">
                                <div class="form-group">
                                <input type="text" name="receiver_full_name" value="" class="form-control" >
                                @error('receiver_full_name')
                                  <strong class="reds">{{ $message }}</strong>   
                                @enderror
                                </div>
                             </div>
                        </div>
                        <div class="col-md-12 row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Residential Address*<sup class="required">*</sup></label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                <input type="text" name="receiver_address" value="" class="form-control" >
                                @error('receiver_address')
                                   <strong class="reds">{{ $message }}</strong>   
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 row" >
                            <div class="col-lg-3">
                            </div>
                            <div class="col-md-9 row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                       <label>Suburb<sup class="required">*</sup></label> 
                                        <input type="text" name="receiver_suburb" value="" class="form-control" >
                                          @error('receiver_suburb')
                                          <strong class="reds">{{ $message }}</strong>   
                                          @enderror

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group"> 
                                          <label>State<sup class="required">*</sup></label>
                                          <input type="text" name="receiver_state" value="" class="form-control" >
                                            @error('receiver_state')
                                               <strong class="reds">{{ $message }}</strong>   
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group"> 
                                      <label>Postcode<sup class="required">*</sup></label>
                                      <input type="text" name="receiver_postcode" value="" class="form-control" >
                                        @error('receiver_postcode')
                                            <strong class="reds">{{ $message }}</strong>   
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Bank Name*<sup class="required">*</sup></label>
                                </div>
                            </div>
                             <div class="col-md-9">
                                <div class="form-group">
                                <input type="text" name="bank_name" value="" class="form-control">
                                  @error('bank_name')
                                   <strong class="reds">{{ $message }}</strong>   
                                  @enderror
                                </div>
                             </div>
                        </div>
                        <div class="col-md-12 row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Account Number*<sup class="required">*</sup></label>

                                </div>
                            </div>
                             <div class="col-md-9">
                                <div class="form-group">
                                <input type="text" name="accont_number" value="" class="form-control" >
                                @error('accont_number')
                                   <strong class="reds">{{ $message }}</strong>   
                                @enderror
                                </div>
                             </div>
                        </div>
                        <div class="col-md-12 row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Branch<sup class="required">*</sup></label>
                                </div>
                               
                            </div>
                             <div class="col-md-9">
                                <div class="form-group">
                                <input type="text" name="branch" value="" class="form-control">
                                @error('branch')
                                   <strong class="reds">{{ $message }}</strong>   
                                @enderror
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
                                <input type="text" name="contact_number" value="" class="form-control">
                               
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
                        <div class="col-md-12 row">
                            <div class="col-md-1">
                                <label class="" for="">Sign:<sup class="required">*</sup></label>
                            </div>
                            <div class="col-md-5">
                                <div id="sig" ></div>
                                 @error('signed')
                                   <strong class="reds">{{ $message }}</strong>   
                                @enderror
                                <br/>
                                <button id="clear" class="btn btn-default">Clear</button>
                                <textarea id="signature64" name="signed" style="display: none"></textarea>
                            </div>
                            <div class="col-md-6 row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Name*<sup class="required">*</sup></label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                    <input type="text" name="name" value="" class="form-control">
                                      @error('name')
                                        <strong class="reds">{{ $message }}</strong>   
                                        @enderror
                                    </div>
                                </div><br>                            
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Date*<sup class="required">*</sup></label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                    <input type="text" name="date" value="" class="form-control">
                                      @error('date')
                                       <strong class="reds">{{ $message }}</strong>   
                                      @enderror
                                    </div>
                                </div>
                            </div>  
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <div class="form-group">  
                             <input type="checkbox" name="acceptance" value="1">&nbsp;&nbsp;&nbsp;&nbsp;<label>I Accept The Above <a href="{{url('terms-and-condition')}}" target="_blank">Terms & Conditions</a></label>
                               @error('acceptance')
                                   <strong class="reds">{{ $message }}</strong>   
                                @enderror
                            </div>
                        </div>
                        <hr>
                            <h3>Upload Documents:</h3>
                            <p>
                                <strong>You must provide  <span style="color: #ff0000; text-decoration: underline;">Two documents</span> from the following list with your completed form to confirm your identity. </strong>
                            </p>
                            <ul style="margin-bottom: 40px;">
                                <li>Current Australian passport(not expired)</li>
                                <li>International Passport (not expired)</li>
                                <li>Australian Driver's License</li>
                                <li>Proof of Age Card (Government Issued)</li>
                            </ul>
                            <div class="col-md-12 row" >
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
                                        <option value="Australia_Photo_ID">Australia Photo ID</option>
                                        <option value="Passport">Passport</option>
                                        <option value="Thai_National_ID">Thai National ID</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    @error('document1')
                                      <strong class="reds">{{ $message }}</strong>   
                                    @enderror
                                    <br>                               
                                    </div>
                                      <input type="file" name="docfile1" size="40" class="" accept=".jpg,.jpeg,.png,.gif,.pdf">
                                        @error('docfile1')
                                       <strong class="reds">{{ $message }}</strong>   
                                    @enderror
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
                                        <option value="Australia_Photo_ID">Australia Photo ID</option>
                                        <option value="Passport">Passport</option>
                                        <option value="Thai_National_ID">Thai National ID</option>
                                        <option value="Others">Others</option>
                                    </select>
                                      @error('document2')
                                       <strong class="reds">{{ $message }}</strong>   
                                      @enderror
                                    <br>                              
                                    </div>
                                    <input type="file" name="docfile2" size="40" class="" accept=".jpg,.jpeg,.png,.gif,.pdf">
                                    @error('docfile2')
                                       <strong class="reds">{{ $message }}</strong>   
                                      @enderror
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
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
    <script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
</script>
@endsection