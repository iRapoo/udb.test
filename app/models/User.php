<?php

namespace Models;

use \Illuminate\Database\Eloquent\Model;

/**
 * @property mixed name
 * @property mixed email
 * @property mixed photo
 * @property mixed key
 * @method static updateOrInsert(array $array, array $array1)
 */
class User extends Model
{
    protected $table = "user";
}