<template>
	<view>
		<view v-if="mode == 'panel'" class="panel-box">
			<u-cell-group :border="border">
				<view class="panel-main">
					<u-cell-item :title="item.title" :value="item.value" @click="openPage(item.path)" :border-bottom="borderBottom"
					 v-for="(item, index) in cells" :key="index"></u-cell-item>
				</view>
			</u-cell-group>

			<u-gap height="60"></u-gap>

			<view class="btn-line">
				<u-button type="error" @click="logout">退出登录</u-button>
			</view>
		</view>
		<view v-if="mode == 'card'" class="card-box">
			<view class="card-main">
				<u-cell-group :border="border">
					<u-cell-item :title="item.title" :value="item.value" @click="openPage(item.path)" :border-bottom="borderBottom"
					 v-for="(item, index) in cells" :key="index"></u-cell-item>
				</u-cell-group>
			</view>

			<u-gap height="60"></u-gap>

			<view class="btn-line">
				<u-button type="error" @click="logout">退出登录</u-button>
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		name: 'my-setting',
		props: {
			// 是否显示边框
			border: {
				type: Boolean,
				default: false
			},
			// 是否显示内边框
			borderBottom: {
				type: Boolean,
				default: false
			},
			// 模式
			mode: {
				type: String,
				default: 'panel'
			}
		},
		data() {
			return {
				cells: [{
						title: '微信昵称',
						value: "123",
						path: ''
					},
					{
						title: '手机号',
						value: '',
						path: 'account/bindMobile/bindMobile'
					},
					{
						title: '微信号',
						value: '填写微信号',
						path: 'account/setUserName/setUserName'
					}
				]
			};
		},
		onLoad() {
			console.log(123)
			this.getinfo();
		},
		methods: {
			getinfo() {
				this.$u.post('/wxapi/api/get_userinfo', {
					token: this.vuex_token.accessToken
					//serinfo:this.vuex_user.userinfo
				}).then(res => {
					console.log(res);
					if (res.code == 200) {

					} else if (res.code == 999) {

					}
					return false;
				});
			},
			openPage(path) {
				this.$u.route({
					url: '/pages/' + path
				});
			},
			logout() {
				this.$u.vuex('vuex_user.hasLogin', false);
				this.$u.vuex('vuex_user.userId', '');
				this.$u.vuex('vuex_user.userName', '');
				this.$u.vuex('vuex_user.userFace', '');
				this.$u.toast('退出成功');
				uni.navigateBack();
			}
		}
	};
</script>

<style lang="scss" scoped>
	.panel-box {
		.panel-main {
			padding: 10rpx 0;
		}

		.btn-line {
			margin: 0 32rpx;
		}
	}

	.card-box {
		.card-main {
			margin: 0 12rpx;
			padding: 10rpx 0;
			border-radius: 16rpx;
			background-color: #ffffff;
		}

		.btn-line {
			margin: 0 40rpx;
		}
	}
</style>
