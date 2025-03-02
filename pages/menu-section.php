<div class="row" id="menu-section">

    <?php include '../modals/universal-modal.php' ?>
    <?php include '../modals/free-item-modal.php' ?>
    <?php include '../modals/menu-section-modal.php' ?>

    <div class="col-lg-12">
        <h1 class="display-6 fw-bold mb-0 text-center">
            <i class="fa-solid fa-cart-circle-check"></i> Our Product(s)
        </h1>
        <p class="text-center lead fw-normal">You may choose from our list of menu from, pastries, to drinks.</p>

        <div class="row">
            <div v-for="coffee in list_of_coffee" class="col-lg-3">
                <div class="card mb-3 text-center">
                    <div class="card-body">
                        <img class="img-fluid" style="width: 10rem;" src="../assets/images/Cof.png" /><br>

                        <p class="lead fw-bold text-muted"> {{
                            coffee.primary_item_name }}</p>

                        <button class="btn btn-md btn-dark is-rounder btn-md" @click="setItem(coffee, true)"
                            :disabled="is_logged === false"><i class="fa-solid fa-eye"></i> View Item</button>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div v-for="frappe in list_of_frappe" class="col-lg-3">
                <div class="card mb-3 text-center">
                    <div class="card-body">


                        <span v-if="frappe.image_src !== null">
                            <img class="img-fluid" style="width: 10rem;" :src="frappe.image_src" /><br>
                        </span>

                        <span v-if="frappe.image_src === null">
                            <img class="img-fluid" style="width: 10rem;" src="../assets/images/frappe.jpg" /><br>
                        </span>


                        <p class="lead fw-bold text-muted"> {{ frappe.item }}</p>

                        <button class="btn btn-md btn-dark is-rounder btn-md" :disabled="is_logged === false"
                            @click="setItem(frappe, false)">
                            <i class="fa-solid fa-eye"></i> View Item
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div v-for="milktea in list_of_milktea" class="col-lg-3">
                <div class="card mb-3 text-center">
                    <div class="card-body">

                        <img class="img-fluid" style="width: 10rem;" src="../assets/images/milktea.png" /><br>

                        <p class="lead fw-bold text-muted"> {{ milktea.item }}</p>

                        <button class="btn btn-md btn-dark is-rounder btn-md" @click="setItem(milktea, false)"
                            :disabled="is_logged === false">
                            <i class="fa-solid fa-eye"></i> View Item
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div v-for="snack in list_of_snacks" class="col-lg-3">
                <div class="card mb-3 text-center">
                    <div class="card-body">

                        <span v-if="snack.image_src !== null">
                            <img class="img-fluid" style="max-height: 200px" :src="snack.image_src" /><br>
                        </span>

                        <span v-if="snack.image_src === null">
                            <img class="img-fluid" style="width: min-;" src="../assets/images/frappe.jpg" /><br>
                        </span>

                        <p class="lead fw-bold text-muted"> {{ snack.item }}</p>
                        <button class="btn btn-md btn-dark is-rounder btn-md" @click="setItem(snack, false)"
                            :disabled="is_logged === false">
                            <i class="fa-solid fa-eye"></i> View Item
                        </button>
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

</div>