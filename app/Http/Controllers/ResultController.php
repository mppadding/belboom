<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Contracts\Auth\Authenticatable;

use App\Result;
use App\Role;
use App\Call;
use App\Company;

class ResultController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		# Get all results from database
	    $results = Result::all();
	    
	    # Create desktop and mobile content arrays
	    $desktop = $mobile = array();
	    
	    # Create mobile default value
	    $mobile[] = 'N.v.t.';
	    
	    $mobile = [
	    	['N.v.t.' => route('resultaten.role', ['id' => 0])]
    	];
	    
	    foreach($results as $result)
	    {
	    	$minutes = $this->parseMinutes($result->body);
	    	$arrival = $result->date->addMinutes($minutes);
	    	
	        $arrive = [
	        	'url' 		=> route('resultaten.update', ['id' => $result->id]),
	        	'method'	=> 'patch',
	        	'name'		=> $result->id
        	];
        	
	        $delete = [
				'url' 		=> route('resultaten.destroy', ['id' => $result->id]),
				'method'	=> 'delete',
				'name' 		=> $result->id
			];
	        
	        $d = [
	            $result->originator,
	            'N.v.t.',
	            $result->body,
	            $arrival->format('d-m H:i'),
	            'Verwijderen' 									=> $delete,
	            $result->arrived ? 'Gearriveerd' : 'Arriveren' 	=> $arrive
            ];
            
            if($result->contact !== null) {
                $d[0] = $result->contact->name;
                $d[1] = $result->contact->role->name;
                
                if(!array_key_exists($result->contact->role->name, $mobile))
                {
                	$mobile[] = [
                		$result->contact->role->name => route('resultaten.role', [
                			'id' => $result->contact->role->id
            			])
        			];
                }
            }
            
            $desktop[] = $d;
	    }
	    
		return view('results.index', [
			'page' => 'Resultaten',
			'company' => Company::find(1),
			'last_id' => Call::last()->id,
			'content' => [
				'desktop' => $desktop,
				'mobile' => $mobile,
			],
		]);
	}
	
	public function table(Authenticatable $auth, $id = null)
	{
		$call = Call::find($id);
		
		if($call === null or $call->company_id != $auth->company_id)
			$call = $auth->company->calls->sortByDesc('created_at')->first();
		
		# Get all results from database
		if($call === null)
			$results = [];
		else
	    	$results = $call->results;
	    
	    # Create desktop and mobile content arrays
	    $desktop = $mobile = array();
	    
	    # Create mobile default value
	    $mobile[] = 'N.v.t.';
	    
	    $mobile = [
	    	['N.v.t.' => route('resultaten.role', ['id' => 0])]
    	];
	    
	    foreach($results as $result)
	    {
	    	$minutes = $this->parseMinutes($result->body);
	    	$arrival = $result->date->addMinutes($minutes);
	    	
	        $arrive = [
	        	'url' 		=> route('resultaten.update', ['id' => $result->id]),
	        	'method'	=> 'patch',
	        	'name'		=> $result->id
        	];
        	
	        $delete = [
				'url' 		=> route('resultaten.destroy', ['id' => $result->id]),
				'method'	=> 'delete',
				'name' 		=> $result->id
			];
	        
	        $d = [
	            $result->originator,
	            'N.v.t.',
	            $result->body,
	            $arrival->format('d-m H:i'),
	            'Verwijderen' 									=> $delete,
	            $result->arrived ? 'Gearriveerd' : 'Arriveren' 	=> $arrive
            ];
            
            if($result->contact !== null) {
                $d[0] = $result->contact->name;
                $d[1] = $result->contact->role->name;
                
                if(!array_key_exists($result->contact->role->name, $mobile))
                {
                	$mobile[] = [
                		$result->contact->role->name => route('resultaten.role', [
                			'id' => $result->contact->role->id
            			])
        			];
                }
            }
            
            $desktop[] = $d;
	    }
	    
		return view('results.index', [
			'page' => 'Resultaten',
			'company' => Company::find(1),
			'last_id' => Call::last()->id,
			'content' => [
				'desktop' => $desktop,
				'mobile' => $mobile,
			],
			'auth' => $auth
		]);
	}
	
	/**
	 * Parse the minutes from the body
	 */
    private function parseMinutes($body)
    {
    	if(!preg_match('/[^\d]+/', $body))
	        return intval($body);
	        
	    $matches = [];
	    
	    if(preg_match_all('/[\d]+/', $body, $matches) === 1)
	        return intval($matches[0][0]);
	        
	    // Ik sta in de file, die is 100 km lang, het duurt nog 100 minuten
	    // Get all numbers
	    // Get the word after the numbers
	    
	    $splitted = explode(' ', $body);
	    
	    $selected = [];
	    
	    for($cnt = 0; $cnt < sizeof($splitted) - 1; $cnt++) {
	        if(is_numeric($splitted[$cnt])) {
	            if(substr($splitted[$cnt + 1], 0, 3) === 'min')
	                $selected[] = $splitted[$cnt];
	        }
	    }
	    
	    if(sizeof($selected) > 1)
	        return $selected;
	    else if(sizeof($selected) === 1)
	        return intval($selected[0]);
	    
	    return -1;
    }
	
	/**
	 * Display the specified resource where role_id equals $id
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function role(Authenticatable $auth, $id)
	{
		$results = Result::all();
		
		$content = [];
		
		foreach($results as $result)
		{
			$minutes = filter_var($result->body, FILTER_SANITIZE_NUMBER_INT);
    		$arrival = $result->date->addMinutes($minutes);
    		
			if($result->contact === null and $id === '0') {
				$content[] = [
					$result->originator,
					$arrival->format('d-m H:i')
				];
			}
			else if($result->contact !== null and $result->contact->role_id === $id) {
				$content[] = [
					$result->contact->name => route('resultaten.show', ['id' => $id]),
					$arrival->format('d-m H:i')
				];
			}
		}
		
		return view('results.role', [
			'page' => 'Resultaten',
			'content' => $content,
			'auth' => $auth
		]);
	}
	
	/**
	 * Display the specified resource.
	 * 
	 * @param  int  $id
	 * @return Response
	 */
	 public function show(Authenticatable $auth, $id)
	 {
	 	$result = Result::findOrFail($id);
	 	
	 	$minutes = filter_var($result->body, FILTER_SANITIZE_NUMBER_INT);
    	$arrival = $result->date->addMinutes($minutes);
	 	
	 	$arrive  = $result->arrived ? 'Gearriveerd' : 'Arriveren';
	 	
	 	$content = [
	 		[$result->contact->role->name => route('functies.index')],
	 		[$result->originator],
	 		[$result->body],
	 		[$arrival->format('d-m H:i')],
	 		[''],
	 		[$arrive => route('resultaten.update', ['id' => $id])],
	 		['Verwijderen' => route('resultaten.destroy', ['id' => $id])]
 		];
	 	
	 	return view('results.show', [
	 		'page' 		=> 'Resultaten',
	 		'header' 	=> [$result->contact->name],
	 		'content'	=> $content,
	 		'id'		=> $id,
	 		'auth' => $auth
 		]);
	 }
	
	/**
	 * Update the specified resource in storage.
	 *
     * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	    $result = Result::find($id);
	    
	    $result->update(['arrived' => !$result->arrived]);
	    
		return redirect('resultaten')->with('message', 'Resultaat bewerkt!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Result::destroy($id);
		
		return redirect('resultaten')->with('message', 'Resultaat verwijderd');
	}
	
	/**
	 * Return all calls from database in a table.
	 *
	 * @return Response
	 */
	public function callIndex(Authenticatable $auth)
	{
		# Create new array
		$data = array();
		
		# Get all calls and loop over them
		foreach($auth->company->calls as $call) {
			# Check if a call has results, if not, ignore
			if(count($call->results)) {
				$data[] = [$call->created_at->format('d-m-y') => route('resultaten.graph',
					['id' => $call->id])
				];
			}
		}
		
		return view('results.calls', [
			'page'  => 'Resultaten',
			'data'  => $data,
			'auth' => $auth
		]);
	}
	
	/**
	 * Display the graph of the resources.
	 * 
	 * @return Response
	 */
	public function graph(Authenticatable $auth, $id)
	{
		$call = Call::find($id);
		
		if($call === null or $call->company_id != $auth->company_id)
			$call = $auth->company->calls->sortByDesc('created_at')->first();
		
		$ids = [];
		foreach(Role::all() as $role)
		{
			$ids[$role->name] = $role->id;
		}
		
		$total = count($call->results) . '/' . $call->recipients . ' ' . 
			round(count($call->results) / $call->recipients * 100) . '%';
			
		$json = json_decode(Result::json());
		
		foreach ($json as $key => $field) {
			# Skip the headers
			if($key === 0)
				continue;
				
			# Get the results from the role name
			$results = Role::where('name', $field[0])->first()->results;
			
			# Count the total results with the same call_id
			$json[$key][1] = count($results->where('call_id', "$id")->all());
		}
		
		return view('results.graph.index', [
			'page'  => 'Resultaten',
			'ids'   => $ids,
			'id'	=> $call->id,
			'date'  => $call->created_at->format('d-m-y'),
			'total' => $total,
			'json'  => json_encode($json, JSON_HEX_APOS),
			'auth' => $auth
		]);
		
		# TODO: passing via view doesn't work with json(for the chart)
		# route however does, figure out a decent way to get the json via
		# the route option.
	}
	
	/**
	 * Return the json for the graph index
	 * 
	 * @param  int      $id
	 * @return JSONResponse
	 */
	public function graphIndex($id) {
		$json = json_decode(Result::json());
		
		foreach ($json as $key => $field) {
			# Skip the headers
			if($key === 0)
				continue;
				
			# Get the results from the role name
			$results = Role::where('name', $field[0])->first()->results;
			
			# Count the total results with the same call_id
			$json[$key][1] = count($results->where('call_id', "$id")->all());
		}
		
		return response()->json($json);
	}
	
	/**
	 * Displays the graph of a specified resource.
	 * 
	 * @param  int  $id
	 * @return Response
	 */
	public function detail(Authenticatable $auth, $id)
	{
		return view('results.graph.role', [
			'page' => 'Resultaten',
			'id'   => $id,
			'auth' => $auth
		]);
	}

}
