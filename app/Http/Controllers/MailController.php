<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;

use App\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        Mail::send('emails.welcome', [], function ($m) {
            $m->from('belboom@codreon.com', 'Belboom');

            $m->to("p.g.boermans@gmail.com", "Pieter Boermans")->subject('Hoi!');
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function accepted()
    {
        $user = User::findOrFail(1);
        return view('emails.accepted', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
