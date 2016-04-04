<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model {

	/**
     * Which table we should query
     */
	protected $table = 'results';
	
	/**
     * Only these columns are changeable, protects against changing columns which shouldn't
     */
	protected $fillable = ['originator', 'body', 'date', 'arrived'];
	
	/**
	 * These columns are transformed into Carbon dates
	 */
	protected $dates = ['date'];
	
	/**
	 * Returns the contact this result belongs to (based on originator -> number)
	 * 
	 * @return BelongsTo
	 */
	public function contact()
    {
        return $this->belongsTo('App\Contact', 'originator', 'number');
    }
    
	/**
	 * Returns the contact this result belongs to (based on originator -> number)
	 * 
	 * @return BelongsTo
	 */
	public function call()
    {
        return $this->belongsTo('App\Call');
    }
    
    /**
     * Parse the minutes from the body
     */
    public static function parseMinutes($body)
    {
    	// echo '1';
    	if(!preg_match('/[^\d]+/', $body))
	        return intval($body);
	    
	    // echo '2';

	    $matches = [];

	    // echo '3';

	    if(preg_match_all('/[\d]+/', $body, $matches) === 1)
	        return intval($matches[0][0]);
	    
		// echo '4';

	    // Ik sta in de file, die is 100 km lang, het duurt nog 100 minuten
	    // Get all numbers
	    // Get the word after the numbers
	    
	    $splitted = explode(' ', $body);
	    
		// echo '5';

	    $selected = [];

	    // echo '6';
	    
	    for($cnt = 0; $cnt < sizeof($splitted) - 1; $cnt++) {
	    	// echo '7';
	        if(is_numeric($splitted[$cnt])) {
	        	// echo '8';
	            if(substr($splitted[$cnt + 1], 0, 3) === 'min')
	                $selected[] = $splitted[$cnt];
	            // echo '9';
	        }
	    }

	    // echo '10';
	    
	    if(sizeof($selected) > 1)
	        return $selected;
	    else if(sizeof($selected) === 1)
	        return intval($selected[0]);
	    
		// echo '11';

	    return -1;
    }
    
    /**
     * Returns all results with the specified role
     */
    public static function json($id = null)
    {
    	# Index
    	if($id === null)
    	{
    		# Graph headers
    		$return = [
    			['Functie', 'Verzonden', 'Reacties', 'Onderweg', 'Gearriveerd'],
    		];
			$results = Result::all();
			
			$roles = [];
			
			foreach($results as $result)
			{
				$role = 'N.v.t.';
				
				# Check if the result has a contact, if so, use the function name of it
				if($result->contact != null)
					$role = $result->contact->role->name;
				
				# Create our basic setup of a graph entry
				$end = [
					$role,	# Role name
					0,		# Ontvangen
					0,		# Reacties
					0,		# Niet Arrived
					0		# Arrived
				];
				
				# Check if the role is already in the roles array, we will group all results together
				if(!in_array($role, $roles)) {
					$roles[] = $role;
					$return[] = $end;
				}
				
				$index = 1 + array_search($role, $roles);
				
				$minutes = Result::parseMinutes($result->body);
				
				# If we couldn't find the minutes, continue to the next iteration
				if($minutes === -1)
					continue;
					
		    	$arrival = $result->date->addMinutes($minutes);
				
				$arrived = $result->arrived ? 1 : (\Carbon\Carbon::now() > $arrival);
				
				# Reacties
				$return[$index][2] += 1;
				
				# If arrived = 0, increase on the way, if not increase arrived
				$return[$index][3 + $arrived] += 1;
			}
			
			return json_encode($return);
		} 
		else if($id === '0') 
		{
			$results = Result::has('contact', '==', 'null')->get();
			
			$return = [
				['Minuten', 'N.v.t.', ['role' => 'annotation']]
			];
			
			$remaining = [
				'0' => 0,
				'5' => 0,
				'15' => 0,
				'30' => 0,
				'60' => 0, 
				'120' => 0
			];
			
			foreach($results as $result)
			{
				if($result->arrived === '0') {
					$minutes = Result::parseMinutes($result->body);
					
					# If we couldn't find minutes, continue to the next iteration
					if($minutes === -1)
						continue;
					
		    		$arrival = $result->date->addMinutes($minutes);
			        
			
			        // Get minutes remaining till arrival
			        $minutes = \Carbon\Carbon::now()->diffInMinutes($arrival, false);
			        
			        // Clamp minutes to values
			        if($minutes > 0) {
		                if($minutes <= 5) $minutes = 5;
		                elseif($minutes <= 15) $minutes = 15;
		                elseif($minutes <= 30) $minutes = 30;
		                elseif($minutes <= 60) $minutes = 60;
		                else $minutes = 120;
			        } else {
			        	$minutes = 0;
			        }
			        
			        $remaining[$minutes] += 1;
				}
			}
			
			foreach($remaining as $key => $val)
				$return[] = [$key, $val, $key . ' Minuten'];
			
			return json_encode($return);
		} 
		else 
		{
			$results = Result::whereHas('contact', function($contact) use($id)
			{
			    $contact->where('role_id', '=', $id);
			
			})->get();
			
			$return = [
				['Minuten', 'N.v.t.', ['role' => 'annotation' ]],
			];
			
			$remaining = [
				'0' => 0,
				'5' => 0,
				'15' => 0,
				'30' => 0,
				'60' => 0, 
				'120' => 0
			];
			
			foreach($results as $result)
			{
				if($result->arrived === '0') {
					$minutes = Result::parseMinutes($result->body);
					
					# If we couldn't find minutes, continue to the next iteration
					if($minutes === -1)
						continue;
						
		    		$arrival = $result->date->addMinutes($minutes);
			        
			
			        // Get minutes remaining till arrival
			        $minutes = \Carbon\Carbon::now()->diffInMinutes($arrival, false);
			        
 					// Clamp minutes to values
			        if($minutes > 0) {
		                if($minutes <= 5) $minutes = 5;
		                elseif($minutes <= 15) $minutes = 15;
		                elseif($minutes <= 30) $minutes = 30;
		                elseif($minutes <= 60) $minutes = 60;
		                else $minutes = 120;
			        } else {
			        	$minutes = 0;
			        }
			        
			        $remaining[$minutes] += 1;
				}
			}
			
			foreach($remaining as $key => $val)
				$return[] = [$key, $val, $key . ' Minuten'];
			
			return json_encode($return);
		}
	}
}