<div class="modal" id="inventory_modal">

    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ active_item.item }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <p class="text-normal mb-0 pt-2">Price: *</p>
                <input type="text" v-model="active_item.price" class="mt-2 form-control">

                <p class="text-normal mb-0 pt-2">Stock(s): *</p>
                <input type="text" v-model="active_item.stocks" class="mt-2 form-control">

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-dark is-rounder" @click="patchItem(active_item)"><i
                        class="fa-solid fa-plus"></i>
                    Save
                </button>
            </div>

        </div>
    </div>
</div>