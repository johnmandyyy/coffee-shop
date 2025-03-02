<body style="padding-top: 56px" class="bg-light">

    <div class="container mt-4">

        <?php include 'home.php' ?>

    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.js"></script>

</body>

<script>

    new Vue({
        el: "#orders-section",
        data: {
            "is_admin": 0,
            "message": ""
        },
        computed: {},
        watch: {},
        mounted() {
            this.getRedirect()
        },
        methods: {

            async getUserDetails() {
                const url = '/coffee-shop/api/user_details.php/'
                const result = await axios.get(url)
                return result
            },

            async getRedirect() {
                const user = await this.getUserDetails()
                console.log(user.data.id)
                const url = '/coffee-shop/api/fetch.php?table=register'
                const result = await axios.post(url, {
                    "id": user.data.id
                })

                if (result) {
                    if (result.data[0].is_admin === 1) {
                        window.location.href = '/coffee-shop/pages/admin.php'
                    }
                }

            }

        },




    });
</script>