<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class,'order_products')->withPivot('price', 'attributes', 'quantity', 'base_price', 'variation_price');   
    }

    public static function generateInvoiceNumber()
	{
		$latest = self::latest()->first();
		$year = date('Y');
		if (!$latest || empty($latest->invoice)) {
			$number = 1;
		} else {
			preg_match('/(\d+)$/', $latest->invoice, $matches);
			$number = isset($matches[1]) ? (int)$matches[1] + 1 : 1;
		}
		return 'INV-' . $year . '-' . str_pad($number, 6, '0', STR_PAD_LEFT);
	}

}