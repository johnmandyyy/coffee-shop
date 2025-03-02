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
                "message": "",
                "loyalty_flag": 0,
                "is_admin": 0,
                "order_count": 0
            },
            computed: {},
            watch: {},
            computed: {
                checkTrueCount() {
                    return this.getChecks.filter(value => value === true).length
                },

                getChecks() {
                    marks = []
                    if (this.loyalty_flag === '1') {
                        for (let i = 0; i < 10; i++) {
                            marks.push(true)
                        }
                    } else {

                        let remaining = 10
                        const orderCount = parseInt(this.order_count, 10); // Convert order_count to an integer
                        const result = orderCount / 10;
                        const tenths = Math.floor((result * 10) % 10);

                        remaining = remaining - tenths

                        if (remaining != 10) {

                            for (let i = 0; i < tenths; i++) {
                                marks.push(true)
                            }

                            for (let i = 0; i < remaining; i++) {
                                marks.push(false)
                            }

                        } else {
                            for (let i = 0; i < 10; i++) {
                                marks.push(true)
                            }
                        }

                    }
                    return marks
                }

            },
            mounted() {
                this.getProfileDetails()
                this.getFlags()
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
                        this.loyalty_flag = result.data[0].loyalty_flag
                        this.is_admin = result.data[0].is_admin
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
                },

                async getFlags() {

                    const user = await this.getUserDetails()
                    const url = '/coffee-shop/api/defined/get_flags.php?id=' + String(user.data.id)
                    const result = await axios.get(url)
                    if (result.status === 200) {
                        this.loyalty_flag = String(result.data.loyalty_flag)
                        this.order_count = result.data.order_count
                        return result
                    }
                },

            },
        });

    </script>


</body>