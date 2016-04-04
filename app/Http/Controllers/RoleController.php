<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Contracts\Auth\Authenticatable;

use App\Role;
use App\Company;
use App\Http\Requests\StoreRoleRequest;

class RoleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Authenticatable $auth)
	{
		$roles = $auth->company->roles;
		$desktop = $mobile = array();
		
		foreach($roles as $role)
		{
			$delete = [
				'url' => route('functies.destroy', ['id' => $role->id]),
				'method' => 'delete',
				'name' => str_replace(' ', '_', $role->name)
			];
			
			$edit = route('functies.edit', ['id' => $role->id]);
			
			if(env('APP_ENV') === 'testing') {
				$edit = [
					'url'  => route('functies.edit', ['id' => $role->id]),
					'type' => 'a',
					'id'   => str_replace(' ', '_', $role->name)
				];
			}
					  
			$desktop[] = [
				$role['name'],
				'Bewerken' 		=> $edit,
				'Verwijderen' 	=> $delete
			];
			
			$mobile[] = [$role['name'] => route('functies.show', ['id' => $role->id])];
		}
		
		return view('functions.index', [
			'page' => 'Functies',
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
		return view('functions.create', [
			'page' => 'Functies',
			'auth' => $auth
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param StoreRoleRequest $request
	 * @return Response
	 */
	public function store(StoreRoleRequest $request)
	{
		Role::create( $request->all() );
		
		return redirect('functies')->with('message', 'Functie toegevoegd');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Authenticatable $auth, $id)
	{
		$role = Role::find($id);
		
		if($role === null or $role->company_id != $auth->company_id)
			return redirect('functies');
		
		return view('functions.show', [
			'page' => 'Functies',
			'title' => [$role->name],
			'content' => [
				['Bewerken' 	=> route('functies.edit', ['id' => $role->id])],
				['Verwijderen'	=> route('functies.destroy', ['id' => $role->id])]
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
		$role = Role::find($id);
		
		if($role === null or $role->company_id != $auth->company_id)
			return redirect('functies');
		
		return view('functions.edit', [
			'page' => 'Functies',
			'id' => $role->id,
			'value' => $role->name,
			'auth' => $auth
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param StoreRoleRequest $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(StoreRoleRequest $request, $id)
	{
		$role = Role::find($id);
		
		if($role === null or $role->company_id != $auth->company_id)
			return redirect('functies');
			
		$role->update($request->all());
		
		return redirect('functies')->with('message', 'Functie bewerkt!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Authenticatable $auth, $id)
	{
		$role = Role::find($id);
		
		if($role === null or $role->company_id != $auth->company_id)
			return redirect('functies');
			
		Role::destroy($id);
		
		return redirect('functies')->with('message', 'Functie verwijderd');
	}

}
