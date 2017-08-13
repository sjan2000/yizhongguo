<?php
/**
 * ShopEx licence
 *
 * @copyright  Copyright (c) 2005-2010 ShopEx Technologies Inc. (http://www.shopex.cn)
 * @license  http://ecos.shopex.cn/ ShopEx License
 */
 

/*
 * @package site
 * @copyright Copyright (c) 2010, shopex. inc
 * @author edwin.lzh@gmail.com
 * @license 
 */
class site_ctl_admin_advment extends site_admin_controller 
{
    /*
     * workground
     * @var string
     */
    var $workground = 'site.wrokground.theme';

    /*
     * 列表
     * @public
     */
    public function index() 
    {
        $this->finder('b2c_mdl_advment', array(
            'title' => app::get('site')->_('广告管理'),
            'base_filter' => array(),
            'actions'=>array(
                array(
                    'label'=>app::get('b2c')->_('添加广告'),
                    'icon'=>'add.gif',
                    'href'=>'index.php?app=site&ctl=admin_advment&act=create',
                    'target'=>'_blank'
                ),
            )
        ));
    }//End Function
    /*
     * 创建广告
     *
     * */
    function create(){
        $this->singlepage('admin/advment/detail.html');
    }//End Function

    function addSubAdvment_pre(){

        $this->display('admin/advment/addSubAdvment_pre.html');
    }

    function save(){
        $adv_position_name = $_POST['adv_position_name'];
        $adv_position_no = $_POST['adv_position_no'];
        $adv_type = $_POST['adv_type'];
        $adv_width = $_POST['adv_width'];
        $adv_height = $_POST['adv_height'];
        $is_used = $_POST['is_used'];
        $adv_list = $_POST['adv_list'];


    }


  
}//End Class
