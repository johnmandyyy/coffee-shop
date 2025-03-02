<div class="modal" id="order_details_modal">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title fw-bold">Item Detail(s):</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="text-center">

                    <span v-if="proof_of_payment !== null">
                        <p class="fw-bold mt-2">Proof of Payment:</p>

                        <img class="img-fluid mb-2" :src="proof_of_payment">

                    </span>


                    <span v-for="item in active_order_details">
                        <br>{{ item.item }}
                        <span v-if="item.add_ons">
                            <span v-if="item.add_ons.length > 0"><br>
                                <span class="fw-bold">With Add Ons</span>
                                <span v-for="adds in item.add_ons">
                                    <br>{{ adds.item }}
                                </span>
                            </span>
                        </span>

                        <br>
                    </span>

                    <p class="fw-bold mt-2">Price Breakdown:</p>
                    <span v-for="data in active_order_view">
                        {{ data.item }} - PHP {{ data.item_price }}.00 <br>
                    </span>
                </div>

            </div>


        </div>
    </div>
</div>