<?php

namespace App\Models\admin;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Employee extends Model implements Authenticatable
{
    protected $table = "EMPLOYEE";
    protected $primaryKey = "employeeid";

    public $timestamps = false;

    protected $perPage = 20;

    static $rules = [
        'phonenumber' => 'required',
        'employeename' => 'required',
        'username' => 'required'
    ];

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
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
    }

    public function job()
    {
        return $this->hasOne('App\Models\admin\Job', 'jobid', 'jobid');
    }

    public function setPasswordAttribute($value)
    {
        // Kiểm tra xem mật khẩu đã được mã hóa hay chưa
        if (Hash::needsRehash($value)) {
            $this->attributes['password'] = bcrypt($value);
        } else {
            $this->attributes['password'] = $value;
        }
    }
}
