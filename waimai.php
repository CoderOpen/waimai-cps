<?php
/***
 *  一点不了解程序的也可以联系作者就行推广，更简单粗暴的方式
 */
header("Access-Control-Allow-Headers: Content-Type,XFILENAME,XFILECATEGORY,XFILESIZE,custom-header");
header('Access-Control-Allow-Origin: *');

$url = "https://waimai.lajun.site"; //后端地址
//$url = 'http://localhost:8000';

$category =
    [
        [
            'icon'  => '/images/category/all.png',  //分类图标，支持网络地址和后台地址
            'text'  => '全部',
            'tabId' => 0,
        ],
        [
            'icon'  => '/images/category/ele.png',
            'text'  => '饿了么',
            'tabId' => 1,
        ],
        [
            'icon'  => '/images/category/meituan.png',
            'text'  => '美团',
            'tabId' => 2,
        ],
        [
            'icon'  => '/images/category/jd.png',
            'text'  => '京东',
            'tabId' => 3,
        ],
    ];


$projects = [

    [
        "id"          => 1,
        "title"       => '饿了么超级大红包', //标题
        "tag"         => '霸王餐', //标签
        'description' => "description",   //描述
        'sort'        => 2,   //排序，越大越靠前
        'logo'        => '/images/projects/ele.png',  //'logo'图片路径
        "image"       => '/images/projects/ele_banner.png',  //海报图路径
        "url"         => 'https://h5.ele.me/ant/qrcode?open_type=miniapp&url_id=35&inviterId=7276c7',  //h5路径，
        'cate_id'     => 1,   //该cps项目的cat_id是上面数据的id，属于哪个分类
        "appid"       => 'wxece3a9a4c82f58c9', //小程序ID
        "path"        => 'ele-recommend-price/pages/guest/index?inviterId=7276c7', //小程序path
    ],
    [
        "id"          => 2,
        "title"   => '饿了么外卖红包',
        "tag"     => '天天领', //标签
        'logo'    => '/images/projects/ele.png',
        "image"   => '/images/projects/ele_guosu.png',
        "url"     => 'https://s.click.ele.me/Af4gvvu',
        'cate_id' => 1,
        'sort'    => 3,   //排序，越大越靠前
        "appid"   => 'wxece3a9a4c82f58c9',
        "path"    => 'pages/sharePid/web/index?scene=https://s.click.ele.me%2FAf4gvvu'
    ],
    [
        "id"          => 3,
        "title"   => '饿了么果蔬',
        'logo'    => '/images/projects/ele.png',
        "image"   => '/images/projects/eleme-cai.png',
        "url"     => 'https://s.click.ele.me/3Bafvvu',
        'cate_id' => 1,
        "sort"    => 1,
        "appid"   => 'wxece3a9a4c82f58c9',
        "path"    => 'pages/sharePid/web/index?scene=https://s.click.ele.me%2F3Bafvvu'
    ],
    [
        "id"          => 4,
        "title"       => '美团外卖红包',
        'description' => "description",   //描述
        'sort'        => 2,   //排序，越大越靠前
        'cate_id'     => 2,   //排序，越大越靠前
        'logo'        => '/images/projects/meituan.png',
        "image"       => '/images/projects/meituan_banner.png',
        "url"         => 'https://runion.meituan.com/url?key=9626de04724fb3b6d3d8954797bc11dd905&url=https%3A%2F%2Fi.meituan.com%2Fawp%2Fhfe%2Fblock%2Fa945391288b790d558b7%2F78716%2Findex.html%3Fappkey%3D9626de04724fb3b6d3d8954797bc11dd905%3Achiheyouhuiquan&sid=chiheyouhuiquan',
        "appid"       => 'wxde8ac0a21135c07d',
        "path"        => '/index/pages/h5/h5?weburl=https%3A%2F%2Frunion.meituan.com%2Furl%3Fkey%3D9626de04724fb3b6d3d8954797bc11dd905%26url%3Dhttps%253A%252F%252Fi.meituan.com%252Fawp%252Fhfe%252Fblock%252Fa13b87919a9ace9cfab4%252F89400%252Findex.html%253Fappkey%253D9626de04724fb3b6d3d8954797bc11dd905%253Achiheyouhuiquan%26sid%3Dchiheyouhuiquan&lch=cps:waimai:5:9626de04724fb3b6d3d8954797bc11dd905:chiheyouhuiquan&f_token=1&f_userId=1'

    ],
    [
        "id"          => 5,
        "title"       => '美团商城',
        'description' => "description",   //描述
        'sort'        => 2,   //排序，越大越靠前
        'cate_id'     => 2,   //排序，越大越靠前
        'logo'        => '/images/projects/meituan.png',
        "image"       => '/images/projects/meituan-shangcheng.png',
        "url"         => 'http://dpurl.cn/aMGpcG7',
        "appid"       => 'wxde8ac0a21135c07d',
        "path"        => '/index/pages/h5/h5?weburl=https%3a%2f%2fact.meituan.com%2fclover%2fpage%2fadunioncps%2fcoupon_shop%3futmSource%3d9744%26utmMedium%3d7FD98FE89D9358CF66217188EA63EA42%26activity%3d0AlN4OtEIa'
    ],
    [
        "id"          => 6,
        "title"       => '美团果蔬',
        'description' => "description",   //描述
        'sort'        => 2,   //排序，越大越靠前
        'cate_id'     => 2,   //排序，越大越靠前
        'logo'        => '/images/projects/meituan.png',
        "image"       => '/images/projects/meituan-shangchao.png',
        "url"         => '/index/pages/h5/h5?weburl=https%3A%2F%2Frunion.meituan.com%2Furl%3Fkey%3D9626de04724fb3b6d3d8954797bc11dd905%26url%3Dhttps%253A%252F%252Fi.meituan.com%252Fawp%252Fhfe%252Fblock%252Fc9ff59b58f6f5bf385b6%252F94455%252Findex.html%253Fappkey%253D9626de04724fb3b6d3d8954797bc11dd905%253Achiheyouhuiquan%26sid%3Dchiheyouhuiquan&lch=cps:waimai:5:9626de04724fb3b6d3d8954797bc11dd905:chiheyouhuiquan&f_token=1&f_userId=1',
        "appid"       => 'wxde8ac0a21135c07d',
        "path"        => '/index/pages/h5/h5?weburl=https%3A%2F%2Frunion.meituan.com%2Furl%3Fkey%3D9626de04724fb3b6d3d8954797bc11dd905%26url%3Dhttps%253A%252F%252Fi.meituan.com%252Fawp%252Fhfe%252Fblock%252Fc9ff59b58f6f5bf385b6%252F94455%252Findex.html%253Fappkey%253D9626de04724fb3b6d3d8954797bc11dd905%253Achiheyouhuiquan%26sid%3Dchiheyouhuiquan&lch=cps:waimai:5:9626de04724fb3b6d3d8954797bc11dd905:chiheyouhuiquan&f_token=1&f_userId=1',
    ],
    [
        "id"          => 7,
        "title"   => '三只松鼠大礼包',
        'logo'    => '/images/projects/jd.png',
        "image"   => '/images/projects/sanzhisongshu.png',
        "appid"   => 'wx91d27dbf599dff74',
        "path"    => '/pages/union/proxy/proxy?spreadUrl=https://u.jd.com/t7cKIqQ&EA_PTAG=17078.26.6',
        "url"     => 'https://u.jd.com/tFDejq',
        'cate_id' => 3,
        'sort'    => 1,
    ],
    [
        "id"          => 8,
        "title"   => '花小猪打车立减20',
        'logo'    => '/images/projects/jd.png',
        "image"   => '/images/projects/huaxiaozhu.png',
        "appid"   => 'wxd98a20e429ce834b',
        "path"    => 'kfpub/pages/gift?jump_home=1&f_dpsid=8d4ef886df0043338c036872dd3524f8&latitude=22.600779351128473&g_channel=2f9e032794de100a0b8eb5a203bd2a37&channel=2001001001&dchn=zxOgqk&share_code=bstir5vp8ib1u40j0cfg&channel_id=2001001001&scene=zxOgqk&longitude=114.05',
        "url"     => '',
        'cate_id' => 3,
        'sort'    => 4,
    ],
];
if (!empty($_GET['id'])) {
    $data = empty($projects[$_GET['id']]) ? [] : $projects[$_GET['id']];
    if ($data) {
        if (strpos($data['logo'], 'http') === false) {
            $data['logo'] = $url . $data['logo'];
        }
        if (strpos($data['image'], 'http') === false) {
            $data['image'] = $url . $data['image'];
        }
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
}

if (!empty($_GET['get_one'])) {
    $randKey = rand(0, count($projects) - 1);
    $data = $projects[$randKey];
    if ($data) {
        if (strpos($data['logo'], 'http') === false) {
            $data['logo'] = $url . $data['logo'];
        }
        if (strpos($data['image'], 'http') === false) {
            $data['image'] = $url . $data['image'];
        }
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
}


function arraySort($array,$keys,$sort='desc') {
    $newArr = $valArr = array();
    foreach ($array as $key=>$value) {
        $valArr[$key] = $value[$keys];
    }
    ($sort == 'asc') ?  asort($valArr) : arsort($valArr);
    reset($valArr);
    foreach($valArr as $key=>$value) {
        $newArr[$key] = $array[$key];
    }
    return $newArr;
}

$cateId = empty($_GET['cate_id']) ? 0 : $_GET['cate_id'];
if ($cateId) {
    foreach ($projects as $k => $v) {
        if ($v['cate_id'] != $cateId) {
            unset($projects[$k]);
        }
    }
}
foreach ($projects as $k => $v) {
    if (strpos($v['logo'], 'http') === false) {
        $projects[$k]['logo'] = $url . $v['logo'];
    }
    if (strpos($v['image'], 'http') === false) {
        $projects[$k]['image'] = $url . $v['image'];
    }
}

foreach ($category as $k => $v) {
    if (strpos($v['icon'], 'http') === false) {
        $category[$k]['icon'] = $url . $v['icon'];
    }
}
if($projects) {
    $projects = arraySort($projects, 'sort');
}
$data = [
    'category' => $category,
    'projects' => array_values($projects),
];


echo json_encode($data, JSON_UNESCAPED_UNICODE);
die();
