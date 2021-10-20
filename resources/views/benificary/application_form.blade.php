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
                        <form action="{{route('beneficiary.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                         <h3>Receiver Detail:</h3>
                         @if(!empty($sender))
                            <input type="hidden" name="sender_id" value="{{$sender->id}}">
                        @endif
                        <div class="row" >
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Full Name<sup class="required">*</sup></label>
                                </div>
                            </div>
                             <div class="col-md-9">
                                <div class="form-group">
                                <input type="text" name="receiver_full_name" value="{{old('receiver_full_name')}}" class="form-control" >
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
                                <input type="text" name="receiver_address" value="{{ old('receiver_address') }}"  class="form-control" >
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
                                            <select name="province" class="form-control">
                                                @foreach($provinces as $province) 
                                                <option value="{{$province->id}}"@if(old('province')==$province->id){{'selected'}} @endif>{{$province->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('province')
                                            <span class="reds">{{ $message }}</span>   
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group"> 
                                              <label>District<sup class="required">*</sup></label>
                                            <input type="text" name="receiver_state" class="form-control" value="{{ old('receiver_state') }}">
                                            @error('receiver_state')
                                               <span class="reds">{{ $message }}</span>   
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group"> 
                                          <label>Postcode<sup class="required">*</sup></label>
                                          <input type="number" name="receiver_postcode" value="{{ old('receiver_postcode') }}"  class="form-control" >
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
                                <input type="text" name="bank_name" value="{{ old('bank_name') }}"  class="form-control">
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
                                <input type="number" name="accont_number" value="{{ old('accont_number') }}"  class="form-control" >
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
                                <input type="text" name="branch" value="{{ old('branch') }}"  class="form-control">
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
                                <input type="number" name="contact_number" value="{{ old('contact_number') }}"  class="form-control">
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
                            </p>
                            <p>PT Money Transfer Reserves The Right To Refuse This Service To Any Person Found To Be Acting Outside These Terms And Conditions.</p>
                            <strong>Important information</strong><br><br>
                            <p>
                                Please Check Your Account Balance As Soon As Possible, Pt Money Transfer Will Only Keep Transfer Record For 60days From The Date Of Your Transfer. All Incorrect Transactions Must Be Notified Within 7days From The Transaction Date. Pt Money Transfer Will Not Be Liable For Any Incorrect Transaction That Had Not Been Reported Within 7days From The Date Of Transaction.</p><p>
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
                            <div class="col-md-6 ">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Name*<sup class="required">*</sup></label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                        <input type="text" name="name" value="{{ old('name') }}"  class="form-control">
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
                                        <input type="date" name="date" max="{{date('Y-m-d')}}"  value="{{date('Y-m-d')}}"  class="form-control" readonly>
                                          @error('date')
                                           <span class="reds">{{ $message }}</span>   
                                          @enderror
                                        </div>
                                    </div>
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

</script>
@endsection