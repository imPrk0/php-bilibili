<?php
/**
 * 用户信息请求
 * @author Prk<code@imprk.me>
 */

declare(strict_types=1);

namespace Prk\PHPBilibili\User\UserInfo;

use Prk\PHPBilibili\{
    Enums\RequestMethod,
    Common\RequestInterface
};

final class UserInfoRequest implements RequestInterface {
    protected string $userId = '';
    protected ?string $referrer;

    /**
     * 构造器
     * @author Prk<code@imprk.me>
     *
     * @param array $data 参数
     */
    public function __construct(array $data = []) {
        foreach (['id', 'mid', 'user_id', 'userId', 'userid', 'uid'] as $key) {
            if (!empty($data[$key])) $this->userId = ((string) $data[$key]);
        }
    }

    /**
     * 设置用户 ID
     * @author Prk<code@imprk.me>
     *
     * @param string | integer $userId 用户 ID
     *
     * @return void 设置完了不返回东西
     */
    public function setUserId(string | int $userId): void {
        // Note: 这样做的目的，是防止 abc 都传进去了
        $this->userId = ((string) ((int) $userId));
    }

    /**
     * 获取用户 ID
     * @author Prk<code@imprk.me>
     *
     * @return string 用户 ID
     */
    public function getUserId(): string {
        return $this->userId;
    }

    /**
     * 设置 Referrer
     * @author Prk<code@imprk.me>
     *
     * @param string $referrer Referrer
     *
     * @return void 设置完了不返回东西
     */
    public function setReferrer(string $referrer): void {
        $this->referrer = $referrer;
    }

    /**
     * 获取请求地址
     * @author Prk<code@imprk.me>
     *
     * @return array 请求地址
     */
    public function getURL(): array {
        return [
            'https://',
            'api.bilibili.com',
            '/x/space/wbi/acc/info'
        ];
    }

    /**
     * 获取请求的方法
     * @author Prk<code@imprk.me>
     *
     * @return RequestMethod 请求的方法
     */
    public function getMethod(): RequestMethod {
        return RequestMethod::GET;
    }

    /**
     * 获取请求的 Query 参数
     * @author Prk<code@imprk.me>
     *
     * @return array | null 请求的 Query 参数
     */
    public function getQuery(): ?array {
        return [
            'mid' => $this->getUserId()
        ];
    }

    /**
     * 获取请求的 Body 参数 (GET 请求无效)
     * @author Prk<code@imprk.me>
     *
     * @return array | string | null 请求的 Body 参数
     */
    public function getBody(): array | string | null {
        return null;
    }

    /**
     * 需要 Wbi 签名
     * @author Prk<code@imprk.me>
     *
     * @return boolean 是否需要 Wbi 签名验证
     */
    public function wbiSign(): bool {
        return true;
    }

    /**
     * 获取 Referrer
     * @author Prk<code@imprk.me>
     *
     * @return string | null Referrer
     */
    public function getReferrer(): ?string {
        return !empty($this->referrer)
            ? $this->referrer
            : 'https://space.bilibili.com/' . $this->userId;
    }
}
