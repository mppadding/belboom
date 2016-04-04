<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OproepTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Test if a user can authenticate and the resultaten page is shown
     *
     * @return void
     */
    public function testIndex()
    {
        $this->actingAs( factory('App\User')->create() );
        
        $role    = factory('App\Role')->create(['name' => 'Test Oproep Functie']);
        $contact = factory('App\Contact')->create(['name' => 'Test Oproep Contact', 'number' => '31636532389', 'role_id' => $role->id]);
        $group   = factory('App\Role')->create(['name' => 'Test Contact Functie']);
        
        $this->visit('/oproep')
             ->see('U heeft ')
             ->see('Kost:');
    }
    
    public function testA()
    {
        #$this->seeInDatabase('roles', ['name' => 'TestingTest']);
    }
}