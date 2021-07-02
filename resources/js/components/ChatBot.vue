<template>
    <div id="chat-bot">

        <div v-for="(assessmentSection, sectionIndex) in assessment" :key="'section' + assessmentSection.id">
            <!-- TODO: fix error handling as it expects chat-section-<id>, not <index>-->
            <div class="chat-section" :id="'chat-section-' + sectionIndex" v-if="sectionIndex === 0 || assessment[sectionIndex - 1].complete == true" :class="{'show-error': assessmentSection.errors}">

                <div v-for="(question, questionIndex) in assessmentSection.questions" :key="questionIndex + 'Question'">
                    <transition name="fade" appear>
                        <div class="message-single" :style="{ 'transition-delay': `${questionIndex}s`}">
                            <div class="chat-message" v-html="question">
                            </div>
                        </div>
                    </transition>
                </div>

                <div v-if="assessmentSection.type === 'radio'">
                    <div v-for="(answer, answerIndex) in assessmentSection.answers" :key="answerIndex + 'Answer'">
                        <transition name="fade" appear>
                            <div class="message-single message-single__response" :style="{ 'transition-delay': `${assessmentSection.questions.length + (answerIndex / 8)}s`}">
                                <input type="radio" class="chat__input" :id="`s${assessmentSection.id}a${answerIndex}`" :name="`s${assessmentSection.id}`" :value="answer.value" @click="completeSection(assessmentSection, sectionIndex)" v-model="assessmentSection.response" @change="$emit('clear-errors', sectionIndex)">

                                <label class="chat-message" :for="`s${assessmentSection.id}a${answerIndex}`">
                                    <p class="chat-message__title">{{answer.title}}</p>
                                    <p class="chat-message__description">{{answer.description}}</p>
                                </label>
                            </div>
                        </transition>
                    </div>
                </div>
                <div v-else-if="assessmentSection.type === 'full-width'">
                    <transition name="fade" appear>
                        <div class="row-full-width" :style="{ 'transition-delay': `${assessmentSection.questions.length}s`}">

                            <div class="chat__column" v-for="(answer, answerIndex) in assessmentSection.answers" :key="answerIndex + 'Answer'">
                                <input type="radio" class="chat__input" :id="`s${assessmentSection.id}a${answerIndex}`" :name="`s${assessmentSection.id}`" :value="answerIndex + 1" @click="completeSection(assessmentSection, sectionIndex)">

                                <label class="chat-message" :for="`s${assessmentSection.id}a${answerIndex}`">
                                    <div class="chat-message__image">
                                        <img class="style-select__image" :src="answer.image" alt="Style description">
                                    </div>
                                    <p>{{answer.title}}</p>
                                </label>
                            </div>

                        </div>
                    </transition>
                </div>
                <div v-else-if="assessmentSection.type === 'submit'">
                    <transition name="fade" appear>
                        <div class="row-submit" :style="{ 'transition-delay': `${assessmentSection.questions.length}s`}">
                            <div class="submit-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h2 class="mt-3 mt-sm-0 mb-3">Congratulations. <br class="m-show">You’ve completed the <span>Enneagram<span> Assessment</span></span></h2>
                                        <p>Enter your name and email below to view your score. We’ll send a detailed report to your email.</p>
                                        <div class="submit-inputs">

                                            <form @submit.prevent="$emit('complete-assessment')">
                                                <div class="row">
                                                    <div class="col-lg-6 mb-1 p-1">
                                                        <label class="sr-only" for="firstName">First Name</label>
                                                        <input type="text" class="form-control" id="firstName" :class="{'has-error': assessmentSection.errors.firstName}" v-model="assessmentSection.response.firstName" placeholder="First Name" @change="$emit('clear-errors', 'firstName')" required>
                                                    </div>

                                                    <div class="col-lg-6 mb-1 p-1">
                                                        <label class="sr-only" for="email">Email Address</label>
                                                        <input type="email" class="form-control" id="email" :class="{'has-error': assessmentSection.errors.email}" v-model="assessmentSection.response.email" placeholder="Email" @change="$emit('clear-errors', 'email')" required>
                                                    </div>

                                                    <div class="col-lg-12 mb-1 p-1">
                                                        <label class="sr-only" for="phone-number">Phone Number</label>
                                                        <input type="tel" class="form-control" id="phone-number" aria-describedby="phone-help" :class="{'has-error': assessmentSection.errors.phone}" v-model="assessmentSection.response.phone" placeholder="Phone Number" @change="$emit('clear-errors', 'phone')" required>
                                                        <small id="phone-help" class="form-text text-muted text-center">We’ll text you valuable resources that will be helpful for your business based on your results.</small>
                                                    </div>

                                                    <div class="col-lg-12 mb-1 p-1">
                                                        <button type="submit" class="btn btn-primary btn-block" :disabled="!isFormValidated || disableSubmit" v-if="!loadingSubmit">View My Results</button>
                                                        <LoadingSpinner v-else></LoadingSpinner>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center align-self-center">
                                        <img src="/images/keanu-trujillo.jpg" alt="Keanu Trujillo Smiling Head Shot">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </transition>
                </div>
                <div v-else-if="assessmentSection.type === 'checkbox'">
                    <div v-for="(answer, answerIndex) in assessmentSection.answers" :key="answerIndex + 'Answer'">
                        <transition name="fade" appear>
                            <div class="message-single message-single__response" :style="{ 'transition-delay': `${assessmentSection.questions.length + (answerIndex / 8)}s`}">
                                <input type="checkbox" class="chat__input" :id="`s${assessmentSection.id}a${answerIndex}`" :value="answerIndex + 1"  v-model="assessmentSection.response" @click="proceedSection(assessmentSection)" @change="$emit('clear-errors', sectionIndex)">
                                <label class="chat-message" :for="`s${assessmentSection.id}a${answerIndex}`">
                                    <p class="chat-message__title">{{answer.title}}</p>
                                    <p class="chat-message__description">{{answer.description}}</p>
                                </label>
                            </div>
                        </transition>
                    </div>
                    <div v-if="assessmentSection.proceed && !assessmentSection.complete" class="proceed">
                        <transition name="fade" appear>
                            <div class="btn-proceed-holder">
                                <button class="btn btn-primary btn-lg btn-proceed" @click="completeSection(assessmentSection, sectionIndex)">Click to Proceed &darr;</button>
                            </div>
                        </transition>
                    </div>
                </div>
                <div v-else-if="assessmentSection.type === 'likert'">
                    <transition name="fade" appear>
                        <div class="row-full-width-no-overflow" :style="{ 'transition-delay': `${assessmentSection.questions.length}s`}">

                            <h5 class="text-center" v-if="assessmentSection.subtitle">{{assessmentSection.subtitle}}</h5>
                            <h3 class="text-center" v-if="assessmentSection.title">{{assessmentSection.title}}</h3>

                            <div class="chat__column__holder">
                                <div class="chat__column" v-for="(answer, answerIndex) in assessmentSection.answers" :key="answerIndex + 'Answer'">
                                    <input type="radio" class="chat__input" :id="`s${assessmentSection.id}a${answerIndex}`" :name="`s${assessmentSection.id}`" :value="answer.value" @click="completeSection(assessmentSection, sectionIndex)" v-model="assessmentSection.response" @change="$emit('clear-errors', sectionIndex)">
                                    <label class="chat-message" :class="assessmentSection.fade ? `chat-message__fade-${answerIndex + 1}` : ''" :for="`s${assessmentSection.id}a${answerIndex}`">
                                        <span>{{answer.title}}</span>
                                    </label>

                                    <div class="likert-legend" v-if="assessmentSection.helperText">
                                        <p class="likert-legend-first font-weight-bold" v-if="answerIndex === 0">Least like Me</p>
                                        <p class="likert-legend-last font-weight-bold" v-if="answerIndex === assessmentSection.answers.length - 1">Most like Me</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </transition>
                </div>
                <div v-else-if="assessmentSection.type === 'button'">
                    <transition name="fade" appear>
                        <div class="row" :style="{ 'transition-delay': `${assessmentSection.questions.length}s`}">
                            <div class="offset-3 col-6 text-center mt-5">
                                <div class="alert alert-danger" role="alert" v-if="errors">
                                    {{errors}}
                                </div>
                                <button type="button" class="btn btn-primary btn-lg" :disabled="disableSubmit" v-if="!loadingSubmit" @click="$emit('complete-assessment')">View Results</button>
                                <LoadingSpinner v-else></LoadingSpinner>
                            </div>
                        </div>
                    </transition>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            assessment: Array,
            response: Object,
            isFormValidated: Boolean,
            disableSubmit: Boolean,
            loadingSubmit: Boolean,
            errors: String,
        },
        computed: {
        },
        methods: {
            proceedSection(section) {
                if (section.proceed) return;
                section.proceed = true;
            },
            completeSection(section, sectionIndex) {
                if (section.complete) return;

                section.complete = true;

                this.$nextTick(() => {
                    window.scrollTo({
                        top: document.querySelector('#chat-section-' + (sectionIndex + 1)).offsetTop + window.innerHeight - (document.querySelector('#header').offsetHeight + document.querySelector('.progress').offsetHeight) + 5,
                        left: 0,
                        behavior: "smooth"
                    });
                });
            },
        },
    }
</script>

<style lang="scss" scoped>
    @import '@/sass/_global_variables';

    #chat-bot {
        padding: 3rem;
        min-height: 100vh;
        max-width: 1100px;
        margin: 0 auto;
        position: relative;

        @media only screen and (max-width: 639px) {
            padding: 3rem 1rem;
        }

        .chat-message {
            user-select: none;
        }

        .chat-section.show-error {
            .message-single.message-single__response label,
            .row-full-width-no-overflow .chat-message {
                border: 1px solid #ff0000;
            }

            .row-full-width-no-overflow h3 {
                color: #ff0000;
            }
        }

        .chat-section {
            display: inline-block;
            width: 100%;
        }

        .fade-enter-active, .fade-leave-active {
            transition: opacity .5s;
        }
        .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
            transform: translateY(50px);
            opacity: 0;
        }

        .message-single {
            padding: 5px 0;
            display: flex;
            transition: 1.5s opacity, .8s transform;

            &.message-single__response {
                justify-content: flex-end;
                width: 100%;

                input {
                    display: none;
                }

                input:checked + label {
                    color: $message-responder-bg-color;
                    background-color: $onsite-white;
                    font-weight: bold;
                }

                label {
                    width: 100%;
                    border-radius: 15px 15px 2px;
                    border: 1px solid #e0e6ed;
                    background-color: $message-responder-bg-color;
                    cursor: pointer;
                    box-shadow: none;
                    margin: 0;

                    &:hover {
                        box-shadow: inset 0 -3px 0 rgba(0,0,0,.2);
                    }
                }
            }

            .chat-message {
                border-radius: 2px 15px 15px;
                background-color: $message-bg-color;
                box-shadow: 0 2px 0 #e0e6ed;
                display: block;
                max-width: 45%;
                padding: 10px 15px;
                text-align: left;
                font-size: 16px;
                line-height: 1.5;
                transition: .2s color,.2s background-color,.2s box-shadow;

                @media only screen and (max-width: 639px) {
                    max-width: 75%;
                }

                p {
                    margin-bottom: 0;
                }
            }
        }

        .row-full-width {
            display: flex;
            transition: 1.5s opacity,.8s transform;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin-left: -10px;
            margin-right: -10px;
            padding-top: 55px;
            padding-bottom: 75px;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;

            .chat__column {
                padding-left: 10px;
                padding-right: 10px;

                    input {
                    display: none;
                }

                input:checked + label {
                    color: $sda-white;
                    background-color: $sda-blue;
                }

                .chat-message {
                    display: block;
                    font-size: 16px;
                    line-height: 1.5;
                    transition: .2s color,.2s background-color,.2s box-shadow;
                    border: 1px solid #e0e6ed;
                    color: $onsite-white;
                    background-color: $message-responder-bg-color;
                    cursor: pointer;
                    max-width: 100%;
                    padding: 37px;
                    text-align: center;
                    border-radius: 15px;

                    &:hover {
                        box-shadow: inset 0 -3px 0 rgba(0,0,0,.2);
                    }
                }

                .chat-message__image {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    width: 175px;
                    height: 175px;
                    margin: 0 auto 20px;

                    img {
                        max-width: 100%;
                        max-height: 100%;
                    }
                }
            }
        }

        .row-full-width-no-overflow {
            transition: 1.5s opacity,.8s transform;
            padding: 55px 0 2.5rem;
            display: inline-block;
            width: 100%;
            float: left;

            .likert-legend {
                position: relative;

                .likert-legend-first {
                    position: absolute;
                    top: .25rem;
                    left: 0;
                    white-space: nowrap;

                    @media only screen and (max-width: 627px) {
                        font-size: .8rem;
                    }

                    @media only screen and (max-width: 380px) {
                        font-size: .75rem;
                    }
                }

                .likert-legend-last {
                    position: absolute;
                    top: .25rem;
                    right: 0;
                    white-space: nowrap;

                    @media only screen and (max-width: 627px) {
                        font-size: .8rem;
                    }

                    @media only screen and (max-width: 380px) {
                        font-size: .75rem;
                    }
                }
            }

            h3 {
                font-size: 1.5rem;
                margin: 0 auto 2rem;
                font-weight: 700;

                @media only screen and (max-width: 627px) {
                    font-size: 1.55rem;
                }

                @media only screen and (max-width: 380px) {
                    font-size: 1.25rem;
                }
            }

            h5 {
                max-width: 675px;
                margin: 0 auto 1rem;
                font-weight: 700;
            }

            .chat__column__holder {
                margin: 0 auto;
                display: flex;
                justify-content: space-between;
                max-width: 860px;
            }

            .chat__column {
                margin-left: 10px;
                float: left;
                width: (100% / 7);

                &:first-of-type {
                    margin-left: 0;
                }

                input {
                    display: none;
                }

                label {
                    margin-bottom: 0;
                }

                input:checked + label {
                    color: $likert-selected-text-color;
                    background-color: $likert-selected-bg-color;

                    span {
                        color: $likert-selected-text-color;
                        opacity: 1;
                    }
                }
            }

            .chat-message {
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 4.5rem;
                line-height: 1;
                font-weight: bold;
                transition: .2s color,.2s background-color,.2s box-shadow;
                border: 1 px solid #e0e6ed;
                background-color: $sda-white;
                cursor: pointer;
                padding: 1rem;
                text-align: center;
                border-radius: 15px;
                box-shadow: 3px 3px 2px rgba(0, 0, 0, 0.17);

                &:hover {
                    box-shadow: none;
                }

                @media only screen and (max-width: 894px) {
                    font-size: 1.25rem;
                    padding: .5rem;
                }
            }
        }

        .row-submit {
            margin-top: 40px;
            margin-bottom: 80px;
            padding: 50px 70px;
            border-radius: 10px;
            background: $opt-in-bg-color;
            box-shadow: 0 2px 0 #e0e6ed;
            transition: 1.5s opacity,.8s transform;

            h2 {
                font-size: 1.2rem;
                font-weight: 400;
                text-transform: uppercase;

                @media only screen and (max-width: 691px) {
                    text-align: center;
                }

                br {
                    display: none;

                    @media only screen and (min-width: 768px) and (max-width: 934px) {
                        display: inline;
                    }

                    @media only screen and (max-width: 691px) {
                        display: inline;
                    }
                }

                span {
                    font-size: 2.4rem;
                    font-weight: 600;
                    text-transform: none;
                }
            }

            p {
                &.disclaimer {
                    line-height: 1rem;
                }
            }

            @media only screen and (max-width: 416px) {
                padding: 25px 35px;
            }

            @media only screen and (max-width: 350px) {
                padding: 20px 15px;
            }
        }

        .btn-proceed {
            border-radius: 5rem;
            min-width: 180px;
        }

        .btn-proceed-holder {
            left: 50%;
            transform: translateX(-50%);
            position: fixed;
            bottom: 1rem;
            z-index: 9999;
        }
    }

    .submit-inputs {
        width: 100%;
        margin: 0 auto;

        input,
        button {
            flex: 1;
            margin: 0 .5rem .5rem 0;
        }

        #email,
        button {
            @media only screen and (max-width: 949px) {
                margin-right: 0;
            }
        }

        #firstName {
            @media only screen and (max-width: 767px) {
                margin-right: 0;
            }
        }

    }

    .submit-body {
        img {
            width: 100%;
            max-width: 250px;
        }
    }

    .btn.btn-info {
        text-transform: uppercase;
        color: $onsite-white;
    }

    input.has-error {
        border: 1px solid #ff0000;
    }

    #phone-help {
        @media only screen and (max-width: 1007px) {
            max-width: 298px;
            margin: 0 auto;
        }
    }

</style>
