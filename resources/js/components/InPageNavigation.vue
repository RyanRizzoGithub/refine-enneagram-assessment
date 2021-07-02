<template>
    <div id="in-page-navigation">
        <ul class="navigation">
            <li v-for="(navItem) in navItems" :key="navItem.title" :class="{active: navItem.active}">
                <button class="btn btn-link" @click="goTo(`#${navItem.id}`)">{{navItem.title}}</button>
            </li>
        </ul>
        <slot></slot>
    </div>
</template>

<script>
    export default {
        props: {
            navItems: {
                type: Array,
                required: true,
            },
        },
        methods: {
            goTo(id) {
                return window.scrollTo({
                    top: document.querySelector(id).offsetTop - 70,
                    behavior: 'smooth'
                });
            }
        },
    }
</script>



<style lang="scss" scoped>
    @import '@/sass/_global_variables';

    #in-page-navigation {
        background: #EDEDED;
        position: sticky;
        top: 4.01375rem;
        z-index: 1020;

        @media only screen and (max-width: 479px) {
            top: 4.88875rem;
        }
    }

    .navigation {
        list-style: none;
        display: flex;
        justify-content: space-between;
        margin: 0;
        padding: .25rem 1rem;
        max-width: 750px;
        margin: 0 auto;

        @media only screen and (max-width: 390px) {
            padding: .25rem;
        }

        li {
            border-bottom: 3px solid transparent;
            margin-bottom: .25rem;
            transition: border 0.15s ease;

            @media only screen and (max-width: 366px) {
                margin-bottom: 0;
            }

            &.active {
                border-bottom: 3px solid $sda-dark-blue;

                button {
                    color: $sda-light-blue;
                }
            }
        }

        button {
            color: #152327;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            border-radius: 0;
            padding-bottom: 0;

            &:hover,
            &:focus {
                text-decoration: none;
            }

            @media only screen and (max-width: 483px) {
                font-size: .75rem;
            }

            @media only screen and (max-width: 366px) {
                font-size: .65rem;
            }

            @media only screen and (max-width: 328px) {
                padding: 0.375rem 0.25rem;
            }
        }
    }

</style>
