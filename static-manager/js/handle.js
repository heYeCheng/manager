(function() {
	cur_brand_id = 0;  //当前选择的 品牌 id
	cur_school_id = 0; //当前选择的学校 id
	cur_send_id = 0; //当前选择的送水员
	cur_school_pic = ''; //当前选择的学校 logo
	admin_json = '';  // 存储 json 经销商信息

	init()
})(jQuery)

function init(){
	$.getJSON("./brand/get_admin_info", function(data) {
		admin_json = data
	}); 
}

/////////////// 以下是关于 品牌管理 模块
// 获取该品牌的详细信息，并进行赋值
function showBrand(id) {
	cur_brand_id = id
	$.getJSON("./brand/handleBrand?type=show&id=" + id, function(data) {
		$('#bandImg').attr('src', '../public/' + data['pic']);  
		$('#moneyBarrel').val(data['price']);
		$('#pointBarrel').val(data['point']);
	}); 
}

// 将该品牌删除
function delBrand(id) {
	cur_brand_id = id
	url = "./brand/handleBrand?type=del&id=" + id
	window.location.href = url
}

// 品牌基本信息的保存
function save_brand_basic(){
	$('#basic_id').val(cur_brand_id)
	$('#form_brand_basic').submit()
}

// 品牌基本信息————图片的保存
function save_brand_pic(){
	$('#pic_id').val(cur_brand_id)
	$('#setting-upload-img-form').submit()
}

/////////////// 以上是关于 品牌管理 模块

/////////////// 以下是关于 学校管理 模块

// 用于展示某个学校已经拥有的水品牌，即上架商品
function showSchool(id, logo){
	cur_school_id = id;
	$('#school_logo').attr('src', logo)

	$.getJSON("./brand/get_school_brand?id=" + id, function(data) {
		$('.school_brand').each(function(i) {
			if (i > 0) {
				deleteBrandFromSchool_c(this)
			};
		});

		for (var i = 0; i < data.length; i++) {
			if (i > 0) {
				addBrandToSchool();
			};
			$('.school_brand:eq('+ i +')').val(data[i]['f_id'])
			$('.schoool_brand_div:eq('+ i +') .shool_brand_id').val(data[i]['g_id'])
			$('.schoool_brand_div:eq('+ i +') .moneyBuddle').val(data[i]['price'])
			$('.schoool_brand_div:eq('+ i +') .pointBuddle').val(data[i]['point'])
		};
		
	}); 
}

// 保存上架的商品，将删除的商品下架
function save_shool_brand(){
	var oldObj = []
	var newObj = []
	$('.schoool_brand_div').each(function(){
		idVal = $(this).find('.shool_brand_id').val()  // 商品的id
		if (idVal) {  // 如果有商品的 id ，就证明这个商品已存在，否则为新增加商品，必需获得此商品的父级商品
			oldObj.push([idVal, $(this).find('.moneyBuddle').val(), $(this).find('.pointBuddle').val()])
		}else{
			fid = $(this).find('.school_brand').val()
			newObj.push([fid, $(this).find('.moneyBuddle').val(), $(this).find('.pointBuddle').val()])
		}
	});

	arr = new Object();
	arr.newO = newObj
	arr.oldO = oldObj
	str = JSON.stringify(arr)
	str = encodeURI(str)
	$.post("./brand/save_school_brand", {json:str, id:cur_school_id} ,function(data) {
		alert('更新成功')
	});
}

// 下架某学校的某个商品
function dele_school_brand(obj){
	idVal = $(obj).parent().find('.shool_brand_id').val()  // 商品的id
	if (idVal) {  // 只允许删除有 商品id  的商品
		$.get("./brand/del_school_brand", {gid:idVal, id:cur_school_id} ,function(data) {
			alert('删除成功')
		});
	};
}

/////////////// 以上是关于 学校管理 模块

/////////////// 以下是关于 订单管理——老板 模块
function check_order_boss(){
	status = $('#boss_send_status').val()
	sd = $('#boss_send_sd').val()
	sc = $('#boss_send_sc').val()
	brand = $('#boss_send_brand').val()
	date = $('#reservation-boss').val()
	dateArr = date.split(' - ')

	url = './oboss?status='+status + '&sd=' + sd + '&sc=' + sc + '&brand=' + brand + '&ex_d=' + dateArr[0] + '&pr_d=' + dateArr[1]
	$('#order-boss').attr('src', url)
}

function finish_order_boss(){
	ids = checkSelect('order-boss');
	$.post("./oboss/mark", {'ids':ids, 'action':'finish'} ,function(data) {
		if (data == 1) {
			alert('更新成功')
		}else{
			alert('更新失败')
		}
	});
}


function export_order_boss(){
	// 导出 订单
	status = $('#boss_send_status').val()
	sd = $('#boss_send_sd').val()
	sc = $('#boss_send_sc').val()
	brand = $('#boss_send_brand').val()
	date = $('#reservation-boss').val()
	dateArr = date.split(' - ')

	// $.get("./oboss/export", {'status':status, 'sd':'sd', 'sc':'sc', 'brand':'brand', 'ex_d':'ex_d', 'pr_d':'pr_d'} ,function(data) {
	// });

	url = './oboss/export?status='+ status + '&sd=' + sd + '&sc=' + sc + '&brand=' + brand + '&ex_d=' + dateArr[0] + '&pr_d=' + dateArr[1]
	window.location.href = url
}

function del_order_boss(){
	ids = checkSelect('order-boss');
	$.post("./oboss/mark", {'ids':ids, 'action':'del'} ,function(data) {
		if (data == 1) {
			alert('删除成功')
		}else{
			alert('删除失败')
		}
	});
}

function checkSelect(iframe) {
	var tbody = document.getElementById(iframe).contentWindow.document.getElementsByClassName('checkbox-tbody');
	ids = ''
	for (var i = 0; i < tbody.length; i++) {
		res = tbody[i].checked;
		if (res) {
			if (ids.length < 1) {
				ids = tbody[i].value
			}else{
				ids += '@@' + tbody[i].value
			}
		};
	}
	return ids
}

/////////////// 以上是关于 订单管理——老板 模块

/////////////// 以下是关于 订水员管理 模块
// 获取该品牌的详细信息，并进行赋值
function showSend(id) {
	cur_send_id = id
	$.getJSON("./send/handleSend?type=show&id=" + id, function(data) {
		sid = data['s_id'];
		addr = data['addr'];
		$('#send_school').val(sid)

		$('.send_addr').each(function(i) {
			if (i > 0) {
				delDor_C(this)
			};
		});
		addrArr = addr.split(',');
		for (var i = 0; i < addrArr.length; i++) {
			if (i > 0) {
				addDorToSchool();
			};
			$('.send_addr:eq('+ i +')').val(addrArr[i])
		};
		
	}); 
}

// 将该订水员删除
function delSend(id) {
	url = "./send/handleSend?type=del&id=" + id
	window.location.href = url
}

// 送水员信息的保存
function save_send(){
	sid = $('#send_school').val();
	addrs = 0;
	$('.send_addr').each(function(i) {
		if (i == 0) {
			addrs = $(this).val()
		}else{
			addrs += ',' + $(this).val()
		}
	});

	$.get("./send/saveBasic", {'id':cur_send_id, 'sid':sid, 'addrs':addrs} ,function(data) {
		alert(data)
	}); 
}

// <form class="brand-price-form" enctype="text/plain" action="__ROOT__/brand/saveBasic" method="get" id="form_brand_basic">


// <?php if(is_array($s_info)) foreach($s_info as $vo){ ?>
// <?php } ?>

