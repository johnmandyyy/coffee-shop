<div class="row mt-4" id="profile">


    <?php include '../modals/universal-modal.php' ?>

    <div class="col-lg-12">
        <h1 class="display-6 fw-bold mb-0">
            <i class="fa-solid fa-user"></i>
            Profile
        </h1>
        <p class="lead fw-normal">Here you can customize your profile.</p>


        <div v-if="is_admin === 0" class="card mt-4">

            <div class="card-header">
                <p class="lead fw-bold mb-0 pb-0">Loyalty Card</p>
            </div>

            <div class="card-body text-center">
                <h1 v-if="loyalty_flag === 1" class="display-6 fw-bold">You can claim your free item!</h1>
                <h1 v-if="loyalty_flag === 0" class="display-6 fw-bold">Not Yet Activated</h1>
                <p class="lead  fw-bold text-muted">Minimum of 10 order(s)</p>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">

                <p class="text-normal fw-bold mb-2">
                    Date Joined: *
                </p>

                <input type="text" v-model="doj" class="form-control" disabled />

                <p class="text-normal fw-bold mb-2 mt-2">
                    First Name: *
                </p>
                <input type="text" v-model="first_name" class="form-control" />

                <p class="text-normal fw-bold mb-2 mt-2">
                    Last Name: *
                </p>
                <input type="text" v-model="last_name" class="form-control" />

                <p class="text-normal fw-bold mb-2 mt-2">
                    Mobile Number: *
                </p>
                <input type="text" v-model="mobile" class="form-control" />

                <div class="form-group">
                    <p class="text-normal fw-bold mb-2 mt-2">Address: *</p>
                    <textarea class="form-control" v-model="address" rows="3"></textarea>
                </div>

                <button class="btn btn-lg btn-dark mt-3" @click="updateProfile()">Save Change(s)</button>

            </div>
        </div>

    </div>
</div>