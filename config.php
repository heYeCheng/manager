<?php
//网站全局配置
//在这里配置你所需的参数(与CanPHP无关)
$config['ver']='2.0.2012.1203';//版本号,2.0.2012.1203表示发布日期

//网站全局配置结束

//日志和错误调试配置
$config['DEBUG']=true;	//是否开启调试模式，true开启，false关闭
$config['LOG_ON']=true;//是否开启出错信息保存到文件，true开启，false不开启
$config['LOG_PATH']='./data/log/';//出错信息存放的目录，出错信息以天为单位存放，一般不需要修改
$config['ERROR_URL']='';//出错信息重定向页面，为空采用默认的出错页面，一般不需要修改
//日志和错误调试配置结束

//应用配置
		//网址配置
$config['URL_REWRITE_ON']=true;//是否开启重写，true开启重写,false关闭重写
$config['URL_MODULE_DEPR']='/';//模块分隔符，一般不需要修改
$config['URL_ACTION_DEPR']='-';//操作分隔符，一般不需要修改
$config['URL_PARAM_DEPR']='-';//参数分隔符，一般不需要修改
$config['URL_HTML_SUFFIX']='.html';//伪静态后缀设置，，例如 .html ，一般不需要修改
		
		//模块配置
$config['MODULE_PATH']='./module/';//模块存放目录，一般不需要修改
$config['MODULE_SUFFIX']='Mod.class.php';//模块后缀，一般不需要修改
$config['MODULE_INIT']='init.php';//初始程序，一般不需要修改
$config['MODULE_DEFAULT']='index';//默认模块，一般不需要修改
$config['MODULE_EMPTY']='empty';//空模块	，一般不需要修改	
		
		//操作配置
$config['ACTION_DEFAULT']='index';//默认操作，一般不需要修改
$config['ACTION_EMPTY']='_empty';//空操作，一般不需要修改

		//静态页面缓存
$config['HTML_CACHE_ON']=false;//是否开启静态页面缓存，true开启.false关闭
$config['HTML_CACHE_PATH']='./data/html_cache/';//静态页面缓存目录，一般不需要修改
$config['HTML_CACHE_SUFFIX']='.html';//静态页面缓存后缀，一般不需要修改
$config['HTML_CACHE_RULE']['index']['index']=1000;//缓存时间,单位：秒
/*
缓存规则如下，可创建多条规则
$config['HTML_CACHE_RULE']['模块名']['操作名']=缓存时间;//单位：秒,可创建多条数据
$config['HTML_CACHE_RULE']['模块名1']['操作名1']=缓存时间;
$config['HTML_CACHE_RULE']['模块名1']['操作名2']=缓存时间;
$config['HTML_CACHE_RULE']['模块名2']['操作名1']=缓存时间;
$config['HTML_CACHE_RULE']['模块名2']['操作名2']=缓存时间;
*/
//应用配置结束

//数据库配置
$config['DB_TYPE']='mysql';//数据库类型，一般不需要修改
$config['DB_HOST']='127.0.0.1';//数据库主机，一般不需要修改
$config['DB_USER']='caozhi';//数据库用户名
$config['DB_PWD']='root';//数据库密码
$config['DB_PORT']=3306;//数据库端口，mysql默认是3306，一般不需要修改
$config['DB_NAME']='cheetah';//数据库名
$config['DB_CHARSET']='utf8';//数据库编码，一般不需要修改
$config['DB_PREFIX']='';//数据库前缀
$config['DB_PCONNECT']=false;//true表示使用永久连接，false表示不适用永久连接，一般不使用永久连接

$config['DB_CACHE_ON']=false;//是否开启数据库缓存，true开启，false不开启
$config['DB_CACHE_PATH']='./data/db_cache/';//数据库查询内容缓存目录，地址相对于入口文件，一般不需要修改
$config['DB_CACHE_TIME']=600;//缓存时间,0不缓存，-1永久缓存
$config['DB_CACHE_CHECK']=true;//是否对缓存进行校验，一般不需要修改
$config['DB_CACHE_FILE']='cachedata';//缓存的数据文件名
$config['DB_CACHE_SIZE']='15M';//预设的缓存大小，最小为10M，最大为1G
$config['DB_CACHE_FLOCK']=true;//是否存在文件锁，设置为false，将模拟文件锁，一般不需要修改
//数据库配置结束

//redis配置
$config['RD_HOST']='127.0.0.1';//redis host
$config['RD_PORT']=6379;//redis host
$config['RD_PWD']='';
//redis配置

//模板配置
$config['TPL_TEMPLATE_PATH']='./template/';//模板目录，一般不需要修改
$config['TPL_TEMPLATE_SUFFIX']='.php';//模板后缀，一般不需要修改
$config['TPL_CACHE_ON']=false;//是否开启模板缓存，true开启,false不开启
$config['TPL_CACHE_PATH']='./data/tpl_cache/';//模板缓存目录，一般不需要修改
$config['TPL_CACHE_SUFFIX']='.php';//模板缓存后缀,一般不需要修改
//模板配置结束

//权限认证配置 
$config['AUTH_LOGIN_URL']='http://127.0.0.1/trunk/admin/index.php/index/login';//登录地址 
$config['AUTH_LOGIN_NO']=array('index'=> array('login','verify'),'common'=>'*');//不需要认证的模块和操作 
$config['AUTH_SESSION_PREFIX']='auth_';//认证session前缀 
$config['AUTH_POWER_CACHE']=false;//是否缓存权限信息，如果设置为false，每次都需要从数据库读取数据 
$config['AUTH_TABLE']=array(                          
   'group'=>array(                             
            'name'=>'group',                                     
			'field'=>array('id'=>'id','power'=>'power_value'),                               
	),                             
   'resource'=>array(       
            'name'=>'resource',
            'field'=>array('id'=>'id','pid'=>'pid','operate'=>'operate'),
	),                             
);//数据库表和字段映射     
//权限认证配置结束


//邮件发送配置 
$config['SMTP_HOST']='smtp.qq.com';//smtp服务器地址 
$config['SMTP_PORT']=25;//smtp服务器端口 
$config['SMTP_SSL']=false;//是否启用SSL安全连接，gmail需要启用sll安全连接 
$config['SMTP_USERNAME']='ygo2046@qq.com';//smtp服务器帐号，如：你的qq邮箱 
$config['SMTP_PASSWORD']='saigame590351';//smtp服务器帐号密码，如你的qq邮箱密码 
$config['SMTP_AUTH']=true;//启用SMTP验证功能，一般需要开启 
$config['SMTP_CHARSET']='utf-8';//发送的邮件内容编码 
$config['SMTP_FROM_TO']='ygo2046@qq.com';//发件人邮件地址 
$config['SMTP_FROM_NAME']='阿cake';//发件人姓名 
$config['SMTP_DEBUG']=false;//是否显示调试信息 
//邮件发送配置结束


//数据表配置
$config['goods']='`goods`';  //产品
$config['goods_type']='`goods_type`';  //产品类别
$config['info_person']='`info_person`';  //个人信息
$config['order']='`order`';  //订单
$config['order_detail']='`order_detail`';  //订单详情
$config['rank_water']='`rank_water`';  // 订水排名，此排名是按订水量进行排名，不涉及具体用户排名
$config['collect_water']='`collect_water`';  // 订水统计，用于收集具体用户的订水统计情况
$config['school']='`school`';  //学校
$config['admin']='`admin`';  //管理员信息
$config['send']='`send`';  //配送员信息
//数据表配置

//微信公众号
$config['USER'] = '1915943457@qq.com';
$config['PWD'] = 'zhuobin19911017';
$config['AppID'] = 'wx3eadc3ccafa2edcf';
$config['AppSecret'] = '8990d4ac28cffb18fb9038246bad5e89';
//微信公众号

define('EX_TIME_COOKIE', 28800*20); // 8 个小时

?>

