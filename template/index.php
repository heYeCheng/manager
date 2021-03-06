<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>后台管理系统</title>
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
                    <p class="user-name">{$user}</p>
                    <a class="logout-btn" href="__ROOT__/index/logout">注销</a>
                    <div class="clearfix"></div>
                </div>
                <ul class="nav nav-sidebar">
                    <li class="leftBtn active"><a href="javascript:void(0)" onclick="selectModule(0)"><span class="icon-color glyphicon glyphicon-heart"></span>&nbsp;&nbsp;品牌管理</span></a></li>
                    <li class="leftBtn"><a href="javascript:void(0)" onclick="selectModule(1)"><span class="icon-color glyphicon glyphicon-user"></span>&nbsp;&nbsp;订水员管理</a></li>
                </ul>
                <ul class="nav nav-sidebar">
                    <li class="leftBtn"><a href="javascript:void(0)" onclick="selectModule(2)"><span class="icon-color glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;订单管理</span><!--<span class="badge">9999</span>--></a></li><!--订水老板版-->
                    <li class="leftBtn"><a href="javascript:void(0)" onclick="selectModule(3)"><span class="icon-color glyphicon glyphicon-piggy-bank"></span>&nbsp;&nbsp;预定记录</a></li>
                    <li class="leftBtn"><a href="javascript:void(0)" onclick="selectModule(4)"><span class="icon-color glyphicon glyphicon-repeat"></span>&nbsp;&nbsp;空桶管理</a></li>
                </ul>
                <ul class="nav nav-sidebar">
                    <!-- <li class="leftBtn"><a href="javascript:void(0)" onclick="selectModule(3)"><span class="icon-color glyphicon glyphicon glyphicon-stats"></span>&nbsp;&nbsp;数据分析</span></a></li> -->
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
                                        <select class="form-control" id="send_school" onchange="getDistrictOption('send_school', 'send_school_c')">
                                            <?php if(is_array($s_info)) foreach($s_info as $vo){ ?>
                                                <option value="{$vo['s_id']}" label="{$vo['c_id']}@@{$vo['c_name']}">{$vo['name']}</option>
                                            <?php } ?>
                                        </select>
                                        <a class="btn btn-primary btn-sm school-btn" onclick="addDorToSchool()">添加宿舍</a>
                                        <a class="btn btn-sm school-btn-red" onclick="resetDor()">重置选项</a>
                                        <div class="district-box">
                                            <select class="form-control" id="send_school_c">
                                                <option>东校区</option>
                                                <option>南校区</option>
                                            </select>
                                            <div class="clear"></div>
                                        </div>
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
                                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input type="text" readonly style="width: 200px" name="reservation" id="reservation-boss" class="form-control back-color-w" value="2015-7-25 - 2015-8-8" />
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

                                <!--订单状态-->
                                <select class="form-control" id="boss_send_status">
                                    <option value="">状态</option>
                                    <option value="0">未配送</option>
                                    <option value="1">正在配送</option>
                                    <option value="2">已配送</option>
                                </select>
                                <!--送水员-->
                                <select class="form-control" id="boss_send_sd">
                                    <option value="">配送员</option>
                                    <?php if(is_array($sd_info)) foreach($sd_info as $vo){ ?>
                                        <option value="{$vo['send_id']}">{$vo['name']}</option>
                                    <?php } ?>
                                </select>
                                <!--学校-->
                                <select class="form-control" id="boss_send_sc" onchange="getDistrictOption('boss_send_sc', 'boss_send_c')">
                                    <option value="">学校</option>
                                    <?php if(is_array($s_info)) foreach($s_info as $vo){ ?>
                                        <option value="{$vo['s_id']}" label="{$vo['c_id']}@@{$vo['c_name']}">{$vo['name']}</option>
                                    <?php } ?>
                                </select>
                                <!--校区-->
                                <select class="form-control" id="boss_send_c">
                                    <option value="">校区</option>
                                        <option value="0">北</option>
                                        <option value="1">南</option>
                                </select>
                                <!--品牌-->
                                <select class="form-control" id="boss_send_brand">
                                    <option value="">品牌</option>
                                    <?php if(is_array($g_info)) foreach($g_info as $vo){ ?>
                                        <option value="{$vo['g_id']}">{$vo['g_name']}</option>
                                    <?php } ?>
                                </select>

                                <a class="btn btn-sm table-btn table-check-btn" onclick="check_order_boss()">查看</a>
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
                                <th>
                                    <a class="btn btn-sm table-btn table-import-btn th-btn" onclick="del_order_boss()">删除</a>
                                    <a class="btn btn-sm table-btn table-import-btn th-btn" onclick="finish_order_boss()">完成</a>
                                </th>
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
                                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input type="text" readonly style="width: 200px" name="reservation" id="reservation-schedule" class="form-control back-color-w" value="2015-7-25 - 2015-8-8" />
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
                                <select class="form-control" id="boss_pre_sc" onchange="getDistrictOption('boss_pre_sc', 'boss_pre_c')">
                                    <option value="">学校</option>
                                    <?php if(is_array($s_info)) foreach($s_info as $vo){ ?>
                                        <option value="{$vo['s_id']}" label="{$vo['c_id']}@@{$vo['c_name']}">{$vo['name']}</option>
                                    <?php } ?>
                                </select>
                                <!--校区-->
                                <select class="form-control" id="boss_pre_c">
                                    <option value="">校区</option>
                                        <option value="0">北</option>
                                        <option value="1">南</option>
                                </select>
                                <!--品牌-->
                                <select class="form-control" id="boss_pre_brand">
                                    <option value="">品牌</option>
                                    <?php if(is_array($g_info)) foreach($g_info as $vo){ ?>
                                        <option value="{$vo['g_id']}">{$vo['g_name']}</option>
                                    <?php } ?>
                                </select>
                                <a class="btn btn-sm table-btn table-check-btn" onclick="check_order_pre()">查看</a>
                                <a class="btn btn-sm table-btn table-import-btn" onclick="del_order_pre()">删除</a>
                                <a class="btn btn-sm table-btn table-import-btn" onclick="export_order_pre()">导出</a>
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
                    <iframe id="schedule-tbody" src="__ROOT__/oboss_pre" width="100%" height="79%" frameborder=”no” border=”0″ marginwidth=”0″ marginheight=”0″ scrolling="yes" allowtransparency=”yes”></iframe>
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
                                <!--学校-->
                                <select class="form-control" id="bucket_sc" onchange="getDistrictOption('bucket_sc', 'bucket_c')">
                                    <option value="">学校</option>
                                    <?php if(is_array($s_info)) foreach($s_info as $vo){ ?>
                                        <option value="{$vo['s_id']}" label="{$vo['c_id']}@@{$vo['c_name']}">{$vo['name']}</option>
                                    <?php } ?>
                                </select>
                                <!--校区-->
                                <select class="form-control" id="bucket_c">
                                    <option value="">校区</option>
                                        <option value="0">北</option>
                                        <option value="1">南</option>
                                </select>
                                <!--宿舍号--> 
                                <select class="form-control" id="bucket_addr">
                                    <option value="">宿舍号</option>
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
                                    <option value="13">13栋</option>
                                    <option value="14">14栋</option>
                                    <option value="15">15栋</option>
                                    <option value="16">16栋</option>
                                    <option value="17">17栋</option>
                                </select>
                                
                                <a class="btn btn-sm table-btn table-check-btn" onclick="mark_bucket()">回收完成</a>
                                <a class="btn btn-sm table-btn table-check-btn" onclick="check_bucket()">查看</a>
                                <!-- <a class="btn btn-sm table-btn table-import-btn">删除</a> -->
                                <a class="btn btn-sm table-btn table-import-btn" onclick="export_bucket()">导出</a>
                            </form>
                        </div>
                    </nav>

                    <!--表头-->
                    <div class="table-content-box-head">
                        <table class="table table-striped table-head-height">
                            <thead>
                            <tr>
                                <th width="50"><input id="empty-check" type="checkbox" class="checkbox-head" onclick="checkAll('empty-tbody','empty-check')"/></th>
                                <th width="180">最近订水时间</th>
                                <th width="150">学校</th>
                                <th width="120">宿舍号</th>
                                <th width="100">空桶数量</th>
                                <th>回收状态</th>
                                <th>
                                    <a class="btn btn-sm table-btn table-import-btn th-btn"  id="empty-button-substitute" disabled="disabled">空桶数修改</a>
                                    <a class="btn btn-sm table-btn table-import-btn th-btn" data-toggle="modal" data-target="#empty-change" id="empty-button" style="display: none;">空桶数修改</a>
                                </th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <!--表格内容-->
                    <iframe id="empty-tbody" src="__ROOT__/oboss_bucket" width="100%" height="79%" frameborder=”no” border=”0″ marginwidth=”0″ marginheight=”0″ scrolling="yes" allowtransparency=”yes”></iframe>
                </div>
            </div>
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

    <!--空桶数量变更-->
    <div id="empty-change" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
            <div class="modal-content add-back">
                <form>
                    <p>剩余空桶数量</p>
                    <input class="form-control" id="left_bucket" type="text"/>
                    <button type="button" class="btn btn-default" onclick="change_bucket()">确定</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>