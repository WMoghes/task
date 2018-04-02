<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClientsTest extends TestCase
{
    /** @test */
    public function client_can_create_a_new_account()
    {
        \App\User::where('email', 'wmoghes@gmail.com')->delete();

        $client = factory(\App\User::class)->create([
            'email' => 'wmoghes@gmail.com',
            'password' => bcrypt('123'),
            'permission_id' => 1 // admin user (permission id == 1)
        ]);

        $email = \App\User::select('email')->where('email', 'wmoghes@gmail.com')->first();

        $this->assertEquals('wmoghes@gmail.com', $email->email);
    }

    /** @test */
    public function client_can_login_by_using_email()
    {
        $this->visit('/login')
            ->type('wmoghes@gmail.com', 'email')
            ->type('123', 'password')
            ->press('Login')
            ->seePageIs('/admin');
    }

    /** @test */
    public function fillData()
    {
        for ($i = 0; $i < 40; $i++) {
            factory(\App\User::class)->create();
        }

        for ($i = 0; $i < 20; $i++) {
            factory(\App\Category::class)->create();
        }

        for ($i = 0; $i < 110; $i++) {
            factory(\App\Product::class)->create();
        }

        for ($i = 0; $i < 110; $i++) {
            factory(\App\Order::class)->create();
        }

        for ($i = 0; $i < 540; $i++) {
            factory(\App\OrderDetail::class)->create();
        }

        factory(\App\Permission::class)->create([
            'permission_name' => 'none'
        ]);

        factory(\App\Permission::class)->create([
            'permission_name' => 'admin'
        ]);

        factory(\App\Permission::class)->create([
            'permission_name' => 'client'
        ]);
    }
}