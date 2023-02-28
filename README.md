# docker-navigation-pane

适用于docker的简单导航页，MIT开源，随意二开，后端基于 ThinkPHP6，前端基于Antd Vue Admin

# 目录结构

* backend-thinkphp6
     * 后端接口，基于ThinkPHP6
     * 文档地址：[https://www.kancloud.cn/manual/thinkphp6_0/1037481](https://www.kancloud.cn/manual/thinkphp6_0/1037481)
* frontend-vue-antd-admin
    * 前端管理后台，基于 Vue Antd Admin
    * 文档地址：[https://iczer.gitee.io/vue-antd-admin-docs/start/use.html](https://iczer.gitee.io/vue-antd-admin-docs/start/use.html)

# 技术架构

* backend-thinkphp6
    * 整体架构：[thinkphp6](https://www.kancloud.cn/manual/thinkphp6_0/1037481)
    * 主要三方包清单：
        * [hg/apidoc](https://hg-code.gitee.io/apidoc-php/) - 文档服务
        * [firebase/php-jwt](https://github.com/firebase/php-jwt) - JWT服务


* frontend-vue-antd-admin
    * 整体框架：[vue-antd-admin](https://iczer.gitee.io/vue-antd-admin-docs/)
    * 主要三方包清单：
        * [vue-antd-vue](https://1x.antdv.com/docs/vue/introduce-cn/) - UI框架
        * [vue@2](https://v2.cn.vuejs.org/) - 核心框架
        * [vuex@3](https://v3.vuex.vuejs.org/zh/) - 状态管理
        * [vue-router@3](https://v3.router.vuejs.org/zh/) - 路由
        * [axios](https://axios-http.com/zh/docs/intro) - 网络请求
        * [momentjs](http://momentjs.cn/) - 日期格式化