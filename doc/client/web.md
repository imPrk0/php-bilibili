# 🌍 Web 客户端 {#title}

<<< ./web-examples/use.php#snippet

::: details Web&nbsp;客户端使用场景

| 场景 | 地址 | 场景 | 地址 |
| :---: | :---: | :---: | :---: |
| 哔哩哔哩弹幕网主站 | https://www.bilibili.com | 哔哩哔哩直播 | https://live.bilibili.com |
| 哔哩哔哩漫画 | https://manga.bilibili.com | 哔哩哔哩会员购 | https://show.bilibili.com |
| 哔哩哔哩游戏 | https://game.bilibili.com<br />_https://*.biligame.com_ |

:::

::: warning ⚠️&nbsp;注意

我们非常建议你至少配置&nbsp;Cookie&nbsp;存储器和&nbsp;Wbi&nbsp;存储器，如果不配置的话，每次请求都会自动从哔哩哔哩弹幕网的首页拉取防封控的&nbsp;Cookie&nbsp;和&nbsp;Wbi&nbsp;加密参数，极大地增加了每次请求的时间。

为了防止封控所照成的问题，我们拒绝提供配置以取消每次的&nbsp;Cookie&nbsp;和&nbsp;Wbi&nbsp;拉取的功能。

:::

## 配置 {#config}

客户端有一个配套的配置类，你可以配置（也可以完全不必配置）。

如果你不配置，可以在新建&nbsp;Web&nbsp;客户端对象时不传或单创建一个空配置。

::: code-group

<<< ./web-examples/use-no-config.php [不传配置]

<<< ./web-examples/use-empty-config.php [传空配置]

:::


### 配置超时时间 {#timeout}

<<< ./web-examples/timeout.php#snippet

超时时间单位为毫秒，1000&nbsp;毫秒&nbsp;=&nbsp;1&nbsp;秒，我们推荐设置在&nbsp;5000-15000&nbsp;毫秒为最佳。同步任务下超过&nbsp;15&nbsp;秒会阻塞进程，异步任务超过&nbsp;15&nbsp;秒也基本上就是请求失败了，建议排查问题。

而因为网络问题，最长&nbsp;5&nbsp;秒也就返回出来了。

> 若不设置，默认就是&nbsp;5000&nbsp;毫秒。

::: details 查看代码示例

<<< ./web-examples/config-timeout.php

:::


### 配置默认情况下的 Referrer {#referrer}

<<< ./web-examples/referrer.php#snippet

设置的是默认情况下的请求头&nbsp;`Referer`，一般，接口在请求时会根据正确的场景而设置&nbsp;`Referer`，但有些接口不会设置，这时就会使用这个默认的&nbsp;`Referer`。

不过我可以告诉你的是其实你不必过于担心这个问题，因为绝大多数接口都会设置&nbsp;`Referer`，只有少数接口不会设置&nbsp;`Referer`，而且哔哩哔哩弹幕网往往不会严格限制&nbsp;`Referer`，通常只要是哔哩哔哩弹幕网自己的域名下的所有地址都可以，所以这个配置项的使用场景并不多。

> 若不设置，默认是&nbsp;`https://www.bilibili.com/`。

::: details 查看代码示例

<<< ./web-examples/config-referrer.php

:::


### 配置浏览器用户代理 User-Agent {#user-agent}

<<< ./web-examples/user-agent.php#snippet

设置的是所有请求的用户代理&nbsp;User&nbsp;Agent，默认的也就够用了，毕竟浏览器五花八门多种多样，只要不犯低级错误往往哔哩哔哩弹幕网不会做出封控。毕竟对于没有基本错误的&nbsp;User&nbsp;Agent&nbsp;采取行动误封的概率非常大。

所以你多数情况下不必要设置该值。但是如果你对于伪装有极致追求，那么就可以贯彻到底了。

> 若不设置，默认是&nbsp;`Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.63 Safari/537.36 Edg/102.0.1245.39`。

::: details 查看代码示例

<<< ./web-examples/config-user-agent.php

:::


### 配置 Hosts 重写规则 {#hosts}

<<< ./web-examples/hosts.php#snippet

如果，你自己搭建了反向代理或其它方式来代理请求，可以通过配置&nbsp;Hosts&nbsp;重写规则来实现。

请注意，传入的数组的格式须遵守&nbsp;`Array<'原 Host', ['新协议', '新 Host']>`&nbsp;格式。

::: warning ⚠️&nbsp;注意

协议头需要是完整协议头，并且&nbsp;Host&nbsp;不要以&nbsp;`/`&nbsp;结尾！

:::

如果你没有看懂，不妨看看下面这个例子。

::: details 查看代码示例

下面的例子，就是寻找&nbsp;`api.bilibili.com`&nbsp;的请求地址，并将其替换为&nbsp;`http://api.bili.example.com`。

<<< ./web-examples/config-hosts.php

底层上是使用字符串拼接&nbsp;Path&nbsp;来实现的，这也就意味着你可以在这里写&nbsp;BaseURL&nbsp;的&nbsp;Path，就像下面这样：

<<< ./web-examples/config-hosts-path.php

该例子，会如此重写：

- `https://api.bilibili.com/x/xxxxx`
  - =>&nbsp;`http://bili.example.com/api/x/xxxxx`
- `https://www.bilibili.com/video/av10492`
  - =>&nbsp;`https://bili.example.com/www/video/av10492`

:::


### 配置 Cookies 存储器 {#cookie}

::: warning 👆🤓

我们非常建议你配置&nbsp;Cookie&nbsp;存储器，如果不配置的话，每次请求都会自动从哔哩哔哩弹幕网的首页拉取防封控的&nbsp;Cookie，极大地增加了每次请求的时间。

:::

<<< ./web-examples/cookie.php#snippet

Cookie&nbsp;存储器需遵循&nbsp;`\Prk\PHPBilibili\Contracts\CookieStoreInterface`&nbsp;的实现，提供下面三个公开方法并设定适当的内容：

- 获取&nbsp;Cookie:&nbsp;`fn get(): ?string;`
  - 不传任何内容
  - 如果返回为字符串（浏览器请求的&nbsp;Cookie&nbsp;格式），则使用它作为请求的&nbsp;Cookie
  - 返回为&nbsp;Null，则会请求&nbsp;Cookie&nbsp;并调用&nbsp;`set`&nbsp;方法
- 设置&nbsp;Cookie:&nbsp;`fn set(array $cookies): void;`
  - 传入&nbsp;Cookie&nbsp;数组是每一行一个&nbsp;Set-Cookie&nbsp;的原始字符串（不包括&nbsp;`Set-Cookie:`&nbsp;部分）
  - 你可以自行决定如何存储&nbsp;Cookie&nbsp;字符串
  - 如果是环境，可以&nbsp;Redis&nbsp;持久化&nbsp;/&nbsp;文件存储
  - 如果是多账号矩阵，可以&nbsp;Redis&nbsp;持久化&nbsp;=>&nbsp;MySQL
- 清除&nbsp;Cookie:&nbsp;`fn clear(?string $key = null): void;`
  - 清除存储的&nbsp;Cookie
  - 如果&nbsp;$key&nbsp;为&nbsp;Null，则清除所有
  - 如果&nbsp;$key&nbsp;不为&nbsp;Null，则清除指定&nbsp;$key&nbsp;的&nbsp;Cookie


### 配置 Wbi 存储器 {#wbi}

::: warning 👆🤓

我们非常建议你配置&nbsp;Wbi&nbsp;存储器，如果不配置的话，每次请求都会自动从哔哩哔哩弹幕网的接口拉取&nbsp;Wbi&nbsp;签名信息，极大地增加了每次请求的时间。

:::

<<< ./web-examples/wbi.php#snippet

> Wbi&nbsp;签名最终要参与计算的是&nbsp;Mixin&nbsp;Key，所以只需要缓存&nbsp;Mixin&nbsp;Key&nbsp;就足够了。

Wbi&nbsp;存储器需遵循&nbsp;`\Prk\PHPBilibili\Contracts\WbiStoreInterface`&nbsp;的实现，提供下面三个公开方法并设定适当的内容：

- 获取&nbsp;Wbi&nbsp;Mixin&nbsp;Key:&nbsp;`fn get(): ?string;`
  - 不传任何内容
  - 如果返回为字符串，则使用它进行&nbsp;Wbi&nbsp;签名认证
  - 返回为&nbsp;Null，则会请求&nbsp;Wbi&nbsp;签名获取接口计算好&nbsp;Mixin&nbsp;Key&nbsp;后调用&nbsp;`set`&nbsp;方法
- 设置&nbsp;Wbi&nbsp;Mixin&nbsp;Key:&nbsp;`fn set(string $mixinKey): void;`
  - 传入&nbsp;Wbi&nbsp;Mixin&nbsp;Key
  - 你可以自行决定如何存储&nbsp;Wbi&nbsp;Mixin&nbsp;Key
  - 如果是环境，可以&nbsp;Redis&nbsp;持久化&nbsp;/&nbsp;文件存储
  - 如果是多账号矩阵，可以&nbsp;Redis&nbsp;持久化&nbsp;=>&nbsp;MySQL
- 清除&nbsp;Wbi&nbsp;Mixin&nbsp;Key:&nbsp;`fn clear(): void;`
  - 调用就清除存储的&nbsp;Wbi&nbsp;Mixin&nbsp;Key


### 配置网络代理 {#network-proxy}

11
