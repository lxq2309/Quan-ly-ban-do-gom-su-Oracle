<?php

namespace App\Models\admin;

use App\Models\admin\ShoppingCartDetail;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "PRODUCT";
    protected $primaryKey = "productid";

    public $timestamps = false;

    static $rules = [
        'productname' => 'required',
        'purchaseprice' => 'required',
        'sellingprice' => 'required',
        'weight' => 'required',
        'type' => 'required',
        'quantity' => 'required'
    ];

    protected $perPage = 20;

    protected $guarded = ['imageurl', 'images-url'];

    protected static function boot()
    {
        parent::boot();

        // Áp dụng điều kiện WHERE deleted = 0 cho SELECT và UPDATE
        static::addGlobalScope('softDelete', function ($builder) {
            $builder->where('deleted', 0);
        });
    }



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productimages()
    {
        return $this->hasMany('App\Models\admin\ProductImage', 'productid', 'productid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function productset()
    {
        return $this->hasOne('App\Models\admin\Productset', 'setid', 'setid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function color()
    {
        return $this->hasOne('App\Models\admin\Color', 'colorid', 'colorid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function glaze()
    {
        return $this->hasOne('App\Models\admin\Glaze', 'glazeid', 'glazeid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne('App\Models\admin\Category', 'categoryid', 'categoryid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function size()
    {
        return $this->hasOne('App\Models\admin\Size', 'sizeid', 'sizeid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function country()
    {
        return $this->hasOne('App\Models\admin\Country', 'countryid', 'countryid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchaseorderdetails()
    {
        return $this->hasMany('App\Models\admin\PurchaseOrderDetail', 'productid', 'productid');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoicedetails()
    {
        return $this->hasMany('App\Models\admin\InvoiceDetail', 'productid', 'productid');
    }

    public function getPurchasePriceAttribute()
    {
        if (empty($this->attributes['purchaseprice'])) {
            return 0;
        }
        return $this->attributes['purchaseprice'] * 1000;
    }

    public function setPurchasePriceAttribute($val)
    {
        $this->attributes['purchaseprice'] = $val / 1000;
    }

    public function getSellingPriceAttribute()
    {
        if (empty($this->attributes['sellingprice'])) {
            return 0;
        }
        return $this->attributes['sellingprice'] * 1000;
    }

    public function setSellingPriceAttribute($val)
    {
        $this->attributes['sellingprice'] = $val / 1000;
    }
}
