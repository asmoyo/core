<?php namespace Asmoyo\Core\Models;

use \Illuminate\Database\Eloquent\Model;
use Config;

abstract class Base extends Model {
	
    public function getConnection()
    {
        return static::resolveConnection('asmoyo');
    }
}
