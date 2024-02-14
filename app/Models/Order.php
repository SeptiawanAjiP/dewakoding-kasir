<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;


class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $keyType = 'string';

    protected $fillable = [
        'invoice_number',
        'done_at',
        'paid_amount'
    ];

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function scopeSearch($query, $value)
    {
        $query->where('invoice_number', 'like', "%{$value}%");
    }

    public function getTotalPriceAttribute()
    {
        $orderProducts = $this->orderProducts;
        $totalPrice = 0;

        foreach ($orderProducts as $orderProduct) {
            $totalPrice += $orderProduct->unit_price * $orderProduct->quantity;
        }

        return $totalPrice;
    }

    public function getDoneAtForHumanAttribute()
    {
        return $this->done_at ? Carbon::parse($this->done_at)->diffForHumans() : null;
    }

    public function getPaidAmountFormattedAttribute()
    {
        return number_format($this->paid_amount, 0, ',', '.');
    }

    public function getTotalPriceFormattedAttribute()
    {
        return 'Rp ' . number_format($this->totalPrice, 0, ',', '.');
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid()->toString();
        });
    }
}
