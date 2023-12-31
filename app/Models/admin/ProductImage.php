<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = "PRODUCTIMAGE";
    protected $primaryKey = "imageid";
    static $rules = [
        'imageid' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['imageid', 'productid', 'imagepath'];

    public $timestamps = false;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->hasOne('App\Models\admin\Product', 'productid', 'productid');
    }


}
