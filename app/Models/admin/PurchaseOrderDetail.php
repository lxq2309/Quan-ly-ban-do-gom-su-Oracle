<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;


class PurchaseOrderDetail extends Model
{
    protected $table = "PURCHASEORDERDETAIL";
    protected $primaryKey = ["ORDERID", "PRODUCTID"];
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
    protected $fillable = ['ORDERID', 'PRODUCTID', 'QUANTITY', 'PRICE', 'DISCOUNT', 'TOTALAMOUNT'];


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
        if (empty($this->attributes['PRICE']))
        {
            return 0;
        }
        return $this->attributes['PRICE'] * 1000;
    }

    public function setPriceAttribute($val)
    {
        $this->attributes['PRICE'] = $val / 1000;
    }

    public function getTotalAmountAttribute()
    {
        if (empty($this->attributes['TOTALAMOUNT']))
        {
            return 0;
        }
        return $this->attributes['TOTALAMOUNT'] * 1000;
    }

    public function setTotalAmountAttribute($val)
    {
        $this->attributes['TOTALAMOUNT'] = $val / 1000;
    }
}
