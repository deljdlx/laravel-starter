<x-row class="gx-0">
  <x-col class="col-md-6">
    <x-card title="Additional Forms" class="m-2">
        @include('form-partials.project-id-form')
    </x-card>
    <x-card title="Basic form" class="m-2">
        @include('form-partials.basic-form-example')
    </x-card>
  </x-col>
  <x-col class="col-md-6">
    <x-card title="Node version form" class="m-2">
      @include('form-partials.nodejs-version-form')
    </x-card>
    <x-card title="Input mask" class="m-2">
      @include('form-partials.input-mask-form')
    </x-card>
  </x-col>
</x-row>



<x-row class="gx-0">
  <x-col class="col-md-6">
    <x-card title="My profile" class="m-2">
        @include('form-partials.my-profile-form')
    </x-card>
  </x-col>
  <x-col class="col-md-6">
    <x-card title="Edit profile" class="m-2">
      @include('form-partials.edit-profile-form')
    </x-card>
  </x-col>
</x-row>
