<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserRegistrationTest()
    {
        $user = new \App\Models\User;
        $user->name = "山田";
        $user->gender = "男性";
        $user->email = "yamada@test.com";
        $user->password = \Hash::make('password');
        $user->save();

        $readUser = \App\Models\User::where('name', '山田')->first();
        $this->assertNotNull($readUser);
        $this->assertTrue(\Hash::check('password', $readUser->password));
        \App\Models\User::where('email', 'yamada@test.com')->delete();
    }
}
