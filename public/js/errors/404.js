document.addEventListener("DOMContentLoaded", () => {

    const homeButton = document.getElementById("goHomeButton");

    if (!homeButton) {
        return;
    }

    /*
     * Save the page that brought the user
     * to the 404 page.
     */
    const previousPage = document.referrer;

    if (
        previousPage &&
        previousPage !== window.location.href &&
        !previousPage.includes("/errors/404")
    ) {
        sessionStorage.setItem(
            "shineSmilePreviousPage",
            previousPage
        );
    }

    /*
     * Go to Home.
     */
    homeButton.addEventListener("click", () => {
        window.location.href = "/";
    });

});
