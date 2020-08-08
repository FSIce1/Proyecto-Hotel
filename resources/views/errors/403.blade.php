<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Error
        </title>
        <meta name="description" content="Big Error">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <link rel="stylesheet" media="screen, print" href="{{ asset('css/vendors.bundle.css') }}">
        <link rel="stylesheet" media="screen, print" href="{{ asset('css/app.bundle.css') }}">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
        <link rel="mask-icon" href="{{ asset('img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
        <!-- Optional: page related CSS-->
    </head>
    <body>
        
        <div class="page-wrapper alt">
            
            <main id="js-page-content" role="main" class="page-content">
                <div class="h-alt-f d-flex flex-column align-items-center justify-content-center text-center">
                    <h1 class="page-error color-fusion-500">
                        ERROR <span class="text-gradient">403</span>
                        <small class="fw-500">
                            !Algo <u>salió</u> mal!
                        </small>
                    </h1>
                    <h3 class="fw-500 mb-5">
                        Usted no está autorizado para esta página.
                    </h3>
                    <!--
                    <h4>
                        Estamos trabajando duro para corregir este problema. Espere unos instantes e intente su búsqueda nuevamente.
                    </h4>
                    -->
                </div>
            </main>
            
        </div>
        
        
        <!-- INICIO LISTA COMANDOS-->
        <nav class="shortcut-menu d-none d-sm-block">
            <input type="checkbox" class="menu-open" name="menu-open" id="menu_open" />
            <label for="menu_open" class="menu-open-button ">
                <span class="app-shortcut-icon d-block"></span>
            </label>
            <a href="#" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Mover hacia Arriba">
                <i class="fal fa-arrow-up"></i>
            </a>
            <a href="page_login-alt.html" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Página de Inicio">
                <i class="fal fa-sign-out"></i>
            </a>
            <a href="#" class="menu-item btn" data-action="app-fullscreen" data-toggle="tooltip" data-placement="left"
                title="Pantalla completa">
                <i class="fal fa-expand"></i>
            </a>
            <a href="#" class="menu-item btn" data-action="app-print" data-toggle="tooltip" data-placement="left"
                title="Imprimir página">
                <i class="fal fa-print"></i>
            </a>
        </nav>
        <!-- FIN LISTA COMANDOS -->
        
        <!-- base vendor bundle: 
			 DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations 
						+ pace.js (recommended)
						+ jquery.js (core)
						+ jquery-ui-cust.js (core)
						+ popper.js (core)
						+ bootstrap.js (core)
						+ slimscroll.js (extension)
						+ app.navigation.js (core)
						+ ba-throttle-debounce.js (core)
						+ waves.js (extension)
						+ smartpanels.js (extension)
						+ src/../jquery-snippets.js (core) -->
        <script src="{{ asset('js/vendors.bundle.js') }}"></script>
        <script src="{{ asset('js/app.bundle.js') }}"></script>
    </body>
</html>