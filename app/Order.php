<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

  protected $fillable = [
    'delivering_address', 'is_insured', 'created_by', 'status', 'pharmacy_id', 'user_id', 'doctor_id', 'total_price'
  ];

    public function user()
    {
        return $this->belongsTo('App\Client');
    }

    public function medicines()
    {
        return $this->belongsToMany('App\Medicine');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Doctor');
    }
    

    public function pharmacy()
    {
        return $this->belongsTo('App\Pharmacy');
    }

<<<<<<< Updated upstream

    public  function getPriceInDollars($cents)
    {
        $dollars = $cents / 100;
        return $dollars;
    }

    public function address()
    {
        return $this->belongsTo('App\Address');
    }
=======
>>>>>>> Stashed changes
}
