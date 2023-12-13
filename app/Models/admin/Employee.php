<?php

namespace App\Models\admin;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Employee extends Model implements Authenticatable
{
    protected $table = "EMPLOYEE";
    protected $primaryKey = "EMPLOYEEID";

    public $timestamps = false;

    protected $perPage = 20;

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName() {}

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier() {}

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword() {}

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken() {}

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value) {}

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName() {}

    public function job()
    {
        return dd($this->hasOne('App\Models\admin\Job', 'JOBID', 'JOBID'));
    }

    public function jobtitle(){
        $result = Job::where('JOBID', $this->jobid)->first();
        if($result){
            return $result->title;
        }
    }
}
