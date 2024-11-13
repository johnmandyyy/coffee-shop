<div class="row" id="orders-section">

    <?php include '../modals/universal-modal.php' ?>
    <?php include '../modals/orders-section-modal.php' ?>

    <div class="row mt-4">

        <div class="col-lg-12">

            <h1 class="display-6 fw-bold mb-0"><i class="fa-solid fa-cart-circle-check"></i> Order History: </h1>
            <p class="lead fw-normal">Here is the report of transaction history.</p>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table_history">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Mobile</th>
                                    <th>Reference ID (QR PH)</th>
                                    <th>Mode of Order (Pickup / Delivery)</th>
                                    <th>Status</th>
                                    <th>Total Price</th>
                                    <th>Action(s)</th>
                                </tr>
                            </thead>
                            <tbody>


                                <tr v-for="data in history">

                                    <td class="fw-bold">{{ data.dot }}</td>
                                    <td class="text-muted">{{ data.name }}</td>
                                    <td class="text-muted">{{ data.address }}</td>
                                    <td class="text-muted">{{ data.mobile }}</td>
                                    <td class="text-muted">
                                        <span v-if="data.ref_id === null">
                                            Paid in Cash
                                        </span>
                                        <span v-if="data.ref_id === '-1'">
                                            FREE ITEM CLAIMED
                                        </span>
                                    </td>
                                    <td class="text-muted">{{ data.mode_of_pickup === 1 ? 'Delivery' : 'Pickup' }}</td>
                                    <td>{{ data.is_done === 1 ? 'Order(s) Completed' : 'Pending' }}</td>
                                    <td class="text-muted">PHP {{ data.total_price }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <button class="btn btn-dark w-100" @click="viewOrderDetails(data)">
                                                    <i class="fa-solid fa-eye"></i> View Details
                                                </button>
                                            </div>

                                            <div class="col-lg-12 mt-2">
                                                <button class="btn btn-success w-100" :disabled="data.is_done === 1"
                                                    @click="orderComplete(data)">
                                                    <i class="fa-solid fa-check"></i> Mark as Done
                                                </button>
                                            </div>

                                        </div>

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

<script>

</script>