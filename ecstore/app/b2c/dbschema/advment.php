<?php
$db['advment']=array(
  'columns' =>
  array (
    'adv_position_id' =>
    array (
      'type' => 'bigint unsigned',
      'required' => true,
      'default' => 0,
      'pkey' => true,
      'label' => app::get('b2c')->_('广告位ID'),
      'is_title' => true,
      'width' => 110,
      'editable' => false,
      'filterdefault' => true,
      'in_list' => true,
      'default_in_list' => true,	 
    ),
 'adv_position_no' =>
    array (
        'type' => 'varchar(15)',
        'required' => true,
        'editable' => false,
        'label' => app::get('b2c')->_('广告位标识'),
	    'comment' => app::get('b2c')->_('广告位标识'),
        'in_list' => true,
        'default_in_list' => true,
    ),
    'adv_position_name' =>
    array (
        'type' => 'varchar(32)',
        'required' => true,
        'editable' => false,
        'label' => app::get('b2c')->_('广告位名称'),
	    'comment' => app::get('b2c')->_('广告位名称'),
        'in_list' => true,
        'default_in_list' => true,
    ),
  'adv_type' =>
      array (
          'type' => array(
              'carousel' => app::get('b2c')->_('轮播'),
              'fixed' => app::get('b2c')->_('固定'),
          ),
          'default' => 'carousel',
          'required' => true,
          'label' => app::get('b2c')->_('广告类型'),
          'comment' => app::get('b2c')->_('广告类型'),
          'editable' => false,
          'in_list' => true,
          'default_in_list' => true,
      ),
    'adv_width' =>
    array (
      'type' => 'varchar(10)',
      'required' => true,
      'editable' => false,    
      'label' => app::get('b2c')->_('宽度'),
      'comment' => app::get('b2c')->_('宽度'),
    ),
	'adv_height' =>
    array (
      'type' => 'varchar(10)',
      'required' => true,
      'editable' => false,    
      'label' => app::get('b2c')->_('高度'),
      'comment' => app::get('b2c')->_('高度'),
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
        'editable' => false,
        'in_list' => true,
        'default_in_list' => true,
    ),
    'add_time' =>
    array (
        'type' =>'time',
        'required' => true,
        'label' => app::get('b2c')->_('新增时间'),
	    'comment' => app::get('b2c')->_('新增时间'),
        'editable' => false,
        'in_list' => true,
        'default_in_list' => true,
    ),
    'add_user' =>
    array (
        'type' => 'varchar(32)',
        'required' => true,
	    'label' => app::get('b2c')->_('新增人'),
        'comment' => app::get('b2c')->_('新增人'),
        'editable' => false,
        'in_list' => true,
        'default_in_list' => true,
    ),
   'update_time' =>
    array (
      'type' => 'time',
      'label' => app::get('b2c')->_('更新时间'),
	  'comment' => app::get('b2c')->_('更新时间'),
	  'editable' => false,
      'in_list' => true,
      'default_in_list' => true,
    ),
   'update_user' =>
    array (
        'type' => 'varchar(32)',
        'label' => app::get('b2c')->_('更新人'),
	    'comment' => app::get('b2c')->_('更新人'),
        'width' => 110,
        'editable' => false,
        'in_list' => true,
        'default_in_list' => true,
    ),
  ),
  'engine' => 'innodb',
  'version' => '$Rev: 42376 $',
  'comment' => app::get('b2c')->_('广告主表'),
);