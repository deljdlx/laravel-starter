<?php

namespace Tests\Feature;

use Tests\TestCase;

class CheckboxInputComponentTest extends TestCase
{
    /**
     * Test that the CheckboxInput component renders correctly
     */
    public function test_checkbox_input_component_renders(): void
    {
        $view = $this->blade(
            '<x-checkbox-input name="accept" label="Accept terms" />'
        );

        $view->assertSee('Accept terms');
        $view->assertSee('name="accept"', false);
        $view->assertSee('type="checkbox"', false);
        $view->assertSee('class="form-check-input"', false);
    }

    /**
     * Test that the CheckboxInput component renders with checked state
     */
    public function test_checkbox_input_component_with_checked(): void
    {
        $view = $this->blade(
            '<x-checkbox-input name="subscribe" label="Subscribe" :checked="true" />'
        );

        $view->assertSee('Subscribe');
        $view->assertSee('checked', false);
    }

    /**
     * Test that the CheckboxInput component renders with disabled state
     */
    public function test_checkbox_input_component_with_disabled(): void
    {
        $view = $this->blade(
            '<x-checkbox-input name="disabled_option" label="Disabled Option" :disabled="true" />'
        );

        $view->assertSee('Disabled Option');
        $view->assertSee('disabled', false);
    }

    /**
     * Test that the CheckboxInput component renders with value
     */
    public function test_checkbox_input_component_with_value(): void
    {
        $view = $this->blade(
            '<x-checkbox-input name="option" label="Option 1" value="option1" />'
        );

        $view->assertSee('Option 1');
        $view->assertSee('value="option1"', false);
    }

    /**
     * Test that the CheckboxInput component renders inline
     */
    public function test_checkbox_input_component_inline(): void
    {
        $view = $this->blade(
            '<x-checkbox-input name="inline_option" label="Inline" :inline="true" />'
        );

        $view->assertSee('Inline');
        $view->assertSee('form-check-inline', false);
    }

    /**
     * Test that the CheckboxInput component renders with description
     */
    public function test_checkbox_input_component_with_description(): void
    {
        $view = $this->blade(
            '<x-checkbox-input name="with_desc" label="Option" description="This is a description" />'
        );

        $view->assertSee('Option');
        $view->assertSee('This is a description');
        $view->assertSee('class="form-check-description"', false);
    }

    /**
     * Test that the CheckboxInput component renders without label
     */
    public function test_checkbox_input_component_without_label(): void
    {
        $view = $this->blade(
            '<x-checkbox-input name="no_label" />'
        );

        $view->assertDontSee('<span class="form-check-label">', false);
        $view->assertSee('name="no_label"', false);
        $view->assertSee('type="checkbox"', false);
    }

    /**
     * Test that the CheckboxInput component renders both checked and disabled
     */
    public function test_checkbox_input_component_checked_and_disabled(): void
    {
        $view = $this->blade(
            '<x-checkbox-input name="both" label="Both" :checked="true" :disabled="true" />'
        );

        $view->assertSee('Both');
        $view->assertSee('checked', false);
        $view->assertSee('disabled', false);
    }
}
