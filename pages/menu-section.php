<div class="row" id="menu-section">

    <?php include '../modals/universal-modal.php' ?>
    <?php include '../modals/menu-section-modal.php' ?>

    <div class="col-lg-12">

        <h1 class="display-6 fw-bold mb-0"><i class="fa-solid fa-cart-circle-check"></i> Choose from Menu: </h1>
        <p class="lead fw-normal">You may choose from our list of menu from, pastries, to drinks.</p>
        <ul class="nav nav-tabs" id="myTab" role="tablist">


            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="coffee-tab" data-bs-toggle="tab" data-bs-target="#coffee"
                    type="button" role="tab" aria-controls="home" aria-selected="true">Coffee Based</button>
            </li>


            <li class="nav-item" role="presentation">
                <button class="nav-link" id="frappe-tab" data-bs-toggle="tab" data-bs-target="#frappe" type="button"
                    role="tab" aria-controls="frappe" aria-selected="false">Frappe</button>
            </li>


            <li class="nav-item" role="presentation">
                <button class="nav-link" id="milktea-tab" data-bs-toggle="tab" data-bs-target="#milktea" type="button"
                    role="tab" aria-controls="milktea" aria-selected="false">Milktea</button>
            </li>


            <li class="nav-item" role="presentation">
                <button class="nav-link" id="snacks-tab" data-bs-toggle="tab" data-bs-target="#snacks" type="button"
                    role="tab" aria-controls="snacks" aria-selected="false">Snacks</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="recommended-tab" data-bs-toggle="tab" data-bs-target="#recommended"
                    type="button" role="tab" aria-controls="snacks" aria-selected="false">Recommendation(s)</button>
            </li>


            <li v-if="is_logged === true" class="nav-item" role="presentation">
                <button class="nav-link" id="previous-tab" data-bs-toggle="tab" data-bs-target="#previous" type="button"
                    role="tab" aria-controls="previous" aria-selected="false">

                    My Previous
                    Order(s)

                </button>
            </li>


            <li v-if="is_logged === true && loyalty_flag === '1'" class="nav-item" role="presentation">
                <button class="nav-link" id="free-tab" data-bs-toggle="tab" data-bs-target="#free" type="button"
                    role="tab" aria-controls="previous" aria-selected="false">
                    Free Item from Loyalty Card
                </button>
            </li>

        </ul>

        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="coffee" role="tabpanel" aria-labelledby="coffee-tab">
                <!-- Coffee -->
                <div class="col-lg-12 mt-4 pt-4 text-center">
                    <div class="card is-rounder">

                        <div class="card-header">
                            <p class="display-6 fw-bold mb-0 pb-0 text-muted">Coffee
                                Based</p>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div v-for="coffee in list_of_coffee" class="col-lg-4">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <img class="img-fluid" style="width: 10rem;"
                                                src="../assets/images/Cof.png" /><br>

                                            <p class="lead fw-bold text-muted"> {{
                                                coffee.primary_item_name }}</p>

                                            <button class="btn btn-md btn-dark is-rounder btn-md"
                                                @click="setItem(coffee, true)"><i class="fa-solid fa-eye"></i> View
                                                Item</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Cart Button - Fixed at the bottom right -->
                    <button class="btn btn-dark btn-lg rounded-circle position-fixed bottom-0 end-0 m-4"
                        :disabled="is_logged === false" @click="openModal('items_cart')">
                        <p class="lead mt-2"><i class="fa-solid fa-cart-shopping"></i>
                            {{ my_cart.length }} - Item(s)</p>
                    </button>

                </div>
                <!-- Coffee -->
            </div>

            <div class="tab-pane fade" id="frappe" role="tabpanel" aria-labelledby="frappe-tab">
                <!-- Frappe -->
                <div class="col-lg-12 mt-4 pt-4 text-center">
                    <div class="card is-rounder">
                        <div class="card-header">
                            <p class="display-6 fw-bold mb-0 pb-0 text-muted">Frappe</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div v-for="frappe in list_of_frappe" class="col-lg-4">
                                    <div class="card mb-3">
                                        <div class="card-body">

                                            <h1 class="display-1">
                                                <i class="fa-duotone fa-solid fa-blender"></i>
                                            </h1>

                                            <p class="lead fw-bold text-muted"> {{ frappe.item }}</p>

                                            <button class="btn btn-md btn-dark is-rounder btn-md"
                                                :disabled="is_logged === false" @click="setItem(frappe, false)">
                                                <i class="fa-solid fa-eye"></i> View Item
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-dark btn-lg rounded-circle position-fixed bottom-0 end-0 m-4"
                        :disabled="is_logged === false" @click="openModal('items_cart')">
                        <p class="lead mt-2"><i class="fa-solid fa-cart-shopping"></i>
                            {{ my_cart.length }} - Item(s)</p>
                    </button>

                </div>
                <!-- Frappe -->
            </div>

            <div class="tab-pane fade" id="milktea" role="tabpanel" aria-labelledby="milktea-tab">
                <!-- Milktea -->
                <div class="col-lg-12 mt-4 pt-4 text-center">
                    <div class="card is-rounder">
                        <div class="card-header">
                            <p class="display-6 fw-bold mb-0 pb-0 text-muted">Milktea</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div v-for="milktea in list_of_milktea" class="col-lg-4">
                                    <div class="card mb-3">
                                        <div class="card-body">

                                            <h1 class="display-1">
                                                <i class="fa-duotone fa-solid fa-cup-straw"></i>
                                            </h1>

                                            <p class="lead fw-bold text-muted"> {{ milktea.item }}</p>

                                            <button class="btn btn-md btn-dark is-rounder btn-md"
                                                @click="setItem(milktea, false)">
                                                <i class="fa-solid fa-eye"></i> View Item
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-dark btn-lg rounded-circle position-fixed bottom-0 end-0 m-4"
                        :disabled="is_logged === false" @click="openModal('items_cart')">
                        <p class="lead mt-2"><i class="fa-solid fa-cart-shopping"></i>
                            {{ my_cart.length }} - Item(s)</p>
                    </button>

                </div>
                <!-- Milktea -->
            </div>

            <div class="tab-pane fade" id="snacks" role="tabpanel" aria-labelledby="snacks-tab">
                <!-- Snacks -->
                <div class="col-lg-12 mt-4 pt-4 text-center">
                    <div class="card is-rounder">
                        <div class="card-header">
                            <p class="display-6 fw-bold mb-0 pb-0 text-muted">Snacks</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div v-for="snack in list_of_snacks" class="col-lg-4">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h1 class="display-1">
                                                <i class="fa-solid fa-cookie-bite"></i>
                                            </h1>
                                            <p class="lead fw-bold text-muted"> {{ snack.item }}</p>
                                            <button class="btn btn-md btn-dark is-rounder btn-md"
                                                @click="setItem(snack, false)">
                                                <i class="fa-solid fa-eye"></i> View Item
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-dark btn-lg rounded-circle position-fixed bottom-0 end-0 m-4"
                        :disabled="is_logged === false" @click="openModal('items_cart')">
                        <p class="lead mt-2"><i class="fa-solid fa-cart-shopping"></i>
                            {{ my_cart.length }} - Item(s)</p>
                    </button>
                </div>
                <!-- Snacks -->
            </div>

            <div class="tab-pane fade" id="previous" role="tabpanel" aria-labelledby="previous-tab">
                <!-- Previous Order -->

                <div class="row mt-4">
                    <div class="col-lg-12">

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


                <!-- Previous Order -->
            </div>

            <div class="tab-pane fade" id="free" role="tabpanel" aria-labelledby="free-tab">
                <!-- Free active_item -->

                <div class="row mt-4">
                    <div class="col-lg-12">


                        <span v-if="free_item.length > 0" class="fw-bold">
                            <p class="lead fw-normal">
                                You have a free {{ free_item[0].item_name }} from us!
                            </p>
                        </span>

                        <button class="btn btn-dark" @click="claimItem()" :hidden="loyalty_flag !== '1'">Click to
                            Claim</button>

                        <button class="btn btn-dark btn-lg rounded-circle position-fixed bottom-0 end-0 m-4"
                            :disabled="is_logged === false" @click="openModal('items_cart')">
                            <p class="lead mt-2"><i class="fa-solid fa-cart-shopping"></i>
                                {{ my_cart.length }} - Item(s)</p>
                        </button>

                    </div>



                </div>

                <!-- Free Item -->
            </div>

            <div class="tab-pane fade" id="recommended" role="tabpanel" aria-labelledby="recommended-tab">
                <!-- Previous Order -->

                <div class="row mt-4">
                    <div class="col-lg-12">

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

                <button class="btn btn-dark btn-lg rounded-circle position-fixed bottom-0 end-0 m-4"
                    :disabled="is_logged === false" @click="openModal('items_cart')">
                    <p class="lead mt-2"><i class="fa-solid fa-cart-shopping"></i>
                        {{ my_cart.length }} - Item(s)</p>
                </button>


                <!-- Previous Order -->
            </div>

        </div>
    </div>

</div>