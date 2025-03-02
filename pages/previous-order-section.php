<div class="row" id="menu-section">

    <?php include '../modals/universal-modal.php' ?>
    <?php include '../modals/free-item-modal.php' ?>
    <?php include '../modals/menu-section-modal.php' ?>

    <div class="col-lg-12 mb-4">

        <h1 class="display-6 fw-bold mb-0 text-center">
            <i class="fa-solid fa-clock-rotate-left"></i> Recommendation and Order(s)
        </h1>


        <p class="text-center lead fw-normal text-muted mb-4">Here you can order again and see our recommended menu or
            bundles.</p>

        <div class="card mb-4">

            <div class="card-body">
                <div class="card-title fw-bold lead text-center">
                    Recommendation(s)
                </div>

                <div class="table-responsive">
                    <table class="table" id="recommendation_history">
                        <thead>
                            <tr>
                                <th>Items</th>
                                <th>Action(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="data in recommendation_history">


                                <td>
                                    <span v-for="orders in JSON.parse(data.json_order)" class="text-muted">
                                        {{ orders.item }}<br>
                                    </span>

                                </td>

                                <td>

                                    <button class="btn btn-dark" @click="setPreviousOrder(data.id)"><i
                                            class="fa-solid fa-repeat"></i> Try Bundle
                                    </button>
                            </tr>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>


        <div class="card">
            <div class="card-body">

                <div class="card-title fw-bold lead text-center">
                    My Previous Order History(s)
                </div>

                <div class="table-responsive">
                    <table class="table" id="previous_history">
                        <thead>
                            <tr>
                                <th>Date of Order</th>
                                <th>Items</th>
                                <th>Action(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="data in previous_history">

                                <td class="text-muted">
                                    {{ data.dot }}
                                </td>

                                <td>
                                    <span v-for="orders in JSON.parse(data.json_order)" class="text-muted">
                                        {{ orders.item }}<br>
                                    </span>

                                </td>

                                <td>
                                    <button class="btn btn-dark" @click="setPreviousOrder(data.id)"><i
                                            class="fa-solid fa-repeat"></i> Order
                                        Again
                                    </button>

                                    <button class="btn btn-dark" @click="setFeedback(data.id)"
                                        :disabled="data.has_feedback === 1">
                                        <i class="fa-solid fa-comment"></i> Give Feedback
                                    </button>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <button class="btn btn-dark btn-lg rounded-circle position-fixed bottom-0 end-0 m-4"
            :disabled="is_logged === false" @click="openModal('items_cart')">
            <p class="lead mt-2"><i class="fa-solid fa-cart-shopping"></i>
                {{ my_cart.length }} - Item(s)</p>
        </button>

    </div>

</div>