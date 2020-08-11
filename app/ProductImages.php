<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $table = 'product_images';
    protected $guarded = [];

    public function pd() 
    {
        return $this->belongsTo('App\Product', 'id');
    }
    
}
