<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
	<table class="head-wrap w320 full-width-gmail-android" bgcolor="#f9f8f8" cellpadding="0" cellspacing="0" border="0">
      <tr class="header-background navbar-light">
        <td class="header container" align="center">
          <div class="content">
            <span class="brand">
              <a href="#">
               <img src="{!! asset('public/img/logo.png') !!}" alt="Company Name" width="100" height="100">
              </a>
            </span>
          </div>
        </td>
      </tr>
    </table>
  <h2>Welcome to Ptmoney Money transfer </h2>
  <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;"></p>
  <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;"> Your registered email-id is {{$user['email']}} </p>
  <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;"> Please click on the link below to verify your account. </p>
  <br/>
  <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">
    <a href="{{url('user/verify', $user->remember_token)}}" target="_blank" style="display: inline-block; color: #ffffff; background-color: #9bad83; border: solid 1px #9bad83; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #9bad83;">Verify</a>
  </p>
</body>
 
</html>