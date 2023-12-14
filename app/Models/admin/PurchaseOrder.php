<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;


class PurchaseOrder extends Model
{
    protected $table = "PURCHASEORDER";
    protected $primaryKey = "orderid";
    static $rules = [
        'orderid' => 'required',

    ];

    protected $perPage = 20;

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        // Áp dụng điều kiện WHERE deleted = 0 cho SELECT và UPDATE
        static::addGlobalScope('softDelete', function ($builder) {
            $builder->where('deleted', 0);
        });
    }

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['orderid', 'employeeid', 'orderdate', 'supplierid'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchaseorderdetail()
    {
        return $this->hasMany('App\Models\admin\PurchaseOrderDetail', 'orderid', 'orderid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function supplier()
    {
        return $this->hasOne('App\Models\admin\Supplier', 'supplierid', 'supplierid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function employee()
    {
        return $this->hasOne('App\Models\admin\Employee', 'employeeid', 'employeeid');
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
