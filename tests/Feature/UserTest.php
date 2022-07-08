<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_create_a_user_happy_way()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
            'type' => $this->faker->randomElement([1, 2])
        ];
        $response = $this->postJson('/api/v1/users', $data);

        $response->assertStatus(201)
            ->assertJson(compact('data'));

        $this->assertDatabaseHas('users', [
            'email' => $data['email']
        ]);
    }

    public function test_create_a_user_blank_name()
    {
        $data = [
            'name' => '',
            'email' => $this->faker->email,
            'password' => $this->faker->password,
            'type' => $this->faker->randomElement([1, 2])
        ];
        $response = $this->postJson('/api/v1/users', $data);

        $response->assertStatus(201)
            ->assertJson(compact('data'));

        $this->assertDatabaseHas('users', [
            'name' => $data['name']
        ]);
    }

    public function test_create_a_user_blank_email()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => '',
            'password' => $this->faker->password,
            'type' => $this->faker->randomElement([1, 2])
        ];
        $response = $this->postJson('/api/v1/users', $data);

        $response->assertStatus(201)
            ->assertJson(compact('data'));

        $this->assertDatabaseHas('users', [
            'email' => $data['email']
        ]);
    }

    public function test_create_a_user_blank_password()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => '',
            'type' => $this->faker->randomElement([1, 2])
        ];
        $response = $this->postJson('/api/v1/users', $data);

        $response->assertStatus(201)
            ->assertJson(compact('data'));

        $this->assertDatabaseHas('users', [
            'email' => $data['email']
        ]);
    }

    public function test_create_a_user_blank_type()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
            'type' => ''
        ];
        $response = $this->postJson('/api/v1/users', $data);

        $response->assertStatus(201)
            ->assertJson(compact('data'));

        $this->assertDatabaseHas('users', [
            'email' => $data['email']
        ]);
    }
}
