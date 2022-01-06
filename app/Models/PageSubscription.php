<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageSubscription extends Model
{
    use SoftDeletes;
    //

    protected $fillable = ['page', 'app_id', 'secret', 'access_token'];
}