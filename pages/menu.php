<!DOCTYPE html>
<html>

<?php
session_start();
include 'header.php';
?>

<body style="padding-top: 56px" class="bg-light">

    <div class="container mt-4">

        <?php include '../partials/pill.php' ?>

        <?php include 'menu-section.php' ?>


    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.js"></script>

</body>



<?php include '../partials/footer.php' ?>


<script>

    new Vue({
        el: "#menu-section",
        data: {

            "quantity": 1, // Used for Anything
            "iced_size": null, // Applicable only for Ice Coffee

            "active_text": "", // Used for displaying text.
            "active_item": null, // Used for Anything

            "active_customized_item": null,
            "prop_coffee_primary_item_id": "", // Active Type of Coffee
            "my_cart": [], // Items in cart
            "feedback_cart": [],
            "feedback_id": null,

            "list_of_coffee": [], // List of Coffee from DB
            "list_of_snacks": [], // List of Snacks from DB
            "list_of_frappe": [],
            "list_of_milktea": [],
            "previous_history": [],

            "is_iced_or_hot": null, // Used for Decision in Modal
            "available_add_ons": [],
            "total_price": 0,
            "is_primary_item": false,
            "is_logged": false,
            "transaction_header_id": null,
            "message": "",
            "user_id": null,

            "mode_of_payment": 0,
            "mode_of_order": 0,
            "qr_ph_reference": null

        },

        computed: {
            // Computed property to calculate the total price of the cart
            computedTotalPrice() {

                let total = 0;
                this.my_cart.forEach(item => {
                    total += item.price;  // Add item price

                    if (item.add_ons && item.add_ons.length > 0)
                        item.add_ons.forEach(addOn => {
                            total += addOn.price;  // Add price of add-ons
                        });

                });


                return total
            }
        },
        watch: {

            async is_iced_or_hot(newValue, oldValue) {

                this.quantity = 1
                this.is_iced_or_hot = newValue
                this.active_item = null

                if (this.is_iced_or_hot === '2') {
                    await this.filterGenericCoffee('hot_coffee')
                }
                else if (this.is_iced_or_hot === '3') {
                    await this.filterGenericCoffee('bottled_coffee')
                }
                else {
                    this.iced_size = null
                }

            }
        },
        mounted() {

            this.getUserDetails()
            this.getAddOns()
            this.getPrimaryItems()
            this.getFrappe()
            this.getMilktea()
            this.getSnacks()
            this.getPreviousOrderHistory()
        },

        methods: {


            async getPreviousOrderHistory() {

                const user = await this.getUserDetails()

                const data = {
                    "register_id": user.data.id
                }

                const result = await axios.post('/coffee-shop/api/fetch.php?table=previous_order', data)

                if (result.status === 200) {
                    this.previous_history = result.data
                    // Wait a tick before initializing DataTable
                    setTimeout(() => {
                        new DataTable('#previous_history');
                    }, 0);
                }

            },

            async getUserDetails() {

                const url = '/coffee-shop/api/user_details.php/'
                const result = await axios.get(url)

                if (result.status === 200) {
                    this.is_logged = true
                    this.user_id = result.data.id
                } else {
                    this.is_logged = false
                }

                return result
            },

            async setPreviousOrder(id) {

                const url = '/coffee-shop/api/fetch.php?table=previous_order'
                const result = await axios.post(url, {
                    "id": id
                })
                this.my_cart = JSON.parse(result.data[0].json_order);
                openModal('items_cart')
            },

            async setFeedback(id) {

                const url = '/coffee-shop/api/fetch.php?table=previous_order'
                const result = await axios.post(url, {
                    "id": id
                })

                this.feedback_id = id

                this.feedback_cart = JSON.parse(result.data[0].json_order);
                this.feedback_cart = this.feedback_cart.map(item => {
                    item.feedback = "";
                    return item;
                });
                openModal('feedback_modal')
            },

            async giveFeedback(id) {

                const feedback_url = '/coffee-shop/api/insert.php?table=feedback'
                this.feedback_cart.forEach(async data => {

                    if (data.feedback !== '') {
                        let result = await axios.post(feedback_url, {
                            "debitable_id": data.id,
                            "item": data.item,
                            "register_id": this.user_id,
                            "feedback": data.feedback
                        })
                    }

                    closeModal('feedback_modal')
                    const feedback_is_done = await this.markFeedback()
                    if (feedback_is_done === true) {
                        this.message = 'Your feedback means to us! Thank you for providing!'
                        await this.getPreviousOrderHistory()
                        openModal('universal_modal')
                    }

                });

            },

            async markFeedback() {

                const url = '/coffee-shop/api/patch.php/' + String(this.feedback_id) + '/?table=previous_order'
                const result = await axios.patch(url, {
                    "has_feedback": 1
                })

                if (result) {
                    return true
                }

                return false
            },


            async getTransactionHeaderId() {
                const url = '/coffee-shop/api/insert.php?table=transaction_header';
                try {
                    const result = await axios.post(url, {
                        "initial_transact": true
                    })
                    console.log('initial transact result')
                    console.log(result)
                    if (result) {
                        console.log('displaying result from get transaction header id.')
                        console.log(result)
                        return result
                    }

                } catch (error) {
                    console.log(error)
                }

            },

            async getPrimaryItems() {
                const url = '/coffee-shop/api/fetch.php?table=primary_items';
                try {
                    const result = await axios.get(url);
                    this.list_of_coffee = result.data
                } catch (error) {
                    console.log(error)
                }
            },

            async setPrimaryItemId(prop) {

                const url = '/coffee-shop/api/fetch.php?table=primary_items';
                try {
                    const result = await axios.get(url);
                    this.list_of_coffee = result.data
                } catch (error) {
                    console.log(error)
                }

            },

            async getSnacks() {
                const url = '/coffee-shop/api/fetch.php?table=debitables';
                try {
                    const filter_snacks = {
                        "type": "snacks"
                    }
                    const result = await axios.post(url, filter_snacks);
                    if (result) {
                        this.list_of_snacks = result.data
                    }
                } catch (error) {
                    console.log(error)
                }
            },

            async getFrappe() {
                const url = '/coffee-shop/api/fetch.php?table=debitables';
                try {
                    const filter_frappe = {
                        "type": "frappe"
                    }
                    const result = await axios.post(url, filter_frappe);
                    if (result) {
                        this.list_of_frappe = result.data
                    }
                } catch (error) {
                    console.log(error)
                }
            },

            async getMilktea() {
                const url = '/coffee-shop/api/fetch.php?table=debitables';
                try {
                    const filter_milktea = {
                        "type": "milktea"
                    }
                    const result = await axios.post(url, filter_milktea);
                    if (result) {
                        this.list_of_milktea = result.data
                    }
                } catch (error) {
                    console.log(error)
                }
            },

            async filterGenericCoffee(category) {

                const url = '/coffee-shop/api/fetch.php?table=debitables_coffee_based';
                const debitable_url = '/coffee-shop/api/fetch.php?table=debitables';

                // Filter table
                try {

                    const filter_coffee = {
                        "primary_item_id": this.prop_coffee_primary_item_id,
                        "category": category,
                    }

                    const result = await axios.post(url, filter_coffee);

                    if (result) {

                        // Set Debitable ID of Iced Coffee
                        const filter_debitable = {
                            "id": result.data[0].debitable_id
                        }

                        const debitable_item = await axios.post(debitable_url, filter_debitable);
                        this.active_item = debitable_item
                    }

                } catch (error) {
                    console.log(error)
                }
            },

            async filterIcedCoffee() {

                const url = '/coffee-shop/api/fetch.php?table=debitables_coffee_based';
                const debitable_url = '/coffee-shop/api/fetch.php?table=debitables';

                // Filter table
                try {

                    const filter_coffee = {
                        "primary_item_id": this.prop_coffee_primary_item_id,
                        "size": this.iced_size
                    }

                    const result = await axios.post(url, filter_coffee);

                    if (result) {

                        // Set Debitable ID of Iced Coffee
                        const filter_debitable = {
                            "id": result.data[0].debitable_id
                        }

                        const debitable_item = await axios.post(debitable_url, filter_debitable);
                        this.active_item = debitable_item
                    }

                } catch (error) {
                    console.log(error)
                }

            },


            async setCoffeeSize(size) {
                this.iced_size = size // Get the Size and Assign
                await this.filterIcedCoffee()
            },


            async setFormat() {
                // Create Initial Transaction Header
                const result = await this.getTransactionHeaderId()

                if (result.status === 201) {
                    this.transaction_header_id = result.data.transaction_header_id
                    let transaction_history_payload = []
                    this.my_cart.forEach(item => {

                        transaction_history_payload.push({
                            "transaction_header_id": result.data.transaction_header_id,
                            "debitable_id": item.id
                        })

                        if (item.add_ons && item.add_ons.length > 0)

                            item.add_ons.forEach(addOn => {
                                transaction_history_payload.push({
                                    "transaction_header_id": result.data.transaction_header_id,
                                    "debitable_id": addOn.id
                                })
                            });

                    });

                    return transaction_history_payload
                }

            },

            async saveLastOrder() {

                const url = '/coffee-shop/api/insert.php?table=previous_order';

                try {

                    const data = {
                        "transaction_header_id": this.transaction_header_id,
                        "previous_order": this.my_cart
                    }

                    const result = await axios.post(url, data)
                    if (result) {
                        console.log('Saved into previous order.')
                    }

                } catch (error) {
                    console.log(error)
                }

            },

            async processTransaction() {

                const formatted_debitables = await this.setFormat()
                const last_order = await this.saveLastOrder()

                const url = '/coffee-shop/api/insert.php?table=transaction_history';

                try {

                    const result = await axios.post(url, formatted_debitables)

                    if (result) {
                        closeModal('items_cart')
                        openModal('universal_modal')
                        this.message = 'Order Success'
                    }

                } catch (error) {
                    console.log(error)
                }



                await this.updateOrder()
                this.resetGenericValues()

            },


            async updateOrder() {
                const url = '/coffee-shop/api/patch.php/' + this.transaction_header_id + '/?table=transaction_header';
                const result = axios.patch(url, {
                    "mode_of_pickup": this.mode_of_order,
                    "ref_id": this.qr_ph_reference
                })

                if (result) {
                    this.my_cart = []
                    this.mode_of_payment = 0
                    this.mode_of_order = 0
                    this.qr_ph_reference = null
                }

            },

            async getAddOns() {
                const url = '/coffee-shop/api/fetch.php?table=debitables';
                try {
                    const result = await axios.post(url, {
                        "type": "add_ons"
                    })
                    this.available_add_ons = result.data
                } catch (error) {
                    console.log(error)
                }
            },

            resetGenericValues() {
                this.active_item = null
                this.iced_size = null
                this.quantity = 1
                this.active_text = ""
                this.prop_coffee_primary_item_id = ""
                this.is_iced_or_hot = null
                this.transaction_header_id = null


            },


            hasAddOns(type) {
                return type === 'hot_coffee' || type === 'iced_coffee' || type === 'bottled_coffee' || type === 'frappe' || type === 'milktea'
            },

            filterAddToCart() {
                // Method Used for adding items.
                console.log(this.active_item.data[0].type)

                if (this.hasAddOns(this.active_item.data[0].type) === false) {
                    const data = {
                        "id": this.active_item.data[0].id,
                        "item": this.active_item.data[0].item,
                        "price": this.active_item.data[0].price,
                        "type": this.active_item.data[0].type
                    }
                    return data
                }

                else if (this.hasAddOns(this.active_item.data[0].type) === true) {
                    return {
                        "id": this.active_item.data[0].id,
                        "item": this.active_item.data[0].item,
                        "price": this.active_item.data[0].price,
                        "type": this.active_item.data[0].type,
                        "add_ons": []
                    }
                }
            },

            setActiveCustomizedItem(index) {
                this.active_customized_item = index
                openModal('add_ons')

            },

            addToCart() {
                for (let i = 0; i < this.quantity; i++) {
                    this.my_cart.push(this.filterAddToCart())
                }
                this.resetGenericValues()
                closeModal('item_category')
            },

            setItem(prop, is_primary) {
                this.resetGenericValues()

                this.is_primary_item = is_primary

                if (is_primary === true) {

                    this.active_text = prop.primary_item_name // Get the Primary Item name and Set
                    this.prop_coffee_primary_item_id = prop.id // Get the Primary Key

                } else {
                    this.active_text = prop.item // Get the Primary Item name and Set
                    this.active_item = {
                        "data": [prop]
                    }
                }

                openModal('item_category')

            },

            customizeDrink(prop) {
                const index_of_active_item = this.active_customized_item
                this.my_cart[index_of_active_item].add_ons.push(
                    prop
                )
                closeModal('add_ons')
            },


        },
    });
</script>


</html>