<?php

namespace App\Models\admin;

use App\Models\admin\ShoppingCartDetail;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "PRODUCT";
    protected $primaryKey = "PRODUCTID";

    public $timestamps = false;

    static $rules = [
		'PRODUCTNAME' => 'required',
        'PURCHASEPRICE' => 'required',
        'SELLINGPRICE' => 'required',
        'WEIGHT' => 'required',
        'TYPE' => 'required',
        'QUANTITY' => 'required'
    ];

    protected $perPage = 20;

    protected $guarded = [];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productimages()
    {
        return $this->hasMany('App\Models\admin\ProductImage', 'PRODUCTID', 'PRODUCTID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function productset()
    {
        return $this->hasOne('App\Models\admin\Productset', 'SETID', 'SETID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function color()
    {
        return $this->hasOne('App\Models\admin\Color', 'COLORID', 'COLORID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function glaze()
    {
        return $this->hasOne('App\Models\admin\Color', 'GLAZEID', 'GLAZEID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne('App\Models\admin\Color', 'CATEGORYID', 'CATEGORYID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function size()
    {
        return $this->hasOne('App\Models\admin\Color', 'SIZEID', 'SIZEID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function country()
    {
        return $this->hasOne('App\Models\admin\Country', 'COUNTRYID', 'COUNTRYID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchaseorderdetails()
    {
        return $this->hasMany('App\Models\admin\PurchaseOrderDetail', 'PRODUCTID', 'PRODUCTID');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoicedetails()
    {
        return $this->hasMany('App\Models\admin\InvoiceDetail', 'PRODUCTID', 'PRODUCTID');
    }

    public function getPurchasePriceAttribute()
    {
        if (empty($this->attributes['PURCHASEPRICE']))
        {
            return 0;
        }
        return $this->attributes['PURCHASEPRICE'] * 1000;
    }

    public function setPurchasePriceAttribute($val)
    {
        $this->attributes['PURCHASEPRICE'] = $val / 1000;
    }

    public function getSellingPriceAttribute()
    {
        if (empty($this->attributes['SELLINGPRICE']))
        {
            return 0;
        }
        return $this->attributes['SELLINGPRICE'] * 1000;
    }

    public function setSellingPriceAttribute($val)
    {
        $this->attributes['SELLINGPRICE'] = $val / 1000;
    }
}
