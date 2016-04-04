<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {
    
    /**
     * Which table we should query
     */
	protected $table = 'roles';
	
	/**
     * Only these columns are changeable, protects against changing columns which shouldn't
     */
	protected $fillable = ['name', 'company_id'];

    /**
     * Returns all contacts belonging to this role
     * 
     * @return HasMany
     */
	public function contacts()
    {
        return $this->hasMany('App\Contact');
    }
    
    /**
     * Return all the results this role has
     * 
     * @return HasManyThrough
     */
    public function results()
    {
    	return $this->hasManyThrough('App\Result', 'App\Contact');
    }

}
