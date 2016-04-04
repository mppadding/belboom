<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Test if a user is redirected to the login page if it isn't authenticated
     *
     * @return void
     */
    public function testLoginPage()
    {
        $this->visit('/')
             ->seePageIs('/auth/login');
    }
    
    /**
     * Test if a user can navigate to the register page
     *
     * @return void
     */
    public function testRegisterPage()
    {
        $this->visit('/auth/register')
             ->seePageIs('/auth/register');
    }
    
    /**
     * Test if a user can authenticate and check if it's redirected to /
     *
     * @return void
     */
    public function testLogin()
    {
        $user = factory('App\User')->create(['allowed' => 1]);
        
        App\User::find($user->id)->update(['password' => bcrypt($user->password)]);
        
        $this->visit('/auth/login');
        
        $this->submitForm('submit', [
            'email' => $user->email,
            'password' => $user->password
        ]);
        
        $this->visit('/')->seePageIs('/');
    }
    
    /**
     * Test if a user can register
     *
     * @return void
     */
    public function testRegister()
    {
        $this->visit('/auth/register');
        
        $this->submitForm('submit', [
            'name' => 'Test User',
            'email' => 'testemail@test.com',
            'password' => 'Test Password',
            'password_confirmation' => 'Test Password'
        ]);
        
        $this->seeInDatabase('users', ['name' => 'Test User', 'email' => 'testemail@test.com']);
    }
}