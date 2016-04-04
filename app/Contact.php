<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

    /**
     * Which table we should query
     */
	protected $table = 'contacts';
	
	/**
     * Only these columns are changeable, protects against changing columns which shouldn't
     */
	protected $fillable = ['name', 'number', 'role_id'];

    /**
     * Returns the role this contact belongs to
     * 
     * @return BelongsTo
     */
	public function role()
    {
        return $this->belongsTo('App\Role');
    }
    
    /**
     * Returns all results with the same phone number as this contact
     * 
     * @return HasMany
     */
    public function results()
    {
        return $this->hasMany('App\Result', 'originator', 'number');
    }
    
    /**
     * Returns the last call this contact belongs to
     * 
     * @return BelongsTo
     */
    public function call()
    {
        return $this->belongsTo('App\Call');
    }

}
