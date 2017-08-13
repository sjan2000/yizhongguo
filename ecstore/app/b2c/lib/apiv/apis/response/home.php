<?php
/**
 * ShopEx licence
 *
 * @copyright  Copyright (c) 2005-2010 ShopEx Technologies Inc. (http://www.shopex.cn)
 * @license  http://ecos.shopex.cn/ ShopEx License
 */


class b2c_apiv_apis_response_home
{
    /**
     * 公开构造方法
     * @params app object
     * @return null
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * 取到所有货品的bn和store
     * @param null
     * @return string json
     */
    public function index()
    {
      //获取广告接口
	  $array = array(
			'advment'=>array(
			    'adv_position_id'=>'1',
                'adv_position_no'=>'home',
                'adv_position_name'=>'首页轮播',
                'adv_type'=>'carousel',
                'is_used'=>'1',
                'advlist'=>array(
                    array(
                        'adv_sub_id'=>'1',
                        'adv_sub_name'=>'广告图片名称1',
                        'adv_sub_content'=>'广告主图描述1',
                        'link_sub_url'=>'http//:127.0.0.1/index.php',
                        'images'=>'http://127.0.0.1/images/1.jpg',
                    ),
                    array(
                        'adv_sub_id'=>'1',
                        'adv_sub_name'=>'广告图片名称2',
                        'adv_sub_content'=>'广告主图描述2',
                        'link_sub_url'=>'http//:127.0.0.1/index.php',
                        'images'=>'http://127.0.0.1/images/2.jpg',
                    ),
                    array(
                        'adv_sub_id'=>'1',
                        'adv_sub_name'=>'广告图片名称3',
                        'adv_sub_content'=>'广告主图描述3',
                        'link_sub_url'=>'http//:127.0.0.1/index.php',
                        'images'=>'http://127.0.0.1/images/3.jpg',
                    ),

                ),

			),
          'notice' => array(
              array(
                  'notice_id' => '1',
                  'message' => '公告内容1',
              ),
              array(
                  'notice_id' => '2',
                  'message' => '公告内容2',
              ),
              array(
                  'notice_id' => '3',
                  'message' => '公告内容3',
              ),
          ),
          'today_act' => array(
              'url'=>'http://127.0.0.1/index.php/',
              'goods_list'=>array(
                array(
                    'goods_id'=>'1',
                    'name'=>'商品1',
                    'describe' => '商品描述',
                    'default_image'=>'http://127.0.0.1/images/1.jpg',
                    'price'=>'1000.00',
                    'act_price'=>'200.00',
                ),
                  array(
                      'goods_id'=>'2',
                      'name'=>'商品2',
                      'describe' => '商品描述',
                      'default_image'=>'http://127.0.0.1/images/2.jpg',
                      'price'=>'1100.00',
                      'act_price'=>'210.00',
                  ),
                  array(
                      'goods_id'=>'3',
                      'name'=>'商品3',
                      'describe' => '商品描述',
                      'default_image'=>'http://127.0.0.1/images/3.jpg',
                      'price'=>'1200.00',
                      'act_price'=>'220.00',
                  ),
                  array(
                      'goods_id'=>'4',
                      'name'=>'商品4',
                      'describe' => '商品描述',
                      'default_image'=>'http://127.0.0.1/images/4.jpg',
                      'price'=>'1300.00',
                      'act_price'=>'230.00',
                  ),
              ),
          ),
	  );

     return $array;
    }

	 public function get_array(){
		return  4444;
		
	}



   
}
