<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Media
 * @package App\Models
 * @version August 23, 2021, 3:43 pm UTC
 *
 */
class Media extends Model
{
    use SoftDeletes;

    public $table = 'media';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'product_id',
        'path',
        'file_name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function product()
    {
        return $this->belongsTo(\App\Models\products::class, 'product_id', 'id');
    }

    public function getFileNameAttribute($value)
    {
        if ($value != null) {
            $path = 'products/';
            return url($path . $value);
        }
        return $value;
    }
}
