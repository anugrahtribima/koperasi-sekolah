<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $table = 'withdrawals';
    protected $guarded = [];

    public function savings()
    {
       return $this->belongsTo(Saving::class, 'saving_id','id');
    }
}
