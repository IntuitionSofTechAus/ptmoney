<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
  <p>Name : {{$transactions->receiver->receiver_full_name}}</p>
  <p>Contact Number : {{$transactions->receiver->contact_number}}</p>
  <p style="color: #e43434;">Note : Please send before noon.</p>
  <p>Bank Account : {{$transactions->receiver->accont_number}}</p>
  <p>Branch : {{$transactions->receiver->branch}}</p>
  <br>
  <p>Total Amount : <span style="font-size: 20px;"><b>฿{{$transactions->receivable_amount}}</b></span></p>
  <br>
  <p>Thank You</p>
</body>
 
</html>