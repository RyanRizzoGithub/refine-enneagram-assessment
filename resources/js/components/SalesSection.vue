<template>
    <div id="sales-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center pb-2">Haven’t booked your <span>Discovery Call?</span><br> Schedule it here.</h2>
                    <p class="sales-sub-heading">Schedule a call with one of our Business Consultants to help you determine how you can grown and scale your business.</p>
                </div>
            </div>
            <div class="row">
                <div class="embed-responsive embed-responsive-4by3">
                    <iframe class="embed-responsive-item" src="https://calendly.com/bac19/schedule?embed_domain=assessments.michaelhyatt.com&amp;embed_type=Inline" width="100%" height="100%" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    @import '@/sass/_global_variables';

    #sales-section {
        display: inline-block;
        position: relative;
        width: 100%;
        padding: 3rem;
        background: rgba(54,54,55, 1);
        background: linear-gradient(90deg, rgba(5,5,6, .96) .0, rgba(23,23,23, .97) 100%);

        @media only screen and (max-width: 409px) {
            padding: 3rem 1rem;
        }

        &:before {
            content: "";
            background-image: url("/images/dot-pattern-white.png");
            background-size: 50rem;
            z-index: 0;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }

        .sales-sub-heading {
            color: $font-color-light;
            max-width: 500px;
            margin: 0 auto;

            @media only screen and (max-width: 767px) {
                margin-bottom: 1.5rem;
            }

        }
    }

    h2 {
        font-size: 3.1rem;
        color: $font-color-light;
        max-width: 932px;
        margin: 0 auto;

        @media only screen and (max-width: 1199px) {
            font-size: 2.7rem;
        }

        @media only screen and (max-width: 574px) {
            font-size: 2.2rem;
        }

        @media only screen and (max-width: 491px) {
            font-size: 2rem;
        }

        @media only screen and (max-width: 458px) {
            font-size: 1.75rem;
        }

        @media only screen and (max-width: 416px) {
            font-size: 1.55rem;
        }
    }

    #testimonials {
        margin-top: 6rem;

        .card-body {
            padding-top: 6rem;
            position: relative;
        }

        .testimonial-image {
            position: absolute;
            top: -4rem;
            width: 8rem;
            left: 50%;
            transform: translateX(-50%);
        }
    }

    .embed-responsive-4by3::before {
        padding-top: 58%;

        @media only screen and (max-width: 1199px) {
            padding-top: 115%;
        }

        @media only screen and (max-width: 1047px) {
            padding-top: 123%;
        }

        @media only screen and (max-width: 991px) {
            padding-top: 153%;
        }

        @media only screen and (max-width: 811px) {
            padding-top: 178%;
        }

        @media only screen and (max-width: 633px) {
            padding-top: 216%;
        }

        @media only screen and (max-width: 553px) {
            padding-top: 238%;
        }

        @media only screen and (max-width: 512px) {
            padding-top: 271%;
        }

        @media only screen and (max-width: 460px) {
            padding-top: 315%;
        }

        @media only screen and (max-width: 409px) {
            padding-top: 263%;
        }

        @media only screen and (max-width: 407px) {
            padding-top: 283%;
        }

        @media only screen and (max-width: 381px) {
            padding-top: 329%;
        }

        @media only screen and (max-width: 381px) {
            padding-top: 372%;
        }
    }

</style>
