<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlyContribution extends Model
{
    protected $table = 'contributions';
	public $timestamps = true;

	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static $rules = [
        'user_id' => 'required',
        'amount' => 'required',
        'payment_type' => 'required',
    ];
}
