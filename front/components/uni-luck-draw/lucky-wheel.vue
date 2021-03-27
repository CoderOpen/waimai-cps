<template>
  <view v-if="isShow" class="lucky-box" :style="{ width: boxWidth + 'px', height: boxHeight + 'px' }">
    <canvas id="lucky-wheel" canvas-id="lucky-wheel" :style="{ width: boxWidth + 'px', height: boxHeight + 'px' }"></canvas>
    <view class="lucky-wheel-btn" @click="toPlay" :style="{ width: btnWidth + 'px', height: btnHeight + 'px' }"></view>
    <div class="lucky-imgs">
      <div v-for="(prize, index) in prizes" :key="index">
        <span v-if="prize.imgs">
          <image v-for="(img, i) in prize.imgs" :key="i" :src="img.src" @load="e => imgBindload(e, 'prizes', index, i)"></image>
        </span>
      </div>
    </div>
    <div class="lucky-imgs">
      <div v-for="(btn, index) in buttons" :key="index">
        <span v-if="btn.imgs">
          <image v-for="(img, i) in btn.imgs" :key="i" :src="img.src" @load="e => imgBindload(e, 'buttons', index, i)"></image>
        </span>
      </div>
    </div>
  </view>
</template>

<script>
  import { changeUnits, resolveImage } from './utils.js'
  import { LuckyWheel } from '../lucky-canvas'
  export default {
    name: 'lucky-wheel',
    data () {
      return {
        isShow: false,
        boxWidth: 100,
        boxHeight: 100,
        btnWidth: 0,
        btnHeight: 0,
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
      blocks: {
        type: Array,
        default: () => []
      },
      prizes: {
        type: Array,
        default: () => []
      },
      buttons: {
        type: Array,
        default: () => []
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
    },
    mounted () {
      this.init()
    },
    watch: {
      blocks (newData, oldData) {
        this.$lucky && (this.$lucky.blocks = newData)
      },
      prizes (newData, oldData) {
        this.$lucky && (this.$lucky.prizes = newData)
      },
      buttons (newData, oldData) {
        this.$lucky && (this.$lucky.buttons = newData)
      },
    },
    methods: {
      async imgBindload (res, name, index, i) {
        const img = this[name][index].imgs[i]
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
        const ctx = this.ctx = uni.createCanvasContext('lucky-wheel', this)
        const $lucky = this.$lucky = new LuckyWheel({
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
            ctx.translate(this.Radius, this.Radius)
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
        this.btnWidth = $lucky.maxBtnRadius * 2
        this.btnHeight = $lucky.maxBtnRadius * 2
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
  .lucky-wheel-btn {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    background: rgba(0, 0, 0, 0);
    border-radius: 50%;
  }
  .lucky-imgs {
    width: 0;
    height: 0;
    visibility: hidden;
  }
</style>
