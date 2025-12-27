<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Alpine.js Examples - {{ config('app.name') }}</title>
    <meta name="msapplication-TileColor" content="#0f172a" />
    <meta name="theme-color" content="#0f172a" />
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    @vite(['resources/css/app.css', 'resources/css/design-system.css'])
</head>
<body>
    <div class="page">
        @include('mocks.header')
        @include('mocks.navbar')
        <div class="page-wrapper">
            @include('mocks.page-header')
            <div class="page-body">
                <div class="container-xl">
                    <div class="mb-4">
                        <a href="{{ route('demo.components') }}" class="btn btn-outline-secondary btn-sm">
                            ← Back to Components
                        </a>
                    </div>
                    
                    <h2 class="page-title mb-3">Alpine.js Interactive Examples</h2>
                    
                    <div class="row row-deck row-cards">
                        <div class="col-lg-4">
                            <x-card title="Click Counter">
                                <div x-data="{ count: 0 }">
                                    <div class="text-center mb-3">
                                        <div class="display-3 ds-font-bold" x-text="count"></div>
                                        <p class="text-secondary">clicks</p>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <button @click="count++" class="ds-btn ds-btn-primary">Increment</button>
                                        <button @click="count = 0" class="ds-btn ds-btn-secondary">Reset</button>
                                    </div>
                                </div>
                            </x-card>
                        </div>

                        <div class="col-lg-4">
                            <x-card title="Toggle Visibility">
                                <div x-data="{ open: false }">
                                    <button @click="open = !open" class="ds-btn ds-btn-primary mb-3 w-100">
                                        <span x-show="!open">Show Content</span>
                                        <span x-show="open">Hide Content</span>
                                    </button>
                                    <div x-show="open" x-transition class="ds-card">
                                        <p class="mb-0">🎉 This content is toggled with Alpine.js!</p>
                                    </div>
                                </div>
                            </x-card>
                        </div>

                        <div class="col-lg-4">
                            <x-card title="Two-Way Binding">
                                <div x-data="{ message: 'Hello Alpine!' }">
                                    <input type="text" x-model="message" class="form-control mb-3" placeholder="Type something...">
                                    <div class="ds-card">
                                        <p class="ds-text-sm ds-text-secondary mb-1">You typed:</p>
                                        <p class="ds-font-bold mb-0" x-text="message"></p>
                                    </div>
                                </div>
                            </x-card>
                        </div>

                        <div class="col-lg-6">
                            <x-card title="Dynamic List">
                                <div x-data="{ items: ['Alpine.js', 'Laravel', 'Tabler'], newItem: '' }">
                                    <div class="input-group mb-3">
                                        <input type="text" x-model="newItem" @keyup.enter="items.push(newItem); newItem = ''" class="form-control" placeholder="Add item...">
                                        <button @click="items.push(newItem); newItem = ''" class="btn btn-primary" :disabled="!newItem">Add</button>
                                    </div>
                                    <ul class="list-group">
                                        <template x-for="(item, index) in items" :key="index">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span x-text="item"></span>
                                                <button @click="items.splice(index, 1)" class="btn btn-sm btn-outline-danger">Remove</button>
                                            </li>
                                        </template>
                                    </ul>
                                </div>
                            </x-card>
                        </div>

                        <div class="col-lg-6">
                            <x-card title="Color Picker">
                                <div x-data="{ color: '#a855f7' }">
                                    <input type="color" x-model="color" class="form-control form-control-color mb-3">
                                    <div class="p-4 rounded text-center" :style="`background-color: ${color}`">
                                        <code class="text-white" x-text="color"></code>
                                    </div>
                                </div>
                            </x-card>
                        </div>
                    </div>
                </div>
            </div>
            @include('mocks.footer')
        </div>
    </div>
    @include('mocks.modals')
    @include('mocks.settings')
    @vite('resources/js/app.js')
</body>
</html>
