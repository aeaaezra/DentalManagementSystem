function filterTable() {
            const search = document.getElementById("searchInput").value.toUpperCase();
            const month = document.getElementById("monthFilter").value;
            const dentist = document.getElementById("dentistFilter")?.value.toUpperCase() || "";
            const service = document.getElementById("serviceFilter")?.value.toUpperCase() || "";
            const status = document.getElementById("statusFilter")?.value.toUpperCase() || "";
            const payment = document.getElementById("paymentFilter")?.value.toUpperCase() || "";


            const table = document.getElementById("historyTable");
            const tr = table.getElementsByTagName("tr");

            for (let i = 1; i < tr.length; i++) {
                const row = tr[i];
                const dateText = row.cells[0].textContent; // YYYY-MM-DD
                const rowMonth = dateText.split('-')[1];
                const rowDentist = row.cells[1].textContent.toUpperCase();
                const rowService = row.cells[2].textContent.toUpperCase();
                const rowStatus = row.cells[6].textContent.toUpperCase();
                const rowPayment = row.cells[7].textContent.toUpperCase();
                const rowFullText = row.textContent.toUpperCase();

                const matchSearch = rowFullText.includes(search);
                const matchMonth = month === "" || rowMonth === month;
                const matchDentist = dentist === "" || rowDentist.includes(dentist);
                const matchService = service === "" || rowService.includes(service);
                const matchStatus = status === "" || rowStatus.includes(status);
                const matchPayment = payment === "" || rowPayment.includes(payment);

                if (matchSearch && matchMonth && matchDentist && matchService && matchStatus && matchPayment) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            }
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

            fetch('/notifications/read-all', {

                method: 'POST',

                headers: {

                    'X-CSRF-TOKEN':
                        document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content,

                    'Accept': 'application/json'

                }

            }).catch(error => {
                console.error(error);
            });

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

function printHistory() {

    const table = document.getElementById('historyTable').outerHTML;

    const printWindow = window.open('', '', 'width=1000,height=700');

    printWindow.document.write(`
        <html>
        <head>
            <title>Appointment History</title>

            <style>

                body{
                    font-family:Arial,sans-serif;
                    padding:30px;
                }

                h2{
                    text-align:center;
                    margin-bottom:20px;
                }

                table{
                    width:100%;
                    border-collapse:collapse;
                }

                th,td{
                    border:1px solid #ccc;
                    padding:10px;
                    text-align:left;
                }

                th{
                    background:#fce7f3;
                }

            </style>

        </head>

        <body>

            <h2>Shine & Smile Dental Clinic</h2>
            <h3 style="text-align:center;">Appointment History</h3>

            ${table}

        </body>
        </html>
    `);

   printWindow.document.close();

    printWindow.onload = function () {

        printWindow.focus();
        printWindow.print();

        setTimeout(() => {
            printWindow.close();
        }, 500);

    };

}
