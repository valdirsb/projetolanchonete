<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

\Carbon\Carbon::setToStringFormat('H:i:s');

class Order extends Model
{

    //public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('quantidade','valor_unitario', 'valor_total', 'obs');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function address()
    {
        return $this->belongsTo('App\Address');
    }

    protected $dates = [
        'created_at',
        'updated_at',
    ];

}
