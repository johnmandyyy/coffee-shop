<div class="modal" id="order_details_modal">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Previous Order Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">



                <div class="text-center">
                    <p class="fw-bold">Price Breakdown:</p>
                    <span v-for="data in active_order_view">
                        {{ data.item }} - PHP {{ data.item_price }}.00 <br>
                    </span>
                </div>

            </div>


        </div>
    </div>
</div>