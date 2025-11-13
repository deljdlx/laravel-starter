<?php

namespace Tests\Feature;

use Tests\TestCase;

class TextInputComponentTest extends TestCase
{
    /**
     * Test that the TextInput component renders correctly
     */
    public function test_text_input_component_renders(): void
    {
        $view = $this->blade(
            '<x-text-input label="Email" name="email" type="email" placeholder="Enter email" />'
        );

        $view->assertSee('Email');
        $view->assertSee('name="email"', false);
        $view->assertSee('type="email"', false);
        $view->assertSee('placeholder="Enter email"', false);
    }

    /**
     * Test that the TextInput component renders with required attribute
     */
    public function test_text_input_component_with_required(): void
    {
        $view = $this->blade(
            '<x-text-input label="Password" name="password" type="password" :required="true" />'
        );

        $view->assertSee('Password');
        $view->assertSee('required', false);
        $view->assertSee('class="form-label required"', false);
    }

    /**
     * Test that the TextInput component renders with disabled state
     */
    public function test_text_input_component_with_disabled(): void
    {
        $view = $this->blade(
            '<x-text-input label="Username" name="username" value="john" :disabled="true" />'
        );

        $view->assertSee('Username');
        $view->assertSee('disabled', false);
        $view->assertSee('value="john"', false);
    }

    /**
     * Test that the TextInput component renders with readonly state
     */
    public function test_text_input_component_with_readonly(): void
    {
        $view = $this->blade(
            '<x-text-input label="ID" name="id" value="123" :readonly="true" />'
        );

        $view->assertSee('ID');
        $view->assertSee('readonly', false);
    }

    /**
     * Test that the TextInput component renders with description
     */
    public function test_text_input_component_with_description(): void
    {
        $view = $this->blade(
            '<x-text-input label="Count" name="count" description="10/100" />'
        );

        $view->assertSee('Count');
        $view->assertSee('10/100');
        $view->assertSee('class="form-label-description"', false);
    }
}
