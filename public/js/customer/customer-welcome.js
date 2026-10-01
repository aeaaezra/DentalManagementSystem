/* =========================================================
   CUSTOMER SHOP JAVASCRIPT
========================================================= */

document.addEventListener("DOMContentLoaded", () => {

    /* =====================================================
       CART
    ===================================================== */

    let cart = JSON.parse(
        localStorage.getItem("dentalShopCart")
    ) || [];

    updateCartCount();


    /* =====================================================
       ADD TO CART
    ===================================================== */

    const addButtons =
        document.querySelectorAll(".add-cart-button");

    addButtons.forEach(button => {

        button.addEventListener("click", () => {

            const id =
                Number(button.dataset.id);

            const name =
                button.dataset.name;

            const price =
                Number(button.dataset.price);


            const existingProduct =
                cart.find(item => item.id === id);


            if (existingProduct) {

                existingProduct.quantity += 1;

            } else {

                cart.push({

                    id: id,

                    name: name,

                    price: price,

                    quantity: 1

                });

            }


            saveCart();

            updateCartCount();

            showToast(
                `${name} was added to your cart.`
            );

        });

    });


    /* =====================================================
       SAVE CART
    ===================================================== */

    function saveCart() {

        localStorage.setItem(
            "dentalShopCart",
            JSON.stringify(cart)
        );

    }


    /* =====================================================
       CART COUNT
    ===================================================== */

    function updateCartCount() {

        const cartCount =
            document.getElementById("cartCount");

        if (!cartCount) return;


        const totalItems =
            cart.reduce(
                (total, item) =>
                    total + item.quantity,
                0
            );


        cartCount.textContent =
            totalItems;


        if (totalItems === 0) {

            cartCount.style.display = "none";

        } else {

            cartCount.style.display = "grid";

        }

    }


    /* =====================================================
       TOAST
    ===================================================== */

    function showToast(message) {

        const toast =
            document.getElementById("toast");

        const toastMessage =
            document.getElementById("toastMessage");


        if (!toast) return;


        toastMessage.textContent =
            message;


        toast.classList.add("show");


        setTimeout(() => {

            toast.classList.remove("show");

        }, 3000);

    }


    /* =====================================================
       WISHLIST
    ===================================================== */

    const wishlistButtons =
        document.querySelectorAll(".wishlist-button");


    wishlistButtons.forEach(button => {

        button.addEventListener("click", () => {

            button.classList.toggle("active");


            const icon =
                button.querySelector("i");


            if (
                button.classList.contains("active")
            ) {

                icon.classList.remove(
                    "fa-regular"
                );

                icon.classList.add(
                    "fa-solid"
                );

                showToast(
                    "Added to wishlist."
                );

            } else {

                icon.classList.remove(
                    "fa-solid"
                );

                icon.classList.add(
                    "fa-regular"
                );

                showToast(
                    "Removed from wishlist."
                );

            }

        });

    });


    /* =====================================================
       SEARCH
    ===================================================== */

    const searchInput =
        document.getElementById("searchInput");

    const searchButton =
        document.getElementById("searchButton");

    const searchSuggestions =
        document.getElementById(
            "searchSuggestions"
        );


    const products =
        document.querySelectorAll(".product-card");


    function performSearch() {

        const searchTerm =
            searchInput.value
                .trim()
                .toLowerCase();


        if (!searchTerm) {

            products.forEach(product => {

                product.style.display = "";

            });

            return;

        }


        let found = false;


        products.forEach(product => {

            const name =
                product.dataset.name || "";


            const category =
                product.dataset.category
                    ?.toLowerCase() || "";


            if (
                name.includes(searchTerm) ||
                category.includes(searchTerm)
            ) {

                product.style.display = "";

                found = true;

            } else {

                product.style.display = "none";

            }

        });


        if (found) {

            document
                .getElementById("popular")
                ?.scrollIntoView({
                    behavior: "smooth"
                });

        }

    }


    searchButton.addEventListener(
        "click",
        performSearch
    );


    searchInput.addEventListener(
        "keydown",
        event => {

            if (event.key === "Enter") {

                performSearch();

            }

        }
    );


    /* =====================================================
       SEARCH SUGGESTIONS
    ===================================================== */

    searchInput.addEventListener(
        "input",
        () => {

            const value =
                searchInput.value
                    .trim()
                    .toLowerCase();


            searchSuggestions.innerHTML = "";


            if (!value) {

                searchSuggestions.classList.remove(
                    "show"
                );

                return;

            }


            const matches = [];


            products.forEach(product => {

                const name =
                    product.dataset.name || "";


                if (
                    name.includes(value) &&
                    !matches.includes(name)
                ) {

                    matches.push(name);

                }

            });


            matches
                .slice(0, 5)
                .forEach(name => {

                    const item =
                        document.createElement("div");


                    item.className =
                        "search-suggestion";


                    item.textContent =
                        capitalizeWords(name);


                    item.addEventListener(
                        "click",
                        () => {

                            searchInput.value =
                                capitalizeWords(name);

                            searchSuggestions.classList.remove(
                                "show"
                            );

                            performSearch();

                        }
                    );


                    searchSuggestions.appendChild(
                        item
                    );

                });


            if (matches.length) {

                searchSuggestions.classList.add(
                    "show"
                );

            } else {

                searchSuggestions.classList.remove(
                    "show"
                );

            }

        }
    );


    document.addEventListener(
        "click",
        event => {

            if (
                !searchInput.contains(event.target) &&
                !searchSuggestions.contains(event.target)
            ) {

                searchSuggestions.classList.remove(
                    "show"
                );

            }

        }
    );


    function capitalizeWords(text) {

        return text
            .split(" ")
            .map(
                word =>
                    word.charAt(0).toUpperCase() +
                    word.slice(1)
            )
            .join(" ");

    }


    /* =====================================================
       POPULAR SEARCH
    ===================================================== */

    const popularSearchLinks =
        document.querySelectorAll(
            ".popular-searches a"
        );


    popularSearchLinks.forEach(link => {

        link.addEventListener(
            "click",
            event => {

                event.preventDefault();


                const search =
                    link.dataset.search;


                searchInput.value =
                    search;


                performSearch();

            }
        );

    });


    /* =====================================================
       CATEGORY FILTER
    ===================================================== */

    const categoryButtons =
        document.querySelectorAll(
            ".category-card"
        );


    categoryButtons.forEach(button => {

        button.addEventListener(
            "click",
            () => {

                const category =
                    button.dataset.category;


                products.forEach(product => {

                    const productCategory =
                        product.dataset.category;


                    if (
                        category === "All Items" ||
                        productCategory === category
                    ) {

                        product.style.display = "";

                    } else {

                        product.style.display = "none";

                    }

                });


                document
                    .getElementById("popular")
                    ?.scrollIntoView({
                        behavior: "smooth"
                    });

            }
        );

    });


    /* =====================================================
       FLASH DEAL COUNTDOWN
    ===================================================== */

    let totalSeconds =
        (8 * 60 * 60) +
        (45 * 60) +
        32;


    function updateCountdown() {

        if (totalSeconds <= 0) {

            totalSeconds =
                8 * 60 * 60;

        }


        const hours =
            Math.floor(
                totalSeconds / 3600
            );


        const minutes =
            Math.floor(
                (totalSeconds % 3600) / 60
            );


        const seconds =
            totalSeconds % 60;


        document.getElementById(
            "hours"
        ).textContent =
            String(hours).padStart(2, "0");


        document.getElementById(
            "minutes"
        ).textContent =
            String(minutes).padStart(2, "0");


        document.getElementById(
            "seconds"
        ).textContent =
            String(seconds).padStart(2, "0");


        totalSeconds--;

    }


    updateCountdown();

    setInterval(
        updateCountdown,
        1000
    );


    /* =====================================================
       LOAD MORE BUTTON
    ===================================================== */

    const loadMoreButton =
        document.getElementById(
            "loadMoreButton"
        );


    if (loadMoreButton) {

        loadMoreButton.addEventListener(
            "click",
            () => {

                showToast(
                    "More products will be loaded here."
                );

            }
        );

    }


    /* =====================================================
       ACTIVE NAVIGATION
    ===================================================== */

    const navLinks =
        document.querySelectorAll(
            ".nav-link"
        );


    navLinks.forEach(link => {

        link.addEventListener(
            "click",
            () => {

                navLinks.forEach(item => {

                    item.classList.remove(
                        "active"
                    );

                });


                link.classList.add(
                    "active"
                );

            }
        );

    });

});
