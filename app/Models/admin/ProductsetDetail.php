<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;


class ProductsetDetail extends Model
{
    protected $table = "PRODUCTSETDETAIL";
    protected $primaryKey = ["setid", "productid"];

    static $rules = [
        'setid' => 'required',
        'productid' => 'required'
    ];

    protected $perPage = 20;

    public $timestamps = false;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['setid', 'productid', 'quantity'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\admin\Product', 'productid', 'productid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function productset()
    {
        return $this->hasOne('App\Models\admin\Productset', 'setid', 'setid');
    }


}
