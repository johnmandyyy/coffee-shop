<?php
session_start();

include 'header.php';

if (isset($_SESSION['user_id']) && $_SESSION['user_id'] !== null) {
    header("Location: /coffee-shop/pages/index.php");
}

?>

<style>
    .background-image {
        background: url('../assets/images/bg2.jpg') no-repeat center center/cover;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }
</style>

<body class="background-image">
    <div class="container d-flex justify-content-center align-items-center vh-100" id="register">

        <?php include '../modals/universal-modal.php'; ?>
        <div class="card shadow-lg" style="width: 400px;">
            <div class="card-body">
                <h4 class="card-title text-center mb-4">Register</h4>


                <div class="mb-3">
                    <label for="username" class="form-label">Email Address</label>
                    <input type="email" v-model="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" v-model="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" v-model="password" class="form-control" required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <button type="button" class="btn btn-dark lg w-100" @click="login()">Login</button>
                </div>


                <div class="text-center">
                    <p class="small">Already have an account?<a href="login.php"> Login Here </a></p>
                </div>

            </div>
        </div>
    </div>
</body>

<script>

    new Vue({

        el: "#register",
        data: {

            "message": "",
            "username": null,
            "password": null,
            "email": null,

        },
        computed: {},
        watch: {},
        mounted() {

        },

        methods: {

            async login() {

                const url = '/coffee-shop/api/insert.php?table=register'

                const result = await axios.post(url, {
                    "username": this.username,
                    "password": this.password,
                    "email": this.email
                })

                if (result.status === 201) {
                    this.message = 'You have successfully created an account!'

                    this.username = ''
                    this.password = ''
                    this.email = ''

                    openModal('universal_modal')
                    // window.location.href = "/coffee-shop/pages/login.php"
                } else {
                    this.message = 'There was a problem on creating your account.'
                    openModal('universal_modal')
                }



            }
        },
    });
</script>