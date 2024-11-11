<nav class="navbar bg-primary-custom border-bottom-primary-custom fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand"></a>

        <?php

        include 'navbar-button.php';

        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] !== null) {
            include '../partials/sidebar.php';
        }

        ?>

    </div>
</nav>