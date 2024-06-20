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

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="collapse collapse-horizontal" id="collapseWidthExample">
            <div class="sidebar-header">
                <a class="sidebar-brand">PRUEBA TÉCNICA</a>
            </div>
            <div class="sidebar-header">
                <a class="sidebar-brand">SOLUCIONES INFORMÁTICAS LJ</a>
            </div>
            <div class="sidebar-header">
                <a class="sidebar-brand">MENU</a>
            </div>
            <div class="sidebar-nav">
                <div class="sidenav">
                    <a class="sidebar-item">
                        <div class="sidebar-item-content">
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                        </div>
                    </a>
                    <a class="sidebar-item">
                        <div class="sidebar-item-content">
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Días Festivos') }}
                            </x-nav-link>
                        </div>
                    </a>
                    <a class="sidebar-item">
                        <div class="sidebar-item-content">
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Usuarios') }}
                            </x-nav-link>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="min-h-screen bg-gray-400">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
