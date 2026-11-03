<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Set Up Two-Factor Authentication</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-5">

    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl p-8">

        <h1 class="text-3xl font-bold text-pink-600 text-center">
            Two-Factor Authentication
        </h1>

        <p class="text-gray-600 text-center mt-3 mb-6">
            Scan the QR code using Google Authenticator.
        </p>

        <div id="loading" class="text-center py-8">
            <p class="text-gray-500">
                Generating your QR code...
            </p>
        </div>

        <div
            id="errorMessage"
            class="hidden bg-red-100 border border-red-300 text-red-700 p-4 rounded-lg mb-5">
        </div>

        <div
            id="successMessage"
            class="hidden bg-green-100 border border-green-300 text-green-700 p-4 rounded-lg mb-5">
        </div>

        <div id="setupContent" class="hidden">

            <div class="flex justify-center mb-5">
                <div id="qrCode"></div>
            </div>

            <div class="mb-5">

                <label class="block font-semibold text-gray-700 mb-2">
                    Manual Setup Key
                </label>

                <div
                    id="secretKey"
                    class="bg-gray-100 border rounded-lg p-3 break-all text-center font-mono text-sm">
                </div>

            </div>

            <form id="verifyForm">

                <label
                    for="otp"
                    class="block font-semibold text-gray-700 mb-2">

                    Enter Google Authenticator Code

                </label>

                <input
                    type="text"
                    id="otp"
                    name="otp"
                    maxlength="6"
                    inputmode="numeric"
                    autocomplete="one-time-code"
                    placeholder="Enter 6-digit code"
                    class="w-full border rounded-lg p-3 text-center text-lg tracking-widest focus:outline-none focus:ring-2 focus:ring-pink-500"
                    required>

                <button
                    type="submit"
                    id="verifyButton"
                    class="w-full bg-pink-600 text-white py-3 rounded-lg mt-5 hover:bg-pink-700 transition font-semibold">

                    Verify and Enable 2FA

                </button>

            </form>

        </div>

        <button
            type="button"
            onclick="window.history.back()"
            class="w-full bg-gray-200 text-gray-700 py-3 rounded-lg mt-4 hover:bg-gray-300 transition">

            Back

        </button>

    </div>


    <script>

        document.addEventListener("DOMContentLoaded", function () {

            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");

            const loading = document.getElementById("loading");

            const setupContent =
                document.getElementById("setupContent");

            const errorMessage =
                document.getElementById("errorMessage");

            const successMessage =
                document.getElementById("successMessage");

            const qrCode =
                document.getElementById("qrCode");

            const secretKey =
                document.getElementById("secretKey");

            const verifyForm =
                document.getElementById("verifyForm");

            const otp =
                document.getElementById("otp");

            const verifyButton =
                document.getElementById("verifyButton");


            function showError(message) {

                errorMessage.textContent = message;

                errorMessage.classList.remove("hidden");

                successMessage.classList.add("hidden");

            }


            function showSuccess(message) {

                successMessage.textContent = message;

                successMessage.classList.remove("hidden");

                errorMessage.classList.add("hidden");

            }


            function hideMessages() {

                errorMessage.classList.add("hidden");

                successMessage.classList.add("hidden");

            }


            /*
            |--------------------------------------------------------------------------
            | GENERATE QR CODE
            |--------------------------------------------------------------------------
            */

            fetch("{{ route('2fa.enable') }}", {

                method: "POST",

                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },

                body: JSON.stringify({})

            })

            .then(function (response) {

                return response.json()
                    .then(function (data) {

                        if (!response.ok) {
                            throw new Error(
                                data.message ||
                                "Unable to generate QR code."
                            );
                        }

                        return data;

                    });

            })

            .then(function (data) {

                loading.classList.add("hidden");

                if (!data.success) {

                    showError(
                        data.message ||
                        "Unable to generate QR code."
                    );

                    return;

                }

                qrCode.innerHTML = data.qrCode;

                secretKey.textContent = data.secret;

                setupContent.classList.remove("hidden");

            })

            .catch(function (error) {

                loading.classList.add("hidden");

                showError(
                    error.message ||
                    "Something went wrong while generating the QR code."
                );

                console.error(error);

            });


            /*
            |--------------------------------------------------------------------------
            | VERIFY GOOGLE AUTHENTICATOR CODE
            |--------------------------------------------------------------------------
            */

            verifyForm.addEventListener(
                "submit",
                function (event) {

                    event.preventDefault();

                    hideMessages();


                    const otpValue =
                        otp.value.trim();


                    if (!/^\d{6}$/.test(otpValue)) {

                        showError(
                            "Please enter a valid 6-digit authentication code."
                        );

                        return;

                    }


                    verifyButton.disabled = true;

                    verifyButton.textContent =
                        "Verifying...";


                    fetch("{{ route('2fa.verify') }}", {

                        method: "POST",

                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": csrfToken
                        },

                        body: JSON.stringify({

                            otp: otpValue

                        })

                    })

                    .then(function (response) {

                        return response.json()
                            .then(function (data) {

                                if (!response.ok) {

                                    throw new Error(
                                        data.message ||
                                        "Invalid authentication code."
                                    );

                                }

                                return data;

                            });

                    })

                    .then(function (data) {

                        if (!data.success) {

                            throw new Error(
                                data.message ||
                                "Invalid authentication code."
                            );

                        }


                        showSuccess(
                            "Two-Factor Authentication enabled successfully!"
                        );


                        verifyButton.textContent =
                            "2FA Enabled ✓";


                        /*
                        |--------------------------------------------------------------------------
                        | RETURN TO PREVIOUS SETTINGS PAGE
                        |--------------------------------------------------------------------------
                        */

                        setTimeout(function () {

                            window.history.back();

                        }, 1500);

                    })

                    .catch(function (error) {

                        console.error(error);

                        showError(
                            error.message ||
                            "Something went wrong. Please try again."
                        );


                        verifyButton.disabled = false;

                        verifyButton.textContent =
                            "Verify and Enable 2FA";

                    });

                }
            );

        });

    </script>

</body>

</html>
