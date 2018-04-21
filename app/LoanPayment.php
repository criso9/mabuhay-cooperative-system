<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanPayment extends Model
{
	protected $table = 'loan_payments';

    public static $rules = [
        'transaction_no' => 'required',
        'amount' => 'required',
        'date_paid' => 'required',
        'payment_type' => 'required',
        'receipt_no' => 'required',
    ];
}
