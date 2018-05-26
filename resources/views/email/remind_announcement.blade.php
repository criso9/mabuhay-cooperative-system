<!DOCTYPE html>
<html>
<head>
</head>
<body>

<h4>Hello {{$f_name}},</h4>

<p>Good day!</p>
<p>An announcement was recently made on {{$coop->coop_name}} website. Please see below for the details.</p>
<p><b>Event Date: </b>{{$event_date}}</p>
<p><b>Information: </b>{{$announcement->details}}</p>
<br/>
<p>Thank you and God Bless!</p>
<br/>
<p>Best Regards,</p>
<p>Officer</p>
<p>{{$coop->coop_name}}</p>
<br/>
<p><b>Note: </b>Do not reply on this email.</p>
</body>
</html>
