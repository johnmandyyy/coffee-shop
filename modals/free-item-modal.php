<div class="modal" id="free_item">

    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notice: </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body text-center">
                <span v-if="free_item.length > 0" class="fw-bold">
                    <p class="lead fw-normal">
                        You have a free {{ free_item[0].item_name }} from us!
                    </p>
                </span>

                <button class="btn btn-dark" @click="claimItem()" :hidden="loyalty_flag !== '1'">Click to
                    Claim
                </button>

            </div>

        </div>
    </div>
</div>