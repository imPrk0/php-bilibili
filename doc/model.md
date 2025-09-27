# 模型化 {#title}

[**作者**](https://imprk.me)&nbsp;个人是个&nbsp;[**Laravel**](https://laravel.com)&nbsp;爱好者，平时也喜欢用&nbsp;[**Eloquent&nbsp;ORM**](https://laravel.com/docs/eloquent)&nbsp;来操作数据库。发现将所有的类和数据库做模型映射是十分优雅的！

因此！本库从建立之初决定采用相同设计规范化每一处细节！如果你是&nbsp;[**Laravel**](https://laravel.com)&nbsp;的用户，使用起来会更加得心应手！


::: tip 统一命名规范

所有资产模型统一使用&nbsp;`id`&nbsp;作为资产主要&nbsp;ID&nbsp;名称，而非使用诸如&nbsp;`mid`&nbsp;/&nbsp;`uid`&nbsp;/&nbsp;`sid`&nbsp;等名称。

与此同时，本库将规范一切命名设计，比如：

- 用户模型的头像，`face`&nbsp;->&nbsp;`avatar`
- 用户模型的昵称，`sign`&nbsp;->&nbsp;`bio`
- ...&nbsp;...

具体模型及对应参数详见对应文档。

---

这样设计的好处是如果哔哩哔哩弹幕网修改相关回调参数或不同接口参数名或参数类型不一致时，本库将自动纠正并映射到模型，以便于统一

:::
