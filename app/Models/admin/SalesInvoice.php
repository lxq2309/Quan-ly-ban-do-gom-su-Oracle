<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class SalesInvoice extends Model
{
    protected $table = "SALESINVOICE";
    protected $primaryKey = "INVOICEID";
    static $rules = [
        'INVOICEID' => 'required',
    ];

    protected $perPage = 20;

    public $timestamps = false;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['INVOICEID', 'EMPLOYEEID', 'SALEDATE', 'CUSTOMERID', 'TOTALAMOUNT'];


    public function salesinvoicedetail()
    {
        return $this->hasMany('App\Models\admin\InvoiceDetail', 'invoiceid', 'invoiceid');
    }


    public function employee()
    {
        return $this->hasOne('App\Models\admin\Employee', 'employeeid', 'employeeid');
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
