<nav class="nav" id="nav_pill">
    <a class="nav-link active" aria-current="page" href="/coffee-shop">Home</a>
    <a class="nav-link" href="/coffee-shop/pages/about.php">About</a>
    <a class="nav-link" href="/coffee-shop/pages/menu.php">Menu</a>
    <a class="nav-link" href="/coffee-shop/pages/feedback.php">Feedback</a>
    <a class="nav-link" href="/coffee-shop/pages/login.php" :hidden="is_logged === true">Log-In</a>
</nav>

<script>

    new Vue({
        el: "#nav_pill",
        data: {
            "is_logged": false
        },
        computed: {},
        watch: {},
        mounted() {
            this.getUserDetails()
        },
        methods: {
            async getUserDetails() {

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