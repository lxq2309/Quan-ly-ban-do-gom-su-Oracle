<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = "SUPPLIER";
    protected $primaryKey = "supplierid";
    static $rules = [
        'suppliername' => 'required',
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
    public function purchaseorders()
    {
        return $this->hasMany('App\Models\admin\PurchaseOrder', 'supplierid', 'supplierid');
    }
}
