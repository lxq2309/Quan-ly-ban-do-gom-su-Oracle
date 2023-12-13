<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;


class PurchaseOrder extends Model
{
    protected $table = "PURCHASEORDER";
    protected $primaryKey = "ORDERID";
    static $rules = [
        'ORDERID' => 'required',

    ];

    protected $perPage = 20;

    public $timestamps = false;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ORDERID', 'EMPLOYEEID', 'ORDERDATE', 'SUPPLIERID'];


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
