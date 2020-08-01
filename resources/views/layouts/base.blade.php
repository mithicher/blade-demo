<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') - {{ config('app.name') }}</title>

        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

        <!-- Styles -->
        <style>
            [x-cloak] { display: none; }
            @keyframes spinner {
                to {
                    transform: rotate(360deg);
                }
            }
            .base-spinner {
                position: relative;
                overflow: hidden;
            }
            .base-spinner:before {
                content: "";
                box-sizing: border-box;
                position: absolute;
                background-color: inherit;
                width: 100%;
                height: 100%;
                display: block;
                z-index: 1;
                top: 0;
                left: 0;
            }
            .base-spinner:after {
                content: "";
                box-sizing: border-box;
                position: absolute;
                top: 50%;
                left: 50%;
                width: 20px;
                height: 20px;
                margin-top: -10px;
                margin-left: -10px;
                border-radius: 50%;
                border: 2px solid rgba(255, 255, 255, 0.25);
                border-top-color: currentColor;
                animation: spinner 0.6s linear infinite;
                z-index: 2;
            }
            .base-spinner.base-spinner-inverse:after {
                border: 2px solid #f3f4f5;
                border-top-color: #ccc;
            }

            /* Custom Radio/Checkox */

            [type="checkbox"], [type="radio"] {
                box-sizing: border-box;
                padding: 0;
            }

            .form-checkbox:checked,
            .form-radio:checked {
                border-color: transparent;
                background-color: currentColor;
                background-size: 100% 100%;
                background-position: center;
                background-repeat: no-repeat;
            }

            .form-checkbox:checked {
                background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M5.707 7.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0-1.414-1.414L7 8.586 5.707 7.293z'/%3e%3c/svg%3e");
            }
            .form-radio:checked {
                background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e");
            }

            .form-checkbox,
            .form-radio {
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
                display: inline-block;
                vertical-align: middle;
                background-origin: border-box;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                flex-shrink: 0;
               
                color: currentColor;
                background-color: #fff;
                border-color: #e2e8f0;
                border-width: 1px;
                height: 1.2em;
                width: 1.2em;
            }

            .form-checkbox {
                border-radius: 0.25rem;
            }

            .form-radio {
                border-radius: 100%;
            }
        </style>

        @stack('styles')
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
		@stack('scripts')
    </head>
    <body class="bg-gray-200 antialiased">
        @yield('content')
    </body>
</html>
