<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Contracts\Auth\Authenticatable;

use App\Group;
use App\Result;
use App\Contact;
use App\Call;

use App\Http\Requests\SendCallRequest;

class CallController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Authenticatable $auth)
	{
		$groups = $contacts = [];
		
		$messagebird = new \MessageBird\Client(env('MESSAGEBIRD_KEY'));
		
		$balance = $messagebird->balance->read();
		$credits;
		
		if($balance->payment === 'postpaid')
			$credits = 'Postpaid, genoeg credits.';
		else if($balance->payment === 'prepaid')
			$credits = 'U heeft ' . $balance->amount . ' credits.';
		
		foreach($auth->company->groups as $group)
		{
			$groups[$group->id] = [
				'name'     => $group->name,
				'contacts' => $group->contacts
			];
		}
		
		$contacts = [];
		
		foreach($auth->company->contacts as $contact)
		{
			$contacts[$contact->id] = 0;
		}
		
		return view('call.test', [
			'page' => 'Oproep',
			'groups' => $groups,
			'credits' => $credits,
			'contacts' => $contacts,
            'auth' => $auth
		]);
	}
	
	/**
	 * Sends a message to the specified groups
	 * 
	 * @param  SendCallRequest $request
	 * @return Response
	 */
	public function send(SendCallRequest $request)
	{
	 	$messagebird = new \MessageBird\Client(env('MESSAGEBIRD_KEY'));
	 	$originator = env('MESSAGEBIRD_ORIGINATOR');
	 	$recipients = [];
	 	
	 	$contacts = Contact::find(explode(',', $request->contacts));
	 	
	 	foreach($contacts as $contact) {
	 		$recipients[] = preg_replace("/[^0-9]/", "", $contact->number);
	 	}
	 	
	 	$message = new \MessageBird\Objects\Message();
		$message->originator = $originator;
		$message->recipients = $recipients;
		$message->body = $request->message;
	 	
	 	$m = $messagebird->messages->create($message);
	 	
 		$balance = $messagebird->balance->read();
 		# TODO: Implement a setting to change this number (< 100)
 		if($balance->payment == 'prepaid' && $balance->amount < 100) {
 			$credits = $balance->amount;
 		}
 			
 		# Create call model
 		$call = Call::create(['message' => $request->message, 'recipients' => count($recipients)]);
 		
 		# Update contacts table with last call id
 		Contact::whereIn('id', explode(',', $request->contacts))
 			->update(['call_id' => $call->id]);
	 	
	 	if(env('APP_ENV') === 'testing')
	 		var_dump($m);
		else {
	 		return redirect('resultaten')->with('message', 'Oproep verstuurd');
		}
	 }
	 
	/**
	 * Stores a specified resource
	 * 
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		# Create database prefab
		$store = $request->except(['createdDatetime', 'recipient']);
		
		$contact = Contact::where('number', $store['originator'])->first();
		
		# Message doesn't meet requirements, ignore
		if($contact === null or $contact->call_id === 0)
			return new Response('', 200);
			
		# Get the date
		$store['date'] = \Carbon\Carbon::parse(str_replace(' ', '+', $request->createdDatetime));
		$store['call_id'] = $contact->call_id;
		$store['contact_id'] = $contact->id;
		
		# Difference in date is higher than 24 hours, ignore message
		if($contact->call->created_at->diffInDays($store['date']) > 0)
			return new Response('', 200);
		
		# Store the result
		Result::create($store);
		
		# Return 200 (OK)
		return new Response('', 200);
	}

}
