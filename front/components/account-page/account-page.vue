<template>
	<view class="page-wrap">
		<view class="page-header">
			<view class="page-title">{{ title }}</view>
			<view class="page-desc">{{ desc }}</view>
		</view>
		<view class="page-body"><slot></slot></view>
	</view>
</template>

<script>
export default {
	name: 'account-page',
	props: {
		// 标题
		title: {
			type: String,
			default: ''
		},
		// 描述
		desc: {
			type: String,
			default: ''
		}
	},
	data() {
		return {};
	}
};
</script>

<style lang="scss" scoped>
.page-wrap {
	.page-header {
		padding: 30rpx 40rpx;
		margin-bottom: 50rpx;

		.page-title {
			text-align: left;
			font-size: 40rpx;
			font-weight: 600;
			margin-bottom: 10rpx;
			color: $u-main-color;
		}

		.page-desc {
			color: $u-tips-color;
		}
	}
	
	.page-body {
		padding: 0 8rpx;
	}
}
</style>
