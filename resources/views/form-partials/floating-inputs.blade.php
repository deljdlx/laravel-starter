<div class="mb-3">
  <label class="form-label">Floating inputs</label>
  <div class="form-floating mb-3">
    <input type="email" class="form-control" id="floating-input" value="name@example.com"
      autocomplete="off" />
    <label for="floating-input">Email address</label>
  </div>
  <div class="form-floating mb-3">
    <input type="password" class="form-control" id="floating-password" value="Password"
      autocomplete="off" />
    <label for="floating-password">Password</label>
  </div>

    <x-select-input
      name="floating_select"
      id="floatingSelect"
      label="Floating label select example"
      placeholder="Open this select menu"
      :options="['1' => 'One', '2' => 'Two', '3' => 'Three']"
      :floating="true"
    />
</div>
