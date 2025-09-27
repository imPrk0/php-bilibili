<?php
/**
 * 用户信息
 * @author Prk<code@imprk.me>
 */

declare(strict_types=1);

namespace Prk\PHPBilibili\User;

use Prk\PHPBilibili\BilibiliClient;
use Prk\PHPBilibili\User\UserInfo\{
    UserInfoRequest,
    UserInfoResponse
};

final class UserInfo {
    public function __construct(
        public BilibiliClient $client,
        public UserInfoRequest $request
    ) {}

    public function request(): UserInfoResponse {
        $request = $this->client->request($this->request);
        return new UserInfoResponse($request->getArray());
    }
}
