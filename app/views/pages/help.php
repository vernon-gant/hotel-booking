<?php
require_once APPROOT . '/views/includes/head.php';
require_once APPROOT . '/views/includes/navbar.php'
?>
    <div class="container py-md-5 py-4">
        <div class="row justify-content-center mb-4 mb-md-5">
            <div class="col-10 col-sm-8 col-lg-6 text-center">
                <h3>Frequently Asked Questions</h3>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-10 col-sm-10 col-lg-8">
                <div class="accordion-flush"
                     id="faq">
                    <div class="card border-2 rounded-2 faq-card mb-3 mb-md-4">
                        <div class="accordion-item">
                            <h2 class="accordion-header"
                                id="flush-headingOne">
                                <button aria-controls="flush-collapseOne"
                                        aria-expanded="false"
                                        class="accordion-button collapsed"
                                        data-bs-target="#flush-collapseOne"
                                        data-bs-toggle="collapse"
                                        type="button">
                                    How can I book at Motel X?
                                </button>
                            </h2>
                            <div aria-labelledby="flush-headingOne"
                                 class="accordion-collapse collapse"
                                 data-bs-parent="#faq"
                                 id="flush-collapseOne">
                                <div class="accordion-body">Sign in and book your desired stay. Your data will be transferred directly to our system, and you will receive your
                                    voucher upon arrival.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-2 rounded-2 faq-card mb-3 mb-md-4">
                    <div class="accordion-item">
                        <h2 class="accordion-header"
                            id="flush-headingTwo">
                            <button aria-controls="flush-collapseTwo"
                                    aria-expanded="false"
                                    class="accordion-button collapsed"
                                    data-bs-target="#flush-collapseTwo"
                                    data-bs-toggle="collapse"
                                    type="button">
                                How many rooms can I book at once on motel-one.com?
                            </button>
                        </h2>
                        <div aria-labelledby="flush-headingTwo"
                             class="accordion-collapse collapse"
                             data-bs-parent="#faq"
                             id="flush-collapseTwo">
                            <div class="accordion-body">Online you can book up to 4 rooms at a time.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-2 rounded-2 faq-card mb-3 mb-md-4">
                    <div class="accordion-item">
                        <h2 class="accordion-header"
                            id="flush-headingThree">
                            <button aria-controls="flush-collapseThree"
                                    aria-expanded="false"
                                    class="accordion-button collapsed"
                                    data-bs-target="#flush-collapseThree"
                                    data-bs-toggle="collapse"
                                    type="button">
                                Can parking spaces be reserved?
                            </button>
                        </h2>
                        <div aria-labelledby="flush-headingThree"
                             class="accordion-collapse collapse"
                             data-bs-parent="#faq"
                             id="flush-collapseThree">
                            <div class="accordion-body">Yes, you can reserve a parking space for a fee of € 10.00 per night. Please note that the number of parking spaces is
                                limited.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-2 rounded-2 faq-card mb-3 mb-md-4">
                    <div class="accordion-item">
                        <h2 class="accordion-header"
                            id="flush-headingFour">
                            <button aria-controls="flush-collapseFour"
                                    aria-expanded="false"
                                    class="accordion-button collapsed"
                                    data-bs-target="#flush-collapseFour"
                                    data-bs-toggle="collapse"
                                    type="button">
                                How can I change my profile data?
                            </button>
                        </h2>
                        <div aria-labelledby="flush-headingFour"
                             class="accordion-collapse collapse"
                             data-bs-parent="#faq"
                             id="flush-collapseFour">
                            <div class="accordion-body">Sign in and click on "Profile". There you will see your entered data and can change them.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-2 rounded-2 faq-card mb-3 mb-md-4">
                <div class="accordion-item">
                    <h2 class="accordion-header"
                        id="flush-headingFive">
                        <button aria-controls="flush-collapseFive"
                                aria-expanded="false"
                                class="accordion-button collapsed"
                                data-bs-target="#flush-collapseFive"
                                data-bs-toggle="collapse"
                                type="button">
                            Where can I find your contact information?
                        </button>
                    </h2>
                    <div aria-labelledby="flush-headingFive"
                         class="accordion-collapse collapse"
                         data-bs-parent="#faq"
                         id="flush-collapseFive">
                        <div class="accordion-body">At the very bottom of the home page footer you will find the "About us" section.
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-2 rounded-2 faq-card mb-3 mb-md-4">
                <div class="accordion-item">
                    <h2 class="accordion-header"
                        id="flush-headingSix">
                        <button aria-controls="flush-collapseSix"
                                aria-expanded="false"
                                class="accordion-button collapsed"
                                data-bs-target="#flush-collapseSix"
                                data-bs-toggle="collapse"
                                type="button">
                            Can I write and upload a news article myself?
                        </button>
                    </h2>
                    <div aria-labelledby="flush-headingSix"
                         class="accordion-collapse collapse"
                         data-bs-parent="#faq"
                         id="flush-collapseSix">
                        <div class="accordion-body">Unfortunately not, only our administrators have access to it.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once APPROOT . '/views/includes/footer.php' ?>