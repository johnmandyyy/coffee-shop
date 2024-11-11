<?php
session_start();
include 'header.php';
?>

<body style="padding-top: 56px" class="bg-light">

    <div class="container mt-4">

        <div class="row mt-4" id="profile">

            <?php include '../modals/inventory-modal.php' ?>
            <?php include '../modals/universal-modal.php' ?>

            <div class="col-lg-12">
                <h1 class="display-6 fw-bold mb-0">
                    <i class="fa-solid fa-shelves"></i>
                    Inventory
                </h1>
                <p class="lead fw-normal">Here you can manage the stock(s) of inventory and price(s).</p>



                <div class="card mt-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table_inventory">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Item</th>
                                        <th>Price in (PHP)</th>
                                        <th>Type</th>
                                        <th>Stocks</th>
                                        <th>Action(s)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="data in inventory">
                                        <td>{{ data.id }}</td>
                                        <td>{{ data.item }}</td>
                                        <td>PHP {{ data.price }}.00</td>
                                        <td>
                                            <span v-if="data.type === 'add_ons'">
                                                Add On(s)
                                            </span>
                                            <span v-if="data.type === 'iced_coffee'">
                                                Iced Coffee
                                            </span>
                                            <span v-if="data.type === 'bottled_coffee'">
                                                Bottled Coffee
                                            </span>
                                            <span v-if="data.type === 'hot_coffee'">
                                                Bottled Coffee
                                            </span>
                                            <span v-if="data.type === 'snacks'">
                                                Snack(s) / Pastries
                                            </span>
                                            <span v-if="data.type === 'milktea'">
                                                Milktea
                                            </span>
                                            <span v-if="data.type === 'frappe'">
                                                Frappe
                                            </span>
                                        </td>

                                        <td>{{ data.stocks }}</td>

                                        <td>
                                            <button class="btn btn-dark lg" @click="updateItem(data)">
                                                <i class="fa-solid fa-eye"></i> Update Item
                                            </button>
                                        </td>

                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.js"></script>


    <script>

        new Vue({
            el: "#profile",
            data: {

                "doj": null,
                "first_name": null,
                "last_name": null,
                "inventory": [],
                "active_item": {},
                "message": ""
            },
            computed: {},
            watch: {},
            mounted() {
                this.getProfileDetails()
                this.getStocks()
            },

            methods: {
                updateItem(prop) {
                    console.log(prop)
                    this.active_item = prop
                    openModal('inventory_modal')
                },

                async patchItem(prop) {
                    const url = '/coffee-shop/api/patch.php/' + String(prop.id) + '/?table=debitables'
                    console.log(prop)
                    const result = await axios.patch(url, {
                        "price": prop.price,
                        "stocks": prop.stocks
                    })

                    if (result) {
                        this.message = 'Record was updated.'
                        openModal('universal_modal')
                    }

                    closeModal('inventory_modal')
                },
                async getStocks() {
                    const url = '/coffee-shop/api/fetch.php?table=debitables'
                    const result = await axios.get(url)

                    if (result) {
                        this.inventory = result.data
                    }
                    // Wait a tick before initializing DataTable
                    setTimeout(() => {
                        new DataTable('#table_inventory');
                    }, 0);

                },
                async updateProfile() {
                    const user = await this.getUserDetails()

                    const url = '/coffee-shop/api/patch.php/' + String(user.data.id) + '/?table=register'
                    const result = await axios.patch(url, {
                        "first_name": this.first_name,
                        "last_name": this.last_name
                    })

                    if (result) {
                        alert('Profile Updated.')
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