<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContactTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Test if an user can create a contact
     * 
     * @return void
     */
    public function testCreate()
    {
        $this->actingAs( factory('App\User')->create() );
        
        $role = factory('App\Role')->create(['name' => 'Test Contact Functie']);
        
        $this->visit('/contacten/create')
             ->seePageIs('/contacten/create');
        
        $this->submitForm([
            'role_id' => $role->id,
            'name' => 'Test Contact',
            'number' => '31636532389'
        ]);
        
        $this->seeInDatabase('contacts', ['name' => 'Test Contact']);
    }
    
    /**
     * Test if an user can read a contact
     * 
     * @return void
     */
    public function testRead()
    {
        $this->actingAs( factory('App\User')->create() );
        
        $contact = factory('App\Contact')->create(['name' => 'Test Contact']);
        $this->seeInDatabase('contacts', ['name' => 'Test Contact']);
        
        $this->visit('/contacten')
             ->see('Test Contact');
    }
    
    /**
     * Test if an user can update a contact
     * 
     * @return void
     */
    public function testUpdate()
    {
        $this->actingAs( factory('App\User')->create() );
        
        $contact = factory('App\Contact')->create(['name' => 'Test Contact']);
        $role = factory('App\Role')->create(['name' => 'Test Contact Functie 2']);
        
        $this->visit('/contacten/' . $contact->id . '/edit');
        
        $this->submitForm([
            'role_id' => $role->id,
            'name' => 'Test Contact 2',
            'number' => '31636532388'
        ]);
        
        $this->seeInDatabase('contacts', ['name' => 'Test Contact 2']);
    }
    
    /**
     * Test if an user can update a contact
     * 
     * @return void
     */
    public function testDelete()
    {
        $this->actingAs( factory('App\User')->create() );
        
        $contact = factory('App\Contact')->create(['name' => 'Test Contact']);
        
        $this->visit('/contacten');
        
        $this->press('delete_Test_Contact')
             ->missingFromDatabase('contacts', ['name' => 'Test Contact']);
    }
}