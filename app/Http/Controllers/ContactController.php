<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Contracts\Auth\Authenticatable;

use App\Contact;
use App\Role;

use App\Http\Requests\StoreContactRequest;

class ContactController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Authenticatable $auth)
	{
		$contacts = $auth->company->contacts;
		
		$desktop = $mobile = array();
		
		foreach($contacts as $contact)
		{
			$delete = [
				'url' 		=> route('contacten.destroy', ['id' => $contact->id]),
				'method' 	=> 'delete',
				'name' 		=> str_replace(' ', '_', $contact->name)
			];
			
			$edit = route('contacten.edit', ['id' => $contact->id]);
			
			if(env('APP_ENV') === 'testing') {
				$edit = [
					'url'  => route('contacten.edit', ['id' => $contact->id]),
					'type' => 'a',
					'id'   => str_replace(' ', '_', $contact->name)
				];
			}
					  
			$desktop[] = [
				$contact->name,
				$contact->number,
				$contact->role()->getResults()->name,
				'Bewerken' 		=> $edit,
				'Verwijderen' 	=> $delete
			];
			
			$mobile[] = [$contact['name'] => route('contacten.show', ['id' => $contact->id])];
		}
		
		return view('contacts.index', [
			'page' => 'Contacten',
			'content' => [
				'desktop' => $desktop,
				'mobile' => $mobile,
			],
			'auth' => $auth
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Authenticatable $auth)
	{
		$roles = array();
		
		foreach(Role::all() as $role)
		{
			$roles["$role->id"] = $role->name;
		}
		
		return view('contacts.create', [
			'page' => 'Contacten',
			'roles' => $roles,
			'auth' => $auth
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param StoreContactRequest $request
	 * @return Response
	 */
	public function store(StoreContactRequest $request)
	{
		Contact::create( $request->all() );
		
		return redirect('contacten')->with('message', 'Contact toegevoegd');
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Authenticatable $auth, $id)
	{
		$contact = Contact::find($id);
		
		if($contact === null or $contact->company_id != $auth->company_id)
			return redirect('contacten');
		
		$content = array();
			
		$delete = [
			'url' 		=> route('contacten.destroy', ['id' => $id]),
			'method' 	=> 'delete',
			'name' 		=> $contact->name
		];
		
		$content = [
			[$contact->number],
			[$contact->role()->getResults()->name],
			[''],
			['Bewerken' 	=> route('contacten.edit', ['id' => $contact->id])],
			['Verwijderen'	=> $delete]
		];
		
		return view('contacts.show', [
			'page' => 'Contacten',
			'title' => [ $contact->name ],
			'content' => $content,
			'auth' => $auth
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Authenticatable $auth, $id)
	{
		$contact = Contact::find($id);
		
		if($contact === null or $contact->company_id != $auth->company_id)
			return redirect('contacten');
		
		$roles = array();
		
		foreach(Role::all() as $role)
		{
			$roles["$role->id"] = $role->name;
		}
		
		return view('contacts.edit', [
			'page' => 'Contacten',
			'name' => $contact->name,
			'number' => $contact->number,
			'role_id' => $contact->role_id,
			'roles' => $roles,
			'id' => $id,
			'auth' => $auth
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  StoreContactRequest $request
	 * @param  int  			   $id
	 * @return Response
	 */
	public function update(Authenticatable $auth, StoreContactRequest $request, $id)
	{
		$contact = Contact::find($id);
		if($contact === null or $contact->company_id != $auth->company_id)
			return redirect('contacten');
			
		$contact->update( $request->all() );
		
		return redirect('contacten')->with('message', 'Contact bewerkt!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Authenticatable $auth, $id)
	{
		$contact = Contact::find($id);
		
		if($contact === null or $contact->company_id != $auth->company_id)
			return redirect('contacten');
			
		Contact::destroy($id);
		
		return redirect('contacten')->with('message', 'Contact verwijderd');
	}

}
