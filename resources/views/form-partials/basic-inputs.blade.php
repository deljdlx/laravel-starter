<div class="mb-3">
  <label class="form-label">Static</label>
  <div class="form-control-plaintext">Input value</div>
</div>
<x-text-input label="Text" name="example-text-input" placeholder="Input placeholder" />
<x-text-input label="Password" name="example-password-input" type="password" placeholder="Input placeholder" />
<x-text-input label="Disabled" name="example-disabled-input" placeholder="Disabled..." value="Well, she turned me into a newt." :disabled="true" />
<x-text-input label="Readonly" name="example-readonly-input" placeholder="Readonly..." value="Well, how'd you become king, then?" :readonly="true" />
<x-text-input label="Required" name="example-required-input" placeholder="Required..." :required="true" />
<div class="mb-3">
  <label class="form-label">Textarea <span class="form-label-description">56/100</span></label>
  <textarea class="form-control" name="example-textarea-input" rows="6" placeholder="Content..">
Oh! Come and see the violence inherent in the system! Help, help, I'm being repressed! We shall say 'Ni' again to you, if you do not appease us. I'm not a witch. I'm not a witch. Camelot!</textarea>
</div>
