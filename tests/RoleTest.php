<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RoleTest extends TestCase
{
    
    use DatabaseTransactions;
    
    /**
     * Test if an user can create a role
     * 
     * @return void
     */
    public function testCreate()
    {
        $this->actingAs( factory('App\User')->create() );
        
        $this->visit('/functies/create')
             ->seePageIs('/functies/create');
        
        $this->submitForm([
            'name' => 'Test Functie'
        ]);
        
        $this->seeInDatabase('roles', ['name' => 'Test Functie']);
    }
    
    /**
     * Test if an user can read a role
     * 
     * @return void
     */
    public function testRead()
    {
        $this->actingAs( factory('App\User')->create() );
        
        $contact = factory('App\Role')->create(['name' => 'Test Functie']);
        $this->seeInDatabase('roles', ['name' => 'Test Functie']);
        
        $this->visit('/functies')
             ->see('Test Functie');
    }
    
    /**
     * Test if an user can update a role
     * 
     * @return void
     */
    public function testUpdate()
    {
        $this->actingAs( factory('App\User')->create() );
        
        $role = factory('App\Role')->create(['name' => 'Test Functie']);
        
        $this->visit('/functies/' . $role->id . '/edit');
        
        $this->submitForm([
            'name' => 'Test Functie 2'
        ]);
        
        $this->seeInDatabase('roles', ['name' => 'Test Functie 2']);
    }
    
    /**
     * Test if an user can update a role
     * 
     * @return void
     */
    public function testDelete()
    {
        $this->actingAs( factory('App\User')->create() );
        
        $contact = factory('App\Role')->create(['name' => 'Test Functie']);
        
        $this->visit('/functies');
        
        $this->press('delete_Test_Functie')
             ->missingFromDatabase('roles', ['name' => 'Test Functie']);
    }
}