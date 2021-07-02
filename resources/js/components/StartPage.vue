<template>
    <div class="start-page container-fluid">
        <!--
        <img class="start-page-logo" src="/images/start-page-bg.png" alt="">
        <div class="row">
            <div class="get-started-container">
                <div class="get-started">
                    <h1>What’s Your <span>Business</span><br> Health Score?</h1>
                    <p>Is your business set to scale and achieve its goals? Take this brief 5-minute assessment to see how prepared your business is to meet big goals. You will receive a Business Health Score and customized insight to improving your score and scaling your business.</p>
                    <button class="btn btn-primary btn-lg" @click="$emit('get-started')"><CircleDownArrow></CircleDownArrow> Get Started</button>
                </div>
            </div>
        </div>
        -->
    </div>
</template>

<script>
    export default {
    }
</script>



<style lang="scss" scoped>
    @import '@/sass/_global_variables';

    .start-page {
        position: relative;
        min-height: 568px;
        min-width: 320px;
        background: rgba(54,54,55, 1);
        background: linear-gradient(90deg, rgba(5,5,6, .96) .0, rgba(23,23,23, .97) 100%);

        @media only screen and (max-height: 568px) {
            height: 568px;
        }

        @media only screen and (max-width: 320px) {
            width: 320px;
        }

        &:before {
            content: "";
            background-image: url("/images/dot-pattern-white.png");
            background-size: 50rem;
            z-index: 1;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }

        > .row {
            min-height: 100vh;
            flex-direction: column;
        }

        .logo {
            max-width: 145px;
            margin-bottom: 2.75rem;
            @media only screen and (max-width: 380px) {
                max-width: 100px;
            }
        }

        .get-started-container {
            flex: 2;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .get-started {
            max-width: 845px;
            z-index: 1;
            padding: 0 1rem;

            @media only screen and (max-width: 639px) {
                padding-bottom: 1.2rem;
            }
        }

        img {
            max-width: 100%;

            @media only screen and (max-width: 1500px) {
                font-size: 3.5rem;
                width: 36%;
            }
        }
    }

    h2 {
        font-size: 1.45rem;
        color: $sda-guage-logo;
        margin-top: 2.8rem;
        font-weight: 900;
        display: inline-block;
        padding: .75rem;
        background: rgba($sda-white, .75);
        border-radius: 15px;

        @media only screen and (max-width: 639px) {
            margin-top: 0;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            font-size: 1rem;
            padding: .5rem;
        }
    }

    h1 {
        font-size: 5rem;
        color: $onsite-white;
        margin: 0.2rem 0 0.4rem;
        font-weight: 500;
        letter-spacing: .1rem;
        text-shadow: 0px 0px 8px rgb(5, 5, 6);

        @media only screen and (max-width: 709px) {
            font-size: 3.5rem;
        }

        @media only screen and (max-width: 627px) {
            font-size: 2.5rem;
        }

        @media only screen and (max-width: 380px) {
            font-size: 1.61rem;
            padding-bottom: 1rem;
        }
    }

    p {
        font-size: 1.52rem;
        color: $onsite-white;
        line-height: 2.1rem;
        text-shadow: 0px 1px 4px #000;

        @media only screen and (max-width: 627px) {
            font-size: 1.25rem;
            line-height: 1.6rem;
        }
    }

    .btn.btn-lg {
        text-transform: uppercase;
        margin-top: 1rem;
        font-size: 1.25rem;
        padding: .75rem;
        min-width: 13rem;

        @media only screen and (max-width: 639px) {
            font-size: 1.15rem;
            padding: .5rem;
        }

        svg {
            height: 1.625rem;
            vertical-align: text-top;
        }
    }

    .privacy-policy {
        position: absolute;
        font-size: .75rem;
        bottom: 0;
        left: 0;
        padding: .75rem;
        background: rgba($sda-white, .75);
        border-radius: 15px;
        color: $sda-blue;
        margin-bottom: .5rem;

        @media only screen and (max-width: 538px) {
            position: relative;
            bottom: 0;
            left: 0;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        @media only screen and (max-width: 345px) {
            font-size: .65rem;
        }
    }

    .privacy-policy-conatiner {

    }

    .start-page-logo {
        position: absolute;
        bottom: 0;
        left: 0;
        z-index: 0;
    }

</style>
