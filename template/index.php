<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>test system</title>
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
                    <p class="user-name">徐曹植</p>
                    <a class="logout-btn" href="#">注销</a>
                    <div class="clearfix"></div>
                </div>
                <ul class="nav nav-sidebar">
                    <li class="leftBtn active"><a href="javascript:void(0)" onclick="selectModule(0)"><span class="icon-color glyphicon glyphicon-heart"></span>&nbsp;&nbsp;品牌管理</span></a></li>
                    <li class="leftBtn"><a href="javascript:void(0)" onclick="selectModule(1)"><span class="icon-color glyphicon glyphicon-user"></span>&nbsp;&nbsp;订水员管理</a></li>
                </ul>
                <ul class="nav nav-sidebar">
<<<<<<< HEAD
                    <li class="leftBtn"><a href="javascript:void(0)" onclick="selectModule(3)"><span class="icon-color glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;订单管理</span><!--<span class="badge">9999</span>--></a></li>
                    <li class="leftBtn"><a href="javascript:void(0)" onclick="selectModule(4)"><span class="icon-color glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;订单管理</span><!--<span class="badge">9999</span>--></a></li><!--订水老板版-->
                    <li class="leftBtn"><a href="javascript:void(0)" onclick="selectModule(5)"><span class="icon-color glyphicon glyphicon-piggy-bank"></span>&nbsp;&nbsp;预定记录</a></li>
                    <li class="leftBtn"><a href="javascript:void(0)" onclick="selectModule(6)"><span class="icon-color glyphicon glyphicon-repeat"></span>&nbsp;&nbsp;空桶管理</a></li>
                    <li class="leftBtn"><a href="javascript:void(0)" onclick="selectModule(7)"><span class="icon-color glyphicon glyphicon-user"></span>&nbsp;&nbsp;用户管理</a></li>
                </ul>
                <ul class="nav nav-sidebar">
                    <li class="leftBtn"><a href="javascript:void(0)" onclick="selectModule(8)"><span class="icon-color glyphicon glyphicon glyphicon-stats"></span>&nbsp;&nbsp;数据分析</span></a></li>
                    <li class="leftBtn"><a href="javascript:void(0)" onclick="selectModule(9)"><span class="icon-color glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;反馈信息</span></a></li>
=======
                    <li class="leftBtn"><a href="javascript:void(0)" onclick="selectModule(2)"><span class="icon-color glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;订单管理</span><!--<span class="badge">9999</span>--></a></li><!--订水老板版-->
                </ul>
                <ul class="nav nav-sidebar">
                    <!-- <li class="leftBtn"><a href="javascript:void(0)" onclick="selectModule(3)"><span class="icon-color glyphicon glyphicon glyphicon-stats"></span>&nbsp;&nbsp;数据分析</span></a></li> -->
>>>>>>> f386109c9a214daf9c3e531a8454df1fea2be1d5
                </ul>
            </div>
        </div>

        <!--品牌管理-->
        <div class="row row-content ">
            <div class="col-xs-10 main brand-manage ">
                <!--品牌设置-->
                <div class="content">
                    <!--品牌列表-->
                    <div class="col-xs-2 brand-list">
                        <div class="span-box">
                            <span>品牌列表</span>
                            <button class="btn btn-primary btn-sm brand-btn" data-toggle="modal" data-target="#brand-ntbox" >添加</button>
                        </div>
                        <ul class="nav nav-stacked brand-nav">
                            <?php if(is_array($g_info)) foreach($g_info as $vo){ ?>
                                <li role="presentation"><a href="#" onclick="showBrand({$vo['g_id']})">{$vo['g_name']}</a><button class="brand-list-btn-delete" onclick="delBrand({$vo['g_id']})">删除</button></li>
                            <?php } ?>
                        </ul>
                    </div>

                    <!--品牌信息详情-->
                    <div class="col-xs-10 col-xs-offset-2 brand-inform-content">
                        <!--品牌基本信息-->
                        <div class="brand-basic－inform">
                            <div class="span-inform-box">
                                <span>基本信息</span><button class="btn btn-default btn-sm brand-btn-default" onclick="save_brand_pic()">保存</button>
                            </div>
                        </div>
                        <p>品牌LOGO</p>
                        <a class="setting-upload-avatar" href="javascript:;">
                            <img src="imgs/brand-logo-default.jpg" class="setting-upload-preview img-circle" id="bandImg" />
                            <form action="__ROOT__/brand/saveBasic_Pic" enctype="multipart/form-data" method="post" id="setting-upload-img-form">
                                <input type="file" class="setting-avatar" value="" name="setting-avatar"/>
                                <input type="hidden" id="pic_id" name="id">
                            </form>
                        </a>

                        <!--品牌定价积分信息-->
                        <div class="brand-default-inform">
                            <div class="span-inform-box">
                                <span>设置默认定价和积分信息</span><button class="btn btn-default btn-sm brand-btn-default" onclick="save_brand_basic()">保存</button>
                            </div>
                        </div>
                        <form class="brand-price-form" enctype="text/plain" action="__ROOT__/brand/saveBasic" method="get" id="form_brand_basic">
                            <input type="hidden" id="basic_id" name="id">
                            <div class="col-xs-2 price-input">
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" id="moneyBarrel" name="moneyBarrel" class="form-control" aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-addon">元/桶</span>
                                </div>
                            </div>

                            <div class="col-xs-2 price-input">
                                <div class="input-group">
                                    <span class="input-group-addon "><span class="glyphicon glyphicon-star"></span></span>
                                    <input type="text" id="pointBarrel" name="pointBarrel" class="form-control " aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-addon">积分/桶</span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--品牌信息详情-->

                </div>
            </div>
        </div>


        <!--订水员管理-->
        <div class="row row-content display-none">
            <div class="col-xs-10 main brand-manage ">
                <!--订水员设置-->
                <div class="content">
                    <!--订水员列表-->
                    <div class="col-xs-2 brand-list">
                        <div class="span-box">
                            <span>订水员列表</span>
                            <button class="btn btn-primary btn-sm brand-btn" data-toggle="modal" data-target="#distribution-ntbox">添加</button>
                        </div>
                        <ul class="nav nav-stacked brand-nav">
                            <?php if(is_array($sd_info)) foreach($sd_info as $vo){ ?>
                                <li role="presentation"><a href="#" onclick="showSend({$vo['send_id']})">{$vo['name']}</a><button class="brand-list-btn-delete" onclick="delSend({$vo['send_id']})">删除</button></li>
                            <?php } ?>
                        </ul>
                    </div>

                    <!--订水员信息详情-->
                    <div class="col-xs-10 col-xs-offset-2 brand-inform-content">
                        <!--工作信息-->
                        <div class="brand-basic－inform">
                            <div class="span-inform-box distribution-title-box">
                                <span>工作信息</span>
                                <!--<button class="btn btn-primary btn-sm school-btn">添加配送学校</button>-->
                                <button class="btn btn-default btn-sm school-btn2" onclick="save_send()">保存</button>
                            </div>
                        </div>
                        <form class="brand-price-school-form-distribution">
                                <ul class="school-inform-box">

                                    <li>
                                        <span>选学校</span>
                                        <select class="form-control" id="send_school">
                                            <?php if(is_array($s_info)) foreach($s_info as $vo){ ?>
                                                <option value="{$vo['s_id']}">{$vo['name']}</option>
                                            <?php } ?>
                                        </select>
                                        <a class="btn btn-primary btn-sm school-btn" onclick="addDorToSchool()">添加宿舍</a>
                                        <!--<a class="btn btn-sm school-btn-red">删除学校</a>--待开发-->
                                        <div class="dormitory-whole-box" id="dormitory-whole-box">
                                            <div class="dormitory-box">
                                                <select class="form-control send_addr" onchange="changeDorOpt(this)">
                                                    <option value="1">1栋</option>
                                                    <option value="2">2栋</option>
                                                    <option value="3">3栋</option>
                                                    <option value="4">4栋</option>
                                                    <option value="5">5栋</option>
                                                    <option value="6">6栋</option>
                                                    <option value="7">7栋</option>
                                                    <option value="8">8栋</option>
                                                    <option value="9">9栋</option>
                                                    <option value="10">10栋</option>
                                                    <option value="11">11栋</option>
                                                    <option value="12">12栋</option>
                                                    <option value="13" selected="true">13栋</option>
                                                    <option value="14">14栋</option>
                                                    <option value="15">15栋</option>
                                                    <option value="16">16栋</option>
                                                    <option value="17">17栋</option>
                                                </select>
                                                <a href="javascript:void(0)" class="brand-school-btn-delete" onclick="delDor(this)">删除</a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>

                                    </li>

                                    <div class="clearfix"></div>
                                </ul>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!--订单管理-订水老板-->
        <div class="row row-content display-none">
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
                                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input type="text" readonly style="width: 200px" name="reservation" id="reservation-boss" class="form-control back-color-w" value="2015-6-21 - 2015-6-29" />
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#reservation-boss').daterangepicker(null, function(start, end, label) {
                                                console.log(start.toISOString(), end.toISOString(), label);
                                            });
                                        });
                                    </script>
                                </div>

                                <!--品牌-->
                                <select class="form-control" id="boss_send_status">
                                    <option value="">状态</option>
                                    <option value="0">未配送</option>
                                    <option value="1">正在配送</option>
                                    <option value="2">已配送</option>
                                </select>
                                <!--学校-->
                                <select class="form-control" id="boss_send_sd">
                                    <option value="">配送员</option>
                                    <?php if(is_array($sd_info)) foreach($sd_info as $vo){ ?>
                                        <option value="{$vo['send_id']}">{$vo['name']}</option>
                                    <?php } ?>
                                </select>
                                <!--订单状态-->
                                <select class="form-control" id="boss_send_sc">
                                    <option value="">学校</option>
                                    <?php if(is_array($s_info)) foreach($s_info as $vo){ ?>
                                        <option value="{$vo['s_id']}">{$vo['name']}</option>
                                    <?php } ?>
                                </select>
                                <select class="form-control" id="boss_send_brand">
                                    <option value="">品牌</option>
                                    <?php if(is_array($g_info)) foreach($g_info as $vo){ ?>
                                        <option value="{$vo['g_id']}">{$vo['g_name']}</option>
                                    <?php } ?>
                                </select>

                                <a class="btn btn-sm table-btn table-check-btn" onclick="check_order_boss()">查看</a>

                                <a class="btn btn-sm table-btn table-import-btn" onclick="del_order_boss()">删除</a>
                                <a class="btn btn-sm table-btn table-import-btn" onclick="finish_order_boss()">完成</a>
                                <a class="btn btn-sm table-btn table-import-btn" onclick="export_order_boss()">导出</a>
                            </form>
                        </div>
                    </nav>

                    <!--表头-->
                    <div class="table-content-box-head">
                        <table class="table table-striped table-head-height">
                            <thead>
                            <tr>
                                <th width="50"><input id="order-boss-ck" type="checkbox" class="checkbox-head" onclick="checkAll('order-boss','order-boss-ck')"/></th>
                                <th width="140">日期</th>
                                <th width="80">用户名</th>
                                <th width="120">手机号</th>
                                <th width="150">学校</th>
                                <th width="80">宿舍号</th>
                                <th width="80">品牌</th>
                                <th width="60">数量</th>
                                <th width="70">送货员</th>
                                <th width="90">结算方式</th>
                                <th>状态</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <!--表格内容-->
                    <iframe id="order-boss" src="__ROOT__/oboss" width="100%" height="79%" frameborder=”no” border=”0″ marginwidth=”0″ marginheight=”0″ scrolling="yes" allowtransparency=”yes”></iframe>
                </div>
            </div>
        </div>

                <!--预定记录-->
                <div class="row row-content display-none ">
                    <div class="col-xs-10 main brand-manage ">
                        <!--预定-->
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
                                                            <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input type="text" readonly style="width: 200px" name="reservation" id="reservation-schedule" class="form-control back-color-w" value="2014-5-21 - 2014-6-21" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    $('#reservation-schedule').daterangepicker(null, function(start, end, label) {
                                                        console.log(start.toISOString(), end.toISOString(), label);
                                                    });
                                                });
                                            </script>
                                        </div>

                                        <!--学校-->
                                        <select class="form-control">
                                            <option>学校</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                        <!--宿舍号-->
                                        <select class="form-control">
                                            <option>宿舍号</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                        <!--订单状态-->
                                        <select class="form-control">
                                            <option>品牌</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                        <a class="btn btn-sm table-btn table-check-btn">查看</a>

                                        <a class="btn btn-sm table-btn table-import-btn">删除</a>
                                        <a class="btn btn-sm table-btn table-import-btn">导出</a>
                                    </form>
                                </div>
                            </nav>

                            <!--表头-->
                            <div class="table-content-box-head">
                                <table class="table table-striped table-head-height">
                                    <thead>
                                    <tr>
                                        <th width="50"><input id="schedule-check" type="checkbox" class="checkbox-head" onclick="checkAll('schedule-tbody','schedule-check')"/></th>
                                        <th width="140">日期</th>
                                        <th width="80">用户名</th>
                                        <th width="120">手机号</th>
                                        <th width="150">学校</th>
                                        <th width="100">宿舍号</th>
                                        <th width="90">品牌</th>
                                        <th width="90">预定数量</th>
                                        <th>剩余数量</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <!--表格内容-->
                            <iframe id="schedule-tbody" src="schedule-tbody.html" width="100%" height="79%" frameborder=”no” border=”0″ marginwidth=”0″ marginheight=”0″ scrolling="yes" allowtransparency=”yes”></iframe>

                            <!--换页按钮-->
                            <div class="page-change-box">
                                <nav>
                                    <ul class="pagination page-btn-box">
                                        <li>
                                            <a href="#" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                        <li><a href="#">6</a></li>
                                        <li><a href="#">7</a></li>
                                        <li><a href="#">8</a></li>
                                        <li><a href="#">9</a></li>
                                        <li><a href="#">10</a></li>
                                        <li>
                                            <a href="#" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <!--空桶管理-->
                <div class="row row-content display-none ">
                    <div class="col-xs-10 main brand-manage ">
                        <!--空桶-->
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
                                                            <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input type="text" readonly style="width: 200px" name="reservation" id="reservation-empty" class="form-control back-color-w" value="2014-5-21 - 2014-6-21" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    $('#reservation-empty').daterangepicker(null, function(start, end, label) {
                                                        console.log(start.toISOString(), end.toISOString(), label);
                                                    });
                                                });
                                            </script>
                                        </div>

                                        <!--学校-->
                                        <select class="form-control">
                                            <option>学校</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                        <!--宿舍号-->
                                        <select class="form-control">
                                            <option>宿舍号</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                        <!--订单状态-->
                                        <select class="form-control">
                                            <option>品牌</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                        <a class="btn btn-sm table-btn table-check-btn">查看</a>

                                        <a class="btn btn-sm table-btn table-import-btn">删除</a>
                                        <a class="btn btn-sm table-btn table-import-btn"  id="empty-button-substitute" disabled="disabled">空桶数修改</a>
                                        <a class="btn btn-sm table-btn table-import-btn" data-toggle="modal" data-target="#empty-change" id="empty-button" style="display: none;">空桶数修改</a>
                                        <a class="btn btn-sm table-btn table-import-btn">导出</a>
                                    </form>
                                </div>
                            </nav>

                            <!--表头-->
                            <div class="table-content-box-head">
                                <table class="table table-striped table-head-height">
                                    <thead>
                                    <tr>
                                        <th width="50"><input id="empty-check" type="checkbox" class="checkbox-head" onclick="checkAll('empty-tbody','empty-check')"/></th>
                                        <th width="140">最近订水时间</th>
                                        <th width="150">学校</th>
                                        <th width="120">宿舍号</th>
                                        <th width="80">用户名</th>
                                        <th width="100">电话</th>
                                        <th>空桶数量</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <!--表格内容-->
                            <iframe id="empty-tbody" src="empty-tbody.html" width="100%" height="79%" frameborder=”no” border=”0″ marginwidth=”0″ marginheight=”0″ scrolling="yes" allowtransparency=”yes”></iframe>

                            <!--换页按钮-->
                            <div class="page-change-box">
                                <nav>
                                    <ul class="pagination page-btn-box">
                                        <li>
                                            <a href="#" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                        <li><a href="#">6</a></li>
                                        <li><a href="#">7</a></li>
                                        <li><a href="#">8</a></li>
                                        <li><a href="#">9</a></li>
                                        <li><a href="#">10</a></li>
                                        <li>
                                            <a href="#" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
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
                                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input type="text" readonly style="width: 200px" name="reservation" id="reservation-user" class="form-control back-color-w" value="2014-5-21 - 2014-6-21" />
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
                                <select class="form-control">
                                    <option value="">学校</option>
                                    <?php if(is_array($s_info)) foreach($s_info as $vo){ ?>
                                        <option value="{$vo['s_id']}">{$vo['name']}</option>
                                    <?php } ?>
                                </select>

                                <!--积分-->
                                <select class="form-control">
                                    <option>积分</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>

                                <!--状态-->
                                <select class="form-control">
                                    <option>状态</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>

                                <a class="btn btn-sm table-btn table-check-btn">查看</a>

                                <a class="btn btn-sm table-btn table-import-btn">删除</a>
                                <a class="btn btn-sm table-btn table-import-btn">冻结</a>
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
                                <th width="80">用户名</th>
                                <th width="120">手机号</th>
                                <th width="150">学校</th>
                                <th width="90">宿舍号</th>
                                <th width="100">拥有积分</th>
                                <th width="90">状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <!--表格内容-->
                    <iframe id="user-table" src="user-form.html" width="100%" height="79%" frameborder=”no” border=”0″ marginwidth=”0″ marginheight=”0″ scrolling="yes" allowtransparency=”yes”></iframe>
                </div>
            </div>
        </div>

        <!--数据分析-->
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