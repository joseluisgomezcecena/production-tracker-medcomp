<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title>Production Tracker - Martech and Medcomp</title>

    <link rel="stylesheet" href="./views/assets/css/style.css" />
    <script src="./views/assets/js/sweetalert.js"></script>

</head>

<body>

<!-- Top Bar -->
<section class="top-bar">

    <!-- Brand -->
    <span class="brand">Production Tracker</span>

    <nav class="flex items-center ltr:ml-auto rtl:mr-auto">

        <!-- Dark Mode -->
        <label class="switch switch_outlined" data-toggle="tooltip" data-tippy-content="Toggle Dark Mode">
            <input id="darkModeToggler" type="checkbox">
            <span></span>
        </label>

        <!-- Fullscreen -->
        <button id="fullScreenToggler" type="button"
                class="hidden lg:inline-block btn-link ltr:ml-5 rtl:mr-5 text-2xl leading-none la la-expand-arrows-alt"
                data-toggle="tooltip" data-tippy-content="Fullscreen"></button>

        <!-- Register
        <a href="auth-register.html" class="btn btn_primary uppercase ltr:ml-5 rtl:mr-5">Register</a>
        -->
    </nav>
</section>
