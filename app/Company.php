<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {

    /**
     * Which table we should query
     */
	protected $table = 'companies';
	
	/**
     * Only these columns are changeable, protects against changing columns which shouldn't
     */
	protected $fillable = ['name'];

    /**
     * Returns all users belonging to this company
     * 
     * @return HasMany
     */
	public function users()
    {
        return $this->hasMany('App\User');
    }
    
    /**
     * Returns all contacts belonging to this company
     * 
     * @return HasMany
     */
    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }
    
    /**
     * Returns all roles belonging to this company
     * 
     * @return HasMany
     */
    public function roles()
    {
        return $this->hasMany('App\Role');
    }
    
    /**
     * Returns all groups belonging to this company
     * 
     * @return HasMany
     */
    public function groups()
    {
        return $this->hasMany('App\Group');
    }
    
    /**
     * Returns all contacts belonging to this company
     * 
     * @return HasMany
     */
    public function calls()
    {
        return $this->hasMany('App\Call');
    }

}
