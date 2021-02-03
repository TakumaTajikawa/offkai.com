<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserSaveRequestTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function 必須エラーとなること(): void
    {
        $data = [
            'name' => null,
            'email' => null,
            'gender' => null,
        ];
        $request = new UserRequest();
        $rules = $request->rules();

        $validator = Validator::make($data, $rules);

        $result = $validator->passes();
        $this->assertFalse($result);
        $expectedFailed = [
            'name' => ['Required' => [],],
            'email' => ['Required' => [],],
            'gender' => ['Required' => [],],
            
        ];
        $this->assertEquals($expectedFailed, $validator->failed());
    }

    
    /**
     * @test
     * @return void
     */
    public function 桁数エラーとなること(): void
    {
        $data = [
            'name' => str_repeat('a', 16),
            'email' => str_repeat('a', 244) . '@example.com',
            'gender' => '男性',
            'introduction' => str_repeat('a', 256),
        ];
        $request = new UserRequest();
        $rules = $request->rules();

        $validator = Validator::make($data, $rules);

        $result = $validator->passes();
        $this->assertFalse($result);
    }


    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function メールのユニークエラーとなること(): void
    {
        $user = User::factory()->make();

        $data = [
            'name' => '名前',
            'email' => $user->email,
            'gender' => '男性',
            'introduction' => str_repeat('a', 80),
        ];
        $request = new UserRequest();
        $rules = $request->rules();

        $validator = Validator::make($data, $rules);

        $result = $validator->passes();
        dd($result);
        $this->assertFalse($result);
    }
}