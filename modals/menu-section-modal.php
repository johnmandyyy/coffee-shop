<div class="modal" id="feedback_modal">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Give us some feedback!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p class="text-normal">

                <ul class="list-group">

                    <li v-for="(item, index) in feedback_cart" :key="index" class="list-group-item">

                        <p class="fw-bold text-muted text-center mb-2">
                            {{ item.item }}
                        </p>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Provide your feedback! :*</label>
                            <textarea class="form-control" v-model="item.feedback" rows="3"></textarea>
                        </div>

                    </li>
                </ul>
                </p>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-dark is-rounder" @click="giveFeedback()"><i
                        class="fa-solid fa-plus"></i> Give Feedback
                </button>
            </div>

        </div>
    </div>
</div>

<div class="modal" id="items_cart">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">My Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <p class="text-normal">

                <ul class="list-group">
                    <li v-for="(item, index) in my_cart" :key="index" class="list-group-item">
                        <p class="fw-bold text-muted text-center mb-2">
                            {{ item.item }}
                        </p>

                        <p v-if="hasAddOns(item.type) === true && item.add_ons.length > 0"
                            class="fw-normal text-muted text-center mb-0 pb-0">
                            Add-Ons:
                        </p>

                        <div class="text-center fw-bold text-muted mt-0 pt-0"
                            v-if="hasAddOns(item.type) === true && item.add_ons.length > 0">
                            <span v-for="added in item.add_ons">
                                <p class="text-normal mt-0 pt-0 mb-0 pb-0">
                                    {{ added.item }}
                                </p>
                            </span>
                        </div>

                        <button v-if="hasAddOns(item.type)" @click="setActiveCustomizedItem(index)"
                            class="btn btn-dark w-100 mb-2 mt-2">
                            <i class="fa-solid fa-coffee-pot"></i> Add
                            Option(s)
                        </button>

                    </li>
                </ul>
                </p>

                <p class="text-normal mb-2 pb-2">Upload Proof of Payment: *</p>

                <!-- Button to trigger file input -->
                <button type="button" class="btn btn-primary bg-dark w-100 mb-2" @click="triggerFileInput">
                    <i class="fa-solid fa-upload"></i> Upload Receipt: *
                </button>

                <!-- Hidden file input -->
                <input type="file" ref="paymentReceipt" @change="handleFileChange" style="display: none;" required />

                <!-- Optionally, display the name of the selected file -->
                <div v-if="fileName" class="mt-2">
                    <p><strong>Selected File: </strong>{{ fileName }}</p>
                </div>

                <p class="text-normal mb-2 pb-2">Payment Method(s): *</p>

                <select class="form-control mb-2" v-model="mode_of_payment">

                    <option value="0" :hidden="loyalty_flag === '1' && is_free_flag === true">Cash</option>
                    <option value="1" :hidden="loyalty_flag === '1' && is_free_flag === true">QR PH</option>
                    <!-- Only render this option if the condition is false -->
                    <option
                        v-if="!(loyalty_flag === '1' && is_free_flag === false) && !(loyalty_flag === '0' && is_free_flag === false)"
                        value="-1">Free Item</option>

                </select>


                <span v-if="mode_of_payment === '1'">
                    <p class="text-normal mb-2 pb-2">QR PH Reference Number: *</p>
                    <input type="text" v-model="qr_ph_reference" class="form-control">
                </span>


                <p class="text-normal mt-2 mb-2 pb-2">Mode of Order: *</p>
                <select class="form-control mb-2" v-model="mode_of_order">
                    <option value="0">Pickup</option>
                    <option value="1">Delivery</option>
                </select>


                <p class="fw-bold text-center">
                    Total Price: PHP {{ computedTotalPrice }}.00
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-dark is-rounder" @click="processTransaction()"><i
                        class="fa-solid fa-plus"></i> Proceed to Checkout
                </button>
            </div>

        </div>
    </div>
</div>

<div class="modal" id="add_ons">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Add-Ons</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <div v-for="adds in available_add_ons">
                    <button class="btn btn-dark is-rounder mb-2 w-100" @click="customizeDrink(adds)">
                        {{ adds.item }}
                        <br>
                        Additional PHP {{ adds.price }}.00
                    </button>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="modal" id="item_category">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">View Item</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">

                <div v-if="is_primary_item === true">
                    <p class="text-normal">
                        Note: Iced Coffee has a size while bottled and hot
                        coffee is pre-sized.
                    </p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="1"
                            v-model="is_iced_or_hot">
                        <label class="form-check-label" for="exampleRadios1">
                            <span class="fw-bold" v-if="iced_size !== null">
                                {{ iced_size }} Oz -
                            </span> Iced {{ active_text }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="2"
                            v-model="is_iced_or_hot">
                        <label class="form-check-label" for="exampleRadios2">
                            Hot {{ active_text }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="3"
                            v-model="is_iced_or_hot">
                        <label class="form-check-label" for="exampleRadios3">
                            Bottled {{ active_text }}
                        </label>
                    </div>

                    <div v-if="is_iced_or_hot === '1'" class="mt-2">
                        <p class="text-normal fw-bold mt-2">Select Size:</p>
                        <button class="btn btn-md btn-dark" @click="setCoffeeSize(16)">16 Oz</button>
                        <button class="btn btn-md btn-dark" @click="setCoffeeSize(22)">22 Oz</button>
                    </div>

                    <p class="text-normal fw-bold mt-2">Select Quantity:</p>


                    <span v-if="active_item" class="fw-bold text-center text-muted">
                        Available Stocks: {{ active_item.data[0].stocks }}
                    </span>

                    <input type="number" v-model="quantity" class="form-control mt-2 pt-2" min="1"
                        :disabled="is_iced_or_hot === null || (is_iced_or_hot === '1' && iced_size === null)" />

                    <p v-if="active_item" class="display-6 lead text-muted text-center fw-bold mt-4">

                        Price: PHP {{ active_item.data[0].price * quantity
                        }}.00
                    </p>
                </div>

                <!-- The v-else should directly follow the v-if block, no empty lines in between -->
                <div v-else>

                    <p class="text-normal fw-bold">
                        {{ this.active_text }}
                    </p>
                    <p class="text-normal fw-bold mt-2">Select Quantity:</p>

                    <span v-if="active_item" class="fw-bold text-center text-muted">
                        Available Stocks: {{ active_item.data[0].stocks }}
                    </span>

                    <input type="number" v-model="quantity" class="form-control mt-2 pt-2 " min="1" />

                    <p v-if="active_item" class="display-6 lead text-muted text-center fw-bold mt-4">
                        Price: PHP {{ active_item.data[0].price * quantity }}.00
                    </p>
                </div>

            </div>

            <div class="modal-footer">

                <button v-if="is_primary_item === true" type="button"
                    :disabled="(is_primary_item === true && iced_size === null && is_iced_or_hot === '1') || is_logged === false"
                    class="btn btn-dark is-rounder" @click="addToCart()"><i class="fa-solid fa-plus"></i> Add
                    to Cart
                </button>


                <button v-else type="button" class="btn btn-dark is-rounder" :disabled="is_logged === false"
                    @click="addToCart()"><i class="fa-solid fa-plus"></i>
                    Add to Cart
                </button>

            </div>

        </div>
    </div>
</div>