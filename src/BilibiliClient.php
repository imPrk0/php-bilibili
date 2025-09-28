<?php
/**
 * 哔哩哔哩弹幕网客户端
 * @author Prk<code@imprk.me>
 */

declare(strict_types=1);

namespace Prk\PHPBilibili;

use Prk\PHPBilibili\Common\{Config, NetworkProxy, HttpResponse, RequestInterface};
use Prk\PHPBilibili\Exception\Http\{InvalidUrlException, RequestException};
use Prk\PHPBilibili\Contracts\{CookieStoreInterface, WbiStoreInterface};
use Prk\PHPBilibili\Helper\WbiSign;

/**
 * @property string | null $url 请求地址
 * @property string $referer Referer
 * @property string | null $cookies 请求 Cookie
 * @property integer $timeout 请求超时时间 (毫秒)，默认为 5000
 * @property string $userAgent 用户浏览器 UA 用户代理
 * @property NetworkProxy $proxy 网络代理
 * @property boolean $wbiSign 是否启用 Wbi 签名，默认为 true
 */
final class BilibiliClient {
    protected int $timeout = 5000;
    protected string $referer = 'https://www.bilibili.com/';

    protected string $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.63 Safari/537.36 Edg/102.0.1245.39';
    protected array $rewriteHost = [];
    protected ?CookieStoreInterface $cookieStore = null;
    protected ?WbiStoreInterface $wbiStore = null;
    protected ?NetworkProxy $proxy = null;
    protected ?Config $config = null;

    /**
     * 构造器，处理配置
     * @author Prk<code@imprk.me>
     *
     * @param Config | null $config 配置对象
     */
    public function __construct(?Config $config = null) {
        if (!empty($config)) {
            $this->config = $config;

            $this->timeout = $config->getTimeout();

            $userAgent = $config->getUserAgent();
            if (!empty($userAgent)) $this->userAgent = $userAgent;
            unset($userAgent);

            $rewriteHost = $config->getRewriteHost();
            if (!empty($rewriteHost)) $this->rewriteHost = $rewriteHost;
            unset($rewriteHost);

            $cookieStore = $config->getCookieStore();
            if (!empty($cookieStore)) $this->cookieStore = $cookieStore;
            unset($cookieStore);

            $wbiStore = $config->getWbiStore();
            if (!empty($wbiStore)) $this->wbiStore = $wbiStore;
            unset($wbiStore);

            $proxy = $config->getNetworkProxy();
            if (!empty($proxy)) $this->proxy = $proxy;
            unset($proxy);
        }
    }

    /**
     * 发起 GET 请求
     * @author Prk<code@imprk.me>
     *
     * @param RequestInterface $request 请求参数
     *
     * @return HttpResponse 响应对象
     * @throws InvalidUrlException 当 URL 为空时抛出
     * @throws RequestException 当请求失败时抛出
     */
    public function request(RequestInterface $request): HttpResponse {
        $url = $request->getURL();
        if (empty($url) || 3 != count($url)) throw new InvalidUrlException('URL 配置有误');

        [$protocol, $host, $path] = $url;
        if (isset($this->rewriteHost[$host])) {
            $_ = $this->rewriteHost[$host];
            $url = $_[0] . $_[1];
            unset($_);
        } else $url = $protocol . $host;
        $url .= $path;
        unset($protocol, $host, $path);

        $query = $request->getQuery();
        if (!empty($query)) $url .= '?' . http_build_query(
            $request->wbiSign()
                ? array_merge($query, (new WbiSign($this->config))->encode($query))
                : $query
        );
        unset($query);

        $referrer = $request->getReferrer();
        if (empty($referrer)) $referrer = $this->referer;

        $ch = curl_init($url);
        $body = $request->getBody();
        $headers = [
            'Accept: */*',
            'Accept-Language: zh-CN;q=0.8,zh;q=0.9,en-US,en;q=0.7',
            'Connection: close',
            'Cache-Control: max-age=0',
            'Content-Type: ' . (
                is_string($body)
                    ? 'application/json; charset=UTF-8'
                    : 'application/x-www-form-urlencoded; charset=UTF-8'
            ),
            'Referer: ' . $referrer
        ];

        if (!empty($this->cookies)) $headers[] = 'Cookie: ' . $this->cookies;

        curl_setopt_array($ch, $request->getMethod()->getOptions($body));
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_ENCODING => '',
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => $this->userAgent,
            CURLOPT_TIMEOUT_MS => $this->timeout,
            CURLOPT_AUTOREFERER => true,
            CURLOPT_REFERER => $referrer
        ]);
        unset($body);

        if (!empty($this->cookies)) curl_setopt($ch, CURLOPT_COOKIE, $this->cookies);

        if (!empty($this->proxy)) {
            $proxyOptions = $this->proxy->toCurlOption();
            if (!empty($proxyOptions)) curl_setopt_array($ch, $proxyOptions);
            unset($proxyOptions);
        }

        $response = curl_exec($ch);
        $error = curl_error($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($error) throw new RequestException('cURL 请求失败: ' . $error);

        return new HttpResponse(strval($response), $status);
    }
}
