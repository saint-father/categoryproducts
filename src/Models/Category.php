<?php
/**
 * @author Aleksey Fiodorov
 * @copyright Copyright (c) saint-father (https://github.com/saint-father)
 */

namespace Alexfed\Categoryproducts\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * class Category model to manage category data
 */
class Category extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'categories';
    /**
     * @var string[]
     */
    protected $fillable = ['name'];
    /**
     * @var string[]
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    /**
     * @var string[]
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Relations
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
