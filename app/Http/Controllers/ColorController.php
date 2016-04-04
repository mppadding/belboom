<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;

use App\Color;

class ColorController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Authenticatable $auth)
	{
		return view('color.index', [
			'page' => 'color',
			'auth' => $auth
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  Authenticatable $auth
	 * @return Response
	 */
	public function edit(Authenticatable $auth)
	{
		return view('color.edit', [
			'page'   => 'color',
			'colors' => $auth->color,
			'auth' => $auth
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Authenticatable $auth
	 * @param  Request		   $request
	 * @return Response
	 */
	public function update(Authenticatable $auth, Request $request)
	{
		// Lets remove all of our #'s in our input, we'll store colors without
		// # to save some space
		$colors = preg_replace('/#/', "", $request->input());
		
		$auth->color->update($colors);
		
		return redirect('color')->with('message', 'Kleuren bewerkt!');
	}
	
}
