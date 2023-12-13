<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;


class Productset extends Model
{
    protected $table = "PRODUCTSET";
    protected $primaryKey = "SETID";

    static $rules = [
        'SETNAME' => 'required',
        'IMAGE' => 'image|mimes:jpeg,png,jpg,gif'
    ];

    protected $perPage = 20;

    public $timestamps = false;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['SETNAME', 'IMAGE', 'NOTE'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productsetdetail()
    {
        return $this->hasMany('App\Models\admin\ProductsetDetail', 'setid', 'setid');
    }


}
