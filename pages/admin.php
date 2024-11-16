<?php
session_start();
include 'header.php';
?>

<body style="padding-top: 56px" class="bg-light">

    <div class="container mt-4">

        <?php include 'admin-section.php'; ?>

    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.js"></script>

    <script>

        new Vue({
            el: "#admin",
            data: {
                "message": "",
                "reports": [],
                "most_sold": []
            },
            computed: {},
            watch: {},
            mounted() {
                this.getReports()
                this.getMostSold()
            },

            methods: {
                goToOrders() {
                    window.location.href = '/coffee-shop/pages/orders.php'
                },
                async getReports() {
                    const url = '/coffee-shop/api/defined/reports.php'
                    const result = await axios.get(url)
                    if (result) {
                        this.reports = result.data
                    }
                },
                async getMostSold() {
                    const url = '/coffee-shop/api/defined/most-ordered.php/'
                    const result = await axios.get(url)
                    if (result) {
                        this.most_sold = result.data
                    }

                },
            },
        });

    </script>


</body>

<?php



?>