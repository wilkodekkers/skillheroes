<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uur extends Model
{
    protected $table = 'uren';
    
    public $timestamps = false;
    
    public function Touser() {
        return $this->belongsTo('App\User', 'users_id');
    }
}
