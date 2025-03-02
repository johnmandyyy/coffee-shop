<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <div class="text-center">

            <h1 class="display-3"><i class="fa-solid fa-circle-user"></i></h1>
            <p class="lead">Welcome {{ permission === 0 ? 'User' : 'Admin' }}</p>
        </div>

        <ul class="navbar-nav">
            <!-- Admin Section -->
            <li v-if="permission === 1" class="nav-item">
                <a class="nav-link fw-normal text-muted" href="/coffee-shop/pages/admin.php">
                    <i class="fa-solid fa-gauge p-3"></i>Admin Dashboard(s)
                </a>
            </li>

            <li v-if="permission === 1" class="nav-item">
                <a class="nav-link fw-normal text-muted" href="/coffee-shop/pages/orders.php">
                    <i class="fa-solid fa-burger-soda p-3"></i>Order(s)
                </a>
            </li>

            <li v-if="permission === 1" class="nav-item">
                <a class="nav-link fw-normal text-muted" href="/coffee-shop/pages/inventory.php">
                    <i class="fa-solid fa-shelves-empty p-3"></i>Inventory and Stock(s)
                </a>
            </li>

            <li v-if="permission === 1" class="nav-item">
                <a class="nav-link fw-normal text-muted" href="/coffee-shop/pages/feedback.php">
                    <i class="fa-solid fa-house p-3"></i>Feedback(s)
                </a>
            </li>

            <!-- User Section -->
            <li v-if="permission === 0" class="nav-item">
                <a class="nav-link fw-normal text-muted" href="/coffee-shop/pages/menu.php">
                    <i class="fa-solid fa-bars p-3"></i>Order / Menu
                </a>
            </li>

            <!-- Profile and Sign-out Links -->
            <li class="nav-item">
                <a class="nav-link fw-normal text-muted" href="/coffee-shop/pages/profile.php">
                    <i class="fa-solid fa-user p-3"></i>Profile
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link fw-normal text-muted" href="/coffee-shop/pages/logout.php/">
                    <i class="fa-solid fa-right-from-bracket p-3"></i>Sign-out
                </a>
            </li>
        </ul>
    </div>
</div>