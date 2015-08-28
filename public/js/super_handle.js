/////////////// 以下是关于 学校管理 模块

// 用于展示某个学校已经拥有的水品牌，即上架商品
function showSchool(id, logo, district){
	cur_school_id = id;
	$('#school_logo').attr('src', logo)

	str = '<option value="">校区</option>'
    label = district
    la_arr = label.split('@@')
    val_arr = la_arr[0].split(',')
    text_arr = la_arr[1].split(',')
    for (var i = 0; i < val_arr.length; i++) {
        str += '<option value="'+ val_arr[i] +'">' + text_arr[i] + '</option>'
    };
    document.getElementById('district-select').innerHTML = str

    showSchool_brand(1)
}

function showSchool_brand(type){
	id = cur_school_id;
	if (type == 1) {
		cid = -1
	}else{
		cid = $('#district-select').val()
	}

	$.getJSON("./brand/get_school_brand", {'id':id , 'cid':cid}, function(data) {
		$('.school_brand').each(function(i) {
			if (i > 0) {
				deleteBrandFromSchool_c(this)
			};
		});

		if (data) {
			for (var i = 0; i < data.length; i++) {
				if (i > 0) {
					addBrandToSchool();
				};
				$('.school_brand:eq('+ i +')').val(data[i]['f_id'])
				$('.schoool_brand_div:eq('+ i +') .shool_brand_id').val(data[i]['g_id'])
				$('.schoool_brand_div:eq('+ i +') .moneyBuddle').val(data[i]['price'])
				$('.schoool_brand_div:eq('+ i +') .pointBuddle').val(data[i]['point'])
			};
		}else{
			$('.school_brand:eq(0)').val('')
			$('.schoool_brand_div:eq(0) .shool_brand_id').val('')
			$('.schoool_brand_div:eq(0) .moneyBuddle').val('')
			$('.schoool_brand_div:eq(0) .pointBuddle').val('')
		};
	});
}

// 保存上架的商品，将删除的商品下架
function save_shool_brand(){
	var oldObj = []
	var newObj = []
	cid = $('#district-select').val()
	flag = true

	$('.schoool_brand_div').each(function(){
		idVal = $(this).find('.shool_brand_id').val()  // 商品的id
		if (idVal) {  // 如果有商品的 id ，就证明这个商品已存在，否则为新增加商品，必需获得此商品的父级商品
			oldObj.push([idVal, $(this).find('.moneyBuddle').val(), $(this).find('.pointBuddle').val()])
		}else{
			if (cid.length < 1) {
				alert('请选择校区');
				flag = false;
			}else{
				fid = $(this).find('.school_brand').val()
				newObj.push([fid, cid, $(this).find('.moneyBuddle').val(), $(this).find('.pointBuddle').val()])
			}
		}
	});

	arr = new Object();
	arr.newO = newObj
	arr.oldO = oldObj
	str = JSON.stringify(arr)
	str = encodeURI(str)
		
	if (flag) {
		$.post("./brand/save_school_brand", {json:str, id:cur_school_id} ,function(data) {
			alert('更新成功')
		});
	};
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

/////////////// 以下是关于 订单管理 模块
function check_send_super(){
	status = $('#super_send_sd').val()
	sc = $('#super_send_sc').val()
	cid = $('#super_send_c').val()
	sell = $('#super_send_sell').val()
	date = $('#reservation-order').val()
	dateArr = date.split(' - ')

	if (sc) {
		url = './super?status='+status + '&sc=' + sc + '&cid=' + cid + '&sell=' + sell + '&ex_d=' + dateArr[0] + '&pr_d=' + dateArr[1]
		$('#order-admin').attr('src', url)
	}else{
		alert('请选择学校')
	}
}
 
// 导出数据
function export_send_super(){
	status = $('#super_send_sd').val()
	sc = $('#super_send_sc').val()
	cid = $('#super_send_c').val()
	sell = $('#super_send_sell').val()
	date = $('#reservation-order').val()
	dateArr = date.split(' - ')

	if (sc) {
		url = './super/export?status='+status + '&sc=' + sc + '&cid=' + cid + '&sell=' + sell + '&ex_d=' + dateArr[0] + '&pr_d=' + dateArr[1]
		window.location.href = url
	}else{
		alert('请选择学校')
	}
}

/////////////// 以上是关于 订单管理 模块


/////////////// 以下是关于 用户管理 模块

function check_user(){
	sc = $('#user_school').val()
	cid = $('#user_school_c').val()
	date = $('#reservation-user').val()
	dateArr = date.split(' - ')

	if (sc) {
		url = './super/user?sc=' + sc + '&cid=' + cid +'&ex_d=' + dateArr[0] + '&pr_d=' + dateArr[1]
		$('#user-table').attr('src', url)
	}else{
		alert('请选择学校')
	}
}


/////////////// 以上是关于 用户管理 模块
