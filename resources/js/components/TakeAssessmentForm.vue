<template>
    <div class="take-assessment-form-container">
        <div class="card">
            <div class="card-body">
                <slot></slot>

                <form id="payment-form" @submit.prevent="submitTakeAssessmentForm">
                    <div class="row" v-if="formErrorText">
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                {{this.formErrorText}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">First Name</label>
                                <input type="text" class="form-control" name="first_name" v-model="formFirstName" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Last Name</label>
                                <input type="text" class="form-control" name="last_name" v-model="formLastName" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" name="email" v-model="formEmail" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Access Code</label>
                                <input type="text" class="form-control" name="title" v-model="formAccessCode" required>
                                <div class="text-center">
                                    <small>The access code will be used when you submit the asseesment on the next page.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-center" >
                                <div class="spinner-border" role="status" v-if="formDisabled">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <input v-else type="submit" class="btn btn-primary" value="Take Assessment">
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>

        <div class="text-center mt-3">
            <p>Need an access code? You can purchase access codes here.</p>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#payment-modal">Purchase Access Codes</button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="payment-modal" tabindex="-1" role="dialog" aria-labelledby="payment-modal-label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="payment-modal-label">Purchase Access Codes</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <PaymentForm></PaymentForm>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>

export default {
    data() {
        return {
            formFirstName: '',
            formLastName: '',
            formEmail: '',
            formAccessCode: '',
            formErrorText: '',
            formDisabled: false,
        }
    },
    computed: {
    },
    methods: {
        validateEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        },
        submitTakeAssessmentForm(e) {
            this.formDisabled = true;
            this.formErrorText = '';

            if(this.formFirstName.length <= 2 || this.formFirstName === '') {
                this.formErrorText = 'The first name field must be a least 2 characters long.';
                this.formDisabled = false;
                return;
            }

            if(this.formLastName.length <= 2 || this.formLastName === '') {
                this.formErrorText = 'The Last name field must be a least 2 characters long.';
                this.formDisabled = false;
                return;
            }

            if(!this.validateEmail(this.formEmail) || this.formEmail === '') {
                this.formErrorText = 'The email field must be a valid email format.';
                this.formDisabled = false;
                return;
            }

            axios.post('/token/redeem', {
                first_name: this.formFirstName,
                last_name: this.formLastName,
                email: this.formEmail,
                title: this.formAccessCode,
            }).then(response => {
                this.$router.push(`/assessment/?fn=${encodeURIComponent(this.formFirstName)}&ln=${encodeURIComponent(this.formLastName)}&e=${encodeURIComponent(this.formEmail)}&t=${encodeURIComponent(response.data.access_token)}`);
            }).catch(error => {
                if(typeof error.response.data != "undefined" && error.response.data.hasOwnProperty('errors')) {
                    Object.keys(error.response.data.errors).map((singleError, index) => {
                        this.formErrorText = error.response.data.errors[singleError][0];
                    });
                }

                this.formDisabled = false;
            });
        },
    },
}
</script>

<style lang="scss" scoped>
    /* @import '@/sass/_global_variables'; */
</style>
