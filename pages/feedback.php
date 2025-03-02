<!DOCTYPE html>
<html>

<?php

session_start();

//include 'validators.php';


include 'header.php';

?>

<body style="padding-top: 56px" class="bg-light">

    <div class="container mt-4">


        <?php include 'feedback-section.php' ?>


    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.js"></script>




</body>



</html>


<script>

    new Vue({
        el: "#feedback",
        data: {
            "feedbacks": []
        },
        computed: {},
        watch: {},
        mounted() {
            this.getFeedbacks()
        },
        methods: {
            async getFeedbacks() {
                const url = '/coffee-shop/api/fetch.php?table=feedback'
                const result = await axios.get(url)
                if (result) {
                    this.feedbacks = result.data
                }
            }
        },
    });

</script>