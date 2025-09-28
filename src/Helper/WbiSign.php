<?php
/**
 * 哔哩哔哩弹幕网自 2023 年 3 月起启用的 Wbi 加密算法
 * @author Prk<code@imprk.me>
 */

declare(strict_types=1);

namespace Prk\PHPBilibili\Helper;

use Prk\PHPBilibili\Common\Config;
use Prk\PHPBilibili\BilibiliClient;
use Prk\PHPBilibili\Contracts\WbiStoreInterface;
use Prk\PHPBilibili\Helper\WbiSign\{WbiSignRequest, WbiSignResponse};

final class WbiSign {
    protected ?Config $config = null;
    protected ?WbiStoreInterface $wbiStore = null;

    /**
     * 构造器
     * @author Prk<code@imprk.me>
     *
     * @param Config | null $config 配置
     */
    public function __construct(?Config $config = null) {
        if (!empty($config)) {
            $this->config = $config;
            $wbiStore = $config->getWbiStore();
            if (!empty($wbiStore)) $this->wbiStore = $wbiStore;
            unset($wbiStore);
        }
    }

    /**
     * 算签名
     * @author Prk<code@imprk.me>
     *
     * @param array $params 请求之参数
     *
     * @return array 补充的 Wbi 签名参数
     */
    public function encode(array $params): array {
        $query = [];
        $params['wts'] = time();

        ksort($params);
        foreach ($params as $key => $value) {
            $value = preg_replace('/[!\'()*]/', '', (string) $value);
            $query[] = urlencode($key) . '=' . urlencode($value);
        }

        return [
            'wts' => $params['wts'],
            'w_rid' => md5(implode('&', $query) . $this->getMixinKey())
        ];
    }

    /**
     * 获取 Mixin Key
     * @author Prk<code@imprk.me>
     *
     * @return string Mixin Key
     */
    protected function getMixinKey(): string {
        if (!empty($this->wbiStore)) {
            $mixinKey = $this->wbiStore->get();
            if (!empty($mixinKey)) return $mixinKey;
        }

        return (new WbiSignResponse((new BilibiliClient($this->config))->request(new WbiSignRequest)))->getMixinKey();
    }
}
