<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {
    
    /**
     * Which table we should query
     */
    protected $table = 'groups';
    
    /**
     * Only these columns are changeable, protects against changing columns which shouldn't
     */
    protected $fillable = ['name'];
    
    /**
     * Returns all contacts belonging to this group
     * 
     * @return BelongsToMany
     */
	public function contacts()
    {
        return $this->belongsToMany('App\Contact');
    }
    
    /**
     * Register any other events for your application.
     *
     * @return void
     */
    protected static function boot() {
        parent::boot();

        # When this group is deleted
        static::deleting(function($group) {
            # Detach all contacts from this group
            $group->contacts()->detach();
        });
    }

}
