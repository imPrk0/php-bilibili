<?php
/**
 * 网络请求响应实现类
 * @author Prk<code@imprk.me>
 */

declare(strict_types=1);

namespace Prk\PHPBilibili\Common;

use Prk\PHPBilibili\Exception\Http\ResponseNotArray;

final class HttpResponse {
    protected string $body;

    protected int $status;

    public function __construct(string $body, int $status) {
        $this->body = $body;
        $this->status = $status;
    }

    /**
     * 获取响应字符串内容
     * @author Prk<code@imprk.me>
     *
     * @return string 返回响应内容
     */
    public function getBody(): string {
        return $this->body;
    }

    /**
     * 获取响应状态码
     * @author Prk<code@imprk.me>
     *
     * @return integer 返回响应状态码
     */
    public function getStatus(): int {
        return $this->status;
    }

    /**
     * 获取数组类型内容
     * @author Prk<code@imprk.me>
     *
     * @return array 返回响应内容数组
     * @throws ResponseNotArray 当响应内容无法转换为数组时抛出
     */
    public function getArray(): array {
        $data = json_decode($this->body, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new ResponseNotArray('响应内容无法转换为数组: ' . json_last_error_msg() . PHP_EOL . $this->body);
        }

        return $data;
    }
}
