<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = [];
  

    public function getCate(){
        return Category::find($this->cate_id);
    }

    public function imageD(){
        $imagePath =  ($this->image) ? $this->image : 'uploads/default-image.jpg';
        return '/storage/' . $imagePath;
    }

    public function comments(){
        return $this->hasMany('App\Comments')->orderBy('created_at','DESC');
    }


    public function images(){
        return $this->hasMany('App\ProductImages');
    }

}
