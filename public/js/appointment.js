document.addEventListener('DOMContentLoaded', function () {

    // ======================
    // MOBILE MENU
    // ======================

    const menuBtn = document.getElementById("menuBtn");
    const closeMenu = document.getElementById("closeMenu");
    const mobileMenu = document.getElementById("mobileMenu");
    const overlay = document.getElementById("overlay");

    if (menuBtn && mobileMenu && overlay) {

        menuBtn.addEventListener("click", function () {

            mobileMenu.style.left = "0";
            overlay.classList.remove("hidden");

        });

    }

    if (closeMenu && mobileMenu && overlay) {

        closeMenu.addEventListener("click", function () {

            mobileMenu.style.left = "-100%";
            overlay.classList.add("hidden");

        });

    }

    if (overlay && mobileMenu) {

        overlay.addEventListener("click", function () {

            mobileMenu.style.left = "-100%";
            overlay.classList.add("hidden");

        });

    }

    // ======================
    // PROFILE DROPDOWN
    // ======================

    const profileBtn = document.getElementById("profileBtn");
    const profileMenu = document.getElementById("profileMenu");

    if (profileBtn && profileMenu) {

        profileBtn.addEventListener("click", function (e) {

            e.stopPropagation();

            profileMenu.classList.toggle("hidden");

            // Close notification if open
            if (notificationDropdown) {
                notificationDropdown.classList.add("hidden");
            }

        });

    }

    // ======================
    // NOTIFICATION DROPDOWN
    // ======================

    const notificationBtn =
        document.getElementById("notificationBtn");

    const notificationDropdown =
        document.getElementById("notificationDropdown");

    if (notificationBtn && notificationDropdown) {

        console.log("Notification Loaded");

        notificationBtn.addEventListener("click", function (e) {

            e.preventDefault();
            e.stopPropagation();

            notificationDropdown.classList.toggle("hidden");

            // Close profile menu if open
            if (profileMenu) {
                profileMenu.classList.add("hidden");
            }

            // Mark notifications as read
            const csrf =
                document.querySelector(
                    'meta[name="csrf-token"]'
                );

            if (csrf) {

                fetch('/notifications/read-all', {

                    method: 'POST',

                    headers: {

                        'X-CSRF-TOKEN': csrf.content,
                        'Accept': 'application/json'

                    }

                })
                .then(response => response.json())
                .then(data => {

                    console.log(data);

                    // Hide badge
                    const badge =
                        document.querySelector(
                            '.notification-badge'
                        );

                    if (badge) {
                        badge.style.display = 'none';
                    }

                })
                .catch(error => {

                    console.error(error);

                });

            }

        });

    }

    // ======================
    // CLOSE DROPDOWNS
    // ======================

    document.addEventListener("click", function (e) {

        if (
            profileBtn &&
            profileMenu &&
            !profileBtn.contains(e.target) &&
            !profileMenu.contains(e.target)
        ) {

            profileMenu.classList.add("hidden");

        }

        if (
            notificationBtn &&
            notificationDropdown &&
            !notificationBtn.contains(e.target) &&
            !notificationDropdown.contains(e.target)
        ) {

            notificationDropdown.classList.add("hidden");

        }

    });

});


// ======================
// FAQ
// ======================

function toggleFaq(btn) {

    const content = btn.nextElementSibling;

    content.classList.toggle('hidden');

    btn.querySelector('span').innerText =
        content.classList.contains('hidden')
        ? '+'
        : '-';

}


// ======================
// APPOINTMENT TRACKER
// ======================

let currentStep = 0;

const steps =
    document.querySelectorAll(".form-step");

const circles =
    document.querySelectorAll(".step");

const progress =
    document.getElementById("progress");

function updateTracker() {

    circles.forEach((circle, index) => {

        if (index <= currentStep) {

            circle.classList.add("active");

        } else {

            circle.classList.remove("active");

        }

    });

    if (progress && circles.length > 1) {

        const percent =
            (currentStep / (circles.length - 1)) * 100;

        progress.style.width =
            percent + "%";

    }

}

function nextStep() {

    if (currentStep < steps.length - 1) {

        steps[currentStep]
            .classList
            .remove("active");

        currentStep++;

        steps[currentStep]
            .classList
            .add("active");

        updateTracker();

    }

}

function prevStep() {

    if (currentStep > 0) {

        steps[currentStep]
            .classList
            .remove("active");

        currentStep--;

        steps[currentStep]
            .classList
            .add("active");

        updateTracker();

    }

}

updateTracker();




//PREFETCH
window.prefetchData = {};

document.addEventListener("DOMContentLoaded", () => {

    fetch('/prefetch')

    .then(res => res.json())

    .then(data => {

        window.prefetchData = data;

        console.log("Prefetched!", data);

    });

});
