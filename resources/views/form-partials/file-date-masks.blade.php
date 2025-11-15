<div>
    <div class="form-label">Custom File Input</div>
        <input type="file" class="form-control" />
    </div>
    <div class="mb-3">
        <label class="form-label">Date of birth</label>
        <div class="row g-2">
            <div class="col-5">
                <x-select-input name="user[month]" :options="[
                    '1' => 'January',
                    '2' => 'February',
                    '3' => 'March',
                    '4' => 'April',
                    '5' => 'May',
                    '6' => 'June',
                    '7' => 'July',
                    '8' => 'August',
                    '9' => 'September',
                    '10' => 'October',
                    '11' => 'November',
                    '12' => 'December',
                ]" value="3" placeholder="Month" />

            </div>
            <div class="col-3">
                <x-select-input name="user[day]" :options="array_combine(range(1, 31), range(1, 31))" value="15" placeholder="Day" />
            </div>
            <div class="col-4">
                <x-select-input name="user[year]" :options="array_combine(range(1900, date('Y')), range(1900, date('Y')))" value="1990" placeholder="Year" />
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Text mask</label>
        <input type="text" name="input-mask" class="form-control" data-mask="00/00/0000"
            data-mask-visible="true" placeholder="00/00/0000" autocomplete="off" />
    </div>
    <div class="mb-3">
        <label class="form-label">Telephone mask</label>
        <input type="text" name="input-mask" class="form-control" data-mask="(00) 0000-0000"
            data-mask-visible="true" placeholder="(00) 0000-0000" autocomplete="off" />
    </div>
    <div class="mb-3">
        <label class="form-label">Autosize textarea</label>
        <textarea class="form-control" data-bs-toggle="autosize" placeholder="Type something…"></textarea>
    </div>
</div>
