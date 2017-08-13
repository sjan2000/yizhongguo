<?php
$db['advertisement']=array(
  'columns' =>
  array (
    'adv_sub_id' =>
    array (
      'type' => 'bigint unsigned',
      'required' => true,
      'default' => 0,
      'pkey' => true,
      'label' => app::get('b2c')->_('广告ID'),
      'is_title' => true,
      'width' => 110,
      'editable' => false,
      'filterdefault' => true,
      'in_list' => true,
      'default_in_list' => true,	 
    ),
    'adv_sub_name' =>
    array (
      'type' => 'varchar(32)',     
      'required' => true,
      'editable' => false,
      'label' => app::get('b2c')->_('广告名称'),
	  'comment' => app::get('b2c')->_('广告名称'),
    ),
    'adv_sub_content' =>
    array (
      'type' => 'varchar(64)',
      'required' => true,
      'editable' => false,
      'label' => app::get('b2c')->_('广告内容'),
      'comment' => app::get('b2c')->_('广告内容'),
    ),
    'adv_sub_memo' =>
    array (
      'type' =>'longtext',
      'label' => app::get('b2c')->_('广告描述'),
	   'comment' => app::get('b2c')->_('广告描述'), 
    ),
    'link_sub_url' =>
    array (
      'type' => 'varchar(255)',
      'required' => true,
	  'label' => app::get('b2c')->_('链接地址'),
      'comment' => app::get('b2c')->_('链接地址'),
    ),
    'images' =>
    array(
        'type' => 'varchar(32)',
        'label' => app::get('b2c')->_('图片'),
        'comment' => app::get('b2c')->_('图片'),
        'width' => 75,
        'hidden' => true,
        'editable' => false,
        'in_list' => false,
    ),
   'start_time' =>
    array (
      'type' => 'time',
      'label' => app::get('b2c')->_('开始时间'),
	  'comment' => app::get('b2c')->_('结束时间'),
	  'width' => 110,
      'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
    ),
   'end_time' =>
    array (
        'type' => 'time',
        'label' => app::get('b2c')->_('结束时间'),
	    'comment' => app::get('b2c')->_('结束时间'),
        'width' => 110,
        'editable' => false,
        'in_list' => true,
        'default_in_list' => true,
    ),
    'is_used' =>
    array (
        'type' =>array(
            0 => app::get('b2c')->_('否'),
            1 => app::get('b2c')->_('是'),
        ),
        'default' => '0',
        'required' => true,
        'label' => app::get('b2c')->_('是否启用'),
	    'comment' => app::get('b2c')->_('是否启用'),
        'filtertype' => 'yes',
        'filterdefault' => true,
        'editable' => false,
        'in_list' => false,
    ),
    'is_delete' =>
    array (
     'type' =>
      array (
        0 => app::get('b2c')->_('否'),
        1 => app::get('b2c')->_('是'),        
      ),
      'default' => '0',
      'required' => true,
      'label' => app::get('b2c')->_('是否删除'),
	  'comment' => app::get('b2c')->_('是否删除'),
      'width' => 75,
      'editable' => false,
      'filtertype' => 'yes',
      'filterdefault' => true,
      'in_list' => true,
      'default_in_list' => true,
    ),
   'add_time' =>
    array (
      'type' => 'time',
      'label' => app::get('b2c')->_('新增时间'),
	  'comment' => app::get('b2c')->_('新增时间'),
      'width' => 75,
      'editable' => false,
      'filtertype' => 'yes',
      'filterdefault' => true,
      'in_list' => true,
      'default_in_list' => true,
    ),
     'add_user' =>
    array (
      'type' => 'varchar(32)',      
      'required' => true,
      'label' => app::get('b2c')->_('新增人'),
	  'comment' => app::get('b2c')->_('新增人'),
      'width' => 75,  
      'editable' => false,
      'in_list' => true,
    ),
    'update_time' =>
    array (
      'type' => 'time',     
      'label' => app::get('b2c')->_('更新时间'),
	  'comment' => app::get('b2c')->_('更新时间'),
      'width' => 75,
      'hidden' => true,
      'editable' => false,
      'in_list' => false,
    ),
    'update_user' =>
    array (
      'type' => 'time',
      'label' => app::get('b2c')->_('更新人'),
	  'comment' => app::get('b2c')->_('更新人'),
      'in_list' => true,
      'default_in_list' => true,
    ),
  ),
  'engine' => 'innodb',
  'version' => '$Rev: 42376 $',
  'comment' => app::get('b2c')->_('广告副表'),
);