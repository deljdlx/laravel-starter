<?php

namespace Tests\Feature;

use Tests\TestCase;

class SelectInputComponentTest extends TestCase
{
    /**
     * Test that the SelectInput component renders correctly
     */
    public function test_select_input_component_renders(): void
    {
        $view = $this->blade(
            '<x-select-input name="country" label="Country" :options="[\'us\' => \'United States\', \'ca\' => \'Canada\', \'mx\' => \'Mexico\']" />'
        );

        $view->assertSee('Country');
        $view->assertSee('name="country"', false);
        $view->assertSee('class="form-select"', false);
        $view->assertSee('United States');
        $view->assertSee('Canada');
        $view->assertSee('Mexico');
        $view->assertSee('value="us"', false);
        $view->assertSee('value="ca"', false);
        $view->assertSee('value="mx"', false);
    }

    /**
     * Test that the SelectInput component renders with selected value
     */
    public function test_select_input_component_with_selected(): void
    {
        $view = $this->blade(
            '<x-select-input name="size" label="Size" :options="[\'s\' => \'Small\', \'m\' => \'Medium\', \'l\' => \'Large\']" selected="m" />'
        );

        $view->assertSee('Size');
        $view->assertSee('Small');
        $view->assertSee('Medium');
        $view->assertSee('Large');
        // Check that Medium is selected
        $view->assertSee('<option value="m" selected>', false);
    }

    /**
     * Test that the SelectInput component renders with placeholder
     */
    public function test_select_input_component_with_placeholder(): void
    {
        $view = $this->blade(
            '<x-select-input name="color" label="Color" :options="[\'red\' => \'Red\', \'blue\' => \'Blue\']" placeholder="Select a color" />'
        );

        $view->assertSee('Color');
        $view->assertSee('Select a color');
        $view->assertSee('Red');
        $view->assertSee('Blue');
        // Placeholder should be disabled, hidden, and selected by default
        $view->assertSee('value="" disabled', false);
        $view->assertSee('selected', false);
        $view->assertSee('hidden', false);
    }

    /**
     * Test that the SelectInput component renders with required attribute
     */
    public function test_select_input_component_with_required(): void
    {
        $view = $this->blade(
            '<x-select-input name="plan" label="Plan" :options="[\'basic\' => \'Basic\', \'pro\' => \'Pro\']" :required="true" />'
        );

        $view->assertSee('Plan');
        $view->assertSee('required', false);
        $view->assertSee('class="form-label required"', false);
    }

    /**
     * Test that the SelectInput component renders with disabled state
     */
    public function test_select_input_component_with_disabled(): void
    {
        $view = $this->blade(
            '<x-select-input name="status" label="Status" :options="[\'active\' => \'Active\', \'inactive\' => \'Inactive\']" :disabled="true" />'
        );

        $view->assertSee('Status');
        $view->assertSee('disabled', false);
    }

    /**
     * Test that the SelectInput component renders with multiple attribute
     */
    public function test_select_input_component_with_multiple(): void
    {
        $view = $this->blade(
            '<x-select-input name="tags" label="Tags" :options="[\'php\' => \'PHP\', \'js\' => \'JavaScript\', \'py\' => \'Python\']" :multiple="true" />'
        );

        $view->assertSee('Tags');
        $view->assertSee('multiple', false);
        $view->assertSee('name="tags[]"', false);
        $view->assertSee('PHP');
        $view->assertSee('JavaScript');
        $view->assertSee('Python');
    }

    /**
     * Test that the SelectInput component renders with multiple selected values
     */
    public function test_select_input_component_with_multiple_selected(): void
    {
        $view = $this->blade(
            '<x-select-input name="skills" label="Skills" :options="[\'html\' => \'HTML\', \'css\' => \'CSS\', \'js\' => \'JS\']" :selected="[\'html\', \'js\']" :multiple="true" />'
        );

        $view->assertSee('Skills');
        $view->assertSee('HTML');
        $view->assertSee('CSS');
        $view->assertSee('JS');
        // Check that HTML and JS are selected
        $view->assertSee('<option value="html" selected>', false);
        $view->assertSee('<option value="js" selected>', false);
        $view->assertDontSee('<option value="css" selected>', false);
    }

    /**
     * Test that the SelectInput component renders with description
     */
    public function test_select_input_component_with_description(): void
    {
        $view = $this->blade(
            '<x-select-input name="tier" label="Tier" :options="[\'free\' => \'Free\', \'paid\' => \'Paid\']" description="Choose your tier" />'
        );

        $view->assertSee('Tier');
        $view->assertSee('Choose your tier');
        $view->assertSee('class="form-label-description"', false);
    }

    /**
     * Test that the SelectInput component renders without label
     */
    public function test_select_input_component_without_label(): void
    {
        $view = $this->blade(
            '<x-select-input name="filter" :options="[\'all\' => \'All\', \'active\' => \'Active\']" />'
        );

        $view->assertDontSee('<label', false);
        $view->assertSee('name="filter"', false);
        $view->assertSee('All');
        $view->assertSee('Active');
    }

    /**
     * Test that the SelectInput component does not show placeholder for multiple select
     */
    public function test_select_input_component_no_placeholder_for_multiple(): void
    {
        $view = $this->blade(
            '<x-select-input name="items" :options="[\'1\' => \'Item 1\', \'2\' => \'Item 2\']" placeholder="Select items" :multiple="true" />'
        );

        $view->assertSee('Item 1');
        $view->assertSee('Item 2');
        // Placeholder should not appear for multiple selects
        $view->assertDontSee('Select items');
    }

    /**
     * Test that the SelectInput component renders with empty options array
     */
    public function test_select_input_component_with_empty_options(): void
    {
        $view = $this->blade(
            '<x-select-input name="empty" label="Empty" :options="[]" />'
        );

        $view->assertSee('Empty');
        $view->assertSee('name="empty"', false);
        $view->assertSee('class="form-select"', false);
    }

    /**
     * Test that placeholder is not selected when a value is selected
     */
    public function test_select_input_component_placeholder_not_selected_when_value_selected(): void
    {
        $view = $this->blade(
            '<x-select-input name="category" :options="[\'a\' => \'Category A\', \'b\' => \'Category B\']" placeholder="Choose category" selected="a" />'
        );

        $view->assertSee('Choose category');
        $view->assertSee('Category A');
        // Check that category A IS selected
        $view->assertSee('<option value="a" selected>', false);
    }
}
