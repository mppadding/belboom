<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Group;
use App\Contact;

use Illuminate\Contracts\Auth\Authenticatable;

use App\Http\Requests\StoreGroupRequest;

class GroupController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Authenticatable $auth)
	{
		$groups = $auth->company->groups;
		
		$desktop = $mobile = array();
		
		foreach($groups as $group)
		{
			$delete = [
				'url' => route('groepen.destroy', ['id' => $group->id]),
				'method' => 'delete',
				'name' => $group->id
			];
					  
			$desktop[] = [
				$group->name 	=> route('groepen.show', ['id' => $group->id]),
				'Bewerken' 		=> route('groepen.edit', ['id' => $group->id]),
				'Verwijderen' 	=> $delete
			];
			
			$mobile[] = [$group->name => route('groepen.show', ['id' => $group->id])];
		}
		
		return view('groups.index', [
			'page' => 'Groepen',
			'content' => [
				'desktop' => $desktop,
				'mobile' => $mobile
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
		$contacts = array();
		
		foreach(Contact::all() as $contact)
		{
			$contacts["$contact->id"] = $contact->name . ' - ' . $contact->role->name;
		}
		
		return view('groups.create', [
			'page' => 'Groepen',
			'contacts' => $contacts,
			'auth' => $auth
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param StoreGroupRequest $request
	 * @return Response
	 */
	public function store(StoreGroupRequest $request)
	{
		Group::create( $request->all() )
			->contacts()->attach(explode(',', $request->contacts));
			
		return redirect('groepen')->with('message', 'Groep toegevoegd');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Authenticatable $auth, $id)
	{
		$group = Group::find($id);
		
		if($group == null or $group->company_id != $auth->company_id)
			return redirect('groepen');
		
		$desktop = $mobile = array();
		
		foreach($group->contacts as $contact)
		{
			$desktop[] = [
				$contact->name 			=> route('contacten.index'),
				$contact->role->name	=> route('functies.index'),
				$contact->number
			];
			
			$mobile[] = [
				$contact->name	=> route('contacten.show', ['id' => $contact->id]),
			];
		}
		
		return view('groups.show', [
			'page' => 'Groepen',
			'name' => $group->name,
			'content' => [
				'desktop'	=> $desktop,
				'mobile' 	=> $mobile,
			],
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
		$group = Group::find($id);
		
		if($group == null or $group->company_id != $auth->company_id)
			return redirect('groepen');
		
		$contacts = array();
		
		foreach(Contact::all() as $contact)
		{
			$contacts["$contact->id"] = $contact->name . ' - ' . $contact->role->name;
		}
		
		return view('groups.edit', [
			'page' 		=> 'Groepen',
			'contacts' 	=> $contacts,
			'name'		=> $group->name,
			'selected'	=> $group->contacts()->getRelatedIds(),
			'id'		=> $id,
			'auth' => $auth
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  StoreGroupRequest $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Authenticatable $auth, StoreGroupRequest $request, $id)
	{
		$group = Group::find($id);
		
		if($group == null or $group->company_id != $auth->company_id)
			return redirect('groepen');
		
		$group->update( $request->all() );
		
		$group->contacts()->detach();
		$group->contacts()->attach( explode( ',', $request->contacts ) );
		
		return redirect('groepen')->with('message', 'Groep bewerkt');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Authenticatable $auth, $id)
	{
		$group = Group::find($id);
		
		if($group == null or $group->company_id != $auth->company_id)
			return redirect('groepen');
			
		Group::destroy($id);
		
		return redirect('groepen')->with('message', 'Groep verwijderd');
	}

}
