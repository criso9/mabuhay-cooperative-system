<!DOCTYPE html>
<html>
<head>
</head>
<body>

<h4>Hello {{$user->f_name}},</h4>

<p>Good day!</p>
<p>Thank you for applying a loan on {{$coop->coop_name}}</p>
<p>We regret to inform you that your loan application was rejected.</p>
<p><b>Transaction No.</b> = {{$loan->transaction_no}}</p>

<br/>
<p>Thank you and God Bless!</p>
<br/>
<p>Best Regards,</p>
<p>Administrator</p>

</body>
</html>
