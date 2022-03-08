<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'names', 'description', 'price', 'image'];

    protected $hidden = ['created_at', 'updated_at'];
}
