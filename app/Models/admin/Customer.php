<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "CUSTOMER";
    protected $primaryKey = "customerid";
    static $rules = [
        'customername' => 'required',
    ];

    protected $perPage = 20;

    public $timestamps = false;

    protected $guarded = [];

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
    public function salesinvoices()
    {
        return $this->hasMany('App\Models\admin\SalesInvoice', 'customerid', 'customerid');
    }
}
