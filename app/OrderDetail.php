<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = ['order_id', 'discount', 'category', 'product', 'brand', 'size', 'quantity', 'price', 'cost_price', 'pku'];

    protected $appends = array('amount', 'cost');

    public function getAmountAttribute()
    {

        return ($this->price - ($this->discount / 100 * $this->price)) * $this->quantity;
    }
    public function getCostAttribute()
    {

        return $this->cost_price * $this->quantity;
    }

    public function scopeFilter($query, $filter)
    {

        try {
            $fields = ['order_id', 'category', 'discount', 'product', 'brand', 'size', 'quantity', 'cost_price', 'price', 'pku'];

            return $query->where(
                function ($query) use ($filter, $fields) {

                    foreach ($filter as $key => $val) {

                        if (in_array($key, $fields)) {

                            $query->where($key, $val);

                        }
                    }
                    return $query;

                });

        } catch (Exception $bug) {

            return $this->exception($bug);
        }

    }

    public function order()
    {

        return $this->belongsTo(Order::class);

    }

    public function products()
    {

        return $this->hasMany(Product::class);

    }

}
