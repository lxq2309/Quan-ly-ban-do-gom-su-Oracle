<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    protected $table = "INVOICEDETAIL";
    protected $primaryKey = ["invoiceid", "productid"];
    public $incrementing = false;
    static $rules = [
        'invoiceid' => 'required',
        'productid' => 'required',
    ];

    protected $perPage = 20;


    public function product()
    {
        return $this->hasOne('App\Models\admin\Product', 'productid', 'productid');
    }

    public function salesinvoice()
    {
        return $this->hasOne('App\Models\admin\SalesInvoice', 'invoiceid', 'invoiceid');
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