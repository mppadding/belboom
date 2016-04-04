<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;

# Store result
Route::post('oproep/store', [
    'as' => 'oproep.store', 'uses' => 'CallController@store'
]);

# Custom color handling based on being logged in
Route::get('css/{name}.css', function(Authenticatable $auth = null, $name)
{
    $colors = [];
    
    $default = [
        'color_dark_primary'   => '0288D1',
        'color_primary'        => '03A9F4',
        'color_light_primary'  => 'B3E5FC',
        'color_icons'          => 'FFFFFF',
        'color_accent'         => 'FF5722',
        'color_text_primary'   => '212121',
        'color_text_secondary' => '727272',
        'color_divider'        => 'B6B6B6'
    ];
    
    if($auth === null)
        $colors = $default;
    else
        $colors = $auth->color;
    
    return response()->view("css.$name", $colors)->header('Content-Type', 'text/css');
});

Route::get('/auth/register/{token?}', [
    'as' => 'auth.register', 'uses' => 'Auth\AuthController@getRegister'
]);

Route::group(['middleware' => ['auth']], function()
{
    Route::get('/', 'ResultController@table');
    Route::get('home', 'ResultController@table');
    Route::get('admin/register', [
        'as' => 'admin.register', 'uses' => 'AdminController@register'
    ]);
    Route::post('admin/store', [
        'as' => 'admin.store', 'uses' => 'AdminController@postRegister'
    ]);
    Route::get('test', function(Authenticatable $auth) {
        return view('emails.register', ['register' => App\Register::find(1), 'user' => $auth]);
    });
    
    Route::resource('functies', 'RoleController');
    Route::resource('contacten', 'ContactController');
    Route::resource('groepen', 'GroupController');
    
    Route::get('act/{id}', ['as' => 'act', function(Request $request, Authenticatable $auth = null, $id) {
        if($request->session()->has('developer') or $auth->developer) {
            Auth::login(App\User::find($id));
            $request->session()->put('developer', true);
        }
            
        return redirect('resultaten');
    }]);
    
    # Mail specific
    Route::get('mail', 'MailController@index');
    Route::get('mail/accepted', 'MailController@accepted');
    
    Route::get('resultaten', [
        'as' => 'resultaten.index', 'uses' => 'ResultController@table'
    ]);
    Route::get('resultaten/graph/{id?}', [
        'as' => 'resultaten.graph', 'uses' => 'ResultController@graph'
    ]);
    Route::get('resultaten/tabel/{id?}', [
        'as' => 'resultaten.table', 'uses' => 'ResultController@table'
    ]);
    Route::get('resultaten/{role}/role', [
        'as' => 'resultaten.role', 'uses' => 'ResultController@role'
    ]);
    Route::get('resultaten/json/index/{id}', [
        'as' => 'resultaten.json.index', 'uses' => 'ResultController@graphIndex'
    ]);
    
    Route::get('resultaten/json/{id?}', ['as' => 'resultaten.json', function($id = null) {
           return \App\Result::json($id);
       }
    ]);
    
    Route::get('resultaten/oproepen', [
        'as' => 'resultaten.calls', 'uses' => 'ResultController@callIndex' 
    ]);
    
    Route::get('resultaten/{result}', [
        'as' => 'resultaten.show', 'uses' => 'ResultController@show' 
    ]);
    
    Route::get('resultaten/{role}/graph', [
        'as' => 'resultaten.detail', 'uses' => 'ResultController@detail'
    ]);
    
    Route::patch('resultaten/{result}', [
        'as' => 'resultaten.update', 'uses' => 'ResultController@update'
    ]);
    Route::delete('resultaten/{result}', [
        'as' => 'resultaten.destroy', 'uses' => 'ResultController@destroy'
    ]);
    Route::get('oproep', [
        'as' => 'oproep.index', 'uses' => 'CallController@index'     
    ]);
    Route::post('oproep', [
        'as' => 'oproep.send', 'uses' => 'CallController@send'  
    ]);
    
    Route::get('admin', [
        'as' => 'admin.index', 'uses' => 'AdminController@index'    
    ]);
    Route::delete('admin/{id}', [
        'as' => 'admin.destroy', 'uses' => 'AdminController@destroy'
    ]);
    Route::patch('admin/{id}', [
        'as' => 'admin.update', 'uses' => 'AdminController@update'
    ]);
    
    Route::get('color', [
        'as' => 'color.index', 'uses' => 'ColorController@index' 
    ]);
    Route::get('color/edit', [
        'as' => 'color.edit', 'uses' => 'ColorController@edit'
    ]);
    Route::patch('color', [
        'as' => 'color.update', 'uses' => 'ColorController@update'
    ]);
    
    # Development specific routes
    if (App::environment('development'))
    {
        Route::get('flowchart', function() {
            # Get full path to the flowcharts
            $full_path = base_path().'/resources/views/flowcharts';
     
            # Check if the directory exists
            if(!is_dir($full_path))
                return 'Views directory not found.' . $full_path;
         
            # Get all files
            $files = scandir($full_path);
            
            # Remove . and .. files (current directory, top directory)
            unset($files[0]);
            unset($files[1]);
            
            # Loop over each file
            foreach($files as $file){
                # Remove the file extension
                $link = str_replace('.php','', $file);
                
                # Add the link
                echo '<a href="flowchart/'.$link.'">'.str_replace('_', ' ', $link).'</a>'.'<br>';
            }
        });
        
        # Show a flowchart with name {name}
        Route::get('flowchart/{name}', function($name) {
            return response()->view("flowcharts.$name"); 
        });
    }
});

# Authentication controllers
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
