<?php
session_start();
include 'header.php';
?>

<body style="padding-top: 56px" class="bg-light">

    <div class="container mt-4">

        <?php include 'profile-section.php'; ?>

    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.js"></script>

    <script>

        new Vue({
            el: "#profile",
            data: {
                "doj": null,
                "first_name": null,
                "last_name": null,
                "mobile": null,
                "address": null,
                "message": ""
            },
            computed: {},
            watch: {},
            mounted() {
                this.getProfileDetails()
            },

            methods: {

                async updateProfile() {
                    const user = await this.getUserDetails()

                    const url = '/coffee-shop/api/patch.php/' + String(user.data.id) + '/?table=register'
                    const result = await axios.patch(url, {
                        "first_name": this.first_name,
                        "last_name": this.last_name,
                        "mobile": this.mobile,
                        "address": this.address
                    })

                    if (result) {
                        this.message = 'Profile Updated.'
                        openModal('universal_modal')
                        await this.getProfileDetails()
                    }
                },

                async getProfileDetails() {

                    const user = await this.getUserDetails()

                    const url = '/coffee-shop/api/fetch.php?table=register'
                    const result = await axios.post(url, {
                        "id": user.data.id
                    })

                    if (result) {
                        this.first_name = result.data[0].first_name
                        this.last_name = result.data[0].last_name
                        this.address = result.data[0].address
                        this.mobile = result.data[0].mobile
                        this.doj = result.data[0].created_at
                    }

                    return result
                },

                async getUserDetails() {

                    const url = '/coffee-shop/api/user_details.php/'
                    const result = await axios.get(url)

                    if (result.status === 200) {
                        this.is_logged = true
                    } else {
                        this.is_logged = false
                    }

                    return result
                }
            },
        });

    </script>


</body>