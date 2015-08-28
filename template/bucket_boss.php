<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>预定表格</title>
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
    <script src="__PUBLIC__/js/main.js"></script>
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
                        <input type="hidden" value="{$vo['status']}">
                        <td width="50"><input type="checkbox" class="checkbox-tbody" value="{$vo['id']}" onclick="oneCheck()"/></td>
                        <td width="180">{$vo['update_time']}</td>
                        <td width="150">{$vo['s_name']}</td>
                        <td width="120">{$vo['addr']}</td>
                        <td width="100" class="static-red">{$vo['wait_recyle']}</td>
                        <td class="static-gray"></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
<div>{$page}</div>

<script type="text/javascript">
(function() {
    $('tbody tr').each(function(){
        val = $(this).find('input').val()
        if (val == 0) {
            $(this).find('td:eq(5)').html('没回收')
        }else if (val == 1) {
            $(this).find('td:eq(5)').attr('class', 'static-blue')
            $(this).find('td:eq(5)').html('正在回收')
        }
    });
})(jQuery)
</script>
</body>
</html>