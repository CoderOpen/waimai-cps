<template>
	<view>
		<view class="project-container">
			<view class="project-content tip-content">
				<view  v-if="project.image" class="image"><image mode="widthFix" :src="project.image"></image></view>
			</view>

			<view class="content" v-if="project.description">{{project.description}}</view>
			<view class="go-btn" @tap="goToProject()">点我领优惠红包</view>
			<ad v-if="showAd" unit-id="adunit-6c0aefd65e51ba34" ad-type="video" ad-theme="white"></ad>
		</view>
	</view>
</template>

<script>
	export default {
		 components: {
			
		 },
		onLoad(res) {
			let projectId = res.project_id
			console.log(projectId + 'aaa1241234')
			this.getProject(projectId)
		},
		data() {
			return {
				project: {},
				showAd: false,
				defaultShareImage: '',
				shareTitle: '',
			}
		},
		onShow() {
			
		},
		onHide() {
			this.showAd = false
		},
	    onShareAppMessage(res) {
			return {
			  title: this.shareTitle,
			  path: '/pages/index/index',
			  imageUrl: this.defaultShareImage,
			}
			
		},
		
		onShareTimeline: function() {
			return {
			  title: this.shareTitle,
			  query: '/pages/index/index',
			  imageUrl: this.defaultShareImage,
			}
		},

		methods: {
			getProject:function(id) {
				uni.request({
				    url: this.requestUrl + '?id=' + id, //仅为示例，并非真实接口地址。
				    data: {
				    },
				    header: {
				        
				    },
				    success: (res) => {
				        console.log(res.data);
							this.project =  res.data;
						
							uni.hideLoading()
							uni.showToast({
								icon: 'none',
								title: res.msg,
								duration: 1000
							});
				    },
				})
			},
			goToProject: function() {
				// #ifdef  MP-QQ
				return false
				// #endif
				let project = this.project
				// #ifdef H5
				location.href = project.url
				// #endif
				// #ifdef MP-WEIXIN
				uni.navigateToMiniProgram({
				  appId: project.appid, 
				  path: project.path,
				  success(res) {
					 // 打开成功
					 console.log(res + 12312)
					 let params = {
					 	 project_id : project.id,
					 	 token: token 
					 }
					 console.log(params)
					 http.post('/add-coupon-log',params).then(res => {
					 		let data = res.data
					 	    console.log(data)
					 }).catch(function(e){
					 	console.log(e)
					 })
				  }
				})
				// #endif
				// #ifdef MP-QQ
				uni.setClipboardData({
					data:  project.url,
					success: function () {
						uni.showModal({
						    title: '温馨提示',
						    content: '红包链接已复制到黏贴版，请到浏览器打开领取！',
						    success: function (res) {
						        
						    }
						});
					}
				});
				// #endif
			}
		}
	}
</script>

<style> 
  .notify image{
	  width: 100%;
  }
  .project-container {
	  width: 92%;
	  margin: 50upx auto; 
  }
  .content{
	  margin: 20upx 0;
	  font-size: 28upx;
	  line-height: 2rem;
  }
  .go-btn{
	  width: 100%;
	  background-color:#e54d42;
	  color: white;
	  text-align: center;
	  padding: 20upx 0;
	  border-radius: 5upx;
	  font-size: 36upx;  
	  margin-bottom: 160upx;
	  margin-top: 30upx;
	  
  }
  .project_item{
	  justify-content: space-between;
	  background-color: #fff;
	  border-radius: 5upx;
	  box-shadow: 2upx 2upx 6upx #b9b9b9;
  }
  .project-header{
	  display: flex;
	  justify-content: space-between;
	  flex-direction: row;
	  margin-bottom: 20upx;
  }
  .title {
	  border-left: #F0AD4E solid 8upx;
	  padding-left: 15upx;
	  line-height: 1.5rem;
	  font-size: 30upx;
	  font-weight: 500;
	  width: 80%;
	  text-align: left;
  }
  .share{
	  width: 42upx;
	  text-align: right;
	  background-color: white;
	  padding: 0;
	  line-height: 1;
	  border: 0;
	  text-align: right;
  }
  .share::after{
  	border: 0;
  	width: 0;
	height: 0;
  }
  .share image{
	  width: 100%;
  }
  .image{
	  width: 100%; 
  }
  .image image{
	  border-radius: 10upx; 
	  max-height: 100%;
	  width: 100%;
  }
  .description{
	  font-size: 28upx;
	  font-weight: 350;
  }
</style>
