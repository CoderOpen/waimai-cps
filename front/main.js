import Vue from 'vue'
import App from './App'

Vue.config.productionTip = false
let  baseRequestUrl = 'https://waimai.lajun.site/waimai.php'  //后端网站域名
Vue.prototype.baseRequestUrl = baseRequestUrl
Vue.prototype.requestUrl = baseRequestUrl
Vue.prototype.raiseImage = 'https://leijun-common.oss-cn-shenzhen.aliyuncs.com/raise.jpeg' //赞赏作者栏目赞赏码
Vue.prototype.contactImage = "https://leijun-common.oss-cn-shenzhen.aliyuncs.com/lajun-wechat.jpeg" //联系作者的二维码
Vue.prototype.shareImage = 'https://lajun-chihe.oss-cn-beijing.aliyuncs.com/chihe-share.jpeg'  //转发朋友的分享图片
App.mpType = 'app'

const app = new Vue({
	...App
})
app.$mount()
