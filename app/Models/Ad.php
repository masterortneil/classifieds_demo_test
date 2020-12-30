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


}
