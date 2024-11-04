<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;
    protected $userRepository;
    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = new UserRepository();
    }

    public function test_get_all_users()
    {
        $users = User::factory()->count(20)->create();

        $perPage = 10;
        $users = $this->userRepository->all($perPage);

        $this->assertCount($perPage, $users);
        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $users);
    }

    public function test_create_a_user()
    {
        $userData = [
            'name' => 'مرتضی حسینی',
            'email' => 'h.morteza011@gmail.com',
            'country' => 'United States',
            'currency' => 'USD'
        ];

        $user = $this->userRepository->create($userData);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($userData['name'],$user->name);
        $this->assertEquals($userData['email'],$user->email);

    }

    public function test_update_a_user()
    {
        $user = User::factory()->create([
            'name' => 'مرتضی حسینی',
            'email' => 'h.morteza011@gmail.com',
            'country' => 'United States',
            'currency' => 'USD'
        ]);

        $updatedData = [
            'name' => 'Morteza Hosseini',
            'email' => 'morteza@yahoo.com',
            'country' => 'Canada',
            'currency' => 'CAD'
        ];

        $updatedUser = $this->userRepository->update($user->id, $updatedData);

        $this->assertEquals($updatedData['name'], $updatedUser->name);
        $this->assertEquals($updatedData['email'], $updatedUser->email);
        $this->assertEquals($updatedData['country'], $updatedUser->country);
        $this->assertEquals($updatedData['currency'], $updatedUser->currency);

    }

    public function test_delete_a_user()
    {
        $user = User::factory()->create([
            'name' => 'Morteza Hosseini',
            'email' => 'morteza@yahoo.com',
        ]);
        $result = $this->userRepository->delete($user->id);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('users',['id' => $user->id]);
    }

    public function test_filter_by_country()
    {

        User::factory()->create(['country' => 'Iran']);
        User::factory()->create(['country' => 'Iran']);
        User::factory()->create(['country' => 'United States']);
        User::factory()->create(['country' => 'Italy']);

        $filters = ['country' => 'Iran'];
        $result = $this->userRepository->filter($filters);

        $this->assertCount(2, $result);
        $this->assertEquals('Iran', $result->first()->country);
    }

    public function test_filter_by_currency()
    {
        User::factory()->create(['currency' => 'USD']);
        User::factory()->create(['currency' => 'EUR']);
        User::factory()->create(['currency' => 'EUR']);
        User::factory()->create(['currency' => 'IRR']);

        $filters = ['currency' => 'EUR'];
        $result = $this->userRepository->filter($filters);

        $this->assertCount(2, $result);
        $this->assertEquals('EUR', $result->first()->currency);
    }


}
