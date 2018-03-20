<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        .confirm {
            background-color: #26B99A;
            border-radius: 3px;
            border: 1px solid #169F85;
            color: #fff;
            padding: 6px 12px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
        }

        .confirm:hover {
            background-color: #169F85;
            border-color: #398439;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h4>Hello {{$user->f_name}},</h4>

<p>Good day!</p>
<p>You membership request for {{$coop->name}} was approved.</p>
<p>Please click below link to verify your email address and to activate your account.</p>

<div>
    <a href="{{route('confirmation')}}?u={{Crypt::encrypt($user->id)}}">Click this link to confirm</a>
</div>

<p>This link is valid for 7 days only.</p>
<br/>
<p>Thank you and God Bless!</p>
<br/>
<p>Best Regards,</p>
<p>Administrator</p>

</body>
</html>
