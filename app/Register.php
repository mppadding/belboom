<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model {
    
    /**
     * Which table we should query
     */
	protected $table = 'registers';
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'token', 'company_id'];
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
	
    /**
     * Returns the company this register belongs to
     * 
     * @return BelongsTo
     */
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

}
