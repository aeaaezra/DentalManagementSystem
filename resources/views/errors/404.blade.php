<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>404 - Page Not Found | Shine & Smile</title>

    <link rel="stylesheet" href="{{ asset('css/errors/404.css') }}">
</head>

<body>

    <main class="error-page">

        <!-- Decorative background -->
        <div class="blob blob-top-left"></div>
        <div class="blob blob-top-right"></div>
        <div class="blob blob-bottom-left"></div>
        <div class="blob blob-bottom-right"></div>

        <!-- Sparkles -->
        <div class="sparkle sparkle-1">✦</div>
        <div class="sparkle sparkle-2">✦</div>
        <div class="sparkle sparkle-3">✦</div>

        <!-- Ceiling lamp -->
        <div class="clinic-lamp">
            <div class="lamp-wire"></div>
            <div class="lamp-head"></div>
            <div class="lamp-light"></div>
        </div>

        <section class="error-content">

            <!-- 404 Illustration -->
            <div class="illustration">

                <div class="number number-left">4</div>
                <div class="number number-right">4</div>

                <!-- Question marks -->
                <div class="question question-small">?</div>
                <div class="question question-large">?</div>

                <!-- Tooth mascot -->
                <div class="tooth-wrapper">

                    <div class="tooth-headband">
                        <div class="head-mirror">
                            <div class="mirror-center"></div>
                        </div>
                    </div>

                    <div class="tooth">

                        <div class="eyebrow eyebrow-left"></div>
                        <div class="eyebrow eyebrow-right"></div>

                        <div class="eye eye-left">
                            <div class="eye-highlight"></div>
                        </div>

                        <div class="eye eye-right">
                            <div class="eye-highlight"></div>
                        </div>

                        <div class="cheek cheek-left"></div>
                        <div class="cheek cheek-right"></div>

                        <div class="mouth">
                            <div class="mouth-tongue"></div>
                        </div>

                        <!-- Tooth arms -->
                        <div class="tooth-arm arm-left"></div>
                        <div class="tooth-arm arm-right"></div>

                        <!-- Tooth feet -->
                        <div class="tooth-foot foot-left"></div>
                        <div class="tooth-foot foot-right"></div>

                    </div>

                </div>

                <!-- Dental cabinet -->
                <div class="cabinet">
                    <div class="cabinet-top"></div>
                    <div class="cabinet-drawer drawer-1"></div>
                    <div class="cabinet-drawer drawer-2"></div>
                    <div class="cabinet-leg leg-left"></div>
                    <div class="cabinet-leg leg-right"></div>
                </div>

                <!-- Dental chair -->
                <div class="dental-chair">

                    <div class="chair-head"></div>

                    <div class="chair-back"></div>

                    <div class="chair-seat"></div>

                    <div class="chair-base"></div>

                    <div class="chair-foot"></div>

                </div>

                <!-- Dental instruments -->
                <div class="dental-tools">
                    <div class="tool tool-1"></div>
                    <div class="tool tool-2"></div>
                    <div class="tool tool-3"></div>
                </div>

            </div>

            <!-- Text -->
            <div class="error-message">

                <h1>
                    Page <span>Not</span> Found
                </h1>

                <p>
                    Oops! The page you're looking for doesn't exist
                    <br class="desktop-break">
                    or may have been moved.
                </p>

                <button
                    type="button"
                    class="home-button"
                    id="goHomeButton"
                >
                    <svg
                        width="22"
                        height="22"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M3 10.8L12 3L21 10.8V21H14.5V14.5H9.5V21H3V10.8Z"
                            fill="currentColor"
                        />
                    </svg>

                    <span>Go Back Home</span>
                </button>

            </div>

        </section>

    </main>

    <script src="{{ asset('js/errors/404.js') }}"></script>

</body>
</html>
