<nav class="navbar navbar-lg bg-dark text-light fixed-top py-3" id="navbar">
    <div class="container-fluid">
        <a class="navbar-brand text-light">
            Craffe MYCC
        </a>

        <div class="d-flex">
            <a class="nav-link active ms-3 text-light" aria-current="page" href="/coffee-shop">HOME</a>
            <a class="nav-link ms-3 text-light" href="/coffee-shop/pages/about.php">ABOUT</a>
            <a class="nav-link ms-3 text-light" href="/coffee-shop/pages/menu.php">MENU</a>
            <a class="nav-link ms-3 text-light" href="/coffee-shop/pages/feedback.php">FEEDBACK</a>

            <span v-if="is_logged === true">
                <a class="nav-link ms-3 text-light" href="/coffee-shop/pages/previous-section.php">ORDERS /
                    RECOMMENDATIONS</a>
            </span>


            <a class="nav-link ms-3 text-light" href="/coffee-shop/pages/login.php"
                :hidden="is_logged === true">LOGIN</a>
        </div>

        <button class="navbar-toggler bg-dark" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars text-light"></i>
        </button>

        <?php

        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] !== null) {
            include '../partials/sidebar.php';
        }

        ?>

    </div>
</nav>

<script>

    new Vue({
        el: "#navbar",
        data: {
            "is_logged": false,
            "permission": 0
        },
        computed: {},
        watch: {},
        mounted() {
            this.getPermission()
        },
        methods: {

            async getPermission() {

                try {
                    console.log('Permission async exectue.')
                    const user = await this.getUserDetailsNavbar(); // Fetch user details
                    const url = '/coffee-shop/api/fetch.php?table=register';  // Correct API URL
                    const result = await axios.post(url, { "id": user.data.id });
                    if (result) {
                        this.permission = result.data[0].is_admin

                    }
                } catch (error) {
                    console.log(error)
                    console.error("Error fetching mission data:", error);
                }
            },

            async getUserDetailsNavbar() {
                const url = '/coffee-shop/api/user_details.php/'
                const result = await axios.get(url)

                if (result.status === 200) {
                    this.is_logged = true
                    this.user_id = result.data.id
                } else {
                    this.is_logged = false
                }
                console.log('this is the id')
                console.log(result)
                return result
            },
        },
    });

</script>