// ============================================================
// FAQ JAVASCRIPT
// ============================================================

document.addEventListener("DOMContentLoaded", function () {

    // ============================================================
    // ELEMENTS
    // ============================================================

    const faqItems =
        document.querySelectorAll(".faq-item");

    const faqQuestions =
        document.querySelectorAll(".faq-question");

    const faqSearch =
        document.getElementById("faqSearch");

    const faqCategories =
        document.querySelectorAll(".faq-category");

    const faqNoResults =
        document.getElementById("faqNoResults");


    // ============================================================
    // CURRENT CATEGORY
    // ============================================================

    let selectedCategory = "all";


    // ============================================================
    // OPEN / CLOSE FAQ
    // ============================================================

    faqQuestions.forEach(function (button) {

        button.addEventListener("click", function () {

            const currentItem =
                this.closest(".faq-item");

            if (!currentItem) {
                return;
            }

            const isOpen =
                currentItem.classList.contains("open");


            // ----------------------------------------------------
            // CLOSE ALL FAQ ITEMS
            // ----------------------------------------------------

            faqItems.forEach(function (item) {

                item.classList.remove("open");

                const icon =
                    item.querySelector(".faq-icon");

                if (icon) {
                    icon.textContent = "+";
                }

            });


            // ----------------------------------------------------
            // OPEN CURRENT ITEM
            // ----------------------------------------------------

            if (!isOpen) {

                currentItem.classList.add("open");

                const icon =
                    currentItem.querySelector(".faq-icon");

                if (icon) {
                    icon.textContent = "−";
                }

            }

        });

    });


    // ============================================================
    // FILTER FAQS
    // ============================================================

    function filterFaqs() {

        const search =
            (faqSearch?.value || "")
                .toLowerCase()
                .trim();

        let visibleCount = 0;


        faqItems.forEach(function (item) {

            const category =
                item.dataset.category || "";

            const question =
                (
                    item.dataset.question ||
                    item.textContent ||
                    ""
                )
                .toLowerCase();


            const categoryMatch =
                selectedCategory === "all" ||
                category === selectedCategory;


            const searchMatch =
                search === "" ||
                question.includes(search);


            const shouldShow =
                categoryMatch &&
                searchMatch;


            // ----------------------------------------------------
            // SHOW FAQ
            // ----------------------------------------------------

            if (shouldShow) {

                item.style.display = "";

                visibleCount++;

            }


            // ----------------------------------------------------
            // HIDE FAQ
            // ----------------------------------------------------

            else {

                item.style.display = "none";

                item.classList.remove("open");


                const icon =
                    item.querySelector(".faq-icon");

                if (icon) {
                    icon.textContent = "+";
                }

            }

        });


        // ========================================================
        // NO RESULTS
        // ========================================================

        if (faqNoResults) {

            if (visibleCount === 0) {

                faqNoResults.classList.add("show");

            } else {

                faqNoResults.classList.remove("show");

            }

        }

    }


    // ============================================================
    // SEARCH
    // ============================================================

    if (faqSearch) {

        faqSearch.addEventListener(
            "input",
            filterFaqs
        );

    }


    // ============================================================
    // CATEGORY BUTTONS
    // ============================================================

    faqCategories.forEach(function (button) {

        button.addEventListener("click", function () {

            selectedCategory =
                this.dataset.category || "all";


            // ----------------------------------------------------
            // REMOVE ACTIVE
            // ----------------------------------------------------

            faqCategories.forEach(function (categoryButton) {

                categoryButton.classList.remove("active");

            });


            // ----------------------------------------------------
            // SET ACTIVE
            // ----------------------------------------------------

            this.classList.add("active");


            // ----------------------------------------------------
            // FILTER
            // ----------------------------------------------------

            filterFaqs();

        });

    });


    // ============================================================
    // INITIAL FILTER
    // ============================================================

    filterFaqs();

});
