<template>
    <div class="guage-holder">
        <div class="gauge">
            <div class="mask">
                <div class="right-cutoff cutoff"></div>
                <div class="left-cutoff cutoff"></div>
                <div class="gauge-background"></div>
                <div class="needle" :style="{'transform': `rotate(${((this.percentage / 100) * 150) - 75}deg)`}"></div>
                <div class="needle-hub"></div>
                <div class="hub-spacer"></div>
            </div>
        </div>
		<h3>your {{title}} impact level</h3>
    </div>
</template>

<script>
    export default {
        props: {
            percentage: {
                type: Number,
                required: true,
            },
            title: {
                type: String,
                required: true,
            },
        },
    }
</script>

<style lang="scss" scoped>
    @import '@/sass/_global_variables';

    .guage-holder {
        max-width: 900px;
        margin: 0 auto;
        text-align: center;
        padding: 4.5rem 1rem 3rem;
    }

    .gauge {
        text-align: center;
        display: inline-block;
        margin-bottom: 10px;
        color: #fff;
    }

	.gauge .mask {
		background: -webkit-linear-gradient(left, transparent 0%, $sda-blue 50%, $sda-orange 100%);
		background: linear-gradient(to right, transparent 0%, $sda-blue 50%, $sda-orange 100%);
		border-radius: 50% 50% 50% 50% / 100% 100% 0% 0%;
		width: 250px;
		height: 125px;
		position: relative;
	}

	.gauge .cutoff {
		width: 100px;
		height: 40px;
		background: $sda-white;
		position: absolute;
		bottom: -20px;
		z-index: 1;
	}

	.gauge .right-cutoff {
		right: -20px;
		-webkit-transform-origin: left center;
		transform-origin: left center;
		-webkit-transform: rotate(-10deg);
		transform: rotate(-10deg);
	}

	.gauge .left-cutoff {
		left: -20px;
		-webkit-transform-origin: right center;
		transform-origin: right center;
		-webkit-transform: rotate(10deg);
		transform: rotate(10deg);
	}

	.gauge .gauge-background {
		position: absolute;
		bottom: 0px;
		border-radius: 50% 50% 50% 50% / 100% 100% 0% 0%;
		background: $sda-white;
		width: 190px;
		height: 95px;
		left: calc(50% - 95px);
	}

	.gauge .needle {
		position: absolute;
		-webkit-transform-origin: center 100%;
		transform-origin: center 100%;
		bottom: 10px;
		width: 0;
		height: 0;
		border-left: 5px solid transparent;
		border-right: 5px solid transparent;
		border-bottom: 120px solid $sda-guage-black;
		left: calc(50% - 5px);
		-webkit-transform: rotate(-70deg);
		transform: rotate(-70deg);
		-webkit-transition: -webkit-transform 1s ease-in-out;
		transition: -webkit-transform 1s ease-in-out;
		transition: transform 1s ease-in-out;
		transition: transform 1s ease-in-out, -webkit-transform 1s ease-in-out;
		z-index: 2;
	}

	.gauge .needle-hub {
		border-radius: 50% 50% 50% 50% / 100% 100% 0% 0%;
		background: $sda-white;
		width: 100px;
		height: 50px;
		position: absolute;
		bottom: 10px;
		left: calc(50% - 50px);
		font-size: 2em;
		line-height: 2em;
		z-index: 3;
	}

	.gauge .hub-spacer {
		width: 100px;
		height: 10px;
		background: $sda-white;
		position: absolute;
		bottom: 0px;
		left: calc(50% - 50px);
		z-index: 3;
	}

    h3 {
        font-weight: 700;
        color: $sda-guage-black;
		margin-top: -2.25rem;
		z-index: 4;
        position: relative;
    }

    h5 {
        font-weight: 700;
        color: $sda-guage-black;
    }
</style>
