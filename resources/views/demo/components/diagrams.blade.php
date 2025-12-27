<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Mermaid Diagrams - {{ config('app.name') }}</title>
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
                    
                    <h2 class="page-title mb-3">Mermaid Diagram Examples</h2>
                    
                    <div class="row row-deck row-cards">
                        <div class="col-lg-6">
                            <x-card title="Flowchart Example">
                                <div class="mermaid">
                                    flowchart TD
                                        A[Start] --> B{Is it working?}
                                        B -->|Yes| C[Great!]
                                        B -->|No| D[Debug]
                                        D --> E[Fix Issue]
                                        E --> B
                                        C --> F[Deploy]
                                        F --> G[End]
                                </div>
                            </x-card>
                        </div>

                        <div class="col-lg-6">
                            <x-card title="Sequence Diagram Example">
                                <div class="mermaid">
                                    sequenceDiagram
                                        participant User
                                        participant Browser
                                        participant Server
                                        participant Database
                                        
                                        User->>Browser: Enter URL
                                        Browser->>Server: HTTP Request
                                        Server->>Database: Query Data
                                        Database-->>Server: Return Data
                                        Server-->>Browser: HTTP Response
                                        Browser-->>User: Display Page
                                </div>
                            </x-card>
                        </div>

                        <div class="col-lg-6">
                            <x-card title="Class Diagram Example">
                                <div class="mermaid">
                                    classDiagram
                                        class Animal {
                                            +String name
                                            +int age
                                            +makeSound()
                                            +move()
                                        }
                                        class Dog {
                                            +String breed
                                            +bark()
                                            +fetch()
                                        }
                                        class Cat {
                                            +String color
                                            +meow()
                                            +scratch()
                                        }
                                        Animal <|-- Dog
                                        Animal <|-- Cat
                                </div>
                            </x-card>
                        </div>

                        <div class="col-lg-6">
                            <x-card title="Entity Relationship Diagram">
                                <div class="mermaid">
                                    erDiagram
                                        USER ||--o{ ORDER : places
                                        ORDER ||--|{ ORDER_ITEM : contains
                                        PRODUCT ||--o{ ORDER_ITEM : "ordered in"
                                        
                                        USER {
                                            int id PK
                                            string name
                                            string email
                                        }
                                        ORDER {
                                            int id PK
                                            int user_id FK
                                            decimal total
                                        }
                                        PRODUCT {
                                            int id PK
                                            string name
                                            decimal price
                                        }
                                </div>
                            </x-card>
                        </div>

                        <div class="col-lg-6">
                            <x-card title="State Diagram Example">
                                <div class="mermaid">
                                    stateDiagram-v2
                                        [*] --> Draft
                                        Draft --> Review: Submit
                                        Review --> Approved: Accept
                                        Review --> Draft: Reject
                                        Approved --> Published: Publish
                                        Published --> Archived: Archive
                                        Archived --> [*]
                                </div>
                            </x-card>
                        </div>

                        <div class="col-lg-6">
                            <x-card title="Gantt Chart Example">
                                <div class="mermaid">
                                    gantt
                                        title Project Schedule
                                        dateFormat YYYY-MM-DD
                                        section Phase 1
                                        Planning           :a1, 2024-01-01, 7d
                                        Design             :a2, after a1, 10d
                                        section Phase 2
                                        Development        :a3, after a2, 20d
                                        Testing            :a4, after a3, 10d
                                        section Phase 3
                                        Deployment         :a5, after a4, 5d
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
