<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Validator;

use Auth;
use Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;

use App\User;
use App\Color;
use App\Register;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;
	
	/**
	 * Get the failed login message.
	 *
	 * @return string
	 */
	public function getFailedLoginMessage()
	{
		return 'De logingegevens komen niet overeen met onze gegevens.';
	}
	
	public function getRegister(Request $request, $token = null)
	{
		$register = Register::where(['token' => $token])->first();
		
		if($register == null)
			abort(404);
			
        return view('auth.register', [
        	'email' => $register->email,
        	'token' => $register->token
        ]);
	}
	
	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postRegister(Request $request)
	{
		# Get our register model
		$register = Register::where(['token' => $request->input('token')])->first();
		
		# Abort if we can't find it
		if($register == null)
			abort(404);
		
		$validator = $this->validator($request->all());
		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator
			);
		}
		
		$data = $request->all();
		$data['company_id'] = $register->company_id;
		
		$user = $this->create($data);
		Color::create(['user_id' => $user->id]);
		
		$register->delete();
		
		return redirect($this->redirectPath())->with('message', 'Succesvol geregistreerd.');
	}
	
	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postLogin(Request $request)
	{

		$this->validate($request, [
			'email' => 'required|email', 'password' => 'required',
		]);

		$credentials = $request->only('email', 'password');
		
		$user = \App\User::all()->where('email', $credentials['email'])->first();
		
		if($user != null and $user->allowed == true)
		{
			if (Auth::attempt($credentials, $request->has('remember')))
			{
				return redirect()->intended($this->redirectPath());
			}
		}
		
		return redirect($this->loginPath())
					->withInput($request->only('email', 'remember'))
					->withErrors([
						'email' => $this->getFailedLoginMessage(),
					]);
	}
	
	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' 		=> 'required|max:255',
			'email' 	=> 'required|email|max:255|unique:users',
			'password' 	=> 'required|confirmed|min:6'
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'company_id' => $data['company_id']
		]);
	}

	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest', ['except' => 'getLogout']);
	}

}
