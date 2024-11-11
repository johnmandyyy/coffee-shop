<div id="feedback">

    <div class="row">

        <h1 class="display-6 fw-bold mb-0 mt-4"><i class="fa-solid fa-notes"></i>Feedback: </h1>
        <p class="lead fw-normal">Hear what our customer says.</p>

        <div class="col-lg-12 mt-2 pt-4 text-center">

            <div class="row">
                <div v-for="feedback in feedbacks" class="col-lg-3">
                    <div class="card is-rounder mt-2 mb-2">
                        <div class="card-header fw-bold ">
                            {{ feedback.item }}
                        </div>
                        <div class="card-body">
                            <p class="text-muted fw-bold ">{{ feedback.feedback }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>