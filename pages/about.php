<!DOCTYPE html>
<html>

<?php

session_start();

//include 'validators.php';
include 'header.php';

?>

<body style="padding-top: 56px" class="bg-light">

    <div class="container mt-4">

        <?php include 'about-section.php' ?>


    </div>

    <?php include '../partials/footer.php' ?>

    <script src="../assets/bootstrap/js/bootstrap.bundle.js"></script>

</body>




</html>


<script>

    new Vue({
        el: "#about",
        data: {
            "mission": "",
            "vision": ""
        },
        computed: {},
        watch: {},
        mounted() {
            this.getMission()
            this.getVision()
        },
        methods: {
            async getMission() {
                const url = '/coffee-shop/api/fetch.php?table=mission'
                const result = await axios.get(url)
                if (result) {
                    this.mission = result.data
                }
            },
            async getVision() {
                const url = '/coffee-shop/api/fetch.php?table=vision'
                const result = await axios.get(url)
                if (result) {
                    this.vision = result.data
                }
            }
        },
    });

</script>