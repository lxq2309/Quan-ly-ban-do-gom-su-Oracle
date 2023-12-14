<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class SalesInvoice extends Model
{
    protected $table = "SALESINVOICE";
    protected $primaryKey = "invoiceid";
    static $rules = [
        'invoiceid' => 'required',
    ];

    protected $perPage = 20;

    public $timestamps = false;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['invoiceid', 'employeeid', 'saledate', 'customerid', 'totalamount'];


    public function salesinvoicedetail()
    {
        return $this->hasMany('App\Models\admin\InvoiceDetail', 'invoiceid', 'invoiceid');
    }


    public function employee()
    {
        return $this->hasOne('App\Models\admin\Employee', 'employeeid', 'employeeid');
    }
    public function customer()
    {
        return $this->hasOne('App\Models\admin\Customer', 'customerid', 'customerid');
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
