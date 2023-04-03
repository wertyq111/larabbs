<?php

use Illuminate\Support\Facades\Route;

/**
 * 路由转换
 * @return array|string|string[]|null
 */
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

/**
 * 话题分类选中验证
 * @param $category_id
 * @return string
 */
function category_nav_active($category_id)
{
    return active_class((if_route('categories.show') && if_route_param('category', $category_id)));
}


