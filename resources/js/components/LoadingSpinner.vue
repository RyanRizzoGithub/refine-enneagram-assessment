<template>
    <transition name="fade" appear>
        <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
    </transition>
</template>

<style lang="scss">
    @import '@/sass/_global_variables';
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
        transition-delay: .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
    .lds-ring {
        display: block;
        margin: 0 auto;
        position: relative;
        width: 40px;
        height: 40px;
        opacity: 1;
    }
    .lds-ring div {
        box-sizing: border-box;
        display: block;
        position: absolute;
        width: 32px;
        height: 32px;
        margin: 4px;
        border: 4px solid $ts-red;
        border-radius: 50%;
        animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        border-color: $ts-red transparent transparent transparent;
    }
    .lds-ring div:nth-child(1) {
        animation-delay: -0.45s;
    }
    .lds-ring div:nth-child(2) {
        animation-delay: -0.3s;
    }
    .lds-ring div:nth-child(3) {
        animation-delay: -0.15s;
    }
    @keyframes lds-ring {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>
