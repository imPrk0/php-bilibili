# 客户端 {#title}

哔哩哔哩弹幕网对于不同的客户端采用了不同的鉴权及防爬验证，所以，本库直接提供的客户端将简化请求流程，以便调用。

比如，获取用户信息，你可以使用我们已经封装的方法来进行获取：

```php
<?php

use Prk\PHPBilibili\User;

$user = User::getUserById(208259);

echo $user->name . PHP_EOL; // 陈睿
echo $user->sex . PHP_EOL; // 男
echo $user->face . PHP_EOL; // http://i2.hdslb.com/bfs/app/8920e6741fc2808cce5b81bc27abdbda291655d3.png
echo $user->sign . PHP_EOL; // 喜欢的话就坚持吧
```

但是，倘若就在下一秒，哔哩哔哩弹幕网修改了接口，而你通过&nbsp;B&nbsp;站的同学或自行抓取，发现接口地址或请求参数变了，
那么作者本人自&nbsp;2023&nbsp;年起已经不使用哔哩哔哩弹幕网，想要得知修改也需要如下途径：

- 通过&nbsp;Issues&nbsp;反馈
  - 使用者发现问题&nbsp;(6-12&nbsp;小时)
  - 使用者报告问题&nbsp;(1-3&nbsp;小时)
  - 提交&nbsp;Issues&nbsp;/&nbsp;PR&nbsp;报告问题&nbsp;(1&nbsp;小时)
  - 修复问题&nbsp;+&nbsp;发版&nbsp;(1-3&nbsp;天，在绝对有空且复杂度并不高的情况下)

整体流程时间过长才能得到修复，当然，这是顺利的情况。

亦或是你需要请求冷门接口或我们没有封装的接口，那么你为了临时解决问题或是请求冷门接口等各种要求，则需要自行处理请求。

::: info 💡&nbsp;值得一提的是

公开的客户端也是我们封装接口成&nbsp;**Function**&nbsp;的底层调用逻辑。

:::

你就可以使用下面的方式来进行请求：

```php
<?php

use Prk\Other\Redis;
use Prk\PHPBilibili\BilibiliClient; // Web 客户端

$request = new BilibiliClient;
$request->url = 'https://api.bilibili.com/x/space/wbi/acc/info';
$request->referer = 'https://space.bilibili.com/208259';
$request->cookies = Redis::get('bilibili_cookies');

/**
 * 如果担心哔哩哔哩弹幕网会进行&nbsp;IP&nbsp;风控
 * 可使用网络代理
 * 底层使用的是&nbsp;cUrl&nbsp;进行请求
 */
$request->proxy->setType('s5');
$request->proxy->setHost('home-ip-cn-shanghai.local.');
$request->proxy->setPort(2233);
$request->proxy->setUsername('server-a1-1');
$request->proxy->setPassword('https://imprk.me');

/**
 * 在这里传入你所要请求的 Query 参数
 * 它将自动化的帮你获取 Wbi 签名
 * 
 * ⚠️ 你今天所看到的仓库是需要拼接 URL 的，不过内部分支已经决定使用优雅的方式进行参数传入。
 */
$response = $request->get([ 'mid' => 208259 ]);

$user = $response->getArray();

echo $user['data']['name'] . PHP_EOL; // 陈睿
echo $user['data']['sex'] . PHP_EOL; // 男
echo $user['data']['face'] . PHP_EOL; // http://i2.hdslb.com/bfs/app/8920e6741fc2808cce5b81bc27abdbda291655d3.png
echo $user['data']['sign'] . PHP_EOL; // 喜欢的话就坚持吧
```

❤️&nbsp;优雅，永不过时～
