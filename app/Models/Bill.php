<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model {
    protected $table = 'bill';

    protected $fillable = [
        'id',
        'email',
        'buyer_phone',
        'buyer_name',
        'buyer_document',
        'discount_rate',
        'item_name',
        'itemDescription',
        'item_type',
        'item_qty',
        'item_amount',
        'total_amount',
        'iva',
        'payment_date',
        'payment_ip',
        'token',
        'user_id',
        'status'
    ];
}
