<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slugurl',
        'price',
        'contactnumber',
        'email',
        'description',
        'category_id',
        'currency_id'
    ];

    public function get_category(){
        return $this->belongsTo("App\Models\Category", 'category_id', 'category_id');
    }

    public function get_images(){
        return $this->hasMany("App\Models\Image", 'ad_id', 'ad_id');
    }

    public function get_currency(){
        return $this->belongsTo("App\Models\Currency", 'currency_id', 'currency_id');
    }

}
