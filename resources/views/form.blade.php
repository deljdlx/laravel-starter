<x-row class="gx-0">
    <x-col class="col-xl-6">
        <x-card title="Basic inputs" class="m-2">
            @include('form-partials.basic-inputs')
        </x-card>
    </x-col>

    <x-col class="col-xl-6">
        <x-card title="Select inputs" class="m-2">
            @include('form-partials.select-inputs')
        </x-card>

        <x-card title="Input groups" class="m-2">
            @include('form-partials.input-groups')
        </x-card>
    </x-col>
</x-row>


<x-row class="gx-0">
    <x-col class="col-xl-7">
        <x-card title="Input addons" class="m-2">
            @include('form-partials.input-addons')
        </x-card>

        <x-card title="Color inputs" class="m-2">
            @include('form-partials.color-inputs')
        </x-card>
    </x-col>

    <x-col class="col-xl-5">
        <x-card title="Form control variants" class="m-2">
            @include('form-partials.form-control-variants')
        </x-card>

        <x-card title="Floating labels" class="m-2">
            @include('form-partials.floating-inputs')
        </x-card>

        <x-card title="Icon inputs" class="m-2">
            @include('form-partials.icon-inputs')
        </x-card>

        <x-card title="Separated inputs" class="m-2">
            @include('form-partials.separated-inputs')
        </x-card>
    </x-col>
</x-row>



<x-row class="gx-0">
    <x-col class="col-xl-6">
        <x-card title="Image check inputs" class="m-2">
            @include('form-partials.image-check')
        </x-card>
    </x-col>

    <x-col class="col-xl-6">
        <x-card title="Validation states" class="m-2">
            @include('form-partials.validation-states')
        </x-card>
    </x-col>
</x-row>


<x-row class="gx-0">
    <x-col class="col-xl-6">
        <x-card title="Select groups & buttons" class="m-2">
            @include('form-partials.selectgroups-buttons')
        </x-card>
    </x-col>

    <x-col class="col-xl-6">
        <x-card title="Radios & checkboxes" class="m-2">
            @include('form-partials.radios-checkboxes')
        </x-card>

        <x-card title="File date masks" class="m-2">
            @include('form-partials.file-date-masks')
        </x-card>
    </x-col>
</x-row>





<x-row class="gx-0">
    <x-col class="col-xl-12">
        <x-card title="Datalist & advanced selects" class="m-2">
            @include('form-partials.datalist-advanced-selects')
        </x-card>
    </x-col>
</x-row>



<div class="card-footer text-end">
    <div class="d-flex">
        <a href="#" class="btn btn-link">Cancel</a>
        <button type="submit" class="btn btn-primary ms-auto">Send data</button>
    </div>
</div>



@include('form-partials.additional-forms')
