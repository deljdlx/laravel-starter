</div>
<div class="col-md-6">
  <div class="card">
    <div class="card-body">
      <h3 class="card-title">Project ID</h3>
      <p class="card-subtitle">Used when interacting with the API.</p>
      <div class="input-icon">
        <input type="text" value="prj_5ae74426fe935327a8fa178b07d84ad9" class="form-control" placeholder="Search…"
          readonly />
        <span class="input-icon-addon">
          <!-- Download SVG icon from http://tabler.io/icons/icon/files -->
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
            <path d="M15 3v4a1 1 0 0 0 1 1h4" />
            <path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" />
            <path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" />
          </svg>
        </span>
      </div>
    </div>
    <div class="card-footer">
      <div class="row align-items-center">
        <div class="col">Learn more about <a href="#">Project ID</a></div>
        <div class="col-auto">
          <a href="#" class="btn btn-primary btn-2"> Save </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-md-6">
  <div class="card">
    <div class="card-body">
      <h3 class="card-title">Node.js Version</h3>
      <p class="card-subtitle">
        The version of Node.js that is used in the Build Step and for Serverless
        Functions. A new Deployment is required for your changes to take
        effect.
      </p>
      <select class="form-select">
        <option>14.x</option>
        <option>12.x</option>
      </select>
    </div>
    <div class="card-footer">Learn more about <a href="#">Node.js Version</a>
    </div>
  </div>
</div>
<div class="col-md-6">
  <form class="card">
    <div class="card-header">
      <h3 class="card-title">Basic form</h3>
    </div>
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
      <div class="mb-3">
        <label class="form-label">Select</label>
        <div>
          <select class="form-select">
            <option>Option 1</option>
            <optgroup label="Optgroup 1">
              <option>Option 1</option>
              <option>Option 2</option>
            </optgroup>
            <option>Option 2</option>
            <optgroup label="Optgroup 2">
              <option>Option 1</option>
              <option>Option 2</option>
            </optgroup>
            <optgroup label="Optgroup 3">
              <option>Option 1</option>
              <option>Option 2</option>
            </optgroup>
            <option>Option 3</option>
            <option>Option 4</option>
          </select>
        </div>
      </div>
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
  </form>
</div>
<div class="col-lg-4">
  <div class="row row-cards">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Input mask</h3>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="text" name="input-mask" class="form-control" data-mask="00/00/0000" data-mask-visible="true"
              placeholder="00/00/0000" autocomplete="off" />
          </div>
          <div class="mb-3">
            <label class="form-label">Hour</label>
            <input type="text" name="input-mask" class="form-control" data-mask="00:00:00" data-mask-visible="true"
              placeholder="00:00:00" autocomplete="off" />
          </div>
          <div class="mb-3">
            <label class="form-label">Date &amp; Hour</label>
            <input type="text" name="input-mask" class="form-control" data-mask="00/00/0000 00:00:00"
              data-mask-visible="true" placeholder="00/00/0000 00:00:00" autocomplete="off" />
          </div>
          <div class="mb-3">
            <label class="form-label">ZIP Code</label>
            <input type="text" name="input-mask" class="form-control" data-mask="00000-000" data-mask-visible="true"
              placeholder="00000-000" autocomplete="off" />
          </div>
          <div class="mb-3">
            <label class="form-label">Money</label>
            <input type="text" name="input-mask" class="form-control" data-mask="000.000.000.000.000,00"
              data-mask-visible="true" placeholder="000.000.000.000.000,00" data-mask-reverse="true"
              autocomplete="off" />
          </div>
          <div class="mb-3">
            <label class="form-label">Telephone</label>
            <input type="text" name="input-mask" class="form-control" data-mask="0000-0000" data-mask-visible="true"
              placeholder="0000-0000" autocomplete="off" />
          </div>
          <div class="mb-3">
            <label class="form-label">Telephone with Code Area</label>
            <input type="text" name="input-mask" class="form-control" data-mask="(00) 0000-0000"
              data-mask-visible="true" placeholder="(00) 0000-0000" autocomplete="off" />
          </div>
          <div class="mb-3">
            <label class="form-label">IP Address</label>
            <input type="text" name="input-mask" class="form-control" data-mask="099.099.099.099"
              data-mask-visible="true" placeholder="000.000.000.000" autocomplete="off" />
          </div>
        </div>
      </div>
    </div>
    <div class="col-12">
      <form class="card">
        <div class="card-header">
          <h3 class="card-title">My Profile</h3>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <div class="row">
              <div class="col-auto">
                <span class="avatar avatar-md" style="background-image: url(./static/avatars/002m.jpg)">
                </span>
              </div>
              <div class="col">
                <div class="mb-3">
                  <label class="form-label">Email-Address</label>
                  <input class="form-control" placeholder="your-email@domain.com" />
                </div>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Bio</label>
            <textarea class="form-control" rows="5">Big belly rude boy, million dollar hustler. Unemployed.</textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Email-Address</label>
            <input class="form-control" placeholder="your-email@domain.com" />
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" value="password" />
          </div>
        </div>
        <div class="card-footer text-end">
          <a href="#" class="btn btn-primary btn-2"> Save </a>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="col-lg-8">
  <div class="row row-cards">
    <div class="col-12">
      <form class="card">
        <div class="card-body">
          <h3 class="card-title">Edit Profile</h3>
          <div class="row row-cards">
            <div class="col-md-5">
              <div class="mb-3">
                <label class="form-label">Company</label>
                <input type="text" class="form-control" disabled="" placeholder="Company" value="Creative Code Inc." />
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" placeholder="Username" value="michael23" />
              </div>
            </div>
            <div class="col-sm-6 col-md-4">
              <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" placeholder="Email" />
              </div>
            </div>
            <div class="col-sm-6 col-md-6">
              <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control" placeholder="Company" value="Chet" />
              </div>
            </div>
            <div class="col-sm-6 col-md-6">
              <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" placeholder="Last Name" value="Faker" />
              </div>
            </div>
            <div class="col-md-12">
              <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" placeholder="Home Address" value="Melbourne, Australia" />
              </div>
            </div>
            <div class="col-sm-6 col-md-4">
              <div class="mb-3">
                <label class="form-label">City</label>
                <input type="text" class="form-control" placeholder="City" value="Melbourne" />
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="mb-3">
                <label class="form-label">Postal Code</label>
                <input type="test" class="form-control" placeholder="ZIP Code" />
              </div>
            </div>
            <div class="col-md-5">
              <div class="mb-3">
                <label class="form-label">Country</label>
                <select class="form-control form-select">
                  <option value="">Germany</option>
                </select>
              </div>
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
    </div>
  </div>
</div>