<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>管理员管理系统</title>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- 可选的Bootstrap主题文件（一般不用引入） -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="__PUBLIC__/css/app.css">

    <!--日期选择插件-->
    <link rel="stylesheet" type="text/css" media="all" href="__PUBLIC__/css/daterangepicker-bs3.css" />
    <script type="text/javascript" src="__PUBLIC__/js/moment.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/js/daterangepicker.js"></script>
    <script type="text/javascript" src="__PUBLIC__/js/main.js"></script>
    <script type="text/javascript" src="__PUBLIC__/js/handle.js"></script>
    <script type="text/javascript" src="__PUBLIC__/js/super_handle.js"></script>
    <script type="text/javascript" src="__PUBLIC__/js/checkbox.js"></script>
</head>
<body>
    <!--头部导航条-->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">DingLing</a>
            </div>
        </div>
        <div class="clearfix visible"></div>
    </nav>


    <!--主体内容-->
    <div class="container-fluid">
        <!--左侧功能栏-->
        <div class="row">
            <!--菜单栏-->
            <div class="col-xs-2 sidebar">
                <div class="user-box">
                    <p class="user-name">{$user}</p>
                    <a class="logout-btn" href="__ROOT__/index/logout">注销</a>
                    <div class="clearfix"></div>
                </div>
                <ul class="nav nav-sidebar">
                    <li class="leftBtn"><a href="javascript:void(0)" onclick="selectModule(0)" class="left-btn"><span class="icon-color glyphicon glyphicon-education"></span>&nbsp;&nbsp;学校管理</a></li>
                </ul>
                <ul class="nav nav-sidebar">
                    <li class="leftBtn"><a href="javascript:void(0)" onclick="selectModule(1)"><span class="icon-color glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;订单管理</span><!--<span class="badge">9999</span>--></a></li><!--订水老板版-->
                    <li class="leftBtn"><a href="javascript:void(0)" onclick="selectModule(2)"><span class="icon-color glyphicon glyphicon-user"></span>&nbsp;&nbsp;用户管理</a></li>
                    <li class="leftBtn"><a href="get-qrcode.html" ><span class="icon-color glyphicon glyphicon-qrcode"></span>&nbsp;&nbsp;推广员系统</span></a></li>
                </ul>
                <ul class="nav nav-sidebar">
                    <li class="leftBtn"><a href="javascript:void(0)" onclick="selectModule(3)"><span class="icon-color glyphicon glyphicon glyphicon-stats"></span>&nbsp;&nbsp;数据分析</span></a></li>
                    <li class="leftBtn"><a href="javascript:void(0)" onclick="selectModule(4)"><span class="icon-color glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;反馈信息</span></a></li>
                </ul>
            </div>
        </div>


        <!--学校管理-->
        <div class="row row-content display-none">
            <div class="col-xs-10 main brand-manage ">
                <!--学校设置-->
                <div class="content">
                    <!--学校列表-->
                    <div class="col-xs-2 brand-list">
                        <div class="span-box">
                            <span>学校列表</span>
                        </div>
                        <ul class="nav nav-stacked brand-nav">
                            <?php if(is_array($s_info)) foreach($s_info as $vo){ ?>
                                <li role="presentation"><a href="#" onclick="showSchool({$vo['s_id']}, '{$vo['pic']}', '{$vo['c_id']}@@{$vo['c_name']}')">{$vo['name']}</a></li>
                            <?php } ?>
                        </ul>
                    </div>

                    <!--学校信息详情-->
                    <div class="col-xs-10 col-xs-offset-2 brand-inform-content">
                        <!--学校基本信息-->
                        <div class="brand-basic－inform">
                            <div class="span-inform-box">
                                <span>基本信息</span><button class="btn btn-default btn-sm brand-btn-default">保存</button>
                            </div>
                        </div>
                        <p>学校LOGO</p>
                        <a class="setting-upload-avatar" href="javascript:;">
                            <img src="" id="school_logo" class="setting-upload-preview img-circle"/>
                            <form action="" enctype="multipart/form-data" method="post" id="setting-upload-img-form">
                                <input type="file" class="setting-avatar" value="" name="setting-avatar"/>
                            </form>
                        </a>

                        <!--关联水品牌-->
                        <form class="brand-price-school-form" id="brand-price-school-form">
                            <div class="brand-default-inform">
                                <div class="span-inform-box">
                                    <select class="form-control district-select" id="district-select" onchange="showSchool_brand(2)">
                                        <option></option>
                                    </select>
                                    <div class="school-title-inform-box">
                                        <span>包含的水品牌</span>
                                        <a class="btn btn-primary btn-sm school-btn" onclick="addBrandToSchool()">添加</a><button class="btn btn-default btn-sm school-btn2" onclick="save_shool_brand()">保存</button>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="shool_brand_invisible">
                                <?php if(is_array($b_info)) foreach($b_info as $vo){ ?>
                                    <input type="hidden" value="{$vo['g_id']}@@{$vo['price']}@@{$vo['point']}">
                                <?php } ?>
                            </div>

                            <div class="brand-for-school-item schoool_brand_div">
                                <select class="form-control school_brand" onchange="changeOptions(this)">
                                    <!-- <option selected="true">娃哈1哈</option> -->
                                    <?php if(is_array($b_info)) foreach($b_info as $vo){ ?>
                                        <option value="{$vo['g_id']}">{$vo['g_name']} - {$vo['name']}</option>
                                    <?php } ?>
                                </select>
                                <div class="col-xs-2 price-input">
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" class="form-control moneyBuddle" aria-label="Amount (to the nearest dollar)">
                                        <span class="input-group-addon">元/桶</span>
                                    </div>
                                </div>

                                <div class="col-xs-2 price-input">
                                    <div class="input-group">
                                        <span class="input-group-addon "><span class="glyphicon glyphicon-star"></span></span>
                                        <input type="text" class="form-control pointBuddle" aria-label="Amount (to the nearest dollar)">
                                        <span class="input-group-addon">积分/桶</span>
                                    </div>
                                </div>
                                <input type="hidden" class="shool_brand_id" value="">
                                <a href="javascript:void(0)" class="brand-school-btn-delete" onclick="deleteBrandFromSchool(this)">删除</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>


        <!--订单管理-->
        <div class="row row-content display-none ">
            <div class="col-xs-10 main brand-manage ">
                <!--订单管理-->
                <div class="content content-left-border">
                    <nav class="nav col-xs-12 table-box">
                        <div class="table-control">
                            <form class="form-horizontal">
                                <!--时间-->
                                <div class="calendar-box">
                                    <fieldset>
                                        <div class="control-group">
                                            <div class="controls">
                                                <div class="input-prepend input-group">
                                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input type="text" readonly style="width: 200px" name="reservation" id="reservation-order" class="form-control back-color-w" value="2015-7-25 - 2015-8-18" />
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#reservation-order').daterangepicker(null, function(start, end, label) {
                                                console.log(start.toISOString(), end.toISOString(), label);
                                            });
                                        });
                                    </script>
                                </div>
                                
                                <!--学校-->
                                <select class="form-control" id="super_send_sc" onchange="getDistrictOption('super_send_sc', 'super_send_c')">
                                    <option value="">学校</option>
                                    <?php if(is_array($s_info)) foreach($s_info as $vo){ ?>
                                        <option value="{$vo['s_id']}" label="{$vo['c_id']}@@{$vo['c_name']}">{$vo['name']}</option>
                                    <?php } ?>
                                </select>
                                <!--校区-->
                                <select class="form-control" id="super_send_c">
                                    <option value="">校区</option>
                                        <option value="0">北</option>
                                        <option value="1">南</option>
                                </select>
                                <!--经销商-->
                                <select class="form-control" id="super_send_sell">
                                    <option value="">经销商</option>
                                    <?php if(is_array($a_info)) foreach($a_info as $vo){ ?>
                                        <option value="{$vo['a_id']}">{$vo['sell_name']}</option>
                                    <?php } ?>
                                </select>
                                <!--订单状态-->
                                <select class="form-control" id="super_send_sd">
                                    <option value="">状态</option>
                                    <option value="0">未配送</option>
                                    <option value="1">正在配送</option>
                                    <option value="2">已配送</option>
                                </select>
                                <a class="btn btn-sm table-btn table-check-btn" onclick="check_send_super()">查看</a>
                                <a class="btn btn-sm table-btn table-import-btn" onclick="export_send_super()">导出</a>
                            </form>
                        </div>
                    </nav>

                    <!--表头-->
                    <div class="table-content-box-head">
                        <table class="table table-striped table-head-height">
                            <thead>
                            <tr>
                                <th width="50"><input id="order-admin-ck" type="checkbox" class="checkbox-head" onclick="checkAll('order-admin','order-admin-ck')"/></th>
                                <th width="140">日期</th>
                                <th width="80">用户名</th>
                                <th width="120">手机号</th>
                                <th width="150">学校</th>
                                <th width="90">宿舍号</th>
                                <th width="90">品牌</th>
                                <th width="60">数量</th>
                                <th width="100">结算方式</th>
                                <th>状态</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <!--表格内容-->
                    <iframe id="order-admin" src="" width="100%" height="79%" frameborder=”no” border=”0″ marginwidth=”0″ marginheight=”0″ scrolling="yes" allowtransparency=”yes”></iframe>

                </div>
            </div>
        </div>


        <!--用户管理-->
        <div class="row row-content display-none">
            <div class="col-xs-10 main brand-manage ">
                <!--用户管理-->
                <div class="content content-left-border">
                    <nav class="nav col-xs-12 table-box">
                        <div class="table-control">
                            <form class="form-horizontal">
                                <!--时间-->
                                <div class="calendar-box">
                                    <fieldset>
                                        <div class="control-group">
                                            <div class="controls">
                                                <div class="input-prepend input-group">
                                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input type="text" readonly style="width: 200px" name="reservation" id="reservation-user" class="form-control back-color-w" value="2015-7-25 - 2015-8-18" />
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#reservation-user').daterangepicker(null, function(start, end, label) {
                                                console.log(start.toISOString(), end.toISOString(), label);
                                            });
                                        });
                                    </script>
                                </div>

                                <!--学校-->
                                <select class="form-control" id="user_school" onchange="getDistrictOption('user_school', 'user_school_c')">
                                    <option value="">学校</option>
                                    <?php if(is_array($s_info)) foreach($s_info as $vo){ ?>
                                        <option value="{$vo['s_id']}" label="{$vo['c_id']}@@{$vo['c_name']}">{$vo['name']}</option>
                                    <?php } ?>
                                </select>
                                <!--校区-->
                                <select class="form-control" id="user_school_c">
                                    <option value="">校区</option>
                                        <option value="0">北</option>
                                        <option value="1">南</option>
                                </select>
                                <!--用户状态-->
                                <select class="form-control" id="user_static_c">
                                    <option value="">用户状态－全部</option>
                                    <option value="0">初次关注</option>
                                    <option value="1">重复关注</option>
                                    <option value="2">已取关</option>
                                </select>

                                <a class="btn btn-sm table-btn table-check-btn" onclick="check_user()">查看</a>
                                <!-- <a class="btn btn-sm table-btn table-import-btn">删除</a>
                                <a class="btn btn-sm table-btn table-import-btn">冻结</a> -->
                            </form>
                        </div>
                    </nav>

                    <!--表头-->
                    <div class="table-content-box-head">
                        <table class="table table-striped table-head-height">
                            <thead>
                            <tr>
                                <th width="50"><input id="user-table-ck" type="checkbox" class="checkbox-head" onclick="checkAll('user-table','user-table-ck')"/></th>
                                <th width="140">注册日期</th>
                                <th width="120">用户名</th>
                                <th width="120">手机号</th>
                                <th width="150">学校</th>
                                <th width="90">宿舍号</th>
                                <th width="100">拥有积分</th>
                                <th width="90">状态</th>
                                <th>推荐人</th>
                                <th></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <!--表格内容-->
                    <iframe id="user-table" src="" width="100%" height="79%" frameborder=”no” border=”0″ marginwidth=”0″ marginheight=”0″ scrolling="yes" allowtransparency=”yes”></iframe>
                </div>
            </div>
        </div>

        <!--数据分析-->
        <div class="row row-content display-none">

        </div>

        <!--用户反馈-->
        <div class="row row-content display-none">

        </div>

        <!--推广员管理-->
        <div class="row row-content display-none">

        </div>
    </div>

    <!--模态框-->
    <!--新增品牌-->
    <div id="brand-ntbox" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
            <div class="modal-content add-back">
                <form enctype="text/plain" action="__ROOT__/brand/handleBrand" method="get">
                    <p>新增品牌</p>
                    <input class="form-control" type="text" name="name" />
                    <input type="hidden" name="type" value="add" />
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!--新增订水员-->
    <div id="distribution-ntbox" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
            <div class="modal-content add-back">
                <form enctype="text/plain" action="__ROOT__/send/handleSend" method="get">
                    <p>新增订水员</p>
                    <input class="form-control" type="text" name="name"/>
                     <input type="hidden" name="type" value="add" />
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>