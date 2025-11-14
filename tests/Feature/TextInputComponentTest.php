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
            '<x-text-input name="email" label="Email" type="email" placeholder="Enter email" />'
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
            '<x-text-input name="password" label="Password" type="password" :required="true" />'
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
            '<x-text-input name="username" label="Username" value="john" :disabled="true" />'
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
            '<x-text-input name="id" label="ID" value="123" :readonly="true" />'
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
            '<x-text-input name="count" label="Count" description="10/100" />'
        );

        $view->assertSee('Count');
        $view->assertSee('10/100');
        $view->assertSee('class="form-label-description"', false);
    }

    /**
     * Test that the TextInput component renders without label
     */
    public function test_text_input_component_without_label(): void
    {
        $view = $this->blade(
            '<x-text-input name="search" placeholder="Search..." />'
        );

        $view->assertDontSee('<label', false);
        $view->assertSee('name="search"', false);
        $view->assertSee('placeholder="Search..."', false);
        $view->assertSee('type="text"', false);
    }
}
