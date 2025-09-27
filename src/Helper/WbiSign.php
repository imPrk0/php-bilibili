<?php
/**
 * 哔哩哔哩弹幕网自 2023 年 3 月起启用的 Wbi 加密算法
 * @author Prk<code@imprk.me>
 */

declare(strict_types=1);

namespace Prk\PHPBilibili\Helper;

use Prk\PHPBilibili\BilibiliClient;
use Prk\PHPBilibili\Common\Config;
use Prk\PHPBilibili\Helper\WbiSign\WbiSignRequest;

final class WbiSign {
    protected const MIXIN_KEY_ENCODE_TAB = [
        46, 47, 18,  2, 53,  8, 23, 32, 15, 50, 10, 31, 58,  3, 45, 35,
        27, 43,  5, 49, 33,  9, 42, 19, 29, 28, 14, 39, 12, 38, 41, 13,
        37, 48,  7, 16, 24, 55, 40, 61, 26, 17,  0,  1, 60, 51, 30,  4,
        22, 25, 54, 21, 56, 59,  6, 63, 57, 62, 11, 36, 20, 34, 44, 52
    ];

    public static function reQuery(array $query): array {
        $wbi_keys = self::getWbiKeys();
        return self::encodeWbi($query, $wbi_keys['img_key'], $wbi_keys['sub_key']);
    }

    protected static function encodeWbi($params, $img_key, $sub_key): array {
        $mixin_key = self::getMixinKey($img_key . $sub_key);
        $curr_time = time();

        $query = [];
        $params['wts'] = $curr_time;

        ksort($params);
        foreach ($params as $key => $value) {
            $value = preg_replace('/[!\'()*]/', '', (string) $value);
            $query[] = urlencode($key) . '=' . urlencode($value);
        }

        $query = implode('&', $query);
        $wbi_sign = md5($query . $mixin_key);

        return [
            'wts' => $curr_time,
            'w_rid' => $wbi_sign
        ];
    }

    protected static function getWbiKeys(): array {
        $response = (new BilibiliClient(new Config))->request(new WbiSignRequest)->getArray();

        $img_url = $response['data']['wbi_img']['img_url'];
        $sub_url = $response['data']['wbi_img']['sub_url'];

        return [
            'img_key' => substr(basename($img_url), 0, strpos(basename($img_url), '.')),
            'sub_key' => substr(basename($sub_url), 0, strpos(basename($sub_url), '.'))
        ];
    }

    protected static function getMixinKey($orig): string {
        $t = '';
        foreach (self::MIXIN_KEY_ENCODE_TAB as $n) $t .= $orig[$n];
        return substr($t, 0, 32);
    }
}
