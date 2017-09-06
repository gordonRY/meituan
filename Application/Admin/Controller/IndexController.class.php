<?php
// +----------------------------------------------------------------------
// | 后台首页模块
// +----------------------------------------------------------------------
// | date:2017-05-16
// +----------------------------------------------------------------------
// | Author: lzb
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
class IndexController extends AdminBaseController{
    //后台首页
	public function index(){

		$this->display();
	}

    //首页内容
    public function welcome(){
        $this->assign('sys_info',$this->get_sys_info());
        $this->display();
    }

    /**
     * 系统信息
     * @return [type] [description]
     */
    public function get_sys_info(){
        $sys_info['os']             = PHP_OS;
        $sys_info['zlib']           = function_exists('gzclose') ? 'YES' : 'NO';//zlib
        $sys_info['safe_mode']      = (boolean) ini_get('safe_mode') ? 'YES' : 'NO';//safe_mode = Off       
        $sys_info['timezone']       = function_exists("date_default_timezone_get") ? date_default_timezone_get() : "no_timezone";
        $sys_info['curl']           = function_exists('curl_init') ? 'YES' : 'NO';  
        $sys_info['web_server']     = $_SERVER['SERVER_SOFTWARE'];
        $sys_info['phpv']           = phpversion();
        $sys_info['ip']             = GetHostByName($_SERVER['SERVER_NAME']);
        $sys_info['fileupload']     = @ini_get('file_uploads') ? ini_get('upload_max_filesize') :'unknown';
        $sys_info['max_ex_time']    = @ini_get("max_execution_time").'s'; //脚本最大执行时间
        $sys_info['set_time_limit'] = function_exists("set_time_limit") ? true : false;
        $sys_info['domain']         = $_SERVER['HTTP_HOST'];
        $sys_info['memory_limit']   = ini_get('memory_limit');      
        $sys_info['version']        = file_get_contents('./Application/Admin/Conf/version.txt');
        $mysqlinfo = M()->query("SELECT VERSION() as version");
        $sys_info['mysql_version']  = $mysqlinfo['version'];
        if(function_exists("gd_info")){
            $gd = gd_info();
            $sys_info['gdinfo']     = $gd['GD Version'];
        }else {
            $sys_info['gdinfo']     = "未知";
        }
        return $sys_info;
    }

	/**
     * ajax 修改指定表数据字段  一般修改状态 比如 是否推荐 是否开启 等 图标切换的
     * table,id_name,id_value,field,value
     */
    public function changeTableVal(){  
        $table = I('table'); // 表名
        $id_name = I('id_name'); // 表主键id名
        $id_value = I('id_value'); // 表主键id值
        $field  = I('field'); // 修改哪个字段
        $value  = I('value'); // 修改字段值                        
        M($table)->where("$id_name = $id_value")->save(array($field=>$value)); // 根据条件保存修改的数据
    }	
}
?>