<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <style>
            /* Variables */
            * {
                box-sizing: border-box;
            }

            body {
                font-family: -apple-system, BlinkMacSystemFont, sans-serif;
                font-size: 16px;
                -webkit-font-smoothing: antialiased;
                display: flex;
                justify-content: center;
                align-content: center;
                height: 100vh;
                width: 100vw;
            }

            form {
                width: 30vw;
                min-width: 500px;
                align-self: center;
                box-shadow: 0px 0px 0px 0.5px rgba(50, 50, 93, 0.1),
                0px 2px 5px 0px rgba(50, 50, 93, 0.1), 0px 1px 1.5px 0px rgba(0, 0, 0, 0.07);
                border-radius: 7px;
                padding: 40px;
            }

            .hidden {
                display: none;
            }

            #payment-message {
                color: rgb(105, 115, 134);
                font-size: 16px;
                line-height: 20px;
                padding-top: 12px;
                text-align: center;
            }

            #payment-element {
                margin-bottom: 24px;
            }

            /* Buttons and links */
            button {
                background: #5469d4;
                font-family: Arial, sans-serif;
                color: #ffffff;
                border-radius: 4px;
                border: 0;
                padding: 12px 16px;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                display: block;
                transition: all 0.2s ease;
                box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
                width: 100%;
            }
            button:hover {
                filter: contrast(115%);
            }
            button:disabled {
                opacity: 0.5;
                cursor: default;
            }

            /* spinner/processing state, errors */
            .spinner,
            .spinner:before,
            .spinner:after {
                border-radius: 50%;
            }
            .spinner {
                color: #ffffff;
                font-size: 22px;
                text-indent: -99999px;
                margin: 0px auto;
                position: relative;
                width: 20px;
                height: 20px;
                box-shadow: inset 0 0 0 2px;
                -webkit-transform: translateZ(0);
                -ms-transform: translateZ(0);
                transform: translateZ(0);
            }
            .spinner:before,
            .spinner:after {
                position: absolute;
                content: "";
            }
            .spinner:before {
                width: 10.4px;
                height: 20.4px;
                background: #5469d4;
                border-radius: 20.4px 0 0 20.4px;
                top: -0.2px;
                left: -0.2px;
                -webkit-transform-origin: 10.4px 10.2px;
                transform-origin: 10.4px 10.2px;
                -webkit-animation: loading 2s infinite ease 1.5s;
                animation: loading 2s infinite ease 1.5s;
            }
            .spinner:after {
                width: 10.4px;
                height: 10.2px;
                background: #5469d4;
                border-radius: 0 10.2px 10.2px 0;
                top: -0.1px;
                left: 10.2px;
                -webkit-transform-origin: 0px 10.2px;
                transform-origin: 0px 10.2px;
                -webkit-animation: loading 2s infinite ease;
                animation: loading 2s infinite ease;
            }

            @-webkit-keyframes loading {
                0% {
                    -webkit-transform: rotate(0deg);
                    transform: rotate(0deg);
                }
                100% {
                    -webkit-transform: rotate(360deg);
                    transform: rotate(360deg);
                }
            }
            @keyframes loading {
                0% {
                    -webkit-transform: rotate(0deg);
                    transform: rotate(0deg);
                }
                100% {
                    -webkit-transform: rotate(360deg);
                    transform: rotate(360deg);
                }
            }

            @media only screen and (max-width: 600px) {
                form {
                    width: 80vw;
                    min-width: initial;
                }
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    @stack('scripts')
    </body>
</html>
