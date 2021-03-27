
## 其他框架适配情况

<table>
  <thead>
    <tr style="background: #fafafb">
      <td align="center">npm 包</td>
      <td align="center">支持的框架</td>
      <td align="center">最新版本</td>
      <td align="center">下载量（月）</td>
      <td align="center">Star</td>
    </tr>
  </thead>
  <tbody>
    <tr style="background: #ecf5ff">
      <td align="center"><a href="https://github.com/LuckDraw/lucky-canvas" target="_black">lucky-canvas</a></td>
      <td align="center">Js / JQuery</td>
      <td align="center"><img src="https://img.shields.io/github/package-json/v/luckdraw/lucky-canvas?color=%23ffca28&logo=npm&style=flat-square" alt="version" /></td>
      <td align="center"><img src="https://img.shields.io/npm/dm/lucky-canvas?color=%237289da&logo=npm&style=flat-square" alt="downloads" /></td>
      <td align="center"><img src="https://img.shields.io/github/stars/luckdraw/lucky-canvas?color=%232DCE89&logo=github&style=flat-square" alt="stars" /></td>
    </tr>
    <tr style="background: #f0f9eb">
      <td align="center"><a href="https://github.com/LuckDraw/vue-luck-draw" target="_black">vue-luck-draw</a></td>
      <td align="center">Vue2.x / Vue3.x</td>
      <td align="center"><img src="https://img.shields.io/github/package-json/v/luckdraw/vue-luck-draw?color=%23ffca28&logo=npm&style=flat-square" alt="version" /></td>
      <td align="center"><img src="https://img.shields.io/npm/dm/vue-luck-draw?color=%237289da&logo=npm&style=flat-square" alt="downloads" /></td>
      <td align="center"><img src="https://img.shields.io/github/stars/luckdraw/vue-luck-draw?color=%232DCE89&logo=github&style=flat-square" alt="stars" /></td>
    </tr>
    <tr style="background: #fef0f0">
      <td align="center">react-luck-draw</td>
      <td align="center">React</td>
      <td align="center" colspan="3">开发中...</td>
    </tr>
    <tr style="background: #fdf6ec">
      <td align="center"><a href="https://github.com/LuckDraw/mini-luck-draw" target="_black">mini-luck-draw</a></td>
      <td align="center">原生微信小程序</td>
      <td align="center"><img src="https://img.shields.io/github/package-json/v/luckdraw/mini-luck-draw?color=%23ffca28&logo=npm&style=flat-square" alt="version" /></td>
      <td align="center"><img src="https://img.shields.io/npm/dm/mini-luck-draw?color=%237289da&logo=npm&style=flat-square" alt="downloads" /></td>
      <td align="center"><img src="https://img.shields.io/github/stars/luckdraw/mini-luck-draw?color=%232DCE89&logo=github&style=flat-square" alt="stars" /></td>
    </tr>
    <tr style="background: #fdf6ec">
      <td align="center"><a href="https://github.com/LuckDraw/uni-luck-draw" target="_black">uni-luck-draw</a></td>
      <td align="center">uni-app</td>
      <td align="center"><img src="https://img.shields.io/github/package-json/v/luckdraw/uni-luck-draw?color=%23ffca28&logo=npm&style=flat-square" alt="version" /></td>
      <td align="center"><img src="https://img.shields.io/npm/dm/uni-luck-draw?color=%237289da&logo=npm&style=flat-square" alt="downloads" /></td>
      <td align="center"><img src="https://img.shields.io/github/stars/luckdraw/uni-luck-draw?color=%232DCE89&logo=github&style=flat-square" alt="stars" /></td>
    </tr>
  </tbody>
</table>


<br />

## 官方文档 & Demo演示

> **中文**：[https://100px.net/document/uni-app.html](https://100px.net/document/uni-app.html)  

<br />

## 在 uni-app 中使用

### 1. 安装插件

- **你可以选择通过 `HBuilderX` 导入插件：** [https://ext.dcloud.net.cn/plugin?id=3499](https://ext.dcloud.net.cn/plugin?id=3499)

- **也可以选择通过 `npm / yarn` 安装**

```shell
# npm 安装：
npm install uni-luck-draw

# yarn 安装：
yarn add uni-luck-draw
```

### 2. 引入并使用

```html
<view>
  <!-- 大转盘抽奖 -->
  <LuckyWheel
    width="600rpx"
    height="600rpx"
    ...你的配置
  />
  <!-- 九宫格抽奖 -->
  <LuckyGrid
    width="600rpx"
    height="600rpx"
    ...你的配置
  />
</view>
```

```js
// npm 下载会默认到 node_modules 里面，直接引入包名即可
import LuckyWheel from 'uni-luck-draw/lucky-wheel' // 大转盘
import LuckyGrid from 'uni-luck-draw/lucky-grid' // 九宫格

// 如果你是通过 HBuilderX 导入插件，那你需要指定一下路径
// import LuckyWheel from '@/components/uni-luck-draw/lucky-wheel' // 大转盘
// import LuckyGrid from '@/components/uni-luck-draw/lucky-grid' // 九宫格

export default {
  // 注册组件
  components: { LuckyWheel, LuckyGrid },
}
```

### 3. 我提供了一个最基本的 demo 供你用于尝试

由于 uni-app 渲染 md 的时候会出问题，所以我把 demo 代码放到了文档里

- [https://100px.net/document/uni-app.html](https://100px.net/document/uni-app.html)
