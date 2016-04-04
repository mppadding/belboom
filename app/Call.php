<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    /**
     * Which table we should query
     */
	protected $table = 'calls';
	
	/**
     * All but these columns are changeable, protects against changing columns which shouldn't
     */
	protected $guarded = ['id'];
	
    /**
     * Get the results for call.
     */
    public function results()
    {
        return $this->hasMany('App\Result');
    }
	
	/**
	 * Return the last row of the table
	 */
	public static function last()
	{
	    return static::find(static::max('id'));
	}
}
