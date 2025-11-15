<form>
    <div class="mb-3">
        <div class="row">
            <div class="col-auto">
                <span class="avatar avatar-md" style="background-image: url(https://picsum.photos/100/100)">
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
    <x-text-input label="Email-Address" name="email-address" placeholder="your-email@domain.com" type="email" />
    <x-text-input label="Password" name="password" type="password" value="password" />

    <div>
        <a href="#" class="btn btn-primary btn-2"> Save </a>
    </div>
</form>
