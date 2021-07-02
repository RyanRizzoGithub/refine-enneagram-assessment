<template>
    <div class="home">
        <StartPage @get-started="getStarted" v-if="!hideStart" v-cloak></StartPage>
        <div id="content" ref="content">
            <Header>
                <ProgressBar :percentage="percentageComplete" :absolute="true"></ProgressBar>
            </Header>
            <ChatBot :assessment="shuffledAssessment" :disableSubmit="disableSubmit" :loadingSubmit="loadingSubmit" @complete-assessment="completeAssessment" @clear-errors="clearErrors" :errors="errors" v-if="start"></ChatBot>

            <div v-if="invalidAccessCode">
                <div class="container">
                    <div class="offset-3 col-6 mt-5">
                        <div class="card">
                            <div class="card-body text-center">
                                <h4>Sorry, the access token you are trying to use is not valid.</h4>
                                <p>Please return to the home page to enter a valid access code or purchase an access code.</p>
                                <a href="/" class="btn btn-primary">Back to home</a>
                            </div>
                        </div>
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
            start: false,
            disableSubmit: false,
            loadingSubmit: false,
            test: [],
            response: {},
            assessment: [],
            hideStart: false,
            invalidAccessCode: false,
            access_token: '',
            errors: '',
        }
    },
    created() {
        // Skip start screen for demo
        this.hideStart = true;

        if (typeof this.$route.query === 'object' && Object.keys(this.$route.query).length > 0) {
            if (this.$route.query.hide_start) {
                this.hideStart = this.$route.query && this.$route.query.hide_start;
                this.start = true;
            }

            if (this.$route.query.fn && this.$route.query.ln && this.$route.query.e && this.$route.query.t) {
                axios.get(`/token/search/${this.$route.query.t}`)
                    .then(response => {
                        if (response.data.success && response.data.access_token.uses >= 1) {
                            this.start = true;
                            this.access_token = response.data.access_token.title;
                        } else {
                            this.invalidAccessCode = true;
                        }
                    });
            } else {
                // No access token, redirect back to home
                this.$router.push('/');
            }
        } else {
            // No access token, redirect back to home
            this.$router.push('/');
        }
    },
    mounted () {
        axios
            .get('/questions')
            .then(response => {
                this.assessment = response.data;
            });
    },
    computed: {
        percentageComplete() {
            return this.assessment.filter(section => section.complete).length / this.assessment.length * 100;
        },
        shuffledAssessment() {

            let shuffledAssessment = [];

            const assessmentFirstAndLastQuestion = this.assessment.filter(section => section.id === 1 || section.type === 'button');
            const remainingQuestions = this.assessment.filter(section => section.id !== 1 && section.type !== 'button');
            const shuffledQuestions = _.shuffle(remainingQuestions);

            if (assessmentFirstAndLastQuestion.length) {
                shuffledAssessment.push(assessmentFirstAndLastQuestion[0])
            }

            if (shuffledQuestions.length) {
                shuffledAssessment.push(...shuffledQuestions);
            }

            if (assessmentFirstAndLastQuestion.length) {
                shuffledAssessment.push(assessmentFirstAndLastQuestion[1])
            }

            return shuffledAssessment;
        },
        questionResponses() {
            return this.assessment
                .filter(section => section.type !== 'submit' && section.type !== 'button')
                .reduce((accumulator, section) => {
                accumulator[section.id] = section.response;
                return accumulator;
            }, {});
        },
    },
    methods: {
        clearErrors(sectionIndex) {
            if((this.assessment[sectionIndex].type === 'checkbox' && this.assessment[sectionIndex].response.length === 0) || (this.assessment[sectionIndex].type === 'radio' && this.assessment[sectionIndex].response === 0)) {
                this.assessment[sectionIndex].errors = true;
            } else {
                this.assessment[sectionIndex].errors = false;
            }
        },
        getStarted() {
            this.start = true;
            this.$nextTick(() => {
                window.scrollTo({
                    top: document.querySelector('#content').offsetTop,
                    left: 0,
                    behavior: "smooth"
                });
            });
        },
        completeAssessment() {

            const $this = this;
            $this.disableSubmit = true;
            $this.loadingSubmit = true;
            $this.errors = '';
            $this.assessment
                .filter(section => section.type !== 'submit' && section.type !== 'button')
                .map(section => section.errors = '');

            const $router = $this.$router;
            const response = $this.assessment
                .filter(section => section.type !== 'submit' && section.type !== 'button')
                .filter(section => section.response === null || (Array.isArray(section.response) && section.response.length === 0))
                .reduce((accumulator, section) => {
                    accumulator = [...accumulator, section.id];
                    return accumulator;
                }, []);

            if (response.length !== 0) {

                let scrollErrorId = null;
                response.map((questionId, index) => {
                    $this.assessment[questionId - 1].errors = true;
                    if (scrollErrorId === null || scrollErrorId > questionId) {
                        scrollErrorId = questionId;
                    }
                });
                if (scrollErrorId === null) {
                    scrollErrorId = $this.assessment.length;
                }
                window.scrollTo({
                    top: document.querySelector('#chat-section-' + (response.length ? response[0] : $this.assessment.length)).offsetTop + window.innerHeight - (document.querySelector('#header').offsetHeight + document.querySelector('.progress').offsetHeight),
                    left: 0,
                    behavior: "smooth"
                });
                $this.disableSubmit = false;
                $this.loadingSubmit = false;

            } else {

                const scoreQuestions = $this.assessment
                    .filter(section => section.type !== 'submit' && section.type !== 'button')

                const answers = scoreQuestions
                    .filter(section => section.type !== 'submit' && section.type !== 'button')
                    .reduce((accumulator, section) => {
                        if (Array.isArray(section.response)) {
                            accumulator[`q${section.id}`] = section.response.reduce((accumulator, singleResponse) => {
                                accumulator = [...accumulator, singleResponse]
                                return accumulator;
                            }, []);
                        } else {
                            if (section.response !== 0) {
                                accumulator[`q${section.id}`] = section.response;
                            }
                        }
                        return accumulator;
                    }, {});

                const postData = {
                    ...$this.assessment[$this.assessment.length - 1].response,
                    ...answers,
                    title: this.access_token,
                    first_name: this.$route.query.fn,
                    last_name: this.$route.query.ln,
                    email: this.$route.query.e,
                };

                axios.post('/submit', postData)
                    .then(function (res) {
                        if(res.data.success) {
                            return $router.push(res.data.resultsUrl);
                        }
                    })
                    .catch(function (error) {
                        let scrollErrorId = null;
                        if(typeof error.response.data != "undefined" && error.response.data.hasOwnProperty('errors')) {
                            Object.keys(error.response.data.errors).map((singleError, index) => {
                                if (singleError.split('')[0] === 'q') {
                                    const questionId = singleError.replace('q','');
                                    $this.assessment[questionId - 1].errors = true;
                                    if (scrollErrorId === null || scrollErrorId > questionId) {
                                        scrollErrorId = questionId;
                                    }
                                } else {
                                    $this.errors = error.response.data.errors[singleError][0];

                                    if (scrollErrorId === null) {
                                        scrollErrorId = $this.assessment.length;
                                    }
                                }
                            });
                        }
                        if (scrollErrorId !== null) {
                            window.scrollTo({
                                top: document.querySelector('#chat-section-' + (scrollErrorId)).offsetTop + window.innerHeight - (document.querySelector('#header').offsetHeight + document.querySelector('.progress').offsetHeight),
                                left: 0,
                                behavior: "smooth"
                            });
                        }
                        $this.disableSubmit = false;
                        $this.loadingSubmit = false;
                    });
            }
        }
    },
}
</script>

<style lang="scss">
    @import '@/sass/_global_variables';

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        transform: translateY(50px);
        opacity: 0;
    }

    .modal {

        .modal-body {
            .card p {
                margin-bottom: 0;
            }
        }

        @media only screen and (max-width: 480px) {

            .modal-title {
                font-size: 1rem;
            }

            .modal-body {
                p {
                    font-size: .7rem;
                    margin-bottom: .5rem;
                }

                .card-body {
                    padding: .5rem;

                    p {
                        margin-bottom: 0;
                    }
                }
            }

            label {
                font-size: .88rem;
            }
        }

        .custom-control-label::before {
            background-color: $onsite-bg-color;
        }

        .custom-control-input:checked ~ .custom-control-label::before {
            color: $onsite-gold;
            border-color: $onsite-gold;
            background-color: $onsite-gold;
        }

        .btn-info {
            color: $onsite-white;
        }

        a {
            color: #1254cd;

        }

        .modal-footer {
            flex-direction: column;

            @media only screen and (max-width: 480px) {
                justify-content: center;
            }
        }

        @media only screen and (max-width: 364px) {
            p {
                font-size: .85rem;
            }
        }
    }
</style>
