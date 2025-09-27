<?php
/**
 * 类库核心配置
 * @author Prk<code@imprk.me>
 */

declare(strict_types=1);

namespace Prk\PHPBilibili\Common;

use Prk\PHPBilibili\Contracts\{
    CookieStoreInterface,
    WbiStoreInterface
};

final class Config {
    protected int $timeoutMs = 5000;
    protected ?string $referrer = null;
    protected ?string $userAgent = null;
    protected array $rewriteHost = [];
    protected ?CookieStoreInterface $cookieStore;
    protected ?WbiStoreInterface $wbiStore = null;
    protected ?NetworkProxy $defaultProxy = null;

    /**
     * 设置网络请求超时时间，单位毫秒
     * @author Prk<code@imprk.me>
     *
     * @param integer $timeoutMs 网络请求超时时间，单位毫秒
     *
     * @return void 设置完了不返回东西
     */
    public function setTimeout(int $timeoutMs): void {
        // 防呆设计 (防呆不防蠢: 过大情况不做处理)
        if (0 <= $timeoutMs) $timeoutMs = 100;
        $this->timeoutMs = $timeoutMs;
    }

    /**
     * 获取网络请求超时时间，单位毫秒
     * @author Prk<code@imprk.me>
     *
     * @return integer 网络请求超时时间，单位毫秒
     */
    public function getTimeout(): int {
        return $this->timeoutMs;
    }

    /**
     * 设置 Referrer
     * @author Prk<code@imprk.me>
     *
     * @param string $referrer Referrer
     *
     * @return void 设置完了不返回东西
     */
    public function setReferer(string $referrer): void {
        if (!empty($referrer)) $this->referrer = $referrer;
    }

    /**
     * 获取 Referrer
     * @author Prk<code@imprk.me>
     *
     * @return ?string Referrer
     */
    public function getReferer(): ?string {
        return $this->referrer;
    }

    /**
     * 缺省状态下的 UserAgent
     * @author Prk<code@imprk.me>
     *
     * @param string $userAgent 缺省状态下的 User-Agent
     *
     * @return void 设置完了不返回东西
     */
    public function setUserAgent(string $userAgent): void {
        if (!empty($userAgent)) $this->userAgent = $userAgent;
    }

    /**
     * 获取缺省状态下的 UserAgent
     * @author Prk<code@imprk.me>
     *
     * @return string | null 缺省状态下的 User-Agent
     */
    public function getUserAgent(): ?string {
        return $this->userAgent;
    }

    /**
     * 设置 Host 重写规则
     * @author Prk<code@imprk.me>
     *
     * @param array $hosts Host 重写规则，键为原始 Host，值为重写后的 Host
     *
     * @return void 设置完了不返回东西
     */
    public function setRewriteHost(array $hosts): void {
        foreach ($hosts as $originalHost => $rewriteRule) {
            if (!is_array($rewriteRule) || 2 != count($rewriteRule)) continue;
            $this->rewriteHost[$originalHost] = $rewriteRule;
        }
    }

    /**
     * 获取 Host 重写规则
     * @author Prk<code@imprk.me>
     *
     * @param string | null $host 原始 Host
     *
     * @return array | null Host 重写规则
     */
    public function getRewriteHost(?string $host = null): ?array {
        if (null !== $host && isset($this->rewriteHost[$host])) return $this->rewriteHost[$host];
        return $this->rewriteHost;
    }

    /**
     * 设置 Cookie 存储器
     * @author Prk<code@imprk.me>
     *
     * @param CookieStoreInterface $cookieStore Cookie 存储接口 (需遵循实现)
     *
     * @return void 设置完了不返回东西
     */
    public function setCookieStore(CookieStoreInterface $cookieStore): void {
        $this->cookieStore = $cookieStore;
    }

    /**
     * 获取 Cookie 存储器
     * @author Prk<code@imprk.me>
     *
     * @return CookieStoreInterface | null 获取 Cookie 存储器
     */
    public function getCookieStore(): ?CookieStoreInterface {
        return $this->cookieStore ?? null;
    }

    /**
     * 设置 Wbi 签名存储器
     * @author Prk<code@imprk.me>
     *
     * @param WbiStoreInterface $wbiStore Wbi 签名存储接口 (需遵循实现)
     *
     * @return void 设置完了不返回东西
     */
    public function setWbiStore(WbiStoreInterface $wbiStore): void {
        $this->wbiStore = $wbiStore;
    }

    /**
     * 获取 Wbi 签名存储器
     * @author Prk<code@imprk.me>
     *
     * @return WbiStoreInterface | null 获取 Wbi 签名存储器
     */
    public function getWbiStore(): ?WbiStoreInterface {
        return $this->wbiStore;
    }

    /**
     * 设置网络代理
     * @author Prk<code@imprk.me>
     *
     * @param NetworkProxy $proxy 网络代理
     *
     * @return void 设置完了不返回东西
     */
    public function setNetworkProxy(NetworkProxy $proxy): void {
        $this->defaultProxy = $proxy;
    }

    /**
     * 获取网络代理
     * @author Prk<code@imprk.me>
     *
     * @return NetworkProxy | null 获取网络代理
     */
    public function getNetworkProxy(): ?NetworkProxy {
        return $this->defaultProxy;
    }
}
