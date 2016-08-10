<?php

if(!function_exists('redirect_with_role')) {
	function redirect_with_role($role)
	{
		if ($role === config('attr.ADMIN')) {
            return route('admin.index');
        } else if ($role === config('attr.SUP')) {
            return route('sup.index');
        } else if ($role === config('attr.USER')) {
            return route('user.index');
        }
	}
}

if(!function_exists('course_list')) {
    function course_list()
    {
        return route('course.index');
    }
}

if(!function_exists('render')) {
    function render($obj, $get_field_name, $type)
    {
        if ($type !== 'date') {
            return !empty($obj) ? $obj->$get_field_name : '';
        } else {
            return !empty($obj) ? $obj->$get_field_name : \Carbon\Carbon::now();
        }
        
    }
}

if(!function_exists('is_admin')) {
    function is_admin($user)
    {
        return $user->role === "1";
    }
}

if (!function_exists('fill_status')) {
    function fill_status($status)
    {
        switch ($status) {
            case 1: {
                return '<label class="ui blue ribbon label">' . config("attr.status.0") . '</label>';
            }
            case 2: {
                return '<label class="ui yellow ribbon label">' . config("attr.status.1") . '</label>';
            }
            case 3: {
                return '<label class="ui red ribbon label">' . config("attr.status.2") . '</label>';
            }
            case 4: {
                return '<label class="ui red ribbon label">' . config("attr.status.3") . '</label>';
            }
        }
    }
}
