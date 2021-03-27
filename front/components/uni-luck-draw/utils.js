export const rpx2px = (value) => {
  if (typeof value === 'string') value = Number(value.replace(/[a-z]*/g, ''))
  return uni.getSystemInfoSync().windowWidth / 750 * value
}

export const changeUnits = (value) => {
  return Number(value.replace(/^(\-*[0-9.]*)([a-z%]*)$/, (value, num, unit) => {
    switch (unit) {
      case 'px':
        num *= 1
        break
      case 'rpx':
        num = rpx2px(num)
        break
      default:
        num *= 1
        break
    }
    return num
  }))
}

let fsm
// #ifdef MP
fsm = wx.getFileSystemManager()
// #endif
let tempImageFlag = 0
export const base64src = function(base64data) {
  return new Promise((resolve, reject) => {
    // 如果不是base64就直接返回路径
    if (!/^data:image\/([a-z]+);base64,/.test(base64data)) return resolve(base64data)
    const [, format, bodyData] = /data:image\/([a-z]+);base64,(.*)/.exec(base64data) || []
    if (!format) return resolve(base64data)
    const filePath = `${wx.env.USER_DATA_PATH}/lucky_${Date.now()}${tempImageFlag++}.${format}`
    const buffer = wx.base64ToArrayBuffer(bodyData)
    fsm.writeFile({
      filePath,
      data: buffer,
      encoding: 'binary',
      success: () => resolve(filePath),
      fail: (res) => {
        console.error('API `fsm.writeFile` 进入失败回调', {
          errMsg: res.errMsg,
          ArrayBuffer: buffer
        })
        reject(new Error('base64图片缓存失败'))
      }
    })
  })
}

export const resolveImage = async (res, { src, $resolve }) => {
  // #ifdef MP
  // 如果是base64就调用base64src()方法把图片写入本地, 然后渲染临时路径
  if (/^data:image\/([a-z]+);base64,/.test(src)) {
    const path = await base64src(src)
    $resolve({ ...res.detail, path })
    return
  }
  // #endif
  // 如果是网络图片, 则通过getImageInfo()方法获取图片宽高
  uni.getImageInfo({
    src: src,
    success: (imgObj) => $resolve(imgObj),
    fail: () => console.error('API `uni.getImageInfo` 加载图片失败', src)
  })
}
