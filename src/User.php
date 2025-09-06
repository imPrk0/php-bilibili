<?php

namespace Prk\PHPBilibili;

use Prk\PHPBilibili\Common\BaseModel;

/**
 * @property integer $id 用户 UID
 * @property string $name 用户名 (哔哩哔哩弹幕网用户名唯一)
 * @property string $sex 用户性别 男 / 女 / 保密 | TODO 未来我想要升级到 8.1 使用 Enum 枚举
 * @property string $avatar 用户头像
 * @property boolean $avatar_nft 用户头像是否为 NFT 头像
 * @property integer $avatar_nft_type 用户头像 NFT 类型，具体尚不明确
 * @property string $bio 用户简介
 * @property integer $level 等级，0-6
 * @property integer $registered_at 注册时间，已废弃，恒定为 0
 * @property integer $moral 节操，已废弃，恒定为 0
 * @property integer $coins 硬币数
 * @property boolean $fans_badge 是否拥有粉丝勋章
 */
final class User extends BaseModel {
    protected array $aliases = [
        'mid' => 'id',
        'face' => 'avatar',
        'face_nft' => 'avatar_nft',
        'face_nft_type' => 'avatar_nft_type',
        'sign' => 'bio',
        'jointime' => 'registered_at',
        'silence' => 'banned'
    ];

    protected array $casts = [
        'id' => 'integer',
        'avatar_nft' => 'boolean',
        'avatar_nft_type' => 'integer',
        'rank' => 'integer',
        'level' => 'integer',
        'registered_at' => 'integer',
        'moral' => 'integer',
        'banned' => 'boolean',
        'coins' => 'integer',
        'fans_badge' => 'boolean'
    ];

    /**
     * 获取用户信息
     * @author Prk<code@imprk.me>
     *
     * @param integer $uid 用户 ID
     *
     * @return array
     */
    public static function find(int $uid): array {
        $client = new BilibiliClient;
        $client->url = 'https://api.bilibili.com/x/space/wbi/acc/info';
        $client->referer = 'https://space.bilibili.com/' . $uid;

        $response = $client->get(['mid' => $uid]);
        return $response->getArray();
    }

    public function rankName(): string {
        return match($this->rank) {
            5000 => '未转正', // 0 级未答题用户
            10000 => '普通会员', // 普通会员
            20000 => '字幕君',
            25000 => 'VIP',
            30000 => '真·职人',
            32000 => '管理员'
        };
    }
}
