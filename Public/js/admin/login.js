/**
 * 前端登录业务类
 * @author cc
 */
var login = {

    check: function () {
        var username = $('input[name="username"]').val();
        var password = $('input[name="password"]').val();

        // if (!username){
        //     dialog.error("用户名不得为空",'/');
        // }
        // if (!password){
        //     dialog.error("密码不得为空",'/');
        // }
        var url = '/index.php?m=admin&c=login&a=check';
        var data = {
            'username': username,
            'password': password
        };
        $.post(url, data, function (result) {
            if (result[0] === 0){
                return dialog.error(result[1]);
            }
            if (result[0] === 1){
                return dialog.success(result[1],'/admin.php');
            }

        },'JSON')
    }

};