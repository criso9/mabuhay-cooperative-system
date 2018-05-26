<!DOCTYPE html>
<html>
<head>
</head>
<body>

<h4>Hello {{$user->f_name}},</h4>

<p>Good day!</p>
<p>This is a reminder that your loan application which has a transaction no. of {{$loan->transaction_no}} for {{$coop->coop_name}} will be due on {{$due_date}}.</p>
<br/>
<p>Thank you and God Bless!</p>
<br/>
<p>Best Regards,</p>
<p>Administrator</p>
<p>{{$coop->coop_name}}</p>
<br/>
<p><b>Note: </b>Do not reply on this email.</p>
</body>
</html>
