<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Mail\MailServiceProvider;

use App\User;
use App\Register;

use Mail;

class AdminController extends Controller {
    
    /**
     * Display a list of the resource
     * 
     * @param  Authenticatable $user
     * @return Response
     */
    public function index(Request $request, Authenticatable $auth)
    {
        $users;
        $header = ['Naam', 'Email', 'Accepteren', 'Verwijderen'];
        
        if($request->session()->has('developer') or $auth->developer) {
        	$users = User::all();
        	$header[] = 'Spoof';
        } elseif ($auth->super_user)
        	$users = $auth->company->users;
        else
        	$users = $auth->company->users->where('allowed', '0');
        
        $content = [];
        
        foreach($users as $user)
        {
            $delete = [
				'url' => route('admin.destroy', ['id' => $user->id]),
				'method' => 'delete',
				'name' => $user->id
			];
            
            $accept = [
                'url' => route('admin.update', ['id' => $user->id]),
				'method' => 'patch',
				'name' => $user->id
            ];
            
            $accept_message = $user->allowed ? 'Geaccepteerd' : 'Accepteren';
            
            $row = [
                $user->name,
				$user->email,
                $accept_message => $accept,
                'Verwijderen'   => $delete
            ];
            
            if($request->session()->has('developer') or $auth->developer)
            	$row['Spoof'] = route('act', ['id' => $user->id]);
            	
            $content[] = $row;
        }
        
        return view('admin.index', [
            'page'    => 'Admins',
            'header'  => $header,
            'content' => $content,
            'auth' => $auth
        ]);
    }
    
    /**
	 * Update the specified resource in storage.
	 *
	 * @param  Authenticatable $auth
	 * @param  int             $id
	 * @return Response
	 */
	public function update(Authenticatable $auth, $id)
	{
	    # Get user from id
	    $user = User::find( $id );
	    
	    # Check if authenticated user is super user
	    if($auth->super_user) {
	        # Swap allowed values around
		    $user->allowed = !$user->allowed;
	    }
		else {
		    # Allow user
		    $user->allowed = true;
		}
		
		if($user->allowed) {
		    Mail::send('emails.accepted', ['user' => $user], function ($m) use ($user) {
                $m->from('belboom@codreon.com', 'Belboom');
    
                $m->to($user->email, $user->name)->subject('Geaccepteerd');
            });
		}
		
		# Save user to the database
		$user->save();
		
		# Redirect with success message
		return redirect('admin')->with('message', 'Admin bewerkt.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
	    if(User::find($id)->super_user == false) {
		    User::destroy($id);
		    return redirect('admin')->with('message', 'Admin verwijderd');
	    }
	    
	    return redirect('admin')->with('message', 'Hier heeft u geen rechten toe.');
		
	}
	
	public function register(Authenticatable $auth)
	{
		return view('admin.register', [
			'page' => 'Admin',
			'auth' => $auth
		]);
	}
	
	public function postRegister(Authenticatable $auth, StoreAdminRequest $request)
	{
		# Get email from request
		$email = $request->get('email');
		
		# Generate a register token
		$uniq  = uniqid();
		$token = substr(str_shuffle(str_random(255) . md5(str_random(rand(10, 100)) . '-' . time())), 0, 255 - (strlen($uniq) +1))
				. '-' . $uniq;
				
		# Create model
		$register = Register::create(['email' => $email, 'token' => $token,
			'company_id' => $auth->company_id]);
		
		Mail::send('emails.register', ['register' => $register, 'user' => $auth],
			function ($m) use($register, $auth) {
            	$m->from('belboom@codreon.com', 'Belboom');

            	$m->to("mppadding@gmail.com", '')->subject('Belboom registratie');
        	}
        );
				
		return redirect('admin')->with('message', 'Registratie toegestuurd.');
	}
}
