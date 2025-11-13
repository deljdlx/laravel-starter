            <div class="mb-3">
              <label class="form-label">Datalist example</label>
              <input class="form-control" list="datalistOptions" placeholder="Type to search..." />
              <datalist id="datalistOptions">
                <option value="Andorra" />
                <option value="United Arab Emirates" />
                <option value="Afghanistan" />
                <option value="Antigua" />
                <option value="Anguilla" />
                <option value="Armenia" />
                <option value="Angolan" />
                <option value="Antarctica" />
                <option value="Argentina" />
                <option value="American Samoa" />
              </datalist>
            </div>
            <div class="mb-3">
              <label class="form-label">Range input</label>
              <input type="range" class="form-range mb-2" value="40" min="0" max="100" step="10" />
              <div class="form-range mb-2" id="range-simple"></div>
              <div class="form-range mb-2" id="range-connect"></div>
              <div class="form-range mb-2 text-green" id="range-color">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Datepicker</label>
              <input class="form-control mb-2" placeholder="Select a date" id="datepicker-default" value="2020-06-20" />
              <div class="input-icon mb-2">
                <input class="form-control" placeholder="Select a date" id="datepicker-icon" value="2020-06-20" />
                <span class="input-icon-addon"><!-- Download SVG icon from http://tabler.io/icons/icon/calendar -->
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-1">
                    <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                    <path d="M16 3v4" />
                    <path d="M8 3v4" />
                    <path d="M4 11h16" />
                    <path d="M11 15h1" />
                    <path d="M12 15v3" />
                  </svg></span>
              </div>
              <div class="input-icon">
                <span class="input-icon-addon"><!-- Download SVG icon from http://tabler.io/icons/icon/calendar -->
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-1">
                    <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                    <path d="M16 3v4" />
                    <path d="M8 3v4" />
                    <path d="M4 11h16" />
                    <path d="M11 15h1" />
                    <path d="M12 15v3" />
                  </svg></span>
                <input class="form-control" placeholder="Select a date" id="datepicker-icon-prepend"
                  value="2020-06-20" />
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Inline datepicker</label>
              <div class="datepicker-inline" id="datepicker-inline"></div>
            </div>
            <div class="mb-3">
              <label class="form-label">Progress</label>
              <div class="progress progress-1 mb-2">
                <div class="progress-bar" style="width: 38%" role="progressbar" aria-valuenow="38" aria-valuemin="0"
                  aria-valuemax="100" aria-label="38% Complete">
                  <span class="visually-hidden">38% Complete</span>
                </div>
              </div>
              <div class="progress progress-2">
                <div class="progress-bar progress-bar-indeterminate bg-green">
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Form buttons</label>
              <div class="row">
                <div class="col">
                  <a href="#" class="btn btn-4 w-100">
                    <!-- Download SVG icon from http://tabler.io/icons/icon/brand-github -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="icon text-github icon-2">
                      <path
                        d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5" />
                    </svg>
                    Login with Github
                  </a>
                </div>
                <div class="col">
                  <a href="#" class="btn btn-4 w-100">
                    <!-- Download SVG icon from http://tabler.io/icons/icon/brand-x -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="icon text-x icon-2">
                      <path d="M4 4l11.733 16h4.267l-11.733 -16z" />
                      <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" />
                    </svg>
                    Login with X
                  </a>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Tags input</label>
              <select class="form-select" placeholder="Select tags" id="select-tags" value="" multiple>
                <option value="HTML">HTML</option>
                <option value="JavaScript">JavaScript</option>
                <option value="CSS">CSS</option>
                <option value="jQuery">jQuery</option>
                <option value="Bootstrap">Bootstrap</option>
                <option value="Ruby">Ruby</option>
                <option value="Python">Python</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Advanced select</label>
              <select class="form-select" id="select-users" value="">
                <option value="1">Chuck Tesla</option>
                <option value="2">Elon Musk</option>
                <option value="3">Paweł Kuna</option>
                <option value="4">Nikola Tesla</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Advanced select with
                optgroup</label>
              <select class="form-select" id="select-optgroups" value="">
                <optgroup label="Tags">
                  <option value="HTML">HTML</option>
                  <option value="JavaScript">JavaScript</option>
                  <option value="CSS">CSS</option>
                  <option value="jQuery">jQuery</option>
                  <option value="Bootstrap">Bootstrap</option>
                  <option value="Ruby">Ruby</option>
                  <option value="Python">Python</option>
                </optgroup>
                <optgroup label="People">
                  <option value="Chuck Tesla">Chuck Tesla</option>
                  <option value="Elon Musk">Elon Musk</option>
                  <option value="Paweł Kuna">Paweł Kuna</option>
                  <option value="Nikola Tesla">Nikola Tesla</option>
                </optgroup>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Select with avatars</label>
              <select class="form-select" id="select-people" value="">
                <option value="1" data-custom-properties="&lt;span class=&#34;avatar avatar-xs&#34; style=&#34;background-image: url(./static/avatars/000m.jpg)&#34;&gt;
&lt;/span&gt;">
                  Paweł Kuna
                </option>
                <option value="2" data-custom-properties="&lt;span class=&#34;avatar avatar-xs&#34; style=&#34;background-image: url(./static/avatars/052f.jpg)&#34;&gt;
&lt;/span&gt;">
                  Jeffie Lewzey
                </option>
                <option value="3" data-custom-properties="&lt;span class=&#34;avatar avatar-xs&#34; style=&#34;background-image: url(./static/avatars/002m.jpg)&#34;&gt;
&lt;/span&gt;">
                  Mallory Hulme
                </option>
                <option value="4" data-custom-properties="&lt;span class=&#34;avatar avatar-xs&#34; style=&#34;background-image: url(./static/avatars/003m.jpg)&#34;&gt;
&lt;/span&gt;">
                  Dunn Slane
                </option>
                <option value="5" data-custom-properties="&lt;span class=&#34;avatar avatar-xs&#34; style=&#34;background-image: url(./static/avatars/000f.jpg)&#34;&gt;
&lt;/span&gt;">
                  Emmy Levet
                </option>
                <option value="6" data-custom-properties="&lt;span class=&#34;avatar avatar-xs&#34; style=&#34;background-image: url(./static/avatars/001f.jpg)&#34;&gt;
&lt;/span&gt;">
                  Maryjo Lebarree
                </option>
                <option value="7" data-custom-properties="&lt;span class=&#34;avatar avatar-xs&#34; style=&#34;background-image: url(./static/avatars/004m.jpg)&#34;&gt;
&lt;/span&gt;">
                  Egan Poetz
                </option>
                <option value="8" data-custom-properties="&lt;span class=&#34;avatar avatar-xs&#34; style=&#34;background-image: url(./static/avatars/002f.jpg)&#34;&gt;
&lt;/span&gt;">
                  Kellie Skingley
                </option>
                <option value="9" data-custom-properties="&lt;span class=&#34;avatar avatar-xs&#34; style=&#34;background-image: url(./static/avatars/003f.jpg)&#34;&gt;
&lt;/span&gt;">
                  Christabel Charlwood
                </option>
                <option value="10" data-custom-properties="&lt;span class=&#34;avatar avatar-xs&#34; style=&#34;background-image: url(./static/avatars/063m.jpg)&#34;&gt;
&lt;/span&gt;">
                  Haskel Shelper
                </option>
                <option value="11" data-custom-properties="&lt;span class=&#34;avatar avatar-xs&#34; style=&#34;background-image: url(./static/avatars/006m.jpg)&#34;&gt;
&lt;/span&gt;">
                  Lorry Mion
                </option>
                <option value="12" data-custom-properties="&lt;span class=&#34;avatar avatar-xs&#34; style=&#34;background-image: url(./static/avatars/004f.jpg)&#34;&gt;
&lt;/span&gt;">
                  Leesa Beaty
                </option>
                <option value="13" data-custom-properties="&lt;span class=&#34;avatar avatar-xs&#34; style=&#34;background-image: url(./static/avatars/007m.jpg)&#34;&gt;
&lt;/span&gt;">
                  Perren Keemar
                </option>
                <option value="14" data-custom-properties="&lt;span class=&#34;avatar avatar-xs&#34;&gt;
SA
&lt;/span&gt;">
                  Sunny Airey
                </option>
                <option value="15" data-custom-properties="&lt;span class=&#34;avatar avatar-xs&#34; style=&#34;background-image: url(./static/avatars/009m.jpg)&#34;&gt;
&lt;/span&gt;">
                  Geoffry Flaunders
                </option>
                <option value="16" data-custom-properties="&lt;span class=&#34;avatar avatar-xs&#34; style=&#34;background-image: url(./static/avatars/010m.jpg)&#34;&gt;
&lt;/span&gt;">
                  Thatcher Keel
                </option>
                <option value="17" data-custom-properties="&lt;span class=&#34;avatar avatar-xs&#34; style=&#34;background-image: url(./static/avatars/005f.jpg)&#34;&gt;
&lt;/span&gt;">
                  Dyann Escala
                </option>
                <option value="18" data-custom-properties="&lt;span class=&#34;avatar avatar-xs&#34; style=&#34;background-image: url(./static/avatars/006f.jpg)&#34;&gt;
&lt;/span&gt;">
                  Avivah Mugleston
                </option>
                <option value="19" data-custom-properties="&lt;span class=&#34;avatar avatar-xs&#34;&gt;
AA
&lt;/span&gt;">
                  Arlie Armstead
                </option>
                <option value="20" data-custom-properties="&lt;span class=&#34;avatar avatar-xs&#34; style=&#34;background-image: url(./static/avatars/008f.jpg)&#34;&gt;
&lt;/span&gt;">
                  Tessie Curzon
                </option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Select with flags</label>
              <select class="form-select" id="select-countries" value="">
                <option value="pl"
                  data-custom-properties="&lt;span class=&#34;flag flag-xs flag-country-pl&#34;&gt;&lt;/span&gt;">
                  Poland
                </option>
                <option value="de"
                  data-custom-properties="&lt;span class=&#34;flag flag-xs flag-country-de&#34;&gt;&lt;/span&gt;">
                  Germany
                </option>
                <option value="cz"
                  data-custom-properties="&lt;span class=&#34;flag flag-xs flag-country-cz&#34;&gt;&lt;/span&gt;">
                  Czech Republic
                </option>
                <option value="br"
                  data-custom-properties="&lt;span class=&#34;flag flag-xs flag-country-br&#34;&gt;&lt;/span&gt;">
                  Brazil
                </option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Select with labels</label>
              <select class="form-select" id="select-labels" value="">
                <option value="copy"
                  data-custom-properties="&lt;span class=&#34;badge bg-primary-lt&#34;&gt;cmd + C&lt;/span&gt;">
                  Copy</option>
                <option value="paste"
                  data-custom-properties="&lt;span class=&#34;badge bg-primary-lt&#34;&gt;cmd + V&lt;/span&gt;">
                  Paste
                </option>
                <option value="cut"
                  data-custom-properties="&lt;span class=&#34;badge bg-primary-lt&#34;&gt;cmd + X&lt;/span&gt;">
                  Cut</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Advanced select with validation
                state</label>
              <select class="form-select mb-3 is-valid" id="select-countries-valid" value="">
                <option value="pl">Poland</option>
                <option value="de">Germany</option>
                <option value="cz">Czech Republic</option>
                <option value="br">Brazil</option>
              </select>
              <select class="form-select is-invalid" id="select-countries-invalid" value="">
                <option value="pl">Poland</option>
                <option value="de">Germany</option>
                <option value="cz">Czech Republic</option>
                <option value="br">Brazil</option>
              </select>
            </div>
