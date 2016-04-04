<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestingTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Test if a user can authenticate and the resultaten page is shown
     *
     * @return void
     */
    public function testIndex()
    {
       #$role = factory('App\Role')->create(['name' => 'TestingTest']);
        
        #$this->seeInDatabase('roles', ['name' => 'TestingTest']);
    }
    
    public function testA()
    {
        #$this->seeInDatabase('roles', ['name' => 'TestingTest']);
    }
}