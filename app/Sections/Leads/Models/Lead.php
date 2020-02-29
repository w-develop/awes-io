<?php

namespace App\Sections\Leads\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    /**
     * The attributes that can be ordered by.
     *
     * @var array
     */
    public $orderable = ['name','status'];

    public $fillable = ['name', 'status'];
}