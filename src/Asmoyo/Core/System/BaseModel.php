<?php namespace Asmoyo\Core\System;

use \Illuminate\Database\Eloquent\Model;
use Config;

abstract class BaseModel extends Model {
	
    public function getConnection()
    {
        return static::resolveConnection('asmoyo');
    }
}
