<div class="row mt-4" id="admin">


    <?php include '../modals/universal-modal.php' ?>

    <div class="col-lg-12">

        <h1 class="display-6 fw-bold mb-0">
            <i class="fa-solid fa-user"></i>
            Admin Dashboard
        </h1>

        <p class="lead fw-normal">Here you can customize your profile.</p>


        <div class="row">


            <div class="col-lg-12">
                <div class="card mt-4">
                    <div class="card-body text-center">
                        <h1 class="lead fw-bold"><i class="fa-solid fa-person"></i> Pending Customer Order(s)</h1>
                        <p class="lead text-normal">
                            <span v-if="reports.pending_customers_order">
                                {{ reports.pending_customers_order }}
                            </span>
                            Order(s) are pending.
                        </p>

                        <button class="btn btn-dark btn-lg" @click="goToOrders()">
                            <i class="fa-solid fa-clock"></i> Go to Order(s)
                        </button>
                    </div>
                </div>

            </div>
            <div class="col-lg-3">
                <div class="card mt-4">
                    <div class="card-body text-center">
                        <h1 class="lead fw-bold"><i class="fa-solid fa-sun"></i> Daily Sale(s)</h1>
                        <p class="lead text-muted fw-bold">PHP
                            {{ reports.daily_sales === '' ? '0.00': reports.daily_sales }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card mt-4">
                    <div class="card-body text-center">
                        <h1 class="lead fw-bold"><i class="fa-solid fa-calendar-day"></i> Weekly Sale(s)</h1>
                        <p class="lead fw-bold text-muted">PHP {{ reports.weekly_sales === '' ? '0.00':
                            reports.weekly_sales }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card mt-4">
                    <div class="card-body text-center">
                        <h1 class="lead fw-bold"> <i class="fa-solid fa-calendar-days"></i> Monthly Sale(s)</h1>
                        <p class="lead  fw-bold text-muted">PHP {{ reports.monthly_sales === '' ? '0.00':
                            reports.monthly_sales }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card mt-4">
                    <div class="card-body text-center">
                        <h1 class="lead fw-bold"><i class="fa-solid fa-money-bill-trend-up"></i> Yearly Sale(s)</h1>
                        <p class="lead  fw-bold text-muted">PHP {{ reports.yearly_sales === '' ? '0.00':
                            reports.yearly_sales }}</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>