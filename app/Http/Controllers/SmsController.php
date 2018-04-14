<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tzsk\Sms\Facade\Sms;

class SmsController extends Controller
{
	Sms::send("Text to send.", function($sms) {
	    $sms->to(['Number 1', 'Number 2']); # The numbers to send to.
	});
}
