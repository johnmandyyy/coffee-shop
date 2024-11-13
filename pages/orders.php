<!DOCTYPE html>
<html>

<?php
session_start();
include 'header.php';
?>

<body style="padding-top: 56px" class="bg-light">

    <div class="container mt-4">

        <?php include 'orders-section.php'; ?>

    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.js"></script>

</body>



<?php include '../partials/footer.php' ?>



<script>

    new Vue({
        el: "#orders-section",
        data: {
            "history": [],
            "active_order_view": [],
            "active_order_details": [],
            "message": ""
        },
        computed: {},
        watch: {},
        mounted() {
            this.getTransactionHistory()
        },
        methods: {

            async getTransactionHistory() {
                const result = await axios.get('/coffee-shop/api/fetch.php?table=transaction_header')
                if (result.status === 200) {
                    this.history = result.data
                    // Wait a tick before initializing DataTable
                    setTimeout(() => {
                        new DataTable('#table_history');
                    }, 0);
                }
            },

            async viewOrderDetails(prop) {
                await this.getOrderDetails(prop.id)
            },

            async getOrderDetails(id) {

                const data = {
                    "transaction_header_id": id
                }

                const result = await axios.post('/coffee-shop/api/fetch.php?table=transaction_history', data)

                if (result.status === 200) {

                    await this.getInDepthDetails(result.data[0].transaction_header_id)
                    this.active_order_view = result.data
                    openModal('order_details_modal')
                }
            },

            async getInDepthDetails(id) {
                const url = '/coffee-shop/api/fetch.php?table=previous_order'
                const result = await axios.post(url, {
                    "transaction_header_id": id
                })

                if (result) {
                    this.active_order_details = JSON.parse(result.data[0].json_order)
                }

            },

            async orderComplete(prop) {
                const url = '/coffee-shop/api/patch.php/' + String(prop.id) + '/?table=transaction_header'
                const result = await axios.patch(url, {
                    "is_done": 1
                })

                if (result) {
                    this.message = "Order has been marked as done."
                    openModal('universal_modal')
                    await this.getTransactionHistory()
                }

            },

        },




    });
</script>


</html>