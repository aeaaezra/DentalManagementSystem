(function () {
    function init() {
        const button = document.getElementById('mobileSidebarToggle');
        const sidebar = document.getElementById('mobileSidebar');
        const overlay = document.getElementById('mobileSidebarOverlay');
        const close = document.getElementById('closeMobileSidebar');

        if (!button || !sidebar || !overlay || !close) {
            console.error('Mobile drawer: required elements are missing.');
            return;
        }

        function openDrawer() {
            document.body.classList.add('mobile-sidebar-open');
            sidebar.setAttribute('aria-hidden', 'false');
            overlay.setAttribute('aria-hidden', 'false');
            button.setAttribute('aria-expanded', 'true');
        }

        function closeDrawer() {
            document.body.classList.remove('mobile-sidebar-open');
            sidebar.setAttribute('aria-hidden', 'true');
            overlay.setAttribute('aria-hidden', 'true');
            button.setAttribute('aria-expanded', 'false');
        }

        button.addEventListener('click', function () {
            if (document.body.classList.contains('mobile-sidebar-open')) {
                closeDrawer();
            } else {
                openDrawer();
            }
        });

        close.addEventListener('click', closeDrawer);
        overlay.addEventListener('click', closeDrawer);

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') closeDrawer();
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
