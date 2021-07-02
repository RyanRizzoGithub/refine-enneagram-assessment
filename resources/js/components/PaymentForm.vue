<template>
    <div class="payment-form-container">
        <slot></slot>
        <form id="payment-form" @submit.prevent="submitPaymentForm">
            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <label for="name">First Name</label>
                        <input type="text" class="form-control" name="first_name" v-model="paymentFirstName" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="name">Last Name</label>
                        <input type="text" class="form-control" name="last_name" v-model="paymentLastName" required>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" v-model="paymentEmail" required>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label class="form-check-label" for="defaultCheck1">Select Access Code Type:</label>
                    </div>
                </div>

                <div class="col-12 text-center">
                    <div class="form-group btn-group btn-group-toggle">
                        <label class="btn btn-outline-secondary" :class="{active: paymentAccessCodeType == 'single-use'}">
                            <input type="radio" name="access_code_type" value="single-use" v-model="paymentAccessCodeType"> Single-use
                        </label>
                        <label class="btn btn-outline-secondary" :class="{active: isAccessCodeTypeMultiUse}">
                            <input type="radio" name="access_code_type" value="multi-use" v-model="paymentAccessCodeType"> Multi-use
                        </label>
                    </div>
                </div>

                <div class="col-12" v-if="isAccessCodeTypeMultiUse">
                    <div class="form-group">
                        <label for="name">Access Code</label>
                        <input type="text" class="form-control" name="title" v-model="paymentAccessCode" required>
                        <div class="text-center">
                            <small>Define the access code users will use when taking the assessment. Each time it is used will deduct one from the available pool of codes. If you would like to add additional uses to a code that already exists insert the code you’ve already created.</small>
                        </div>
                    </div>
                </div>

                <div class="col-6" v-if="isAccessCodeTypeMultiUse">
                    <div class="form-group">
                        <label for="name">How many times can this code be used?</label>
                        <input type="number" class="form-control" name="uses" min="1" step="1" v-model="paymentAccessCodeUses" required>
                    </div>
                </div>

                <div class="col-6 align-self-end" v-if="isAccessCodeTypeMultiUse">
                    <div class="form-group">
                        <label for="name">Uses Remaining</label>
                        <input type="text" class="form-control" name="uses" :value="paymentAccessCodeRemainingUses" readonly>
                    </div>
                </div>

                <hr>

                <div class="col-12" v-show="paymentAccessCodeType">
                    <div class="form-group">
                        <label for="name">Name on Card</label>
                        <input type="text" class="form-control" id="name" v-model="paymentName" required>
                    </div>
                </div>

                <div class="col-12" v-show="paymentAccessCodeType">
                    <div class="form-group">
                        <label for="card">Card Info</label>
                        <div id="card-element" ref="card">
                            <!-- Elements will create input elements here -->
                        </div>
                    </div>
                </div>

                <div class="col-12" v-if="formErrorText">
                    <div class="alert alert-danger" role="alert">
                        {{formErrorText}}
                    </div>
                </div>

                <div class="col-12" v-show="paymentAccessCodeType">
                    <div class="d-flex justify-content-center" >
                        <div class="spinner-border" role="status" v-if="paymentFormDisabled">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <input v-else type="submit" class="btn btn-primary" :value="`Purchase - $${getPrice()}`">
                    </div>
                </div>

                <div class="col-12" v-show="paymentAccessCodeType">
                    <div class="text-center">
                        <small>One time payment of ${{getPrice()}}. Not a subscription.<br> You will receive your access code in an email in case you don't take the assessment right now.</small>
                    </div>
                </div>

            </div>
        </form>
    </div>
</template>

<script>

let stripe = Stripe(stripeCustom.key),
    elements = stripe.elements(),
    card = undefined;

export default {
    data() {
        return {
            formErrorText: '',
            paymentFormDisabled: false,
            paymentFirstName: '',
            paymentLastName: '',
            paymentEmail: '',
            paymentAccessCodeType: '',
            paymentAccessCode: '',
            paymentAccessCodeUses: 1,
            paymentAccessCodeRemainingUses: 0,
            paymentName: '',
            purchaseSuccessful: false,
            awaitingSearch: false,
        }
    },
    computed: {
        isAccessCodeTypeMultiUse() {
            return this.paymentAccessCodeType == 'multi-use';
        },
    },
    watch: {
        paymentAccessCode(after, before) {
            if (!this.awaitingSearch) {
                setTimeout(() => {
                    this.getAccessCodeUses()
                    this.awaitingSearch = false;
                }, 1000); // 1 sec delay
            }
            this.awaitingSearch = true;
        }
    },
    methods: {
        getAccessCodeUses() {
            axios.get(`/token/search/${this.paymentAccessCode}`)
                .then(response => {
                    if (response.data.success) {
                        this.paymentAccessCodeRemainingUses = response.data.access_token.uses;
                    } else {
                        this.paymentAccessCodeRemainingUses = 0;
                    }
                })
                .catch(error => {
                    this.paymentAccessCodeRemainingUses = 0;
                });
        },
        validateEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        },
        getPrice() {

            return this.paymentAccessCodeType === 'single-use' ? stripeCustom.price : stripeCustom.price * this.paymentAccessCodeUses;
        },
        submitPaymentForm(e) {
            this.paymentFormDisabled = true;
            this.formErrorText = '';

            if(this.paymentFirstName.length <= 2 || this.paymentFirstName === '') {
                this.formErrorText = 'The first name field must be a least 2 characters long.';
                this.paymentFormDisabled = false;
                return;
            }

            if(this.paymentLastName.length <= 2 || this.paymentLastName === '') {
                this.formErrorText = 'The last name field must be a least 2 characters long.';
                this.paymentFormDisabled = false;
                return;
            }

            if(!this.validateEmail(this.paymentEmail) || this.paymentEmail === '') {
                this.formErrorText = 'The email field must be a valid email format.';
                this.paymentFormDisabled = false;
                return;
            }

            if(this.paymentName.length <= 2 || this.paymentName === '') {
                this.formErrorText = 'The name on card field must be a least 2 characters long.';
                this.paymentFormDisabled = false;
                return;
            }

            stripe
                .createPaymentMethod({
                    type: 'card',
                    card: card,
                    billing_details: {
                        email: this.paymentEmail,
                        name: this.paymentName,
                    },
                })
                .then((result) => {
                    // Handle result.error or result.paymentMethod

                    if (result.error) {
                        // Show error to your customer (e.g., insufficient funds)
                        this.formErrorText = result.error.message
                        this.paymentFormDisabled = false;
                    } else {

                        let postData = {
                            first_name: this.paymentFirstName,
                            last_name: this.paymentLastName,
                            email: this.paymentEmail,
                            name: this.paymentName,
                            token: result.paymentMethod.id,
                        };

                        if (this.isAccessCodeTypeMultiUse) {
                            postData.title = this.paymentAccessCode;
                            postData.uses = this.paymentAccessCodeUses;
                        }

                        axios.post('/charge', postData)
                            .then(response => {
                                if (response.data.success) {
                                    $('#payment-modal').modal('hide');
                                    return this.$router.push(`/assessment/?fn=${encodeURIComponent(this.paymentFirstName)}&ln=${encodeURIComponent(this.paymentLastName)}&e=${encodeURIComponent(this.paymentEmail)}&t=${encodeURIComponent(response.data.access_token)}`);
                                } else {
                                    this.formErrorText = 'Please refresh the page and try again.';
                                    this.paymentFormDisabled = false;
                                }
                            }).catch(error => {
                                if(typeof error.response.data != "undefined" && error.response.data.hasOwnProperty('errors')) {
                                    Object.keys(error.response.data.errors).map((singleError, index) => {
                                        this.formErrorText = error.response.data.errors[singleError][0];
                                    });
                                } else if(typeof error.response.data != "undefined" && error.response.data.hasOwnProperty('message')) {
                                    this.formErrorText = error.response.data.message;
                                } else {
                                    this.formErrorText = 'Please refresh the page and try again.';
                                }

                                this.paymentFormDisabled = false;
                            });
                    }
                });
        },
    },
    created () {
    },
    mounted() {
        // Set up Stripe.js and Elements to use in checkout form
        card = elements.create("card");
        card.mount(this.$refs.card);
    },
    beforeDestroy () {
        card.destroy(this.$refs.card);
    }
}
</script>

<style lang="scss" scoped>
    @import '@/sass/_global_variables';

    #card-element {
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 0.9rem;
        font-weight: 400;
        line-height: 1.6;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

</style>
