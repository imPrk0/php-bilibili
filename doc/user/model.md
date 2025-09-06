# 用户模型 {#title}

| 参数名 | 说明 | 类型 | 示例 |
| :---: | :---: | :---: | :---: |
| `id` | 用户 UID | Integer | `1` |
| `name` | 用户名 <br />_哔哩哔哩弹幕网用户名唯一_ | String | `陈睿` |
| `sex` | 用户性别<br />`男`&nbsp;/&nbsp;`女`&nbsp;/&nbsp;`保密` | String | `女` |
| `avatar` | 用户头像 | String | |
| `avatar_nft` | 用户头像是否为&nbsp;NFT&nbsp;头像 | Boolean | |
| `avatar_nft_type` | 用户头像&nbsp;NFT&nbsp;类型<br />_具体尚不明确_ | Integer | |
| `bio` | 用户简介 | String | `我，陈睿，是 Bilibili 最美的舞间` |
| `level` | 等级，0-6 | Integer | |
| `registered_at` | 注册时间，**已废弃**<br />_恒定为&nbsp;0_ | Integer | |
| `moral` | 节操，已废弃，恒定为 0 | Integer | |
| `coins` | 硬币数 | Integer | |
| `fans_badge` | 是否拥有粉丝勋章 | Boolean | |
