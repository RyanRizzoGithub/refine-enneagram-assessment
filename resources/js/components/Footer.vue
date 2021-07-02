<template>
    <div id="footer">
        <div class="containter-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-12 text-md-left text-center">
                    Created By {{site_name}}.
                </div>
                <div class="col-md-6 col-sm-12 text-md-right text-center">
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
    }
</style>
