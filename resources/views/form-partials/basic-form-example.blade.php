<div>
  <div class="card-body">
    <div class="mb-3">
      <label class="form-label required">Email address</label>
      <div>
        <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" />
        <small class="form-hint">We'll never share your email with anyone
          else.</small>
      </div>
    </div>
    <div class="mb-3">
      <label class="form-label required">Password</label>
      <div>
        <input type="password" class="form-control" placeholder="Password" />
        <small class="form-hint">
          Your password must be 8-20 characters long, contain letters and numbers,
          and must not contain spaces, special characters, or emoji.
        </small>
      </div>
    </div>
    <x-select-input 
        name="select_example" 
        label="Select" 
        :options="[
            'option1' => 'Option 1',
            'option1-1' => 'Optgroup 1 - Option 1',
            'option1-2' => 'Optgroup 1 - Option 2',
            'option2' => 'Option 2',
            'option2-1' => 'Optgroup 2 - Option 1',
            'option2-2' => 'Optgroup 2 - Option 2',
            'option3-1' => 'Optgroup 3 - Option 1',
            'option3-2' => 'Optgroup 3 - Option 2',
            'option3' => 'Option 3',
            'option4' => 'Option 4'
        ]" 
    />
    <div class="mb-3">
      <label class="form-label">Checkboxes</label>
      <div>
        <label class="form-check">
          <input class="form-check-input" type="checkbox" checked />
          <span class="form-check-label">Option 1</span>
        </label>
        <label class="form-check">
          <input class="form-check-input" type="checkbox" />
          <span class="form-check-label">Option 2</span>
        </label>
        <label class="form-check">
          <input class="form-check-input" type="checkbox" disabled />
          <span class="form-check-label">Option 3</span>
        </label>
      </div>
    </div>
    <div class="text-end">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</div>
