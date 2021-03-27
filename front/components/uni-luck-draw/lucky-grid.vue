<template>
	<view v-if="isShow" class="lucky-box" :style="{ width: boxWidth + 'px', height: boxHeight + 'px' }">
    <canvas id="lucky-grid" canvas-id="lucky-grid" :style="{ width: boxWidth + 'px', height: boxHeight + 'px' }"></canvas>
    <view class="lucky-grid-btn" @click="toPlay" :style="{ left: btnLeft + 'px', top: btnTop + 'px', width: btnWidth + 'px', height: btnHeight + 'px' }"></view>
    <div class="lucky-imgs">
      <div v-for="(prize, index) in prizes" :key="index">
        <span v-if="prize.imgs">
          <image v-for="(img, i) in prize.imgs" :key="i" :src="img.src" @load="e => imgBindload(e, 'prizes', index, i)"></image>
        </span>
      </div>
    </div>
    <div class="lucky-imgs">
      <span v-if="button && button.imgs">
        <image v-for="(img, i) in button.imgs" :key="i" :src="img.src" @load="e => imgBindloadBtn(e, 'button', i)"></image>
      </span>
    </div>
  </view>
</template>

<script>
  import { changeUnits, resolveImage } from './utils.js'
  import { LuckyGrid } from '../lucky-canvas'
  export default {
    name: 'lucky-grid',
    data () {
      return {
        isShow: false,
        boxWidth: 100,
        boxHeight: 100,
        btnWidth: 0,
        btnHeight: 0,
        btnLeft: 0,
        btnTop: 0,
        dpr: 1,
        transformStyle: '',
      }
    },
    props: {
      width: {
        type: String,
        default: '600rpx'
      },
      height: {
        type: String,
        default: '600rpx'
      },
      cols: {
        type: [String, Number],
        default: 3,
      },
      rows: {
        type: [String, Number],
        default: 3,
      },
      blocks: {
        type: Array,
        default: () => []
      },
      prizes: {
        type: Array,
        default: () => []
      },
      button: {
        type: Object,
        default: () => {
          return {}
        }
      },
      defaultConfig: {
        type: Object,
        default: () => {
          return {}
        }
      },
      defaultStyle: {
        type: Object,
        default: () => {
          return {}
        }
      },
      activeStyle: {
        type: Object,
        default: () => {
          return {}
        }
      }
    },
    mounted () {
      this.init()
    },
    watch: {
      cols (newData, oldData) {
        this.$lucky && (this.$lucky.cols = newData)
      },
      rows (newData, oldData) {
        this.$lucky && (this.$lucky.rows = newData)
      },
      blocks (newData, oldData) {
        this.$lucky && (this.$lucky.blocks = newData)
      },
      prizes (newData, oldData) {
        this.$lucky && (this.$lucky.prizes = newData)
      },
      button (newData, oldData) {
        this.$lucky && (this.$lucky.button = newData)
      },
    },
    methods: {
      async imgBindload (res, name, index, i) {
        const img = this[name][index].imgs[i]
        resolveImage(res, img)
      },
      async imgBindloadBtn (res, name, i) {
        const img = this[name].imgs[i]
        resolveImage(res, img)
      },
      init () {
        const dpr = this.dpr = uni.getSystemInfoSync().pixelRatio
        this.boxWidth = changeUnits(this.width)
        this.boxHeight = changeUnits(this.height)
        const compute = (len) => (len * dpr - len) / (len * dpr) * (dpr / 2) * 100
        this.transformStyle = `scale(${1 / dpr}) translate(
          ${-compute(this.boxWidth * dpr)}%, ${-compute(this.boxHeight * dpr)}%
        )`
        this.isShow = true
        this.$nextTick(() => {
          this.draw()
        })
      },
      draw () {
        const ctx = this.ctx = uni.createCanvasContext('lucky-grid', this)
        const $lucky = this.$lucky = new LuckyGrid({
          // #ifdef H5
          flag: 'UNI-H5',
          // #endif
          // #ifdef MP
          flag: 'UNI-MINI-WX',
          // #endif
          dpr: 1,
          ctx: this.ctx,
          width: this.width,
          height: this.height,
          setTimeout: setTimeout,
          clearTimeout: clearTimeout,
          setInterval: setInterval,
          clearInterval: clearInterval,
          unitFunc: (num, unit) => changeUnits(num + unit),
          beforeDraw: function () {
            // const { config } = this
            // ctx.scale(config.dpr, config.dpr)
          },
          afterDraw: function () {
            ctx.draw()
          },
        }, {
          ...this.$props,
          start: (...rest) => {
            this.$emit('start', ...rest)
          },
          end: (...rest) => {
            this.$emit('end', ...rest)
          },
        })
        // 动态设置按钮大小
        const button = this.$props.button
        if (button.hasOwnProperty('x') && button.hasOwnProperty('y')) {
          [
            this.btnLeft,
            this.btnTop,
            this.btnWidth,
            this.btnHeight
          ] = $lucky.getGeometricProperty([
            button.x,
            button.y,
            button.col || 1,
            button.row || 1
          ])
        }
      },
      toPlay (e) {
        this.$lucky.startCallback()
      },
      play (...rest) {
        this.$lucky.play(...rest)
      },
      stop (...rest) {
        this.$lucky.stop(...rest)
      },
    },
  }
</script>

<style scoped>
  .lucky-box {
    position: relative;
    overflow: hidden;
  }
  .lucky-box canvas {
    position: absolute;
  }
  .lucky-grid-btn {
    position: absolute;
    background: rgba(0, 0, 0, 0);
    border-radius: 0;
  }
  .lucky-imgs {
    width: 0;
    height: 0;
    visibility: hidden;
  }
</style>
