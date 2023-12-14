<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;


class PurchaseOrderDetail extends Model
{
    protected $table = "PURCHASEORDERDETAIL";
    protected $primaryKey = ["orderid", "productid"];
    public $incrementing = false;
    static $rules = [

    ];

    protected $perPage = 20;

    public $timestamps = false;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['orderid', 'productid', 'quantity', 'price', 'discount', 'totalamount'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->hasOne('App\Models\admin\Product', 'productid', 'productid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function purchaseorder()
    {
        return $this->hasOne('App\Models\admin\PurchaseOrder', 'orderid', 'orderid');
    }

    public function getPriceAttribute()
    {
        if (empty($this->attributes['price']))
        {
            return 0;
        }
        return $this->attributes['price'] * 1000;
    }

    public function setPriceAttribute($val)
    {
        $this->attributes['price'] = $val / 1000;
    }

    public function getTotalAmountAttribute()
    {
        if (empty($this->attributes['totalamount']))
        {
            return 0;
        }
        return $this->attributes['totalamount'] * 1000;
    }

    public function setTotalAmountAttribute($val)
    {
        $this->attributes['totalamount'] = $val / 1000;
    }
}
