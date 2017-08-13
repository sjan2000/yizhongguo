<?php
class b2c_apiv_apis_response_goods_goods
{
    public function __construct($app)
    {
        $this->app=$app;    
    }
    /**
     * 根据商品id获取商品详情
     * @param int goods_id 商品id
     * @return goods_id 商品的id 
     * @return goods_context 商品的详情 
     */
    public function get_goods_intro($params, &$service)
    {
        $goods_id = $params['goods_id'];
        if(empty($goods_id)){
            return $service->send_user_error('商品ID必填');  
        } 
        $obj_goods = $this->app->model('goods');
        $filter = array('goods_id'=>intval($goods_id));
        $wap_status = app::get('wap')->getConf('wap.status');
        if( $wap_status == 'true' ){
            $intro = $obj_goods->getList('wapintro,intro',$filter);
        }else{
            $intro = $obj_goods->getList('intro',$filter);
        }
        $intro = $intro[0];
        $return['goods_id'] = $goods_id;
        if( $intro['wapintro'] ){
            $return['goods_context'] = $intro['wapintro'];
        } else {
            $return['goods_context'] = $intro['intro'];
        }
        return $return;
    }

     /**
     * 根据筛选条件查询商品
     * @param int page_num 页码
     * @param int page_size 每页的容量
     * @param int cat_id 商品分类 
     * @param string search_keywords 关键词（根据名字搜索）
     * @param string brand_id array(int)数组的json(品牌id)
     * @param string specs array(int=>array(int))格式的json 商品规格array(规格id=>array(规格值id))
     * @param string props array(int=>array(int))格式的json props 商品属性id
     * @return goods 商品
     * @return count 商品条目数
     */
    public function search_properties_goods($params, &$service)
    {
        //json转array
        $params['brand_id'] = $params['brand_id'] ? json_decode($params['brand_id'],true) : null;
        $params['specs'] = $params['specs'] ? json_decode($params['specs'],true) : null;
        $params['props'] = $params['props'] ? json_decode($params['props'],true) : null;
        //分类、品牌、关键词必须要有一个才可以查询
        if( $params['cat_id'] == null && $params['search_keywords'] == null && $params['brand_id'] == null)
        {
            return array('status'=>'error','message'=>'分类、作者、关键词至少有一项需要填写');
        }
        
        $obj_goods = $this->app->model('goods');
        $limit = $params['page_size'] ? $params['page_size'] : 10;
        $offset = $params['page_num'] ? (($params['page_num']-1) * $limit) : 0;

        //根据分类查询
        if(isset($params['cat_id']) && $params['cat_id']!=null)
        {
            $obj_cat = $this->app->model('goods_cat');
            $cat_data = $obj_cat->getList('cat_id',array('parent_id|in'=>$params['cat_id']));
            foreach($cat_data as $value)
            {
                $cat_filter[$value['cat_id']] = $value['cat_id'];
            }
            $cat_filter[$params['cat_id']] = $params['cat_id'];
            $filter['cat_id|in'] = $cat_filter;
        }

        //根据关键字查询
        if(isset($params['search_keywords']) && $params['search_keywords']!=null)
        {
            $filter['search_keywords'] = array($params['search_keywords']);
        }

        //根据品牌查询
        if(isset($params['brand_id']) && count($params['brand_id'])>0)
        {
            $filter['brand_id'] = $params['brand_id'];
        }

       //根据属性查询
        if(isset($params['props']) && count($params['props'])>0)
        {
            foreach($params['props'] as $prop_id=>$prop)
            {
                $prop_ids[$prop_id] = $prop_id;
            }

            $obj_props = $this->app->model('goods_type_props');
            $props = $obj_props->getList('props_id,goods_p',array('props_id|in'=>$prop_ids));
            foreach($props as $prop)
            {
                $filter['p_'.$prop['goods_p'].'|in'] = $params['props'][$prop['props_id']];
            }
        }

        //根据规格查询
        if(isset($params['specs']) && count($params['specs'])>0)
        {
            foreach($params['specs'] as $spec_id=>$spec)
            {
                $filter['s_'.$spec_id] = $spec;
            }
        }

        //排序
        if(isset($params['orderBy_id']) && $params['orderBy_id']>0 && $params['orderBy_id'] <11)
        {
            $order = $obj_goods->orderBy($params['orderBy_id']);
            $orderBy = $order['sql'];
        }
        $filter['marketable'] = 'true';
        $data = $obj_goods->getList('marketable,goods_id,bn,name,price,store,mktprice,brief,image_default_id,comments_count',$filter,$offset,$limit,$orderBy);

        foreach($data as $key=>$goods)
        {
            $fmt_use_for_img[$goods['goods_id']] = $goods['image_default_id'];
        }
        $obj_image = app::get('image')->model('image');
        $resource_host_url = kernel::get_resource_host_url();
        $image_from_db = $obj_image->getList('image_id,storage,l_url,m_url,s_url',array('image_id|in'=>$fmt_use_for_img));
        foreach($image_from_db as $imageRow)
        {
            $image_id = $imageRow['image_id'];
            $fmt_image[$image_id]['s_url'] = $imageRow['s_url'] ? $imageRow['s_url'] : $imageRow['url'];
            if($fmt_image[$image_id]['s_url'] &&!strpos($fmt_image[$image_id]['s_url'],'://')){
                $fmt_image[$image_id]['s_url'] = $resource_host_url.'/'.$fmt_image[$image_id]['s_url'];
            }
            $fmt_image[$image_id]['m_url'] = $imageRow['m_url'] ? $imageRow['m_url'] : $imageRow['url'];
            if($fmt_image[$image_id]['m_url'] &&!strpos($fmt_image[$image_id]['m_url'],'://')){
                $fmt_image[$image_id]['m_url'] = $resource_host_url.'/'.$fmt_image[$image_id]['m_url'];
            }
            $fmt_image[$image_id]['l_url'] = $imageRow['l_url'] ? $imageRow['l_url'] : $imageRow['url'];
            if($fmt_image[$image_id]['l_url'] &&!strpos($fmt_image[$image_id]['l_url'],'://')){
                $fmt_image[$image_id]['l_url'] = $resource_host_url.'/'.$fmt_image[$image_id]['l_url'];
            }
        }
        foreach($data as $key=>$goods)
        {
            $data[$key]['price'] = $goods['price'];
            $data[$key]['mktprice'] = $goods['mktprice'];
            $data[$key]['image'] = $fmt_image[$goods['image_default_id']];
        }
        $return['goods']=$data;
        //获取总条数
        $count = $obj_goods->countGoods($filter);
        $return['count']=$count;
        return $return;
    }
}
