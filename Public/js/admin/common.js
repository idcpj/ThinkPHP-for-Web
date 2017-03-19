/*
 * 添加按钮操作
 * 可以服用
 * */
$('#button-add').click(function () {
    var url = SCOPE.add_url;
    window.location.href = url;
});

/*
 *add from
 * 提交form操作
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
            dialog.error(result.message);
        }
    }, 'JSON')
});

/**
 跳转到编辑菜单
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


function delByMenuId(url,data){
    $.post(url,data,function(result){
        if (result.status ==1){
            dialog.success(result.message,'/admin.php?c=menu');
        }else if (result.status == 0 ){
            dialog.success(result.message,'/admin.php?c=menu');
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
           return dialog.success(result.message,result['data']['jumpUrl']);
        } else if (result.status === 0) {
            return dialog.error(result.message,result['data']['jumpUrl']);
        }
    }, 'JSON')

});