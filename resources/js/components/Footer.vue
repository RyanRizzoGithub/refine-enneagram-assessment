<template>
    <div id="footer">
        <div class="containter-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-12 text-md-left text-center">
                    Created By <span>{{site_name}}</span>.
                </div>

                <div class="col-md-4 col-sm-12 text-center">
                    Powered by True Strategy
                </div>

                <div class="col-md-4 col-sm-12 text-md-right text-center">
                    &#169; {{year}} All Rights Reserved
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            year() {
                const date = new Date();
                return date.getFullYear();
            },
            site_name() {
                return process.env.MIX_APP_NAME;
            }
        },
    }
</script>



<style lang="scss" scoped>
    @import '@/sass/_global_variables';

    #footer {
        background: $onsite-black;
        color: $onsite-white;
        padding: 1rem;
        text-transform: uppercase;
        float: left;
        width: 100%;

        span {
            text-transform: none;
        }
    }
</style>
