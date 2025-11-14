<div class="mb-3">
  <div class="form-label">Radios</div>
  <div>
    <x-radio-input name="radios" value="1" label="Option 1" :checked="true" />
    <x-radio-input name="radios" value="2" label="Option 2" />
    <x-radio-input name="radios" value="3" label="Option 3" :disabled="true" />
    <x-radio-input name="radios" value="4" label="Option 4" :checked="true" :disabled="true" />
  </div>
</div>
<div class="mb-3">
  <div class="form-label">Inline Radios</div>
  <div>
    <x-radio-input name="radios-inline" value="1" label="Option 1" :checked="true" :inline="true" />
    <x-radio-input name="radios-inline" value="2" label="Option 2" :inline="true" />
    <x-radio-input name="radios-inline" value="3" label="Option 3" :disabled="true" :inline="true" />
  </div>
</div>
<div class="mb-3">
  <div class="form-label">Checkboxes</div>
  <div>
    <x-checkbox-input name="checkbox1" label="Checkbox input" />
    <x-checkbox-input name="checkbox2" label="Disabled checkbox input" :disabled="true" />
    <x-checkbox-input name="checkbox3" label="Checked checkbox input" :checked="true" />
  </div>
</div>
<div class="mb-3">
  <div class="form-label">Inline Checkboxes</div>
  <div>
    <x-checkbox-input name="inline-checkbox1" label="Option 1" :inline="true" />
    <x-checkbox-input name="inline-checkbox2" label="Option 2" :disabled="true" :inline="true" />
    <x-checkbox-input name="inline-checkbox3" label="Option 3" :checked="true" :inline="true" />
  </div>
</div>
<div class="mb-3">
  <label class="form-label">Checkboxes with description</label>
  <x-checkbox-input name="desc-checkbox1" label="Default checkbox" description="Lorem ipsum dolor sit amet, consectetur adipisicing elit." />
  <x-checkbox-input name="desc-checkbox2" label="Longer checkbox item that wraps on to two separate lines" description="Ab alias aut, consequuntur cumque esse eveniet incidunt laborum minus molestiae." />
  <x-checkbox-input name="desc-checkbox3" label="Default checkbox without description" />
</div>
<div class="mb-3">
  <div class="form-label">Toggle switches</div>
  <label class="form-check form-switch form-switch-3">
    <input class="form-check-input" type="checkbox" checked />
    <span class="form-check-label">Option 1</span>
  </label>
  <label class="form-check form-switch form-switch-2">
    <input class="form-check-input" type="checkbox" />
    <span class="form-check-label">Option 2</span>
  </label>
  <label class="form-check form-switch form-switch-2">
    <input class="form-check-input" type="checkbox" />
    <span class="form-check-label">Option 3</span>
  </label>
</div>
<div class="mb-3">
  <div class="form-label">Single switch</div>
  <label class="form-check form-switch form-switch-2">
    <input class="form-check-input" type="checkbox" />
    <span class="form-check-label">I agree with terms and conditions</span>
  </label>
</div>
<div class="mb-3">
  <label class="form-label">Notification</label>
  <div class="divide-y">
    <div>
      <label class="row">
        <span class="col">Push Notifications</span>
        <span class="col-auto">
          <label class="form-check form-check-single form-switch">
            <input class="form-check-input" type="checkbox" checked />
          </label>
        </span>
      </label>
    </div>
    <div>
      <label class="row">
        <span class="col">SMS Notifications</span>
        <span class="col-auto">
          <label class="form-check form-check-single form-switch">
            <input class="form-check-input" type="checkbox" />
          </label>
        </span>
      </label>
    </div>
    <div>
      <label class="row">
        <span class="col">Email Notifications</span>
        <span class="col-auto">
          <label class="form-check form-check-single form-switch">
            <input class="form-check-input" type="checkbox" checked />
          </label>
        </span>
      </label>
    </div>
  </div>
</div>
