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
            "message": "",
            "proof_of_payment": ''
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
                const receipt = await this.getProofOfPayment(prop.id)
                if (!receipt === false) {
                    if (receipt.data[0].receipt_image !== null) {
                        this.proof_of_payment = '/coffee-shop/media/' + String(receipt.data[0].receipt_image)
                    } else {
                        this.proof_of_payment = null
                    }

                }

            },

            async getProofOfPayment(id) {
                const data = {
                    "id": id
                }
                const result = await axios.post('/coffee-shop/api/fetch.php?table=transaction_header', data)

                if (result.status === 200) {
                    return result
                } else return false

            },
            async getOrderDetails(id) {

                this.proof_of_payment = ''

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


                const previous_oder = await this.getPreviousOrder(prop.id)
                const url = '/coffee-shop/api/patch.php/' + String(prop.id) + '/?table=transaction_header'
                const result = await axios.patch(url, {
                    "is_done": 1
                })

                if (result) {
                    this.message = "Order has been marked as done."

                    // Notify the recepient that the order has been processed.
                    await this.fetchRecepient(prop.id, previous_oder)

                    openModal('universal_modal')
                    await this.getTransactionHistory()
                }

                const is_patch_done = await this.patchDone(previous_oder.data[0].id)

            },

            async fetchRecepient(id, transactions) {
                const url = '/coffee-shop/api/fetch.php?table=transaction_header'
                const data = {
                    'id': id
                }
                const result = await axios.post(url, data)

                if (result) {
                    const email_details = await this.getEmailFromTransactionHeader(result.data[0].register_id)
                    if (!email_details === false) {

                        await this.sendMail(
                            email_details.data[0].email,
                            transactions
                        )
                    }
                } else {
                    return false
                }
            },

            async getEmailFromTransactionHeader(register_id) {
                const url = '/coffee-shop/api/fetch.php?table=register'
                const result = await axios.post(url, {
                    "id": register_id
                })
                if (result) {
                    return result
                } else {
                    return false
                }
            },

            async sendMail(recepient, message) {
                const url = '/coffee-shop/api/sendmail.php'
                const formattedMessage = this.formatMessage(message)
                const data = {
                    'message': formattedMessage,
                    'recepient': recepient
                }
                const result = await axios.post(url, data)
                if (result) {
                    console.log('Notified the recepient.')
                }
            },

            formatMessage(message) {

                const price = message.data[0].total_price_of_all
                const transaction_header_id = message.data[0].transaction_header_id
                const date_of_transaction = message.data[0].dot
                const orders = JSON.parse(message.data[0].json_order)
                const formatted = ''

                const orders_message = ''

                let resultString = 'Your order has been placed and completed successfully. \n\n';

                // Loop through the data array and build the result string
                // orders.forEach(item => {
                //     resultString += `${item.item} - ${item.price}\n`;
                // });

                resultString = resultString + "\n\n" + "Total Price: " + price + "\n\n" + "Transaction Header ID Reference#: " + transaction_header_id + "\n\n" + "Date of Transaction: " + date_of_transaction

                // console.log(resultString)
                return resultString
            },

            async getPreviousOrder(transaction_id) {
                const url = '/coffee-shop/api/fetch.php?table=previous_order'

                const result = await axios.post(url, {
                    "transaction_header_id": transaction_id
                })

                return result
            },


            async patchDone(id) {

                console.log(id)
                console.log('patching id')
                const data = {
                    "is_done": 1
                }

                const result = await axios.patch('/coffee-shop/api/patch.php/' + id + '/?table=previous_order', data)
                return result

            },

        },




    });
</script>


</html>