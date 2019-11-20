<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class InquiryTest
 *
 * Scenerio:
 * Test all form fields for invalid responses
 * Test valid form and ensure its in the database
 * Assert we see endpoint responses on non required fields
 *
 * @package Tests\Feature
 */
class InquiryTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testFormValidResponse()
    {
        $email = $this->faker->email;
        $response = $this->call('POST','/submit', [
            'name'  => $this->faker->name,
            'email' => $email,
            'phone' => $this->faker->phoneNumber,
            'message' => $this->faker->text(50)
        ]);

        $response->assertSeeText('data sent');
        $response->assertStatus(200);
        $this->assertDatabaseHas('inquires', [
            'email' => $email
        ]);
    }

    public function testFormNoPhone()
    {
        $response = $this->call('POST','/submit', [
            'name'  => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => '',
            'message' => $this->faker->text(50)
        ]);

        $response->assertSeeText('data sent');
        $response->assertStatus(200);
    }

    public function testFormInvalidMissingName()
    {
        $response = $this->call('POST','/submit', [
            'name'  => '',
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'message' => $this->faker->text(50)
        ]);

        $response->assertSessionHasErrors(('name'));

    }

    public function testFormInvalidEmail()
    {
        $response = $this->call('POST','/submit', [
            'name'  => $this->faker->name,
            'email' => '',
            'phone' => $this->faker->phoneNumber,
            'message' => $this->faker->text(50)
        ]);

        $response->assertSessionHasErrors(('email'));
    }

    public function testFormInvalidNoMessage()
    {
        $response = $this->call('POST','/submit', [
            'name'  => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'message' => ''
        ]);

        $response->assertSessionHasErrors(('message'));
    }

}
