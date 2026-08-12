// ======================
// APPOINTMENT TRACKER
// ======================

let currentStep = 0;

const steps = document.querySelectorAll(".form-step");
const circles = document.querySelectorAll(".step");
const progress = document.getElementById("progress");

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

        progress.style.width = percent + "%";
    }
}

function nextStep() {

    if (currentStep < steps.length - 1) {

        steps[currentStep].classList.remove("active");

        currentStep++;

        steps[currentStep].classList.add("active");

        updateTracker();
    }
}

function prevStep() {

    if (currentStep > 0) {

        steps[currentStep].classList.remove("active");

        currentStep--;

        steps[currentStep].classList.add("active");

        updateTracker();
    }
}

updateTracker();


// ======================
// PAGE READY
// ======================

document.addEventListener('DOMContentLoaded', function () {

    // ======================
    // MOBILE SIDEBAR
    // ======================

    const menuBtn = document.getElementById("menuBtn");
    const closeMenu = document.getElementById("closeMenu");
    const mobileMenu = document.getElementById("mobileMenu");

    if (menuBtn && mobileMenu) {

        menuBtn.addEventListener("click", () => {

            mobileMenu.style.left = "0";

        });

    }

    if (closeMenu && mobileMenu) {

        closeMenu.addEventListener("click", () => {

            mobileMenu.style.left = "-100%";

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

        notificationBtn.addEventListener("click", function (e) {

            e.preventDefault();
            e.stopPropagation();

            notificationDropdown.classList.toggle("hidden");

            const token = document.querySelector(
                'meta[name="csrf-token"]'
            );

            if (token) {

                fetch('/notifications/read-all', {

                    method: 'POST',

                    headers: {

                        'X-CSRF-TOKEN': token.content,

                        'Accept': 'application/json'

                    }

                }).catch(error => {

                    console.error(error);

                });

            }

        });

        notificationDropdown.addEventListener(
            "click",
            function (e) {

                e.stopPropagation();

            }
        );

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

    // ======================
    // DENTIST FILTER
    // ======================

    const searchInput =
        document.getElementById('searchInput');

    const filterSpec =
        document.getElementById('filterSpec');

    if (searchInput && filterSpec) {

        function filterDentists() {

            const search =
                searchInput.value.toLowerCase();

            const specialization =
                filterSpec.value.toLowerCase();

            const cards =
                document.querySelectorAll('.dentist-card');

            cards.forEach(card => {

                const name =
                    card.dataset.name || '';

                const spec =
                    card.dataset.specialization || '';

                const matchesSearch =
                    name.includes(search) ||
                    spec.includes(search);

                const matchesSpec =
                    specialization === 'all' ||
                    spec === specialization;

                if (
                    matchesSearch &&
                    matchesSpec
                ) {

                    card.style.display = 'block';

                } else {

                    card.style.display = 'none';

                }

            });

        }

        searchInput.addEventListener(
            'input',
            filterDentists
        );

        filterSpec.addEventListener(
            'change',
            filterDentists
        );

    }

});
