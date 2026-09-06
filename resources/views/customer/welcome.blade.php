<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name', 'Dental Shop') }} | Online Ordering</title>

    <link rel="stylesheet" href="{{ asset('css/customer/customer-welcome.css') }}">

    {{--
        NEW: additive stylesheet for the redesign. It never touches
        customer-welcome.css — it only adds rules for the new premium
        classes below (e.g. .cat-card-premium, .hero-cinematic) and a
        handful of documented overrides (.main-header.scrolled, the
        countdown, etc). If anything ever looks off, this is the only
        file to check first.
    --}}
    <link rel="stylesheet" href="{{ asset('css/customer-welcome-premium.css') }}">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,440;0,9..144,560;1,9..144,440&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>

    {{--
        DATA NOTE: $flashProducts and $products are unchanged from the
        original view — same keys, same ids, same values — only moved
        up so the hero's floating product cards can reference two real
        items instead of inventing new ones. The Flash Deals and
        Popular Products loops further down still consume the exact
        same variables.
    --}}
    @php
        $flashProducts = [
            [
                'id' => 1,
                'name' => 'Nitrile Examination Gloves',
                'category' => 'Infection Control',
                'price' => 180,
                'old_price' => 250,
                'discount' => 28,
                'rating' => 4.9,
                'sold' => 1240,
                'icon' => 'fa-hand',
            ],
            [
                'id' => 2,
                'name' => 'Dental Examination Mirror',
                'category' => 'Instruments',
                'price' => 95,
                'old_price' => 130,
                'discount' => 27,
                'rating' => 4.8,
                'sold' => 856,
                'icon' => 'fa-magnifying-glass',
            ],
            [
                'id' => 3,
                'name' => 'Disposable Face Mask',
                'category' => 'Infection Control',
                'price' => 120,
                'old_price' => 170,
                'discount' => 29,
                'rating' => 4.9,
                'sold' => 2130,
                'icon' => 'fa-mask-face',
            ],
            [
                'id' => 4,
                'name' => 'Dental Composite Resin',
                'category' => 'Restorative',
                'price' => 850,
                'old_price' => 1100,
                'discount' => 23,
                'rating' => 4.7,
                'sold' => 432,
                'icon' => 'fa-tooth',
            ],
        ];

        $products = [
            [
                'id' => 5,
                'name' => 'Stainless Steel Dental Explorer',
                'category' => 'Instruments',
                'price' => 180,
                'rating' => 4.8,
                'sold' => 325,
                'icon' => 'fa-screwdriver',
            ],
            [
                'id' => 6,
                'name' => 'Disposable Dental Bibs',
                'category' => 'Consumables',
                'price' => 145,
                'rating' => 4.9,
                'sold' => 890,
                'icon' => 'fa-sheet-plastic',
            ],
            [
                'id' => 7,
                'name' => 'Orthodontic Brackets Set',
                'category' => 'Orthodontics',
                'price' => 1250,
                'rating' => 4.7,
                'sold' => 210,
                'icon' => 'fa-grip-lines',
            ],
            [
                'id' => 8,
                'name' => 'Dental Cotton Rolls',
                'category' => 'Consumables',
                'price' => 85,
                'rating' => 4.9,
                'sold' => 1560,
                'icon' => 'fa-circle',
            ],
            [
                'id' => 9,
                'name' => 'Root Canal Files',
                'category' => 'Endodontics',
                'price' => 420,
                'rating' => 4.8,
                'sold' => 478,
                'icon' => 'fa-toolbox',
            ],
            [
                'id' => 10,
                'name' => 'Dental Syringe',
                'category' => 'Surgical',
                'price' => 250,
                'rating' => 4.8,
                'sold' => 340,
                'icon' => 'fa-syringe',
            ],
            [
                'id' => 11,
                'name' => 'Professional Toothbrush',
                'category' => 'Oral Care',
                'price' => 99,
                'rating' => 4.9,
                'sold' => 1850,
                'icon' => 'fa-toothbrush',
            ],
            [
                'id' => 12,
                'name' => 'Dental Impression Tray',
                'category' => 'Prosthodontics',
                'price' => 320,
                'rating' => 4.7,
                'sold' => 182,
                'icon' => 'fa-teeth-open',
            ],
        ];
    @endphp

    <!-- ================= TOP BAR ================= -->
    <div class="top-bar">
        <div class="top-container">

            <div class="top-left">
                <span>Download App</span>
                <span class="divider">|</span>
                <span>Follow Us</span>

                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-tiktok"></i></a>
            </div>

            <div class="top-right">
                <a href="#">
                    <i class="fa-regular fa-bell"></i>
                    Notifications
                </a>

                <a href="#">
                    <i class="fa-regular fa-circle-question"></i>
                    Help
                </a>

                <a href="#">
                    <i class="fa-solid fa-globe"></i>
                    English
                </a>
            </div>

        </div>
    </div>


    <!-- ================= MAIN HEADER ================= -->
    {{-- id="mainHeader" added so the premium JS can toggle a "scrolled" class for the glass/sticky effect. Nothing else about this header changed. --}}
    <header class="main-header" id="mainHeader">

        <div class="header-container">

            <!-- LOGO -->
            <a href="{{ route('customer.shop') }}" class="logo">

                <div class="logo-icon">
                    <i class="fa-solid fa-tooth"></i>
                </div>

                <div class="logo-text">
                    <strong>Dental<span>Shop</span></strong>
                    <small>Online Ordering</small>
                </div>

            </a>


            <!-- SEARCH -->
            <div class="search-container">

                <div class="search-box">

                    <input
                        type="text"
                        id="searchInput"
                        placeholder="What are you looking for? Try &quot;gloves&quot;, &quot;composite&quot;, or &quot;dental mirror&quot;"
                        autocomplete="off"
                    >

                    <button type="button" id="searchButton">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>

                </div>

                <div class="search-suggestions" id="searchSuggestions"></div>

                <div class="popular-searches">
                    <span>Popular:</span>
                    <a href="#" data-search="Gloves">Gloves</a>
                    <a href="#" data-search="Dental Mirror">Dental Mirror</a>
                    <a href="#" data-search="Face Mask">Face Mask</a>
                    <a href="#" data-search="Composite">Composite</a>
                </div>

            </div>


            <!-- HEADER ACTIONS -->
            <div class="header-actions">

                <a href="{{ route('customer.cart') }}" class="header-action cart-link">

                    <i class="fa-solid fa-cart-shopping"></i>

                    <span class="cart-count" id="cartCount">
                        0
                    </span>

                </a>


                @auth

                    <a href="{{ route('customer.orders') }}" class="header-action">
                        <i class="fa-solid fa-receipt"></i>
                        <span>Orders</span>
                    </a>

                    <a href="{{ route('customer.profile') }}" class="user-profile">

                        <div class="user-avatar">
                            <i class="fa-solid fa-user"></i>
                        </div>

                        <span>{{ Auth::user()->name }}</span>

                    </a>

                @else

                    <a href="{{ route('login') }}" class="login-link">
                        Login
                    </a>

                @endauth

            </div>

        </div>

    </header>


    <!-- ================= NAVIGATION ================= -->
    <nav class="category-navigation" id="categoryNav">

        <div class="navigation-container">

            <button class="mobile-menu-button" id="mobileMenuButton">
                <i class="fa-solid fa-bars"></i>
            </button>

            <a href="#home" class="nav-link active">
                Home
            </a>

            <a href="#categories" class="nav-link">
                Categories
            </a>

            <a href="#flash-deals" class="nav-link">
                Flash Deals
            </a>

            <a href="#popular" class="nav-link">
                Popular Products
            </a>

            <a href="#about" class="nav-link">
                Why Shop With Us
            </a>

        </div>

    </nav>


    <main>

        <!-- ================= CINEMATIC HERO ================= -->
        {{--
            TODO: swap .hero-cinematic's background gradient for a real
            photo/video of the clinic — e.g. background-image: url('{{ asset('images/hero-clinic.jpg') }}')
            in customer-welcome-premium.css. Kept as a crafted gradient
            here so the page never depends on stock imagery.
        --}}
        <section class="hero-cinematic" id="home">

            <div class="hero-cinematic-media" aria-hidden="true"></div>
            <div class="hero-cinematic-glow" aria-hidden="true"></div>

            <div class="hero-cinematic-container">

                <div class="hero-cinematic-content">

                    <span class="hero-cinematic-label">ONLINE DENTAL STORE</span>

                    <h1 class="hero-cinematic-title">
                        Your practice.<br>
                        Your supplies.<br>
                        One smarter way to order.
                    </h1>

                    <p class="hero-cinematic-copy">
                        Everything your dental practice needs, from everyday essentials to
                        professional equipment — conveniently available in one place.
                    </p>

                    <div class="hero-cinematic-cta">
                        <a href="{{ route('customer.shop') }}" class="btn-cinematic btn-cinematic-primary">
                            Start Shopping
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a href="#categories" class="btn-cinematic btn-cinematic-ghost">
                            Explore Products
                        </a>
                    </div>

                    <ul class="hero-trust-list">
                        <li><i class="fa-solid fa-check"></i> Quality Dental Supplies</li>
                        <li><i class="fa-solid fa-check"></i> Easy Online Ordering</li>
                        <li><i class="fa-solid fa-check"></i> Reliable Service</li>
                    </ul>

                </div>

                {{--
                    Floating cards reuse real catalog data (flashProducts[0]
                    and products[0]) instead of inventing new products, so
                    the "Add to cart" button below hooks into the exact
                    same JS your Flash Deals / Popular cards already use.
                --}}
                <div class="hero-floating-cards" aria-hidden="false">

                    <div class="floating-product-card fpc-one">
                        <span class="fpc-badge">Best Seller</span>
                        <div class="fpc-icon"><i class="fa-solid {{ $flashProducts[0]['icon'] }}"></i></div>
                        <h3>{{ $flashProducts[0]['name'] }}</h3>
                        <div class="fpc-rating">
                            <span class="stars">★★★★★</span>
                            <span>{{ $flashProducts[0]['rating'] }}</span>
                        </div>
                        <div class="fpc-bottom">
                            <strong>₱{{ number_format($flashProducts[0]['price'], 2) }}</strong>
                            <button
                                type="button"
                                class="add-cart-button"
                                data-id="{{ $flashProducts[0]['id'] }}"
                                data-name="{{ $flashProducts[0]['name'] }}"
                                data-price="{{ $flashProducts[0]['price'] }}"
                            >
                                Add to Cart
                            </button>
                        </div>
                    </div>

                    <div class="floating-product-card fpc-two">
                        <span class="fpc-badge fpc-badge-alt">New Arrival</span>
                        <div class="fpc-icon"><i class="fa-solid {{ $products[0]['icon'] }}"></i></div>
                        <h3>{{ $products[0]['name'] }}</h3>
                        <div class="fpc-rating">
                            <span class="stars">★★★★★</span>
                            <span>{{ $products[0]['rating'] }}</span>
                        </div>
                        <div class="fpc-bottom">
                            <strong>₱{{ number_format($products[0]['price'], 2) }}</strong>
                            <a href="{{ route('customer.shop') }}" class="fpc-view-link">View Product</a>
                        </div>
                    </div>

                </div>

            </div>

            <div class="hero-scroll-indicator">
                <span>SCROLL TO EXPLORE</span>
                <div class="hero-scroll-line"></div>
            </div>

        </section>


        <!-- ================= SOCIAL PROOF ================= -->
        {{--
            Numbers below are placeholders clearly marked as such —
            swap the data-count values (and the "Fast" label) for real
            figures once they're available from the orders/products
            tables, e.g. Order::count() / Product::count().
        --}}
        <section class="trust-section" id="trust">
            <div class="trust-container">

                <h2 class="trust-heading">Trusted for everyday dental care</h2>

                <div class="trust-stats">

                    <div class="trust-stat">
                        <div class="trust-stat-value">
                            <i class="fa-solid fa-star"></i> 4.9<span class="trust-stat-suffix">/5</span>
                        </div>
                        <div class="trust-stat-label">Customer Rating</div>
                    </div>

                    <div class="trust-stat">
                        <div class="trust-stat-value">
                            <span class="counter" data-count="1000">0</span>+
                        </div>
                        <div class="trust-stat-label">Orders <span class="trust-placeholder-tag">placeholder</span></div>
                    </div>

                    <div class="trust-stat">
                        <div class="trust-stat-value">
                            <span class="counter" data-count="500">0</span>+
                        </div>
                        <div class="trust-stat-label">Dental Products <span class="trust-placeholder-tag">placeholder</span></div>
                    </div>

                    <div class="trust-stat">
                        <div class="trust-stat-value">Fast</div>
                        <div class="trust-stat-label">Order Processing</div>
                    </div>

                </div>

            </div>
        </section>


        <!-- ================= FEATURES ================= -->
        <section class="features-section">

            <div class="features-container">

                <div class="feature">

                    <div class="feature-icon">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>

                    <div>
                        <strong>Fast Delivery</strong>
                        <span>Reliable delivery to your clinic</span>
                    </div>

                </div>


                <div class="feature">

                    <div class="feature-icon">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>

                    <div>
                        <strong>Secure Shopping</strong>
                        <span>Your information is protected</span>
                    </div>

                </div>


                <div class="feature">

                    <div class="feature-icon">
                        <i class="fa-solid fa-certificate"></i>
                    </div>

                    <div>
                        <strong>Quality Products</strong>
                        <span>Trusted dental supplies</span>
                    </div>

                </div>


                <div class="feature">

                    <div class="feature-icon">
                        <i class="fa-solid fa-headset"></i>
                    </div>

                    <div>
                        <strong>Customer Support</strong>
                        <span>We're here to help</span>
                    </div>

                </div>

            </div>

        </section>


        <!-- ================= CATEGORIES ================= -->
        <section class="section" id="categories">

            <div class="section-header">

                <div>
                    <span class="section-label">
                        FIND WHAT YOUR PRACTICE NEEDS
                    </span>

                    <h2>
                        Categories
                    </h2>

                    <p class="section-subtitle">Explore our dental categories and get exactly what you need.</p>
                </div>

                <a href="#categories" class="view-all">
                    View All
                    <i class="fa-solid fa-chevron-right"></i>
                </a>

            </div>

            {{--
                Every button below KEEPS class="category-card" and
                data-category exactly as before — that's what your
                existing JS filters on. "cat-card-premium" is purely a
                styling hook and is safe to remove without breaking
                anything.
            --}}
            <div class="category-grid cat-grid-premium">

                <button class="category-card cat-card-premium" data-category="All Items">
                    <div class="category-icon"><i class="fa-solid fa-border-all"></i></div>
                    <span class="cat-card-name">All Items</span>
                    <span class="cat-card-desc">Browse the entire catalog.</span>
                    <span class="cat-card-arrow">Explore <i class="fa-solid fa-arrow-right"></i></span>
                </button>

                <button class="category-card cat-card-premium" data-category="Instruments">
                    <div class="category-icon"><i class="fa-solid fa-screwdriver-wrench"></i></div>
                    <span class="cat-card-name">Instruments</span>
                    <span class="cat-card-desc">Precision tools for everyday procedures.</span>
                    <span class="cat-card-arrow">Explore <i class="fa-solid fa-arrow-right"></i></span>
                </button>

                <button class="category-card cat-card-premium" data-category="Consumables">
                    <div class="category-icon"><i class="fa-solid fa-box"></i></div>
                    <span class="cat-card-name">Consumables</span>
                    <span class="cat-card-desc">Daily-use essentials, always on hand.</span>
                    <span class="cat-card-arrow">Explore <i class="fa-solid fa-arrow-right"></i></span>
                </button>

                <button class="category-card cat-card-premium" data-category="Restorative">
                    <div class="category-icon"><i class="fa-solid fa-tooth"></i></div>
                    <span class="cat-card-name">Restorative</span>
                    <span class="cat-card-desc">Composites, cements, and fillings.</span>
                    <span class="cat-card-arrow">Explore <i class="fa-solid fa-arrow-right"></i></span>
                </button>

                <button class="category-card cat-card-premium" data-category="Endodontics">
                    <div class="category-icon"><i class="fa-solid fa-teeth"></i></div>
                    <span class="cat-card-name">Endodontics</span>
                    <span class="cat-card-desc">Files, obturation, and root canal supplies.</span>
                    <span class="cat-card-arrow">Explore <i class="fa-solid fa-arrow-right"></i></span>
                </button>

                <button class="category-card cat-card-premium" data-category="Orthodontics">
                    <div class="category-icon"><i class="fa-solid fa-grip-lines"></i></div>
                    <span class="cat-card-name">Orthodontics</span>
                    <span class="cat-card-desc">Brackets, wires, and alignment tools.</span>
                    <span class="cat-card-arrow">Explore <i class="fa-solid fa-arrow-right"></i></span>
                </button>

                <button class="category-card cat-card-premium" data-category="Prosthodontics">
                    <div class="category-icon"><i class="fa-solid fa-teeth-open"></i></div>
                    <span class="cat-card-name">Prosthodontics</span>
                    <span class="cat-card-desc">Impression and prosthetic materials.</span>
                    <span class="cat-card-arrow">Explore <i class="fa-solid fa-arrow-right"></i></span>
                </button>

                <button class="category-card cat-card-premium" data-category="Surgical">
                    <div class="category-icon"><i class="fa-solid fa-scissors"></i></div>
                    <span class="cat-card-name">Surgical</span>
                    <span class="cat-card-desc">Sterile surgical kits and instruments.</span>
                    <span class="cat-card-arrow">Explore <i class="fa-solid fa-arrow-right"></i></span>
                </button>

                <button class="category-card cat-card-premium" data-category="Infection Control">
                    <div class="category-icon"><i class="fa-solid fa-pump-medical"></i></div>
                    <span class="cat-card-name">Infection Control</span>
                    <span class="cat-card-desc">PPE, sterilization, and barrier products.</span>
                    <span class="cat-card-arrow">Explore <i class="fa-solid fa-arrow-right"></i></span>
                </button>

                <button class="category-card cat-card-premium" data-category="Equipment">
                    <div class="category-icon"><i class="fa-solid fa-microscope"></i></div>
                    <span class="cat-card-name">Equipment</span>
                    <span class="cat-card-desc">Chairs, units, and diagnostic equipment.</span>
                    <span class="cat-card-arrow">Explore <i class="fa-solid fa-arrow-right"></i></span>
                </button>

                <button class="category-card cat-card-premium" data-category="Oral Care">
                    <div class="category-icon"><i class="fa-solid fa-toothbrush"></i></div>
                    <span class="cat-card-name">Oral Care</span>
                    <span class="cat-card-desc">Patient take-home and preventive care.</span>
                    <span class="cat-card-arrow">Explore <i class="fa-solid fa-arrow-right"></i></span>
                </button>

                <button class="category-card cat-card-premium" data-category="Others">
                    <div class="category-icon"><i class="fa-solid fa-ellipsis"></i></div>
                    <span class="cat-card-name">Others</span>
                    <span class="cat-card-desc">Everything else your practice needs.</span>
                    <span class="cat-card-arrow">Explore <i class="fa-solid fa-arrow-right"></i></span>
                </button>

            </div>

        </section>


        <!-- ================= FLASH DEALS ================= -->
        <section class="section flash-section" id="flash-deals">

            <div class="section-header">

                <div class="flash-title">

                    <span class="section-label">
                        LIMITED TIME
                    </span>

                    <h2>
                        Deals Worth Grabbing
                        <span class="live-badge">
                            LIVE
                        </span>
                    </h2>

                    <p class="section-subtitle">Professional dental essentials at special prices — while supplies last.</p>

                </div>


                <div class="countdown">

                    <span class="countdown-label">Ending Soon</span>

                    <div class="time-box" id="hours">
                        08
                    </div>

                    <b>:</b>

                    <div class="time-box" id="minutes">
                        45
                    </div>

                    <b>:</b>

                    <div class="time-box" id="seconds">
                        32
                    </div>

                </div>

            </div>


            <div class="product-grid" id="flashProducts">

                @foreach($flashProducts as $product)

                    <article
                        class="product-card product-card-premium"
                        data-name="{{ strtolower($product['name']) }}"
                        data-category="{{ $product['category'] }}"
                    >

                        <div class="product-image">

                            <span class="discount-badge">
                                -{{ $product['discount'] }}%
                            </span>

                            <button
                                class="wishlist-button"
                                type="button"
                            >
                                <i class="fa-regular fa-heart"></i>
                            </button>

                            <div class="product-placeholder">
                                <i class="fa-solid {{ $product['icon'] }}"></i>
                            </div>

                            {{-- Cosmetic status label only — not a claim of real-time stock data. --}}
                            <span class="stock-pill">In Stock</span>

                        </div>


                        <div class="product-info">

                            <span class="product-category">
                                {{ $product['category'] }}
                            </span>

                            <h3 class="product-name">
                                {{ $product['name'] }}
                            </h3>


                            <div class="rating">

                                <span class="stars">
                                    ★★★★★
                                </span>

                                <span>
                                    {{ $product['rating'] }}
                                </span>

                            </div>


                            <div class="product-sales">
                                {{ number_format($product['sold']) }} sold
                            </div>


                            <div class="product-bottom">

                                <div class="price">

                                    <strong>
                                        ₱{{ number_format($product['price'], 2) }}
                                    </strong>

                                    <del>
                                        ₱{{ number_format($product['old_price'], 2) }}
                                    </del>

                                </div>


                                <button
                                    type="button"
                                    class="add-cart-button"
                                    data-id="{{ $product['id'] }}"
                                    data-name="{{ $product['name'] }}"
                                    data-price="{{ $product['price'] }}"
                                >
                                    <i class="fa-solid fa-cart-plus"></i>
                                </button>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

        </section>


        <!-- ================= FIRST ORDER CTA ================= -->
        <section class="promo-cta">
            <div class="promo-cta-inner">
                <h2>Your next order just got easier.</h2>
                <p>Stop searching through shelves and catalogs. Find your dental essentials, add them to your cart, and place your order in just a few clicks.</p>
                <a href="{{ route('customer.shop') }}" class="btn-cinematic btn-cinematic-primary">
                    Start My Order
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </section>


        <!-- ================= POPULAR PRODUCTS ================= -->
        <section class="section" id="popular">

            <div class="section-header">

                <div>

                    <span class="section-label">
                        CUSTOMER FAVORITES
                    </span>

                    <h2>
                        Dental Professionals' Favorites
                    </h2>

                    <p class="section-subtitle">Discover the products customers keep coming back for.</p>

                </div>

                <a href="#popular" class="view-all">
                    View All
                    <i class="fa-solid fa-chevron-right"></i>
                </a>

            </div>


            <div class="product-grid" id="productGrid">

                @foreach($products as $product)

                    <article
                        class="product-card product-card-premium"
                        data-name="{{ strtolower($product['name']) }}"
                        data-category="{{ $product['category'] }}"
                    >

                        <div class="product-image">

                            <button
                                class="wishlist-button"
                                type="button"
                            >
                                <i class="fa-regular fa-heart"></i>
                            </button>

                            <div class="product-placeholder">
                                <i class="fa-solid {{ $product['icon'] }}"></i>
                            </div>

                            <div class="product-quick-view">Quick View</div>

                        </div>


                        <div class="product-info">

                            <span class="product-category">
                                {{ $product['category'] }}
                            </span>

                            <h3 class="product-name">
                                {{ $product['name'] }}
                            </h3>


                            <div class="rating">

                                <span class="stars">
                                    ★★★★★
                                </span>

                                <span>
                                    {{ $product['rating'] }}
                                </span>

                            </div>


                            <div class="product-sales">
                                {{ number_format($product['sold']) }} sold
                            </div>


                            <div class="product-bottom">

                                <div class="price">

                                    <strong>
                                        ₱{{ number_format($product['price'], 2) }}
                                    </strong>

                                </div>


                                <button
                                    type="button"
                                    class="add-cart-button"
                                    data-id="{{ $product['id'] }}"
                                    data-name="{{ $product['name'] }}"
                                    data-price="{{ $product['price'] }}"
                                >
                                    <i class="fa-solid fa-cart-plus"></i>
                                </button>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>


            <div class="load-more-container">

                <button
                    type="button"
                    class="load-more-button"
                    id="loadMoreButton"
                >
                    View More Products
                </button>

            </div>

        </section>


        <!-- ================= WHY SHOP ================= -->
        <section class="why-section" id="about">

            <div class="section">

                <div class="section-header centered">

                    <div>

                        <span class="section-label">
                            SHOP WITH CONFIDENCE
                        </span>

                        <h2>
                            Why Dental Practices Choose Shine &amp; Smile
                        </h2>

                    </div>

                </div>


                <div class="why-grid why-grid-premium">

                    <div class="why-card">
                        <div class="why-icon"><i class="fa-solid fa-medal"></i></div>
                        <h3>Quality Products</h3>
                        <p>Reliable dental supplies selected for professional use.</p>
                    </div>

                    <div class="why-card">
                        <div class="why-icon"><i class="fa-solid fa-truck"></i></div>
                        <h3>Easy Ordering</h3>
                        <p>Find what you need and order without unnecessary steps.</p>
                    </div>

                    <div class="why-card">
                        <div class="why-icon"><i class="fa-solid fa-tags"></i></div>
                        <h3>Clear Pricing</h3>
                        <p>See prices clearly before adding products to your cart.</p>
                    </div>

                    <div class="why-card">
                        <div class="why-icon"><i class="fa-solid fa-comments"></i></div>
                        <h3>Customer Support</h3>
                        <p>Get assistance whenever you need help with your order.</p>
                    </div>

                </div>

            </div>

        </section>


        <!-- ================= HOW ORDERING WORKS ================= -->
        <section class="section how-section" id="how-it-works">

            <div class="section-header centered">
                <div>
                    <span class="section-label">PROCESS</span>
                    <h2>From Search to Order in Minutes</h2>
                </div>
            </div>

            <div class="how-steps">

                <div class="how-step">
                    <span class="how-step-num">01</span>
                    <h3>Search</h3>
                    <p>Find the dental supplies you need.</p>
                </div>

                <div class="how-step">
                    <span class="how-step-num">02</span>
                    <h3>Select</h3>
                    <p>Choose your products and quantities.</p>
                </div>

                <div class="how-step">
                    <span class="how-step-num">03</span>
                    <h3>Add to Cart</h3>
                    <p>Review everything before checkout.</p>
                </div>

                <div class="how-step">
                    <span class="how-step-num">04</span>
                    <h3>Order</h3>
                    <p>Submit your order and track it.</p>
                </div>

            </div>

        </section>


        <!-- ================= CUSTOMER EXPERIENCE ================= -->
        <section class="experience-section" id="experience">

            <div class="experience-container">

                <div class="experience-copy">
                    <span class="section-label">YOUR ACCOUNT</span>
                    <h2>A Better Way to Manage Your Dental Orders</h2>

                    <ul class="experience-list">
                        <li><i class="fa-solid fa-check"></i> Easy product discovery</li>
                        <li><i class="fa-solid fa-check"></i> Organized categories</li>
                        <li><i class="fa-solid fa-check"></i> Fast shopping</li>
                        <li><i class="fa-solid fa-check"></i> Simple cart management</li>
                        <li><i class="fa-solid fa-check"></i> Order tracking</li>
                        <li><i class="fa-solid fa-check"></i> Customer account</li>
                    </ul>

                    @auth
                        <a href="{{ route('customer.orders') }}" class="btn-cinematic btn-cinematic-outline">View My Orders</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-cinematic btn-cinematic-outline">Create Your Account</a>
                    @endauth
                </div>

                {{-- CSS-only mockup of the ordering UI — not a screenshot, so nothing here needs a real asset. --}}
                <div class="experience-mockup" aria-hidden="true">
                    <div class="mockup-window">
                        <div class="mockup-topbar">
                            <span></span><span></span><span></span>
                        </div>
                        <div class="mockup-row mockup-row-search"></div>
                        <div class="mockup-grid">
                            <div class="mockup-card"></div>
                            <div class="mockup-card"></div>
                            <div class="mockup-card"></div>
                            <div class="mockup-card"></div>
                        </div>
                    </div>
                    <div class="mockup-floating-pill">
                        <i class="fa-solid fa-cart-shopping"></i> Order placed
                    </div>
                </div>

            </div>

        </section>


        <!-- ================= FINAL CTA ================= -->
        <section class="final-cta">
            <div class="final-cta-media" aria-hidden="true"></div>
            <div class="final-cta-inner">
                <h2>Ready to stock your practice?</h2>
                <p>Your dental essentials are only a few clicks away.</p>
                <div class="final-cta-buttons">
                    <a href="{{ route('customer.shop') }}" class="btn-cinematic btn-cinematic-primary">
                        Start Shopping
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <a href="#popular" class="btn-cinematic btn-cinematic-ghost">View Products</a>
                </div>
            </div>
        </section>

    </main>


    <!-- ================= FOOTER ================= -->
    <footer class="footer">

        <div class="footer-container">

            <div class="footer-brand">

                <div class="footer-logo">

                    <div class="logo-icon">
                        <i class="fa-solid fa-tooth"></i>
                    </div>

                    <strong>
                        Dental<span>Shop</span>
                    </strong>

                </div>

                <p>
                    Your trusted online store for dental
                    supplies and equipment.
                </p>

            </div>


            <div class="footer-column">

                <h4>Customer Service</h4>

                <a href="#">Help Center</a>
                <a href="#">Order Tracking</a>
                <a href="#">Shipping Information</a>
                <a href="#">Returns & Refunds</a>

            </div>


            <div class="footer-column">

                <h4>About Us</h4>

                <a href="#">About DentalShop</a>
                <a href="#">Contact Us</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms & Conditions</a>

            </div>


            <div class="footer-column">

                <h4>Follow Us</h4>

                <a href="#">
                    <i class="fab fa-facebook"></i>
                    Facebook
                </a>

                <a href="#">
                    <i class="fab fa-instagram"></i>
                    Instagram
                </a>

                <a href="#">
                    <i class="fab fa-tiktok"></i>
                    TikTok
                </a>

            </div>

        </div>


        <div class="footer-bottom">

            <p>
                © {{ date('Y') }} DentalShop. All rights reserved.
            </p>

        </div>

    </footer>


    <!-- ================= TOAST ================= -->
    <div class="toast" id="toast">

        <div class="toast-icon">
            <i class="fa-solid fa-check"></i>
        </div>

        <div>
            <strong>Added to cart</strong>
            <span id="toastMessage">
                Product added successfully.
            </span>
        </div>

    </div>


    <script src="{{ asset('js/customer-welcome.js') }}"></script>


    <script src="{{ asset('js/customer-welcome-premium.js') }}"></script>

</body>
</html>
