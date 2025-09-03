<?php
/**
 * 哔哩哔哩弹幕网客户端
 * @author Prk<code@imprk.me>
 */

declare(strict_types=1);

namespace Prk\PHPBilibili;

use Prk\PHPBilibili\Common\{NetworkProxy, HttpResponse};
use Prk\PHPBilibili\Exception\Http\{InvalidUrlException, RequestException};

/**
 * @property string | null $url 请求地址
 * @property string $referer Referer
 * @property string | null $cookies 请求 Cookie
 * @property integer $timeout 请求超时时间 (秒)，默认为 15
 * @property string $userAgent 用户浏览器 UA 用户代理
 * @property NetworkProxy $proxy 网络代理
 */
final class BilibiliClient {
    public ?string $url = null;
    public string $referer = 'https://www.bilibili.com/';
    public ?string $cookies = null;
    public int $timeout = 15;
    public string $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.63 Safari/537.36 Edg/102.0.1245.39';
    public NetworkProxy $proxy;

    public function __construct() {
        $this->proxy = new NetworkProxy();
    }

    /**
     * 发起 GET 请求
     * @author Prk<code@imprk.me>
     *
     * @return HttpResponse 响应对象
     * @throws InvalidUrlException 当 URL 为空时抛出
     * @throws RequestException 当请求失败时抛出
     */
    public function get(): HttpResponse {
        if (empty($this->url)) throw new InvalidUrlException('URL 不能为空');

        $ch = curl_init($this->url);

        $headers = [
            'Accept: */*',
            'Accept-Language: zh-CN;q=0.8,zh;q=0.9,en-US,en;q=0.7',
            'Connection: close',
            'Cache-Control: max-age=0',
            'Referer: ' . $this->referer
        ];

        if (!empty($this->cookies)) $headers[] = 'Cookie: ' . $this->cookies;

        curl_setopt_array($ch, [
            CURLOPT_HTTPGET => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_ENCODING => '',
            CURLOPT_URL => $this->url,
            CURLOPT_USERAGENT => $this->userAgent,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_AUTOREFERER => $this->referer,
            CURLOPT_REFERER => $this->referer
        ]);

        if (!empty($this->cookies)) curl_setopt($ch, CURLOPT_COOKIE, $this->cookies);

        $proxyOptions = $this->proxy->toCurlOption();
        if ($proxyOptions) curl_setopt_array($ch, $proxyOptions);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($error) throw new RequestException('cURL 请求失败: ' . $error);

        return new HttpResponse(strval($response), $status);
    }
}
