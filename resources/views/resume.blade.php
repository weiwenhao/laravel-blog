<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>简历</title>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #000000;
        }
        .resume h1 {
            /*color: #5bc0de;*/
            color: #337ab7;
            font-weight: bold;
        }
        .resume  h2 {
            color: #337ab7;
        }
        .resume  h3 {
            color: #337ab7;
        }
        .resume  h4 {
            color: #337ab7;
        }
        .resume a {
            color: #51547d;
        }
        .resume > .row > .title {
            background-color: #f5f8fa;
        }
        .resume .body {
            background-color: #fff;
            padding-bottom: 30px;
        }

        .resume > .row > .title .logo img {
            width: 70%;
            border-radius:50%;
            margin: 0 auto;
        }
        .resume > .row > .title .logo {
            margin-top: 25%;
        }

        .resume > .row > .title .info-title {
            margin-top: 4rem;
        }
        .resume > .row > .title .info-body {
            margin-top: 4rem;
        }
        .resume > .row > .title .info-body .row  {
            font-size: 1.2em;
            color: #7d7d7d;
            margin-left: 15px;
            line-height: 2.2em;
        }
        .resume > .row > .title .info-body .row i {
            margin-right: 1em;
            color: #337ab7;
        }

        .resume  .project-content .title {
            font-size: 1.5em;
        }
        .resume .project-content .content {
            margin: 10px 0;
            color: #7d7d7d;
        }

        .resume .skill .content {
            margin: 10px 0;
            color: #7d7d7d;
            line-height: 1.8em;
        }
        .resume .profile p{
            font-size: 2em;
        }

        .erweima > img{
            width: 200px;
        }

    </style>
</head>
<body>
<div class="container resume" id="app">
    <div class="row">
        <div class="col-md-3 col-md-offset-1 title" id="title">
            <br>
            <div class="logo">
                <img src=".//img/wuye.jpeg" alt="" class="img-responsive">
            </div>
            <div class="info-title text-center">
                <div class="my-name">
                    <h1>魏文豪</h1>
                </div>
                <div class="want-work">
                    <h4>求职岗位：php程序开发</h4>
                </div>
            </div>
            <div class="info-body">
                <div class="row">
                    <i class="fa fa-mortar-board"></i>
                    <span>学历：专科/应届毕业生</span>
                </div>
                <div class="row">
                    <i class="fa fa-institution"></i>
                    <span>学院：广东技术师范学院</span>
                </div>
                <div class="row">
                    <i class="fa fa-birthday-cake"></i>
                    <span>生日：1996 .05 .01</span>
                </div>
                <div class="row">
                    <i class="fa fa-map-signs"></i>
                    <span>现居：广东惠州</span>
                </div>
                <div class="row">
                    <i class="fa fa-phone-square"></i>
                    <span>13168065609</span>
                </div>
                <div class="row">
                    <i class="fa fa-envelope"></i>
                    <span>1101140857@qq.com</span>
                </div>
                <div class="row">
                    <i class="fa fa-rss"></i>
                    <span><a href="http://www.weiwenhao.xyz" target="_blank">http://www.weiwenhao.xyz</a></span>
                </div>
                <div class="row">
                    <i class="fa fa-github"></i>
                    <span><a href="https://github.com/weiwenhao" target="_blank">https://github.com/weiwenhao</a></span>
                </div>
            </div>
            <div class="skill-tree">
                <h3 class="page-header">Powerbar</h3>
                <div class="row">
                    <div class="col-md-2">
                        <span>php</span>
                    </div>
                    <div class="col-md-10">
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 95%">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <span>mysql</span>
                    </div>
                    <div class="col-md-10">
                        <div class="progress">
                            <div class="progress-bar progress-bar-info" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 95%">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <span>js</span>
                    </div>
                    <div class="col-md-10">
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <span>linux</span>
                    </div>
                    <div class="col-md-10">
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <span>web</span>
                    </div>
                    <div class="col-md-10">
                        <div class="progress">
                            <div class="progress-bar progress-bar-danger" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 body">
            <br>
            <div class="skill">
                <h3 class="page-header">
                    <i class="fa fa-send"></i> 技能清单
                </h3>
                <div class="row">
                    <div class="col-md-3">
                        <h4>核心：</h4>
                    </div>
                    <div class="col-md-9 content">
                        <p>
                            0. 精通php+mysql <br>
                            1. 具备面向对象的编程思想和mvc架构思想<br>
                            2. 熟练使用laravel、ThinkPHP框架<br>
                            3. 能快速的搭建和调试lnmp线上环境<br>
                            4. 拥有独立开发和解决问题的能力 <br>
                            5. 良好的编码习惯和沟通能力，对计算机编程有着浓厚的兴趣
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h4>web开发相关：</h4>
                    </div>
                    <div class="col-md-9 content">
                        <p>
                            <b>前端：</b>熟练使用 jquery（ajax）、vue.js、bootstrap等前端框架。及良好的js基础，和逻辑思维能力
                            <br>
                            <b>其他：</b>熟悉linux，redis缓存， git版本控制，mysql优化，页面静态化等web开发必备技术。
                        </p>
                    </div>
                </div>
            </div>
            <div class="project">
                <h3 class="page-header"><i class="fa fa-rocket"></i> 项目经验</h3>
                <div class="project-content">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="title">
                                <span>2016.11.30 ~ 12.28</span>
                            </div>
                            <div class="project-name">
                                <h4>仿京东商城</h4>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="title">
                                基于ThinkPHP3.2的电商项目
                            </div>
                            <div class="content">
                                <p>
                                    完成了商品模块、商品属性（难点）、库存、购物车、订单、商品筛选（难点）、RABC、spinx全文索引、阿里支付api等主要功能。
                                </p>
                                <p>
                                    使用了页面静态化，redis缓存，jquery，ajax等web开发相关技术。
                                </p>
                                <p>
                                    Demo地址： <a href="http://shop.weiwenhao.xyz" target="_blank">http://shop.weiwenhao.xyz</a>
                                    <br>后台地址：<a href="http://shop.weiwenhao.xyz/admin" target="_blank">http://shop.weiwenhao.xyz/admin</a>
                                    <br>管理员账号:root 密码:root
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="title">
                                <span>2017.2.22 ~ 3.6</span>
                            </div>
                            <div class="project-name">
                                <h4>个人博客</h4>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="title">
                                基于laravel框架的个人博客（开源）
                            </div>
                            <div class="content">
                                <p>
                                    经过对laravel框架，bootstrap框架，vue等相关知识学习和理解后做的一个总结性项目。
                                </p>
                                <p>
                                    博客地址：<a href="http://www.weiwenhao.xyz" target="_blank">http://www.weiwenhao.xyz</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="title">
                                <span>2017.4.21 ~ 5.22</span>
                            </div>
                            <div class="project-name">
                                <h4>校园商城</h4>
                            </div>
                            <div class="erweima">
                                <img src="/img/erweima.jpg" alt="" class="img-responsive">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="title">
                                基于laravel的校园商城
                            </div>
                            <div class="content">
                                <p>
                                    时隔4个月后再次着手进行的电商项目。个人负责php和js部分，以及对整体的把控。
                                </p>
                                <p>
                                    商城已公众号为入口，使用了微信网页授权，其中校园圈子部分采用了当下流行的vue.js前端框架。
                                    <br>
                                    在本次的项目开发中，基本上没有什么技术上的难题，即使有也具备了快速解决问题的能力。
                                    但整体的架构设计上确实遇到了些麻烦，在解决的过程中充分认识到了，一个好的结构设计，编码规范，可以减少大量的工作时间，
                                    对项目的长期维护，重构都至关重要。
                                </p>
                                <p>
                                    前台demo，请使用微信扫左侧二维码查看
                                    <br>
                                    后台demo地址：<a href="http://wechat.weiwenhao.xyz/admin" target="_blank">http://wechat.weiwenhao.xyz/admin</a>
                                    <br>
                                    超级管理员账号 1101140857@qq.com 密码 123456

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h4>其他</h4>
                        </div>
                        <div class="col-md-8">
                            <div class="content">
                                目前正在制作一个论坛（开源），特点是采用了前后端分离（考虑重构为spa单页应用）。laravel进行api的编写，前端采用vue.js和bootstrap。
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="profile">
                <h3 class="page-header"><i class="fa fa-heartbeat"></i> 自我评价</h3>
                <p class="text-center">
                    现在的我，就是我最想活成的样子。
                </p>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    $(window).resize(setHeight);
    function setHeight() {
        if($(window).width() > 970){
            $("#title").css('height', $(".body").outerHeight(true));
        }else {
            $("#title").css('height', '');
        }
    }
    setHeight();
</script>
</body>
</html>