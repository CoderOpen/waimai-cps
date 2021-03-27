<template>
	<view class="container">
		<v-tabs v-model="current" :tabs="category" @change="changeTab" class="tab"></v-tabs>
		<view class="coupon" ref="coupon">
			<view class="item" v-for="(v, i) in projectList" @click="toProject(i)" :key="i">
				<view class="top">
					<view class="left">
						<view class="content">
							<image :src="v.logo" class="icon" mode="widthFix" />
							<view class="name">{{ v.title }}</view>
						</view>
						<view class="text"> {{v.tag ? v.tag : "天天可领"}}</view>
					</view>
					<view class="right">免费领取</view>
				</view>
				<view class="bottom"><image :src="v.image" mode="widthFix" /></view>
			</view>
		</view>
	</view>
</template>

<script>
export default {
	data() {
		return {
			current: 0,
			category: [
			
			],
			projectList: [
			],
		};
	},
	onLoad(e) {
                let uid  = e.uid
		//#ifdef H5
		let tabId = this.$route.query.tabId ? parseInt(this.$route.query.tabId) : 0
		//#endif
		//#ifdef MP-WEIXIN
		let tabId = e.tabId ? parseInt(e.tabId) : 0
		//#endif
		for(let i in this.tabs){
			if(tabId == this.tabs[i].tabId){
				this.current = parseInt(i)
			}
		}
		this.changeTab(this.current,uid)
	},
	onShareAppMessage(res) {
		return {
			title: '美团饿了么大额红包，每日可领',
			path: '/pages/index/index'
		}
	},
	methods: {
		changeTab(index,uid) {
			console.log('当前选中的项：' + index);
                        if (!uid) {
                           uid = 'index'
                        }
			this.couponList = []
			uni.showLoading({
			    title: '获取优惠中'
			});
			uni.request({
			    url: this.requestUrl + '/' + uid + ".php?cate_id=" + index, //仅为示例，并非真实接口地址。
			    data: {
			    },
			    header: {
			        
			    },
			    success: (res) => {
			        console.log(res.data);
			        this.category = res.data.category
					let projects = res.data.projects
					let newProjects = []
					//#ifdef MP-WEIXIN
					for (let item in projects) {
						if (projects[item].path) {
							newProjects.push(projects[item])
						}
					}
					//#endif
					//#ifdef H5
					for (let item in projects) {
						if (projects[item].url) {
							newProjects.push(projects[item])
						}
					}
					//#endif
					this.projectList =  newProjects
			    }
			});

			// if(index == 0){
			// 	this.couponList = this.coupons
			// }else{
			// 	for(let i in this.coupons){
			// 		if(this.coupons[i].tabId == this.tabs[index].tabId){
			// 			this.couponList.push(this.coupons[i])
			// 		}
			// 	}
			// }
			//#ifdef H5
			this.$nextTick(() => {
				this.$refs.coupon.scrollTop= 0;
			})
			//#endif
			setTimeout(() => {
				uni.hideLoading()
			}, 500)
		},
		toProject(i){
			let project = this.projectList[i]
			//h5
			//#ifdef H5
			window.location.href = this.projectList[i].url
			//#endif
			//微信小程序
			//#ifdef MP-WEIXIN 
		
		   
			if (project.description) {
				console.log(project) 
				return
				uni.navigateTo({
					url: '/pages/detail/detail?project_id=' + project.id,
					fail(res) {
						console.log(res)
					}
				});
				return;
			}
			
			wx.navigateToMiniProgram({
			  appId: this.projectList[i].appid, 
			  path: this.projectList[i].path,
			  success(res) {
				// 打开成功
			  }
			})
			//#endif
		}
	}
};
</script>

<style lang="scss">
page {
	background-color: #f8f8f8;
}
.container {
	font-size: 14px;
	line-height: 24px;
	position: relative;
	.tab {
		position: fixed;
		top: var(--window-top);
		left: 0;
		z-index: 9999;
	}
	.coupon {
		padding-top: 200rpx;
		.item {
			background-color: #ffffff;
			margin: 30rpx;
			border-radius: 10rpx;
			padding: 0 30rpx 30rpx 30rpx;
			.top {
				height: 116rpx;
				display: flex;
				align-items: center;
				justify-content: space-between;
				.left {
					height: 116rpx;
					width: 400rpx;
					display: flex;
					align-items: center;
					justify-content: space-between;
					.content {
						width: 100%;
					}
					.icon {
						display: inline-block;
						vertical-align: bottom;
						width: 52rpx;
						height: auto;
					}
					.name {
						text-align: left;
						display: inline-block;
						vertical-align: bottom;
						font-size: 28rpx;
						color: #000;
						line-height: 50rpx;
						font-weight: bold;
						margin-left: 15rpx;
					}
					.text {
						width: 150rpx;
						height: 38rpx;
						line-height: 38rpx;
						text-align: center;
						font-size: 24rpx;
						color: #61300e;
						background: linear-gradient(90deg, #f9db8d, #f8d98a);
						border-radius: 6rpx;
					}
				}

				.right {
					width: 170rpx;
					height: 60rpx;
					border-radius: 30rpx;
					background: linear-gradient(90deg, #ec6f43, #ea4a36);
					color: #fff;
					font-size: 28rpx;
					line-height: 60rpx;
					text-align: center;
				}
			}

			.bottom {
				height: auto;
				width: 100%;
				image {
					display: block;
					width: 100%;
					height: auto;
				}
			}
		}
	}
}
</style>
