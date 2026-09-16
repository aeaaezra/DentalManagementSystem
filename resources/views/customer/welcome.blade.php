<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#E91E63">
  <title>Shine & Smile Dental Supply</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/orders/landingpage.css') }}">
</head>
<body>

  <div class="page-glow glow-one"></div>
  <div class="page-glow glow-two"></div>

  <header class="site-header" id="siteHeader">
    <div class="nav-wrap">
      <a href="#" class="brand" aria-label="Shine and Smile home">
        <span class="brand-mark"><span>✦</span></span>
        <span class="brand-copy">
          <strong>Shine<span>&</span>Smile</strong>
          <small>DENTAL SUPPLY</small>
        </span>
      </a>

      <nav class="desktop-nav" aria-label="Main navigation">
        <a href="#categories">Categories</a>
        <a href="#products">Popular</a>
        <a href="#how-it-works">How It Works</a>
        <a href="#why-us">Why Us</a>
      </nav>

      <div class="nav-actions">
        <a href="#products" class="search-button" aria-label="Search products">⌕</a>
        <a href="/products" class="cart-button" aria-label="Shopping cart">🛒<span>0</span></a>
        <a href="/customer/login" class="nav-order">Login <span></span></a>
        <button class="menu-button" id="menuButton" aria-label="Open menu" aria-expanded="false">☰</button>
      </div>
    </div>

    <div class="mobile-menu" id="mobileMenu">
      <a href="#categories">Categories</a>
      <a href="#products">Popular Dental Supplies</a>
      <a href="#how-it-works">How It Works</a>
      <a href="#why-us">Why Shine & Smile</a>
      <a href="/customer/login">Log in</a>
      <a href="/products" class="mobile-order">Start Ordering →</a>
    </div>
  </header>

  <main>
    <section class="hero">
      <div class="hero-content reveal">
        <div class="eyebrow"><span class="eyebrow-dot"></span> YOUR DENTAL SUPPLY PARTNER</div>
        <h1>Everything Your Dental Practice Needs.<em>Delivered with Care.</em></h1>
        <p class="hero-description">
          Shop quality dental supplies, instruments, materials, and equipment in one convenient ordering system.
        </p>

        <div class="hero-buttons">
          <a href="/products" class="btn btn-primary">Browse Dental Supplies <span>→</span></a>
          <a href="#categories" class="btn btn-secondary">Explore Categories</a>
        </div>

        <div class="hero-trust">
          <div class="avatar-stack">
            <span>🦷</span><span>👩‍⚕️</span><span>🧑‍⚕️</span><span>+</span>
          </div>
          <div><strong>Trusted by dental professionals</strong><small>Quality supplies. Convenient ordering.</small></div>
        </div>
      </div>

      <div class="hero-visual reveal reveal-delay">
        <div class="visual-orbit orbit-a"></div>
        <div class="visual-orbit orbit-b"></div>
        <div class="pink-light"></div>

        <div class="floating-product product-mirror">
          <div class="product-icon mirror-icon">◯</div><span>Dental Mirror</span>
        </div>
        <div class="floating-product product-forceps">
          <div class="product-icon">✣</div><span>Forceps</span>
        </div>
        <div class="floating-product product-gloves">
          <div class="product-icon glove-icon">🧤</div><span>Examination Gloves</span>
        </div>
        <div class="floating-product product-bracket">
          <div class="product-icon">✦</div><span>Brackets</span>
        </div>

        <div class="supply-box">
          <div class="box-top"></div>
          <div class="box-front">
            <div class="box-logo">✦</div>
            <strong>SHINE<span>&</span>SMILE</strong>
            <small>DENTAL SUPPLY</small>
            <div class="box-line"></div>
            <span class="box-label">PROFESSIONAL ESSENTIALS</span>
          </div>
          <div class="box-side"></div>
        </div>

        <div class="hero-badge">
          <span class="badge-icon">✓</span>
          <div><strong>Practice Ready</strong><small>Reliable dental essentials</small></div>
        </div>
      </div>
    </section>

    <section class="category-section section-pad" id="categories">
      <div class="section-heading reveal">
        <div>
          <span class="section-kicker">SHOP BY CATEGORY</span>
          <h2>Everything for Your <span>Dental Practice</span></h2>
        </div>
        <p>Find the essentials you need, organized for a faster and simpler ordering experience.</p>
      </div>

      <div class="category-track reveal">
        <a class="category-card active" href="/products?category=instruments">
          <div class="category-art instrument-art">✣</div>
          <strong>Dental Instruments</strong><span>Explore →</span>
        </a>
        <a class="category-card" href="/products?category=consumables">
          <div class="category-art consumable-art">🧤</div>
          <strong>Consumables</strong><span>Explore →</span>
        </a>
        <a class="category-card" href="/products?category=restorative">
          <div class="category-art restorative-art">●</div>
          <strong>Restorative</strong><span>Explore →</span>
        </a>
        <a class="category-card" href="/products?category=endodontics">
          <div class="category-art endo-art">⌁</div>
          <strong>Endodontics</strong><span>Explore →</span>
        </a>
        <a class="category-card" href="/products?category=orthodontics">
          <div class="category-art ortho-art">✦</div>
          <strong>Orthodontics</strong><span>Explore →</span>
        </a>
        <a class="category-card" href="/products?category=prosthodontics">
          <div class="category-art prostho-art">◒</div>
          <strong>Prosthodontics</strong><span>Explore →</span>
        </a>
        <a class="category-card" href="/products?category=surgical">
          <div class="category-art surgical-art">⌁</div>
          <strong>Surgical</strong><span>Explore →</span>
        </a>
        <a class="category-card" href="/products?category=infection-control">
          <div class="category-art infection-art">✚</div>
          <strong>Infection Control</strong><span>Explore →</span>
        </a>
        <a class="category-card" href="/products?category=equipment">
          <div class="category-art equipment-art">◉</div>
          <strong>Dental Equipment</strong><span>Explore →</span>
        </a>
        <a class="category-card" href="/products?category=oral-care">
          <div class="category-art oral-art">◉</div>
          <strong>Oral Care</strong><span>Explore →</span>
        </a>
      </div>
    </section>

    <section class="products-section section-pad" id="products">
      <div class="section-heading reveal">
        <div>
          <span class="section-kicker">FEATURED SUPPLIES</span>
          <h2>Popular Dental <span>Supplies</span></h2>
        </div>
        <a class="text-link" href="/products">View all products →</a>
      </div>

      <div class="product-grid">
        <article class="product-card reveal">
          <button class="favorite" aria-label="Add Dental Mirror Set to favorites">♡</button>
          <div class="product-photo photo-mirror"><div class="photo-object mirror-object">◯</div></div>
          <div class="product-info">
            <span class="product-category">Dental Instruments</span>
            <h3>Dental Mirror Set</h3>
            <div class="rating">★★★★★ <span>4.9</span></div>
            <div class="product-bottom"><strong>₱350.00</strong><span class="stock">● In Stock</span></div>
            <a href="/products" class="add-cart">Add to Cart <span>+</span></a>
          </div>
        </article>

        <article class="product-card reveal">
          <button class="favorite" aria-label="Add Dental Explorer Probe to favorites">♡</button>
          <div class="product-photo photo-probe"><div class="photo-object probe-object">⌁</div></div>
          <div class="product-info">
            <span class="product-category">Dental Instruments</span>
            <h3>Dental Explorer Probe</h3>
            <div class="rating">★★★★★ <span>4.8</span></div>
            <div class="product-bottom"><strong>₱280.00</strong><span class="stock">● In Stock</span></div>
            <a href="/products" class="add-cart">Add to Cart <span>+</span></a>
          </div>
        </article>

        <article class="product-card reveal">
          <button class="favorite" aria-label="Add Latex Examination Gloves to favorites">♡</button>
          <div class="product-photo photo-gloves"><div class="photo-object glove-object">🧤</div></div>
          <div class="product-info">
            <span class="product-category">Consumables</span>
            <h3>Latex Examination Gloves</h3>
            <div class="rating">★★★★★ <span>4.9</span></div>
            <div class="product-bottom"><strong>₱450.00</strong><span class="stock">● In Stock</span></div>
            <a href="/products" class="add-cart">Add to Cart <span>+</span></a>
          </div>
        </article>

        <article class="product-card reveal">
          <button class="favorite" aria-label="Add Disposable Dental Masks to favorites">♡</button>
          <div class="product-photo photo-mask"><div class="photo-object mask-object">▰</div></div>
          <div class="product-info">
            <span class="product-category">Infection Control</span>
            <h3>Disposable Dental Masks</h3>
            <div class="rating">★★★★★ <span>4.7</span></div>
            <div class="product-bottom"><strong>₱180.00</strong><span class="stock">● In Stock</span></div>
            <a href="/products" class="add-cart">Add to Cart <span>+</span></a>
          </div>
        </article>

        <article class="product-card reveal">
          <button class="favorite" aria-label="Add Composite Resin Kit to favorites">♡</button>
          <div class="product-photo photo-resin"><div class="photo-object resin-object">▮</div></div>
          <div class="product-info">
            <span class="product-category">Restorative</span>
            <h3>Composite Resin Kit</h3>
            <div class="rating">★★★★★ <span>4.9</span></div>
            <div class="product-bottom"><strong>₱1,850.00</strong><span class="stock">● In Stock</span></div>
            <a href="/products" class="add-cart">Add to Cart <span>+</span></a>
          </div>
        </article>

        <article class="product-card reveal">
          <button class="favorite" aria-label="Add High-Speed Dental Handpiece to favorites">♡</button>
          <div class="product-photo photo-handpiece"><div class="photo-object handpiece-object">◖</div></div>
          <div class="product-info">
            <span class="product-category">Dental Equipment</span>
            <h3>High-Speed Dental Handpiece</h3>
            <div class="rating">★★★★★ <span>4.9</span></div>
            <div class="product-bottom"><strong>₱8,500.00</strong><span class="stock">● In Stock</span></div>
            <a href="/products" class="add-cart">Add to Cart <span>+</span></a>
          </div>
        </article>

        <article class="product-card reveal">
          <button class="favorite" aria-label="Add Orthodontic Bracket Set to favorites">♡</button>
          <div class="product-photo photo-brackets"><div class="photo-object brackets-object">✦</div></div>
          <div class="product-info">
            <span class="product-category">Orthodontics</span>
            <h3>Orthodontic Bracket Set</h3>
            <div class="rating">★★★★★ <span>4.8</span></div>
            <div class="product-bottom"><strong>₱1,200.00</strong><span class="stock">● In Stock</span></div>
            <a href="/products" class="add-cart">Add to Cart <span>+</span></a>
          </div>
        </article>

        <article class="product-card reveal">
          <button class="favorite" aria-label="Add Dental Curing Light to favorites">♡</button>
          <div class="product-photo photo-curing"><div class="photo-object curing-object">◉</div></div>
          <div class="product-info">
            <span class="product-category">Dental Equipment</span>
            <h3>Dental Curing Light</h3>
            <div class="rating">★★★★★ <span>4.9</span></div>
            <div class="product-bottom"><strong>₱3,500.00</strong><span class="stock">● In Stock</span></div>
            <a href="/products" class="add-cart">Add to Cart <span>+</span></a>
          </div>
        </article>
      </div>
    </section>

    <section class="steps-section section-pad" id="how-it-works">
      <div class="center-heading reveal">
        <span class="section-kicker">SIMPLE ORDERING</span>
        <h2>Order Dental Supplies in <span>3 Simple Steps</span></h2>
        <p>Less time searching. More time focused on your patients.</p>
      </div>

      <div class="steps">
        <div class="step reveal">
          <div class="step-number">01</div>
          <div class="step-icon">⌕</div>
          <h3>Browse</h3>
          <p>Find dental supplies by category or search.</p>
        </div>
        <div class="step-line"></div>
        <div class="step reveal reveal-delay">
          <div class="step-number">02</div>
          <div class="step-icon">🛒</div>
          <h3>Add to Cart</h3>
          <p>Select products, quantities, and review your order.</p>
        </div>
        <div class="step-line"></div>
        <div class="step reveal reveal-delay-2">
          <div class="step-number">03</div>
          <div class="step-icon">📦</div>
          <h3>Receive</h3>
          <p>Complete checkout and track your dental supply delivery.</p>
        </div>
      </div>
    </section>

    <section class="why-section section-pad" id="why-us">
      <div class="why-visual reveal">
        <div class="dental-ring"></div>
        <div class="tooth-symbol">♢</div>
        <span class="orbit-dot dot-one"></span><span class="orbit-dot dot-two"></span><span class="orbit-dot dot-three"></span>
      </div>
      <div class="why-content reveal">
        <span class="section-kicker">WHY SHINE & SMILE</span>
        <h2>Made for the way <span>dentistry works.</span></h2>
        <p class="lead">A focused ordering experience designed around the products and workflows dental professionals use every day.</p>
        <div class="benefit-list">
          <div class="benefit"><span>✓</span><div><h3>Quality Dental Products</h3><p>Carefully organized products for everyday dental practice needs.</p></div></div>
          <div class="benefit"><span>✓</span><div><h3>Convenient Ordering</h3><p>Order dental supplies anytime from your phone or computer.</p></div></div>
          <div class="benefit"><span>✓</span><div><h3>Secure Checkout</h3><p>Keep customer and payment information protected.</p></div></div>
          <div class="benefit"><span>✓</span><div><h3>Order Tracking</h3><p>Easily monitor your order from processing to delivery.</p></div></div>
          <div class="benefit"><span>✓</span><div><h3>Reliable Support</h3><p>Get assistance whenever you need help with your order.</p></div></div>
        </div>
      </div>
    </section>

    <section class="serve-section section-pad">
      <div class="center-heading reveal">
        <span class="section-kicker">WHO WE SERVE</span>
        <h2>Built for <span>Dental Professionals</span></h2>
      </div>
      <div class="serve-grid">
        <div class="serve-card reveal"><div class="serve-art">🦷</div><h3>Dentists</h3><p>Essential supplies for daily clinical care.</p></div>
        <div class="serve-card reveal"><div class="serve-art">🏥</div><h3>Dental Clinics</h3><p>Organize purchasing across your practice.</p></div>
        <div class="serve-card reveal"><div class="serve-art">🎓</div><h3>Dental Students</h3><p>Find the supplies needed for training and practice.</p></div>
        <div class="serve-card reveal"><div class="serve-art">👩‍⚕️</div><h3>Dental Assistants</h3><p>Quick access to everyday clinical essentials.</p></div>
        <div class="serve-card reveal"><div class="serve-art">🧑‍🔬</div><h3>Dental Laboratories</h3><p>Source products for efficient laboratory workflows.</p></div>
      </div>
    </section>

    <section class="stats-section section-pad">
      <div class="stats-card reveal">
        <div class="stat"><strong class="counter" data-target="500">0</strong><span>+</span><p>Dental Products</p></div>
        <div class="stat"><strong class="counter" data-target="100">0</strong><span>+</span><p>Dental Professionals</p></div>
        <div class="stat"><strong>4.9</strong><span>/5</span><p>Customer Rating</p></div>
        <div class="stat"><strong>24</strong><span>/7</span><p>Ordering Access</p></div>
      </div>
    </section>

    <section class="promo-section section-pad">
      <div class="promo-card reveal">
        <div class="promo-content">
          <span class="section-kicker">READY WHEN YOU ARE</span>
          <h2>Keep Your Practice <strong>Ready.</strong></h2>
          <p>Get the dental supplies you need, when you need them.</p>
          <a href="/products" class="btn btn-white">Browse Dental Supplies <span>→</span></a>
        </div>
        <div class="promo-art">
          <span class="promo-item item-a">✣</span>
          <span class="promo-item item-b">🧤</span>
          <span class="promo-item item-c">◉</span>
          <span class="promo-item item-d">✦</span>
          <div class="promo-tooth">♢</div>
        </div>
      </div>
    </section>
  </main>

  <footer class="site-footer">
    <div class="footer-main">
      <div class="footer-brand">
        <a href="#" class="brand">
          <span class="brand-mark"><span>✦</span></span>
          <span class="brand-copy"><strong>Shine<span>&</span>Smile</strong><small>DENTAL SUPPLY</small></span>
        </a>
        <p>Quality dental supplies, convenient ordering, and care you can count on.</p>
      </div>
      <div class="footer-links"><h4>Shop</h4><a href="/products">All Products</a><a href="#categories">Categories</a><a href="/products">Popular Supplies</a></div>
      <div class="footer-links"><h4>Support</h4><a href="#how-it-works">How It Works</a><a href="#why-us">Why Us</a><a href="/customer/login">Customer Login</a></div>
      <div class="footer-links"><h4>Account</h4><a href="/customer/login">Log in</a><a href="/products">Start Ordering</a></div>
    </div>
    <div class="footer-bottom"><span>© 2026 Shine & Smile Dental Supply. All rights reserved.</span><span>Professional dental ordering made simple.</span></div>
  </footer>

<script src="{{ asset('js/orders/customer-welcome-premium.js') }}"></script>
</body>
</html>
