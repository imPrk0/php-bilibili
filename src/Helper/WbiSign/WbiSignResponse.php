<?php
/**
 * Wbi 签名响应
 * @author Prk<code@imprk.me>
 */

declare(strict_types=1);

namespace Prk\PHPBilibili\Helper\WbiSign;

use Prk\PHPBilibili\Common\HttpResponse;

final class WbiSignResponse {
    protected const MIXIN_KEY_ENCODE_TAB = [
        46, 47, 18,  2, 53,  8, 23, 32, 15, 50, 10, 31, 58,  3, 45, 35,
        27, 43,  5, 49, 33,  9, 42, 19, 29, 28, 14, 39, 12, 38, 41, 13,
        37, 48,  7, 16, 24, 55, 40, 61, 26, 17,  0,  1, 60, 51, 30,  4,
        22, 25, 54, 21, 56, 59,  6, 63, 57, 62, 11, 36, 20, 34, 44, 52
    ];

    protected string $mixinKey;

    /**
     * 构造器
     * @author Prk<code@imprk.me>
     *
     * @param HttpResponse $response 响应
     */
    public function __construct(HttpResponse $response) {
        $data = $response->getArray();

        $imgUrl = $data['data']['wbi_img']['img_url'];
        $subUrl = $data['data']['wbi_img']['sub_url'];

        if (empty($imgUrl) || empty($subUrl)) {
            // TODO 获取失败抛出异常
        }

        $this->mixinKey = $this->calcMixinKey($imgUrl, $subUrl);
        unset($imgUrl, $subUrl);
    }

    /**
     * 拿 Mixin Key
     * @author Prk<code@imprk.me>
     *
     * @return string Mixin Key
     */
    public function getMixinKey(): string {
        return $this->mixinKey;
    }

    /**
     * 计算 Mixin Key
     * @author Prk<code@imprk.me>
     *
     * @param string ...$original 原始字符串
     *
     * @return string 计算后的 Mixin Key
     */
    protected static function calcMixinKey(string ...$original): string {
        $originalString = '';
        foreach ($original as $item) {
            $originalString .= substr(basename($item), 0, strpos(basename($item), '.'));
        }
        unset($original);

        $string = '';
        foreach (self::MIXIN_KEY_ENCODE_TAB as $originalIndex) {
            $string .= $originalString[$originalIndex];
        }
        unset($originalString, $originalIndex);

        return substr($string, 0, 32);
    }
}
