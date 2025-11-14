<?php

namespace Tests\Feature;

use Tests\TestCase;

class RadioInputComponentTest extends TestCase
{
    /**
     * Test that the RadioInput component renders correctly
     */
    public function test_radio_input_component_renders(): void
    {
        $view = $this->blade(
            '<x-radio-input name="gender" value="male" label="Male" />'
        );

        $view->assertSee('Male');
        $view->assertSee('name="gender"', false);
        $view->assertSee('value="male"', false);
        $view->assertSee('type="radio"', false);
        $view->assertSee('class="form-check-input"', false);
    }

    /**
     * Test that the RadioInput component renders with checked state
     */
    public function test_radio_input_component_with_checked(): void
    {
        $view = $this->blade(
            '<x-radio-input name="option" value="1" label="Option 1" :checked="true" />'
        );

        $view->assertSee('Option 1');
        $view->assertSee('checked', false);
    }

    /**
     * Test that the RadioInput component renders with disabled state
     */
    public function test_radio_input_component_with_disabled(): void
    {
        $view = $this->blade(
            '<x-radio-input name="disabled_option" value="disabled" label="Disabled" :disabled="true" />'
        );

        $view->assertSee('Disabled');
        $view->assertSee('disabled', false);
    }

    /**
     * Test that the RadioInput component renders inline
     */
    public function test_radio_input_component_inline(): void
    {
        $view = $this->blade(
            '<x-radio-input name="inline_option" value="inline" label="Inline" :inline="true" />'
        );

        $view->assertSee('Inline');
        $view->assertSee('form-check-inline', false);
    }

    /**
     * Test that the RadioInput component renders with description
     */
    public function test_radio_input_component_with_description(): void
    {
        $view = $this->blade(
            '<x-radio-input name="with_desc" value="desc" label="Option" description="This is a description" />'
        );

        $view->assertSee('Option');
        $view->assertSee('This is a description');
        $view->assertSee('class="form-check-description"', false);
    }

    /**
     * Test that the RadioInput component renders without label
     */
    public function test_radio_input_component_without_label(): void
    {
        $view = $this->blade(
            '<x-radio-input name="no_label" value="val" />'
        );

        $view->assertDontSee('<span class="form-check-label">', false);
        $view->assertSee('name="no_label"', false);
        $view->assertSee('value="val"', false);
        $view->assertSee('type="radio"', false);
    }

    /**
     * Test that the RadioInput component renders both checked and disabled
     */
    public function test_radio_input_component_checked_and_disabled(): void
    {
        $view = $this->blade(
            '<x-radio-input name="both" value="both" label="Both" :checked="true" :disabled="true" />'
        );

        $view->assertSee('Both');
        $view->assertSee('checked', false);
        $view->assertSee('disabled', false);
    }

    /**
     * Test that multiple radio buttons with same name work correctly
     */
    public function test_multiple_radio_buttons_same_name(): void
    {
        $view = $this->blade(
            '<x-radio-input name="choice" value="1" label="Choice 1" :checked="true" />
             <x-radio-input name="choice" value="2" label="Choice 2" />'
        );

        $view->assertSee('Choice 1');
        $view->assertSee('Choice 2');
        $view->assertSee('value="1"', false);
        $view->assertSee('value="2"', false);
        $view->assertSee('checked', false);
    }
}
