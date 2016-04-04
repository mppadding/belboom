<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model {

	/**
     * Which table we should query
     */
	protected $table = 'colors';
	
	/**
     * All but these columns are changeable, protects against changing columns which shouldn't
     */
	protected $guarded = ['id'];

    /**
     * Returns the user these colors belongs to
     * 
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
