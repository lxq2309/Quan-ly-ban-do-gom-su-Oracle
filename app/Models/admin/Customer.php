<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "CUSTOMER";
    protected $primaryKey = "CUSTOMERID";
    static $rules = [
        'CUSTOMERNAME' => 'required',
    ];

    protected $perPage = 20;

    public $timestamps = false;

    protected $guarded = [];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function salesinvoices()
    {
        return $this->hasMany('App\Models\admin\SalesInvoice', 'CUSTOMERID', 'CUSTOMERID');
    }
}
