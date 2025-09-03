<?php
/**
 * 网络代理核心库
 * @author Prk<code@imprk.me>
 */

declare(strict_types=1);

namespace Prk\PHPBilibili\Common;

use Prk\PHPBilibili\Exception\Http\{
    InvalidProxyException,
    InvalidPortException
};

final class NetworkProxy {
    protected const SUPPORTED_TYPES = [
        'http', 'https',
        'socks4', 'socks5', 's4', 's5'
    ];

    private ?string $type = null;
    private ?string $host = null;
    private ?int $port = null;
    private ?string $username = null;
    private ?string $password = null;

    /**
     * 设置代理类型
     * @author Prk<code@imprk.me>
     *
     * @param string $type 代理类型
     * @example http
     *
     * @return void 该函数不会返回任何
     * @throws InvalidProxyException 当代理类型不被支援时抛出此异常
     */
    public function setType(string $type): void {
        $type = strtolower($type);
        if (!in_array($type, self::SUPPORTED_TYPES, true)) {
            throw new InvalidProxyException('网络代理类型 [' . $type . '] 不被支援。');
        }

        switch ($type) {
            case 's4':
                $type = 'socks4';
                break;
            case 's5':
                $type = 'socks5';
                break;
        }

        $this->type = $type;
    }

    /**
     * 设置代理主机地址
     * @author Prk<code@imprk.me>
     *
     * @param string $host 欲要设置的代理主机地址
     * @example 233.233.233.233
     *
     * @return void 该函数不会返回任何
     */
    public function setHost(string $host): void {
        $this->host = $host;
    }

    /**
     * 设置代理端口
     * @author Prk<code@imprk.me>
     *
     * @param integer $port 欲要设置的端口 (需在合法范围)
     * @example 2233
     *
     * @return void 该函数不会返回任何
     * @throws InvalidPortException 当端口不在合法范围时抛出此异常
     */
    public function setPort(int $port): void {
        if (1 > $port || 65535 < $port) {
            throw new InvalidPortException('网络代理端口 [' . $port . '] 不在合法范围内。');
        }

        $this->port = $port;
    }

    /**
     * 设置代理认证的用户名 (如有)
     * @author Prk<code@imprk.me>
     *
     * @param string $username 欲要设置的用户名
     * @example prk
     *
     * @return void 该函数不会返回任何
     */
    public function setUsername(string $username): void {
        $this->username = $username;
    }

    /**
     * 设置代理认证的密码 (如有)
     * @author Prk<code@imprk.me>
     *
     * @param string $password 欲要设置的密码
     * @example prk123456
     *
     * @return void 该函数不会返回任何
     */
    public function setPassword(string $password): void {
        $this->password = $password;
    }

    /**
     * 将当前代理配置转换为 cURL 选项
     * @author Prk<code@imprk.me>
     *
     * @return array cURL 选项数组
     */
    public function toCurlOption(): array {
        if (!$this->host || !$this->port) return [];

        $proxy = $this->host . ':' . $this->port;
        $options = [
            CURLOPT_PROXYTYPE => $this->resolveProxyType(),
            CURLOPT_PROXY => $proxy
        ];

        if ($this->username && $this->password) $options[CURLOPT_PROXYUSERPWD] = $this->username . ':' . $this->password;

        return $options;
    }

    /**
     * 解析代理类型为 cURL 常量
     * @author Prk<code@imprk.me>
     *
     * @return integer cURL 代理类型常量
     * @throws InvalidProxyException 当代理类型不被支援时抛出此异常
     */
    private function resolveProxyType(): int {
        return match ($this->type) {
            'http' => CURLPROXY_HTTP,
            'https' => CURLPROXY_HTTPS,
            'socks4' => CURLPROXY_SOCKS4,
            'socks5' => CURLPROXY_SOCKS5,
            default  => throw new InvalidProxyException('网络代理类型 [' . $this->type . '] 不被支援。')
        };
    }
}
