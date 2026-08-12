// ======================
// APPOINTMENT TRACKER
// ======================

let currentStep = 1;
const totalSteps = 3;

function nextStep() {

    // Step 1 → Step 2
    if (currentStep === 1) {
        updateSummary();
    }

    if (currentStep < totalSteps) {
        currentStep++;
        showStep(currentStep);
    }
}

function previousStep() {

    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
    }
}

function showStep(step) {

    // Hide all pages
    document.querySelectorAll('.form-step').forEach(page => {
        page.classList.remove('active');
    });

    // Show current page
    document.getElementById('step' + step).classList.add('active');

    // Update tracker
    document.querySelectorAll('.tracker-step').forEach((item, index) => {

        item.classList.remove('active', 'completed');

        if (index + 1 === step) {
            item.classList.add('active');
        }

        if (index + 1 < step) {
            item.classList.add('completed');
        }
    });

    // Progress bar
    const progress = document.querySelector('.tracker-progress');

    if (progress) {
        progress.style.width = ((step - 1) / (totalSteps - 1)) * 100 + "%";
    }

    window.scrollTo({ top: 0, behavior: "smooth" });
}
// ======================
// WAIT FOR PAGE TO LOAD
// ======================

document.addEventListener('DOMContentLoaded', function () {

    // ======================
    // MOBILE SIDEBAR
    // ======================

    const menuBtn = document.getElementById("menuBtn");
    const closeMenu = document.getElementById("closeMenu");
    const mobileMenu = document.getElementById("mobileMenu");
    const dateInput = document.getElementById('date');

if (dateInput) {
    dateInput.addEventListener('change', function () {
        console.log("Date changed:", this.value); // debug
        loadSlots(this.value);
    });
}

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


/// ======================
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

        // Toggle dropdown
        notificationDropdown.classList.toggle("hidden");

        // Only mark as read when opening
        if (!notificationDropdown.classList.contains("hidden")) {

            fetch('/notifications/read-all', {
                method: 'POST',

                headers: {
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'),

                    'Accept': 'application/json'
                }
            })
            .then(response => {

                console.log(
                    "HTTP STATUS:",
                    response.status
                );

                if (!response.ok) {
                    throw new Error(
                        `HTTP ${response.status}`
                    );
                }

                return response.json();
            })
            .then(data => {

                console.log(
                    "READ ALL RESPONSE:",
                    data
                );

                if (data.success) {

                    // Remove badge immediately
                    const badge =
                        document.querySelector(
                            '.notification-badge'
                        );

                    if (badge) {
                        badge.remove();
                    }

                    // Optional: set all visible notification items
                    // to read visually
                    document
                        .querySelectorAll(
                            '[data-notification]'
                        )
                        .forEach(notification => {
                            notification.classList.remove(
                                'unread'
                            );
                        });
                }

            })
            .catch(error => {

                console.error(
                    "READ ALL ERROR:",
                    error
                );

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
const paymentSelect = document.getElementById('payment_method');

if (paymentSelect) {
    paymentSelect.addEventListener('change', function () {

        const selected = this.options[this.selectedIndex];

        if (selected.value === "") {
            document.getElementById('paymentInfo')?.classList.add('hidden');
            return;
        }

        document.getElementById('paymentInfo')?.classList.remove('hidden');

        document.getElementById('paymentQR').src = selected.dataset.qr;
        document.getElementById('accountName').textContent = selected.dataset.name;
        document.getElementById('accountNumber').textContent = selected.dataset.number;
    });
}

/*
const teeth = document.querySelectorAll(".tooth");

teeth.forEach(tooth => {

    tooth.addEventListener("click", function(){

        this.classList.toggle("selected");

        console.log(this.dataset.tooth);

    });

});

fetch('/odontogram/save', {

    method: 'POST',

    headers: {

        'Content-Type': 'application/json',

        'X-CSRF-TOKEN':
        document.querySelector('meta[name="csrf-token"]').content

    },

    body: JSON.stringify({

        patient_record_id: patientId,

        tooth_number: selectedTooth,

        condition: selectedCondition,

        remarks: remarks

    })

});
*/
async function loadSlots(date) {
    let res = await fetch(`/available-slots?date=${date}`);
    let slots = await res.json();

    console.log("SLOTS:", slots);

    let container = document.getElementById('slots');
    container.innerHTML = '';

    slots.forEach(slot => {
        let btn = document.createElement('button');
        btn.innerText = slot.time;
        btn.type = "button";
        btn.classList.add('slot-btn');

        if (!slot.available) {
            btn.classList.add('disabled');
            btn.disabled = true;
        } else {
            btn.onclick = () => {

                document.querySelectorAll('.slot-btn')
                    .forEach(b => b.classList.remove('active'));

                btn.classList.add('active');

                // ✅ STRICT CHECK (NO FALLBACK)
                if (!slot.start) {
                    console.error("Missing slot.start:", slot);
                    alert("Invalid slot data. Please refresh.");
                    return;
                }

                document.getElementById('start_time').value = slot.start;
                document.getElementById('end_time').value = slot.end ?? '';

                console.log("SELECTED:", slot.start);
            };
        }

        container.appendChild(btn);
    });
}

document.querySelector("form").addEventListener("submit", function(e) {

    let time = document.getElementById("start_time").value;

    if (!time || time === "undefined") {
        e.preventDefault();
        alert("⚠️ Please select a valid time slot.");
        return;
    }

    console.log("Submitting time:", time);
});

//For SweetAlert2 confirmation before submitting the form
function confirmSubmit(form) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to submit this appointment?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#ec4899',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, submit'
    }).then((result) => {
        if (result.isConfirmed) {

            const btn = form.querySelector("button[type='submit']");
            if (btn) {
                btn.disabled = true;
                btn.innerText = "Submitting...";
            }

            // 🔥 Show loading popup
            Swal.fire({
                title: 'Submitting...',
                text: 'Please wait',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            form.submit();
        }
    });
}

document.addEventListener("DOMContentLoaded", () => {
    showStep(1);
});


function updateSummary() {

    // PATIENT INFORMATION

    setSummary(
        'summary_patient_name',
        getValue('input[name="patient_name"]')
    );

    setSummary(
        'summary_age',
        getValue('input[name="age"]')
    );

    setSummary(
        'summary_sex',
        getValue('select[name="sex"]')
    );

    setSummary(
        'summary_civil_status',
        getValue('input[name="civil_status"]')
    );

    setSummary(
        'summary_tel_no',
        getValue('input[name="tel_no"]')
    );

    setSummary(
        'summary_occupation',
        getValue('input[name="occupation"]')
    );

    setSummary(
        'summary_address',
        getValue('textarea[name="address"]')
    );


    // MEDICAL HISTORY

    updateCheckboxSummary(
        'heart_condition',
        'summary_heart_condition'
    );

    updateCheckboxSummary(
        'allergy',
        'summary_allergy'
    );

    updateCheckboxSummary(
        'diabetes',
        'summary_diabetes'
    );

    updateCheckboxSummary(
        'hypertension',
        'summary_hypertension'
    );

    updateCheckboxSummary(
        'bleeding_tendency',
        'summary_bleeding_tendency'
    );

    updateCheckboxSummary(
        'asthma',
        'summary_asthma'
    );

    setSummary(
        'summary_other_conditions',
        getValue('textarea[name="other_conditions"]') || 'None'
    );


    // DENTAL INFORMATION




    // APPOINTMENT SERVICE

    const serviceSelect =
        document.getElementById('service_id');

    if (serviceSelect) {

        const selectedOption =
            serviceSelect.options[
                serviceSelect.selectedIndex
            ];

        if (
            selectedOption &&
            selectedOption.value
        ) {

            setSummary(
                'summary_service',
                selectedOption.textContent.trim()
            );

        } else {

            setSummary(
                'summary_service',
                '—'
            );
        }
    }


    // DATE

    setSummary(
        'summary_date',
        formatDate(
            getValue('#date')
        )
    );


    // TIME

    const startTime =
        getValue('#start_time');

    const endTime =
        getValue('#end_time');

    let appointmentTime = '—';

    if (startTime && endTime) {

        appointmentTime =
            formatTime(startTime) +
            ' - ' +
            formatTime(endTime);

    } else if (startTime) {

        appointmentTime =
            formatTime(startTime);
    }

    setSummary(
        'summary_time',
        appointmentTime
    );


    // REASON

    setSummary(
        'summary_reason',
        getValue('textarea[name="reason"]') || '—'
    );
}

// ======================
// GET VALUE
// ======================

function getValue(selector) {

    const element =
        document.querySelector(selector);

    if (!element) {
        return '';
    }

    return element.value.trim();
}


// ======================
// SET SUMMARY
// ======================

function setSummary(id, value) {

    const element =
        document.getElementById(id);

    if (element) {
        element.textContent =
            value || '—';
    }
}


// ======================
// CHECKBOX SUMMARY
// ======================

function updateCheckboxSummary(
    name,
    summaryId
) {

    const checkbox =
        document.querySelector(
            `input[name="${name}"]`
        );

    const summary =
        document.getElementById(summaryId);

    if (!checkbox || !summary) {
        return;
    }

    summary.textContent =
        checkbox.checked
            ? 'Yes'
            : 'No';
}


// ======================
// TEETH SUMMARY
// ======================

function updateTeethSummary() {

    const summary =
        document.getElementById(
            'summary_teeth'
        );

    if (!summary) {
        return;
    }

    const selectedTeeth =
        document.querySelectorAll(
            '.tooth.selected'
        );

    if (selectedTeeth.length === 0) {

        summary.innerHTML =
            '<span>No teeth selected</span>';

        return;
    }

    summary.innerHTML = '';

    selectedTeeth.forEach(function(tooth) {

        const badge =
            document.createElement('span');

        badge.className =
            'tooth-badge';

        badge.textContent =
            tooth.dataset.tooth;

        summary.appendChild(badge);
    });
}


// ======================
// FORMAT DATE
// ======================

function formatDate(dateValue) {

    if (!dateValue) {
        return '—';
    }

    const date =
        new Date(
            dateValue + 'T00:00:00'
        );

    return date.toLocaleDateString(
        'en-US',
        {
            month: 'long',
            day: 'numeric',
            year: 'numeric'
        }
    );
}


// ======================
// FORMAT TIME
// ======================

function formatTime(timeValue) {

    if (!timeValue) {
        return '';
    }

    const parts =
        timeValue.split(':');

    let hours =
        parseInt(parts[0]);

    const minutes =
        parts[1];

    const ampm =
        hours >= 12
            ? 'PM'
            : 'AM';

    hours =
        hours % 12;

    if (hours === 0) {
        hours = 12;
    }

    return hours +
        ':' +
        minutes +
        ' ' +
        ampm;
}


