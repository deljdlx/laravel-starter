<form class="card">
  <div class="card-body">
    <div class="row row-cards">
      <div class="col-md-5">
        <x-text-input label="Company" name="company" placeholder="Company" value="Creative Code Inc." :disabled="true" />
      </div>
      <div class="col-sm-6 col-md-3">
        <x-text-input label="Username" name="username" placeholder="Username" value="michael23" />
      </div>
      <div class="col-sm-6 col-md-4">
        <x-text-input label="Email address" name="email" type="email" placeholder="Email" />
      </div>
      <div class="col-sm-6 col-md-6">
        <x-text-input label="First Name" name="first-name" placeholder="Company" value="Chet" />
      </div>
      <div class="col-sm-6 col-md-6">
        <x-text-input label="Last Name" name="last-name" placeholder="Last Name" value="Faker" />
      </div>
      <div class="col-md-12">
        <x-text-input label="Address" name="address" placeholder="Home Address" value="Melbourne, Australia" />
      </div>
      <div class="col-sm-6 col-md-4">
        <x-text-input label="City" name="city" placeholder="City" value="Melbourne" />
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="mb-3">
          <label class="form-label">Postal Code</label>
          <input type="test" class="form-control" placeholder="ZIP Code" />
        </div>
      </div>
      <div class="col-md-5">
        <x-select-input 
            name="country" 
            label="Country" 
            :options="['de' => 'Germany']" 
            value="de" 
        />
      </div>
      <div class="col-md-12">
        <div class="mb-3 mb-0">
          <label class="form-label">About Me</label>
          <textarea rows="5" class="form-control" placeholder="Here can be your description" value="Mike">
Oh so, your weak rhyme
You doubt I'll bother, reading into it
I'll probably won't, left to my own devices
But that's the difference in our opinions.</textarea>
        </div>
      </div>
    </div>
  </div>
  <div class="card-footer text-end">
    <button type="submit" class="btn btn-primary">Update Profile</button>
  </div>
</form>
