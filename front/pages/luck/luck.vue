<template>
  <view>
	  <view class="main">
		<LuckyWheel
		  ref="luckyWheel"
		  width="600rpx"
		  height="600rpx"
		  style="margin-top: 200upx"
		  :blocks="blocks"
		  :prizes="prizes"
		  :buttons="buttons"
		  :defaultStyle="defaultStyle"
		  @start="startCallBack"
		  @end="endCallBack" 
		/>
	  </view>
  </view>
</template>
<style>
	.main {
		display: flex;
		flex-direction:  row;
		justify-content: center ;
	}
</style>
<script>
  import LuckyWheel from '@/components/uni-luck-draw/lucky-wheel'
  export default {
    components: { LuckyWheel },
    data () {
      return {
		randApp: {},
		callBackNoting: false,
        blocks: [
          { padding: '13px', background: '#d64737' }
        ],
        prizes: [
          { title: '汤粉面', background: '#f9e3bb', fonts: [{ text: '汤粉面', top: '18%' }] },
          { title: '炒粉', background: '#f8d384', fonts: [{ text: '炒粉', top: '18%' }] },
          { title: '烤鱼', background: '#f9e3bb', fonts: [{ text: '烤鱼', top: '18%' }] },
		  { title: '湖南菜', background: '#f8d384', fonts: [{ text: '湖南菜', top: '18%' }] },
          { title: '水饺', background: '#f8d384', fonts: [{ text: '水饺', top: '18%' }] },
		  { title: '随便', background: '#f8d384', fonts: [{ text: '随便', top: '18%' }] },
          { title: '酸菜鱼', background: '#f9e3bb', fonts: [{ text: '酸菜鱼', top: '18%' }] },
          { title: '凉皮肉夹馍', background: '#f8d384', fonts: [{ text: '凉皮肉夹馍', top: '18%' }] },
        ],
        buttons: [
          { radius: '50px', background: '#d64737' },  
          { radius: '45px', background: '#fff' },
          { radius: '41px', background: '#f6c66f', pointer: true },
          {
            radius: '35px', background: '#ffdea0',
            fonts: [{ text: '吃啥呢', fontSize: '18px', top: -18 }]
          }
        ],
        defaultStyle: {
          fontColor: '#d64737',
          fontSize: '14px'
        },
      }
    },
	onHide() {
		 this.callBackNoting = true
		 this.$refs.luckyWheel.stop(1)
	},
	onShow() {
		 this.callBackNoting = false
	},
	onLoad() {
		uni.request({
		    url: this.requestUrl + '?get_one=1', //仅为示例，并非真实接口地址。
		    data: {
		    },
		    header: {
		        
		    },
		    success: (res) => {
		        console.log(res.data);
				let data = res.data
				this.randApp = data 
		    },
		})
	},
    methods: {
      // 点击抽奖按钮触发回调
      startCallBack () {
        // 先开始旋转
        this.$refs.luckyWheel.play()
        // 使用定时器来模拟请求接口
        setTimeout(() => {
          // 3s后得到中奖索引
          let index = Math.random() * 6 >> 0
          // 缓慢停止游戏
          this.$refs.luckyWheel.stop(index)
        }, 2000)
      },
      // 抽奖结束触发回调
      endCallBack (prize) {
		 if (this.callBackNoting) {
			 return;
		 }
		 console.log(prize)
		 let that = this
		 uni.showModal({
		 	title: "这顿就来个" + prize.title,
			cancelText: '重选',
			//showCancel,
			success: function (res) {
				if (res.confirm) {
					console.log('用户点击确定');
					console.log(that.randApp)
					if (that.randApp) {
						uni.navigateToMiniProgram({
							appId: that.randApp.appid,
							path: that.randApp.path,
							success(res) {
								// 打开成功
							}
						});
					} else {
						uni.switchTab({
							url: '/pages/index/index'
						})
					}
				} else if (res.cancel) {
					that.startCallBack()
				}
			}
		 })
      }
    }
  }
</script>