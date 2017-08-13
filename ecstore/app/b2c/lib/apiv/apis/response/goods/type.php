<?php

class b2c_apiv_apis_response_goods_type{

	public $app;
    /**
     * 构造方法
     * @param object app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * 根据分类获取类型及其详情
     * @param $cat_id
     * return $goods_type_detial
     */
    public function get_type_detial($param,&$service){
    	if(empty($param['type_id']))
            $service->send_user_error('7001', '商品类型id不能为空！');
        //获取商品类型model
        $goods_type=$this->app->model('goods_type');
        $goods_brand=$this->app->model('type_brand');
        $brand=$this->app->model('brand');
        $brand_id=$goods_brand->getList('brand_id',array('type_id'=>$param['type_id']));
        
        foreach ($brand_id as $key => $value) {
            foreach ($value as $k => $v) {
                $brand_id[$key]=$v['brand_id'];
            }
        }
        $brand_name=$brand->getList('brand_name,brand_id',array('brand_id|in'=>$brand_id));
       
        //获取商品属性model
        $goods_type_props=$this->app->model('goods_type_props');
        $goods_type_props_value=$this->app->model('goods_type_props_value');
        //获取规model
       // $goods_spec_index=$this->app->model('goods_spec_index');
        $goods_spec=$this->app->model('goods_type_spec');
        $spec_name=$this->app->model('specification');
        //获取规格值的model
        $spec_values=$this->app->model('spec_values');
        //$spec_id=$goods_spec->getRow('spec_id',array('type_id'=>intval($param['type_id'])));
        $spec_id=$goods_spec->getList('spec_id',array('type_id'=>intval($param['type_id'])));
        //转换格式

        foreach ($spec_id as $key => $value) {
            foreach ($value as $k => $va) {
                $spec_id[$key]=$va['spec_id'];
            }
        }

        $spec_name=$spec_name->getList('spec_id,spec_name,spec_show_type',array('spec_id|in'=>$spec_id));
        $spec_style=$goods_spec->getList('spec_id,spec_style',array('type_id'=>intval($param['type_id'])));

        $spec_value =$spec_values->getList('spec_id,spec_value,spec_value_id',array('spec_id|in'=>$spec_id));
        foreach ($spec_value as $key => $value) {
            foreach ($spec_style as $k => $v) {
               if($value['spec_id']==$v['spec_id']){
                $spec_value[$key]['spec_style']=$v['spec_style'];
               }
            }
        }
        foreach ($spec_value as $key => $value) {
            foreach ($spec_name as $k => $v) {
               if($value['spec_id']==$v['spec_id']){
                $spec_value[$key]['spec_name']=$v['spec_name'];
               }
            }
        }
        
        foreach ($spec_value as $key => $value) {
            
                $fmt_spec[$value['spec_id']]['spec_id'] = $value['spec_id'];
                $fmt_spec[$value['spec_id']]['spec_name'] = $value['spec_name'];
                $fmt_spec[$value['spec_id']]['spec_style'] = $value['spec_style'];
                $fmt_spec[$value['spec_id']]['spec_value'][$value['spec_value_id']]['spec_value_id'] = $value['spec_value_id'];
                $fmt_spec[$value['spec_id']]['spec_value'][$value['spec_value_id']]['spec_value'] = $value['spec_value'];

        }
       
        $props_id=$goods_type_props->getList('props_id',array('type_id'=>$param['type_id']));
        foreach ($props_id as $key => $value) {
            $props_id[$key]=$value['props_id'];
        }

        $props_values=$goods_type_props_value->getList('props_id,name,props_value_id',array('props_id|in'=>$props_id));
        $props_value=$goods_type_props->getList('props_id,search,show,name',array('type_id'=>$param['type_id']));
        //return  $props_value;
        foreach ($props_values as $key => $value) {
            foreach ($props_value as $k => $v) {
                if($value['props_id']==$v['props_id']){
                    $props_values[$key]['search']=$v['search'];
                    $props_values[$key]['show']=$v['show'];
                    $props_values[$key]['props_name']=$v['name'];
                }
            }
        }
       //return $props_values;
        foreach ($props_values as $key => $value) {
            
                $fmt_props[$value['props_id']]['props_id'] = $value['props_id'];
                $fmt_props[$value['props_id']]['search'] = $value['search'];
                $fmt_props[$value['props_id']]['show'] = $value['show'];
                $fmt_props[$value['props_id']]['props_name'] = $value['props_name'];
                $fmt_props[$value['props_id']]['props_values'][$value['props_value_id']]['name'] = $value['name'];
                $fmt_props[$value['props_id']]['props_values'][$value['props_value_id']]['props_value_id'] = $value['props_value_id'];

        }
        //return $fmt_props;
        
        $goods_type_detial=$goods_type->getRow('type_id,name,alias,price,tab,params,setting',array('type_id'=>$param['type_id']));
        if($goods_type_detial['params']){
            $goods_type_detial['params'] = unserialize($goods_type_detial['params']);
        }
        //给结果集添加商品规格
        $goods_type_detial['spec']=$fmt_spec;
        $goods_type_detial['brand']=$brand_name;
        //给结果集添加商品属性
        $goods_type_detial['props']=$fmt_props;
    	return $goods_type_detial;
    }
}
