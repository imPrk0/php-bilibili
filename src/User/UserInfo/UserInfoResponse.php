<?php
/**
 * 用户信息响应
 * @author Prk<code@imprk.me>
 */

declare(strict_types=1);

namespace Prk\PHPBilibili\User\UserInfo;

use Prk\PHPBilibili\Enums\UserSex;

final class UserInfoResponse {
    /**
     * 构造器
     * @author Prk<code@imprk.me>
     *
     * @param array $data 数据
     */
    public function __construct(array $data = []) {
        if (0 != $data['code'] || '0' != $data['message']) {
            exit('throw'); // TODO 创建不同的错误类型
        }

        $data = $data['data'];
        $this->userId = (string) $data['mid'];
        $this->userName = $data['name'];
        $this->sex = match($data['sex']) {
            '男' => UserSex::Male,
            '女' => UserSex::Female,
            default => UserSex::Unknown // 保密
        };
        $this->avatar = $data['face'];
        $this->avatarNFT = 1 == ((int) $data['face_nft']);
        $this->avatarNFTType = (int) $data['face_nft_type'];
        $this->bio = $data['sign'];
        $this->rank = (int) $data['rank'];
        $this->level = (int) $data['level'];
        $this->registered_at = date('Y-m-d H:i:s', (int) $data['jointime']); // 目前恒定为 0
        $this->moral = (int) $data['moral']; // 目前恒定为 0
        $this->ban = 1 == ((int) $data['silence']);
        $this->coins = (int) $data['coins'];
    }

    ///////////////////////////////////////////////////
    /// 用户 ID
    ///////////////////////////////////////////////////
    protected string $userId;

    /**
     * 获取用户 ID
     * @author Prk<code@imprk.me>
     *
     * @return string 用户 ID
     */
    public function getUserId(): string { return $this->userId; }

    ///////////////////////////////////////////////////
    /// 用户名
    ///////////////////////////////////////////////////
    protected string $userName;

    /**
     * 获取用户名
     * @author Prk<code@imprk.me>
     *
     * @return string 用户名
     */
    public function getUserName(): string { return $this->userName; }

    ///////////////////////////////////////////////////
    /// 性别
    ///////////////////////////////////////////////////
    protected UserSex $sex;

    /**
     * 获取性别
     * @author Prk<code@imprk.me>
     *
     * @return UserSex 性别枚举
     */
    public function getSex(): UserSex { return $this->sex; }

    /**
     * 获取姓名直接名称
     * @author Prk<code@imprk.me>
     *
     * @return string 性别枚举名称
     */
    public function getSexName(): string { return $this->sex->name(); }

    ///////////////////////////////////////////////////
    /// 头像
    ///////////////////////////////////////////////////
    protected string $avatar;
    protected bool $avatarNFT;
    protected int $avatarNFTType;

    /**
     * 获取头像地址
     * @author Prk<code@imprk.me>
     *
     * @return string
     */
    public function getAvatar(): string { return $this->avatar; }

    /**
     * 该头像是不是 NFT 头像
     * @author Prk<code@imprk.me>
     *
     * @return boolean 是不是 NFT 头像
     */
    public function isAvatarNFT(): bool { return $this->avatarNFT; }

    /**
     * 获取头像 NFT 类型
     * @author Prk<code@imprk.me>
     *
     * @return integer 头像 NFT 类型
     */
    public function getAvatarNFTType(): int { return $this->avatarNFTType; }

    ///////////////////////////////////////////////////
    /// 个性签名
    ///////////////////////////////////////////////////
    protected string $bio;

    /**
     * 获取个性签名
     * @author Prk<code@imprk.me>
     *
     * @return string 个性签名
     */
    public function getBio(): string { return $this->bio; }

    ///////////////////////////////////////////////////
    /// 用户权限等级
    ///////////////////////////////////////////////////
    protected int $rank;

    /**
     * 获取用户权限等级
     * @author Prk<code@imprk.me>
     *
     * @return integer 用户权限等级
     */
    public function getRank(): int { return $this->rank; }

    /**
     * 获取用户等级名字
     * @author Prk<code@imprk.me>
     *
     * @return string 用户等级名字
     */
    public function getRankName(): string {
        return match($this->rank) {
            5000 => '未答题',
            10000 => '普通会员',
            20000 => '字幕君',
            25000 => 'VIP',
            30000 => '真·职人',
            32000 => '管理员',
            default => ((string) $this->rank)
        };
    }

    ///////////////////////////////////////////////////
    /// 等级
    ///////////////////////////////////////////////////
    protected int $level;

    /**
     * 获取用户等级 (0-6)
     * @author Prk<code@imprk.me>
     *
     * @return integer 用户等级 (0-6)
     */
    public function getLevel(): int { return $this->level; }

    ///////////////////////////////////////////////////
    /// 注册时间
    ///////////////////////////////////////////////////
    protected string $registered_at; // 注册时间 已格式化

    /**
     * 获取注册时间
     * @author Prk<code@imprk.me>
     *
     * @return string 注册时间 已格式化
     */
    public function getRegisteredAt(): string { return $this->registered_at; }

    ///////////////////////////////////////////////////
    /// 节操
    ///////////////////////////////////////////////////
    protected int $moral; // 节操

    /**
     * 获取节操值 (目前恒定为 0)
     * @author Prk<code@imprk.me>
     *
     * @return integer 节操值 (目前恒定为 0)
     */
    public function getMoral(): int { return $this->moral; }

    ///////////////////////////////////////////////////
    /// 被封禁
    ///////////////////////////////////////////////////
    protected bool $ban; // 被封

    /**
     * 用户是否被封禁
     * @author Prk<code@imprk.me>
     *
     * @return boolean 用户是否被封禁
     */
    public function isBanned(): bool { return $this->ban; }

    ///////////////////////////////////////////////////
    /// 硬币
    ///////////////////////////////////////////////////
    protected int $coins; // 硬币

    /**
     * 获取用户硬币数 (需登录)
     * @author Prk<code@imprk.me>
     *
     * @return integer 硬币数
     */
    public function getCoins(): int { return $this->coins; }
}
