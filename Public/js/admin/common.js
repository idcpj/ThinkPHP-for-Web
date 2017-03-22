/*
 * 添加按钮操作
 * 可以按钮
 * */
$('#button-add').click(function () {
    var url = SCOPE.add_url;
    window.location.href = url;
});

/*
 *提交按钮
 * 添加,更改
 * */
$('#singcms-button-submit').click(function () {
    //data为二维对象
    var data = $('#singcms-form').serializeArray();
    var postData = {};
    //把二维对象变成一维
    $(data).each(function (i) {
        postData[this.name] = this.value;
    });
    var url = SCOPE.save_url;
    $.post(url, postData, function (result) {
        if (result.status === 1) {
            dialog.success(result.message, SCOPE.jump_url);
        } else if (result.status === 0) {
            dialog.error(result.message,SCOPE.jump_url);
        }
    }, 'JSON')
});

/*
 * 跳转到编辑菜单
 */
$('.singcms-table #singcms-edit').on('click',function (event) {
    event.preventDefault(); //阻止默认时间,否则需要点击两次跳转;
    var id = $(this).attr('attr-id');
    var url = SCOPE.edit_url+'&id='+id;
    window.location.href=url;
});

/*
* 删除记录
* */
$('.singcms-table #singcms-delete').click(function () {
    var id = $(this).attr('attr-id');
    var url = SCOPE.del_url;

    var data = {};
    data['id']=id;
    data['status']=-1;

    layer.open({
        content : "是否删除",
        icon:3,
        btn : ['是','否'],
        yes : function(){
            delByMenuId(url,data);
        },
    });
});

/**
 * 删除记录函数
 */
function delByMenuId(url,data){
    $.post(url,data,function(result){
        if (result.status ==1){
            dialog.success(result.message,result.data['url']);
        }else if (result.status == 0 ){
            dialog.error(result.message,result.data['url']);
        }
    },'JSON');
}

/*
* 排序按钮
* */
$('#button-listorder').click(function(){
    var data = $('#singcms-listorder').serializeArray();
    var postData = {};
    //把二维对象变成一维
    $(data).each(function (i) {
        postData[this.name] = this.value;
    });
    var url = SCOPE.listorder_url;
    $.post(url, postData, function (result) {
        if (result.status === 1) {
            return dialog.success(result.message, result['data']['jumpUrl']);
        } else if (result.status === 0) {
            return dialog.error(result.message,result['data']['jumpUrl']);
        }
    }, 'JSON')

});

/*
 * 更改状态
 * */
$('.singcms-table #singcms-on-off').click(function () {
    var id = $(this).attr('attr-id');
    var url = SCOPE.del_url;
    var status = $(this).attr('attr-status');
    var content;
    if( status==1){
        status=0;
        content='是否隐藏';
    }else if(status==0){
        status=1;
        content='是否显示';
    }
    var data = {};
    data['id']=id;
    data['status']=status;

    layer.open({
        content : content,
        icon:3,
        btn : ['是','否'],
        yes : function(){
            delByMenuId(url,data);
        },
    });
});


//推送
$('#singcms-push').click(function () {
   var position_id = $('#select-push').val();
   var data={};
   var postData={};
   if (!position_id){
       dialog.error('请选择推荐位');
   }

   $('input[name="pushcheck"]:checked').each(function (i) {
       data[i]=this.value;
   })
    postData['position_id']=position_id;
    postData['data']=data;
    var url = SCOPE.push_url;

    console.log(postData);
    $.post(url,postData,function(result){
        if (result.status ===1){
            dialog.success(result.message,result['data']['url']);
        }else if (result.status ===0){
            dialog.error(result.message,result['data']['url']);
        }
    },'JSON');
});



