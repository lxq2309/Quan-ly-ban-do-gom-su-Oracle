<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = "SUPPLIER";
    protected $primaryKey = "SUPPLIERID";
    static $rules = [
        'SUPPLIERNAME' => 'required',
    ];

    protected $perPage = 20;

    public $timestamps = false;

    protected $guarded = [];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchaseorders()
    {
        return $this->hasMany('App\Models\admin\PurchaseOrder', 'SUPPLIERID', 'SUPPLIERID');
    }
}
