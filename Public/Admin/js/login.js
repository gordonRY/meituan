$(document).ready(function() {
	$(".btn-submit").click(function(){
		login();
	});
	$('#form_login').keydown(function(event){
        if (event.keyCode == 13) {
            $('.btn-submit').click();
        }
    });
});
function login(){
	if($('#admin_name').val() == ''){
        layer.msg('账号不能为空');
        $('#admin_name').focus();
        return false;
    }
    if($('#admin_password').val() == ''){
        layer.msg('密码不能为空');
        $('#admin_password').focus();
        return false;
    }

    if($('#captcha').val() == ''){
        layer.msg('验证码不能为空');
        $('#captcha').focus();
        return false;
    }

    $.post(loginHandleUrl,{'admin_name':$('#admin_name').val(), 'admin_password':$('#admin_password').val(),'captcha': $('#captcha').val()},function(data){
		if(data.status){
			setTimeout(function(){
				$('.input-username,dot-left').addClass('animated fadeOutRight')
			    $('.input-password-box,dot-right').addClass('animated fadeOutLeft')
			    $('.btn-submit').addClass('animated fadeOutUp')
			    setTimeout(function () {
			        $('.avatar').addClass('avatar-top');
			        $('.submit').hide();
			        $('.submit2').html('<div class="progress"><div class="progress-bar progress-bar-success" aria-valuetransitiongoal="100"></div></div>');
			        layer.msg(data.msg);
			        $('.progress .progress-bar').progressbar({done : function() {
			            location.href = homeUrl;
			        }}); 
			    },300);
			},300)
			
		}else{
			layer.msg(data.msg);
            verifyimage();
		}
	},'json')

    
	
}