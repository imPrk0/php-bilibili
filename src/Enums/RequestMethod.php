<?php
/**
 * 请求方法枚举
 * @author Prk<code@imprk.me>
 */

namespace Prk\PHPBilibili\Enums;

/**
 * @type string
 */
enum RequestMethod: string {
    case GET = 'GET';
    case POST = 'POST';
    case PUT = 'PUT';
    case DELETE = 'DELETE';

    public function getOptions(array | string | null $data = null): array {
        $postData = (RequestMethod::GET != $this && !empty($data)) ? [
            CURLOPT_POSTFIELDS => $data
        ] : [];

        return match($this) {
            self::GET => [
                CURLOPT_HTTPGET => true,
                CURLOPT_CUSTOMREQUEST => 'GET'
            ],
            self::POST => array_merge([
                CURLOPT_POST => true
            ], $postData),
            self::PUT => array_merge([
                CURLOPT_CUSTOMREQUEST => 'PUT'
            ], $postData),
            self::DELETE => array_merge([
                CURLOPT_CUSTOMREQUEST => 'DELETE'
            ], $postData)
        };
    }
}
