<form action="https://httpbin.org/post" method="post" class="card">
  <div class="card-header">
    <h4 class="card-title">Form elements</h4>
  </div>
  <div class="card-body">
    <div class="row g-5">
      <div class="col-xl-4">
        <div class="row">
          <div class="col-md-6 col-xl-12">
            @include('form-partials.basic-inputs')
            @include('form-partials.select-inputs')
            @include('form-partials.input-groups')
            @include('form-partials.icon-inputs')
            @include('form-partials.separated-inputs')
          </div>
          <div class="col-md-6 col-xl-12">
            @include('form-partials.form-control-variants')
            @include('form-partials.input-addons')
            @include('form-partials.floating-inputs')
          </div>
        </div>
      </div>
      <div class="col-xl-4">
        <div class="row">
          <div class="col-md-6 col-xl-12">
            @include('form-partials.image-check')
            @include('form-partials.color-inputs')
            @include('form-partials.validation-states')
            @include('form-partials.form-fieldset')
          </div>
          <div class="col-md-6 col-xl-12">
            @include('form-partials.selectgroups-buttons')
          </div>
        </div>
      </div>
      <div class="col-xl-4">
        <div class="row">
          <div class="col-md-6 col-xl-12">
            @include('form-partials.radios-checkboxes')
            @include('form-partials.file-date-masks')
          </div>
          <div class="col-md-6 col-xl-12">
            @include('form-partials.datalist-advanced-selects')
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card-footer text-end">
    <div class="d-flex">
      <a href="#" class="btn btn-link">Cancel</a>
      <button type="submit" class="btn btn-primary ms-auto">Send data</button>
    </div>
  </div>
</form>
@include('form-partials.additional-forms')
