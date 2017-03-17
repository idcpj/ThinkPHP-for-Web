/*
 * 添加按钮操作
 * */
$('#button-add').click(function () {
    var url = SCOPE.add_url;
    window.location.href = url;
});

/*
 * 提交form操作
 * */
$('#singcms-button-submit').click(function () {
    //data为二维对象
    var data = $('#singcms-form').serializeArray();
    postData = {};
    //把二维对象变成一维
    $(data).each(function (i) {
        postData[this.name] = this.value;
    });
    var url = SCOPE.jump_url;
    $.post(url, postData, function (result) {
        if (result.status === 1) {

        } else if (result.status === 0){

        }
    }, 'JSON')
});