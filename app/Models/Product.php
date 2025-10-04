<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;



use App\Models\Category;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['name', 'price', 'category_id', 'image', 'images', 'discount', 'slug', 'short_desc', 'description', 'featured', 'status', 'stock', 'trending', 'deals'];

    /**
     * Get the product images path in json.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */



    public function getImagesAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setImagesAttribute($value)
    {
        return $this->attributes['images'] = json_encode($value);
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class,'order_products')->withPivot('price');   
    }

    public function wishlist()
    {
        return $this->belongsToMany(User::class,'wishlists');
    }
}
