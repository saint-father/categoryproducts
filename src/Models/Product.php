<?php

namespace Alexfed\Categoryproducts\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'isActive'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


}
