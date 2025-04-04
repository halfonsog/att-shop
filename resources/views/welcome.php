<?php

$products= [
    ["product_id"=>1, "title"=>"Mangos frescos", "base_price"=>4.3, "price"=>3.0, "tag"=>"-30%", "content"=>"1000g", "image"=>"/images/products/1/default.png"],
    ["product_id"=>2, "title"=>"Naranjas frescas", "base_price"=>4.3, "price"=>3.0, "tag"=>"-30%", "content"=>"1000g", "image"=>"/images/products/2/default.png"],
    ["product_id"=>3, "title"=>"Limones frescos", "base_price"=>4.3, "price"=>3.0, "tag"=>"-25%", "content"=>"1000g", "image"=>"/images/products/3/default.png"],
    ["product_id"=>4, "title"=>"Aceite de oliva puro", "base_price"=>4.3, "price"=>3.0, "tag"=>"-30%", "content"=>"1000ml", "image"=>"/images/products/4/default.png"],
    ["product_id"=>5, "title"=>"File mignon", "base_price"=>4.3, "price"=>3.0, "tag"=>"-30%", "content"=>"500g", "image"=>"/images/products/5/default.png"],
    ["product_id"=>6, "title"=>"Muesli", "base_price"=>4.3, "price"=>3.0, "tag"=>"-30%", "content"=>"1000g", "image"=>"/images/products/6/default.png"],
];

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Navbar Implementation</title>
    <!-- Bootstrap -->
    <link href="/lib/bootstrap-5.3.3/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/lib/bootstrap-icons-1.11.3/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/lib/swiper/swiper-bundle.min.css">
    <link href="/assets/css/att.css" rel="stylesheet">

    <style>

</style>

</head>
<body>
    <!-- Top Navigation Row -->
    <nav class="navbar navbar-light bg-light p-0">
        <div class="container-fluid">
            <!-- Top Row -->
            <div class="navbar-top">
                <!-- Logo -->
                <a class="navbar-brand me-3" href="#">
                    <img src="/assets/att-logo1.png" alt="Logo" height="40">
                </a>

                <!-- Departments Button -->
                <div class="me-3">
                    <button class="btn btn-outline-secondary departments-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#departmentsOffcanvas">
                        <i class="bi bi-grid-fill"></i>
                        <span class="nav-item-text ms-1">Departamentos</span>
                        <span class="menu-chevron"></span><!--i class="bi bi-chevron-down ms-1 departments-chevron"></i-->
                    </button>
                </div>

                <!-- Search Container (grows when space available) -->
                <div class="search-container d-none d-lg-flex">
                    <div class="input-group search-box">
                        <input type="text" class="form-control border-0" placeholder="Buscar...">
                        <button class="btn btn-outline-secondary border-0" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>

                <!-- Search Toggle (Visible on mobile) -->
                <button class="btn btn-outline-secondary d-lg-none me-auto search-toggle" type="button">
                    <i class="bi bi-search"></i>
                </button>

                <!-- Account -->
                <div class="me-3">
                    <a class="nav-link" href="#account">
                        <i class="bi bi-person-fill"></i>
                        <span class="account-name ms-1">huesped</span>
                        <span class="menu-chevron"></span><!--i class="bi bi-chevron-down ms-1"></i-->
                    </a>
                </div>

                <!-- Delivery (Desktop version) -->
                <div class="me-3 delivery-desktop">
                    <a class="nav-link" href="#delivery">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span class="ms-1">Entrega a </span>
                        <span class="fw-bold">Maria - Ciego de Avila</span>
                        <span class="menu-chevron"></span><!--i class="bi bi-chevron-down ms-1"></i-->
                    </a>
                </div>

                <!-- Shopping Cart -->
                <a class="nav-link" href="#cart">
                    <i class="bi bi-cart-fill position-relative">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                        </span>
                    </i>
                </a>
            </div>

            <!-- Delivery Row (Mobile only) -->
            <div class="delivery-row">
                <a class="nav-link" href="#delivery">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>Deliver to </span>
                    <span class="fw-bold">Maria - Ciego de Avila</span>
                    <span class="menu-chevron"></span><!--i class="bi bi-chevron-down ms-1"></i-->
                </a>
            </div>
        </div>
    </nav>

    <!-- Expanded Search (hidden by default) -->
    <div class="container-fluid search-expanded bg-light py-2">
        <div class="container">
            <div class="input-group search-box">
                <input type="text" class="form-control border-0" placeholder="Buscar...">
                <button class="btn btn-outline-secondary border-0 search-go" type="button">
                    <i class="bi bi-search"></i> Buscar
                </button>
            </div>
        </div>
    </div>

    <!-- Departments Offcanvas -->
    <div class="offcanvas offcanvas-start offcanvas-departments" tabindex="-1" id="departmentsOffcanvas">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Departamentos</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-group">
                <li class="list-group-item">Electronics</li>
                <li class="list-group-item">Clothing</li>
                <li class="list-group-item">Home & Kitchen</li>
                <li class="list-group-item">Grocery</li>
                <li class="list-group-item">Toys</li>
            </ul>
        </div>
    </div>

    <main class="content-wrapper">
 
        <!-- Discounted products carousel -->
        <section class="container pt-xl-2 pb-5 mb-2 mb-sm-3 mb-lg-4 mb-xl-5">
        <div class="row">
            <div class="col-12">
            <div class="d-flex align-items-center justify-content-between border-bottom pb-3 pb-md-4 mb-3 mb-lg-4">
                <h2 class="h3 mb-0">Productos con descuentos</h2>
                <div class="nav ms-3">
                <a class="nav-link animate-underline px-0 py-2" href="shop-catalog-grocery.html">
                    <span class="animate-target text-nowrap">Ver todos</span>
                    <i class="bi bi-chevron-right fs-base ms-1"></i>
                </a>
                </div>
            </div>          
            <!-- Swiper container -->
            <div class="swiper discounted-products-swiper">
              <div class="swiper-wrapper">
<?php foreach($products as $p): ?>
                <!-- Product Card -->
                <div class="swiper-slide h-auto" onclick="showProduct('<?= $p['product_id'] ?>')">
                    <div class="card product-card h-100 bg-transparent border-0 shadow-none">
                        
                        <!-- Product Image with Badge -->
                        <div class="position-relative">
                            <!-- Discount Badge -->
                            <span class="badge bg-danger rounded-2 position-absolute top-0 start-0 m-2 px-2 py-1">
                                -<?= $p['tag'] ?>
                            </span>
                            
                            <!-- Product Image (Square with transparent PNG) -->
                            <div class="ratio ratio-1x1 bg-light">
                                <img src="<?= $p['image'] ?>" class="object-fit-contain p-3" alt="<?= $p['title'] ?>">
                            </div>
                        </div>
                        
                        <!-- Product Details -->
                        <div class="card-body p-3">
                            <!-- Prices -->
                            <div class="d-flex align-items-center mb-2">
                                <span class="fw-bold me-2">$<?= $p['price'] ?></span>
                                <span class="text-decoration-line-through text-muted fs-7">$<?= $p['base_price'] ?></span>
                            </div>
                            
                            <!-- Product Title -->
                            <h3 class="h6 mb-1"><?= htmlspecialchars($p['title']) ?></h3>
                            
                            <!-- Weight/Volume -->
                            <p class="text-dark-gray fs-8 mb-2"><?= $p['content'] ?></p>
                            
                            <!-- Add to Cart Button -->
                            <button class="btn btn-sm btn-primary w-100" 
                                    onclick="event.stopPropagation(); addToCart('<?= $p['product_id'] ?>')">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
<?php endforeach; ?>               
              </div>
              <div class="swiper-pagination position-static mt-3 mt-sm-4"></div>
              </div>
          </div>
        </div>
      </section>


    </main>
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="/lib/bootstrap-5.3.3/bootstrap.bundle.min.js"></script>
    <script src="/lib/swiper/swiper-bundle.min.js"></script>
    <script src="/js/att.js"></script>
    
    <script>
     // Initialize the discounted products swiper
    const discountedProductsSwiper = new Swiper('.discounted-products-swiper', {
    // Autoplay configuration
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true
    },
    
    // Slides configuration
    slidesPerView: 2,
    spaceBetween: 15,
    
    // Pagination configuration (bullets only)
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
        type: 'bullets' // Explicitly set to bullets
    },
    
    // No navigation arrows
    navigation: false,
    
    // Responsive breakpoints
    breakpoints: {
        840: {
        slidesPerView: 3
        },
        992: {
        slidesPerView: 4
        }
    }
    });
  </script>
</body>
</html>