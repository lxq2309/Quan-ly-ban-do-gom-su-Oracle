<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "GOMSU_CATEGORY";
    protected $primaryKey = "categoryid";
    static $rules = [
        'categoryname' => 'required',
    ];

    protected $perPage = 20;

    public $timestamps = false;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['categoryname', 'parentid'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\admin\Product', 'categoryid', 'categoryid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childcategories()
    {
        return $this->hasMany('App\Models\admin\Category', 'categoryid', 'categoryid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parentcategory()
    {
        return $this->hasOne('App\Models\admin\Category', 'categoryid', 'categoryid');
    }
}
