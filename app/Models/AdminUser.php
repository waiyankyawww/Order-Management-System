<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminUser extends Model
{
    use SoftDeletes;
    protected $table = "admins";
    protected $guarded = [];

   
}
