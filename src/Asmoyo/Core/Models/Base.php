<?php namespace Asmoyo\Core\Models;

use \Illuminate\Database\Eloquent\Model;

class Base extends Model {
	
    public function getConnection()
    {
        return static::resolveConnection('asmoyo');
    }
}
