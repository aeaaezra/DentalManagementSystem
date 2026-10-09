
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector(
        '.sh-sales-filters input[name="search"]'
    );

    if (searchInput) {
        searchInput.setAttribute(
            'aria-label',
            'Search sales by invoice or status'
        );
    }

    document.querySelectorAll('.sh-sales-table tbody tr').forEach((row) => {
        row.addEventListener('click', (event) => {
            if (event.target.closest('a, button, input, select')) {
                return;
            }

            row.classList.toggle('sh-row-selected');
        });
    });
});

