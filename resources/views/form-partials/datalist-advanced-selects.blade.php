<div>
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


    <x-text-input type="date" name="date_picker" label="Date picker" />

    <x-text-input type="color" name="color_picker" label="Color picker" value="#ff0000" />


    <div class="mb-3">
        <label class="form-label">Datepicker</label>
        <input type="date" class="form-control mb-2" placeholder="Select a date" id="datepicker-default" />
        <div class="input-icon mb-2">
            <input type="datetime-local" class="form-control" placeholder="Select a date" id="datepicker-icon"
                value="2020-06-20 12:00" />
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
            <input class="form-control" placeholder="Select a date" id="datepicker-icon-prepend" value="2020-06-20" />
        </div>
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon text-github icon-2">
                        <path
                            d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5" />
                    </svg>
                    Login with Github
                </a>
            </div>
            <div class="col">
                <a href="#" class="btn btn-4 w-100">
                    <!-- Download SVG icon from http://tabler.io/icons/icon/brand-x -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon text-x icon-2">
                        <path d="M4 4l11.733 16h4.267l-11.733 -16z" />
                        <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" />
                    </svg>
                    Login with X
                </a>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <x-select-input 
            name="tags" 
            label="Tags input" 
            id="select-tags" 
            :options="[
                'HTML' => 'HTML',
                'JavaScript' => 'JavaScript',
                'CSS' => 'CSS',
                'jQuery' => 'jQuery',
                'Bootstrap' => 'Bootstrap',
                'Ruby' => 'Ruby',
                'Python' => 'Python'
            ]" 
            :multiple="true" 
            class="tags" 
        />
    </div>
    <div class="mb-3">
        <x-select-input 
            name="users" 
            label="Advanced select" 
            id="select-users" 
            :options="[
                '1' => 'Chuck Tesla',
                '2' => 'Elon Musk',
                '3' => 'Paweł Kuna',
                '4' => 'Nikola Tesla'
            ]" 
        />
    </div>
    <div class="mb-3">
        <x-select-input 
            name="optgroups" 
            label="Advanced select with optgroup" 
            id="select-optgroups" 
            :options="[
                'HTML' => 'HTML',
                'JavaScript' => 'JavaScript',
                'CSS' => 'CSS',
                'jQuery' => 'jQuery',
                'Bootstrap' => 'Bootstrap',
                'Ruby' => 'Ruby',
                'Python' => 'Python',
                'Chuck Tesla' => 'Chuck Tesla',
                'Elon Musk' => 'Elon Musk',
                'Paweł Kuna' => 'Paweł Kuna',
                'Nikola Tesla' => 'Nikola Tesla'
            ]" 
        />
    </div>
    <div class="mb-3">
        <x-select-input 
            name="people" 
            label="Select with avatars" 
            id="select-people" 
            :options="[
                '1' => 'Paweł Kuna',
                '2' => 'Jeffie Lewzey',
                '3' => 'Mallory Hulme',
                '4' => 'Dunn Slane',
                '5' => 'Emmy Levet',
                '6' => 'Maryjo Lebarree',
                '7' => 'Egan Poetz',
                '8' => 'Kellie Skingley',
                '9' => 'Christabel Charlwood',
                '10' => 'Haskel Shelper',
                '11' => 'Lorry Mion',
                '12' => 'Leesa Beaty',
                '13' => 'Perren Keemar',
                '14' => 'Sunny Airey',
                '15' => 'Geoffry Flaunders',
                '16' => 'Thatcher Keel',
                '17' => 'Dyann Escala',
                '18' => 'Avivah Mugleston',
                '19' => 'Arlie Armstead',
                '20' => 'Tessie Curzon'
            ]" 
        />
    </div>
    <div class="mb-3">
        <x-select-input 
            name="countries" 
            label="Select with flags" 
            id="select-countries" 
            :options="[
                'pl' => 'Poland',
                'de' => 'Germany',
                'cz' => 'Czech Republic',
                'br' => 'Brazil'
            ]" 
        />
    </div>
    <div class="mb-3">
        <x-select-input 
            name="labels" 
            label="Select with labels" 
            id="select-labels" 
            :options="[
                'copy' => 'Copy',
                'paste' => 'Paste',
                'cut' => 'Cut'
            ]" 
        />
    </div>
    <div class="mb-3">
        <label class="form-label">Advanced select with validation state</label>
        <x-select-input 
            name="countries_valid" 
            id="select-countries-valid" 
            :options="[
                'pl' => 'Poland',
                'de' => 'Germany',
                'cz' => 'Czech Republic',
                'br' => 'Brazil'
            ]" 
            class="mb-3 is-valid" 
        />
        <x-select-input 
            name="countries_invalid" 
            id="select-countries-invalid" 
            :options="[
                'pl' => 'Poland',
                'de' => 'Germany',
                'cz' => 'Czech Republic',
                'br' => 'Brazil'
            ]" 
            class="is-invalid" 
        />
    </div>
</div>
