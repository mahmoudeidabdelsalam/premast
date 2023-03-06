@if (
    !function_exists('elementor_theme_do_location') ||
        !elementor_theme_do_location('header'))
    <div class="container-xxl">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">
                    <a href="{{ home_url('/') }}">
                        <img src="{{ get_field('website_logo', 'option') }}"
                            alt="premast logo" class="img-fluid logo"
                            width="100">
                    </a>
                </span>
                <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    @if (has_nav_menu('primary_navigation'))
                        {!! wp_nav_menu([
                            'theme_location' => 'primary_navigation',
                            'container' => false,
                            'menu_class' => 'navbar-nav ms-auto pmst-nav',
                            'walker' => new NavWalker(),
                        ]) !!}
                    @endif
                </div>
                {{-- Login buttons --}}
                <div class="d-flex align-items-center gap-2 pmst-login">
                    <a href="https://app.premast.com/login"
                        class="btn btn-outline-secondary" target="_blank">
                        {{-- icon --}}
                        <i class="fa fa-user me-2"></i>
                        Sign in</a>
                    <a href="https://app.premast.com/login"
                        class="btn btn-primary"
                        target="_blank
                ">Try for free</a>
                </div>
            </div>
        </nav>
    </div>

    <style>
        /* Bootstrap override */
        /* --colors-- */
        :root {
            --primary: #1F6DFB;
            --secondary: #D8DAE5;
            --success: #198754;
            --info: #0dcaf0;
            --warning: #ffc107;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #212529;
            --white: #fff;
            --gray: #6c757d;
            --gray-dark: #343a40;
            --primary-rgb: 13, 110, 253;
            --secondary-rgb: 108, 117, 125;
            --success-rgb: 25, 135, 84;
            --info-rgb: 13, 202, 240;
            --warning-rgb: 255, 193, 7;
            --danger-rgb: 220, 53, 69;
            --light-rgb: 248, 249, 250;
        }

        /* spacer */
        .me-2 {
            margin-right: 0.5rem !important;
        }

        .gap-2 {
            gap: 1rem;
        }


        /* Buttons */
        .btn {
            border-radius: 4px;
            font-size: 16px;
            font-weight: 400;
            font-family: 'Poppins', sans-serif;
        }

        .btn-outline-secondary {
            color: #696F8C;
            border-color: #D8DAE5;
        }

        .btn-outline-secondary:hover {
            color: #696F8C !important;
            background-color: #D8DAE5 !important;
            border-color: #D8DAE5 !important;
        }

        .btn-outline-secondary:focus {
            box-shadow: unset !important;

        }

        .pmst-nav {
            display: flex;
            align-items: center;
        }

        .pmst-nav .nav-link {
            color: #000;
            font-size: 15px;
            font-weight: 400;
            padding: 0 10px;
        }

        .pmst-login .fa {
            font-size: 12px;
            font-weight: 400;
        }
    </style>
@endif
