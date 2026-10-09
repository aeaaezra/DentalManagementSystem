
(function () {
    function setupCashierDropdown() {
        const menu = document.querySelector(
            '.products-topbar .cashier-menu'
        );

        const button = document.getElementById(
            'productsCashierDropdownBtn'
        );

        if (!menu || !button) {
            console.error(
                'Products cashier dropdown: button or menu not found.'
            );
            return;
        }

        // Avoid registering the same handler twice.
        if (button.dataset.dropdownInitialized === 'true') {
            return;
        }

        button.dataset.dropdownInitialized = 'true';

        button.addEventListener('click', function (event) {
            event.preventDefault();
            event.stopPropagation();

            const isOpen = menu.classList.toggle('active');

            button.setAttribute('aria-expanded', String(isOpen));
        });

        document.addEventListener('click', function (event) {
            if (!menu.contains(event.target)) {
                menu.classList.remove('active');
                button.setAttribute('aria-expanded', 'false');
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                menu.classList.remove('active');
                button.setAttribute('aria-expanded', 'false');
            }
        });

        console.log('Products cashier dropdown initialized.');
    }

    // The script is loaded with defer, so the HTML should already exist.
    setupCashierDropdown();
})();
