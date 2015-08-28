<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>订单表格</title>
    <title>test system</title>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- 可选的Bootstrap主题文件（一般不用引入） -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="__PUBLIC__/css/iframe-table.css">
</head>

<body>
<div class="row">
    <div class="col-xs-12 main brand-manage ">
        <form>
            <!--表身-->
            <div class="table-content-box-body">
                <table class="table table-striped table-tbody">
                    <tbody>
                    <?php if(is_array($o_info)) foreach($o_info as $vo){ ?>
                    <tr>
                        <td width="50"><input type="checkbox" class="checkbox-tbody"/></td>
                        <td width="140">{$vo['update_time']}</td>
                        <td width="80">{$vo['name']}</td>
                        <td width="120">{$vo['phone']}</td>
                        <td width="150">{$vo['s_name']}-{$vo['c_name']}</td>
                        <td width="100">{$vo['addr']}</td>
                        <td width="90">{$vo['g_name']}</td>
                        <td width="90">{$vo['pre_num']}</td>
                        <td class="static-red">{$vo['left_num']}</td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
<div>{$page}</div>

</body>
</html>