<?php

namespace Models;

use \Illuminate\Database\Eloquent\Model;

/**
 * @property string token
 * @property mixed key
 */
class Token extends Model
{
    protected $table = "tokens";
}