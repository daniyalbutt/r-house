<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attribute;


class AttributeValueProduct extends Model
{
    use HasFactory;
     /**
     * AttributeValues that should be mass-assignable.
     *
     * @var array
     */
    protected $table = 'attribute_value_product';
    protected $fillable = ['attribute_id', 'attribute_value', 'product_id', 'image', 'addon'];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
