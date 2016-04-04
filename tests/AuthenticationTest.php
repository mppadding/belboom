<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthenticationTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Test if a user can authenticate and the resultaten page is shown
     *
     * @return void
     */
    public function testResultaten()
    {
        $user = factory('App\User')->create();
        
        $this->actingAs($user)
             ->visit('/')
             ->seePageIs('/');
    }
    
    /**
     * Test if a user can authenticate and the groepen page is shown
     *
     * @return void
     */
    public function testGroepen()
    {
        $user = factory('App\User')->create();
        
        $this->actingAs($user)
             ->visit('/groepen')
             ->seePageIs('/groepen');
    }
    
    /**
     * Test if a user can authenticate and the contacten page is shown
     *
     * @return void
     */
    public function testContacten()
    {
        $user = factory('App\User')->create();
        
        $this->actingAs($user)
             ->visit('/contacten')
             ->seePageIs('/contacten');
    }
    
    /**
     * Test if a user can authenticate and the oproep page is shown
     *
     * @return void
     */
    public function testOproep()
    {
        $user = factory('App\User')->create();
        
        $this->actingAs($user)
             ->visit('/oproep')
             ->seePageIs('/oproep');
    }
    
    /**
     * Test if a user can authenticate and the admin page is shown
     *
     * @return void
     */
    public function testAdmin()
    {
        $user = factory('App\User')->create();
        
        $this->actingAs($user)
             ->visit('/admin')
             ->seePageIs('/admin');
    }
    
    /**
     * Test if a user can authenticate and the color page is shown
     *
     * @return void
     */
    public function testColor()
    {
        $user = factory('App\User')->create();
        
        $this->actingAs($user)
             ->visit('/color')
             ->seePageIs('/color');
    }
}