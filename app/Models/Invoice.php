<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'total',
        'address',
        'phone',
        'note',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function products()
    {
        // table name is invoice_details with pitvot: quantity, price
        return $this->belongsToMany(Product::class, 'invoice_details')->withPivot('quantity', 'price');
    }
}