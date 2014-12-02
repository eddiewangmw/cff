<?php

/*

@name			    Event Date
@since			    1.0.0
@author			    Pavel Richter <pavel@grandpixels.com>
@copyright		    Copyright (c) 2014, Grand Pixels

*/

$date						= gp_meta('gp_event_date');
$date_timestamp				= strtotime($date);
$date_day					= date('d', $date_timestamp);
$date_month					= date('m', $date_timestamp);
$date_year					= date('Y', $date_timestamp);

$date_end       			= gp_meta('gp_event_date_end');
$date_end_timestamp	        = strtotime($date_end);
$date_end_day			    = date('d', $date_end_timestamp);
$date_end_month				= date('m', $date_end_timestamp);
$date_end_year				= date('Y', $date_end_timestamp);

// Date Delimiter
if (gp_option('gp_date_format')) {
    $date_delimiter			= gp_option('gp_date_delimiter');
} else {
    $date_delimiter			= '/';
}

// Date Format
if (gp_option('gp_date_format') == 'd m Y') {

    // 01 02 2000
    $date_full				= $date_day . $date_delimiter . $date_month . $date_delimiter . $date_year;
    $date_end_full		    = $date_end_day . $date_delimiter . $date_end_month . $date_delimiter . $date_end_year;

} else if (gp_option('gp_date_format') == 'm d Y') {

    // 02 01 2000
    $date_full				= $date_month . $date_delimiter . $date_day . $date_delimiter . $date_year;
    $date_end_full		    = $date_end_month . $date_delimiter . $date_end_day . $date_delimiter . $date_end_year;


} else if (gp_option('gp_date_format') == 'Y m d') {

    // 2000 02 01
    $date_full				= $date_year . $date_delimiter . $date_month . $date_delimiter . $date_day;
    $date_end_full          = $date_end_year . $date_delimiter . $date_end_month . $date_delimiter . $date_end_day;

} else if (gp_option('gp_date_format') == 'Y d m') {

    // 2000 01 02
    $date_full				= $date_year . $date_delimiter . $date_month . $date_delimiter . $date_day;
    $date_end_full		    = $date_end_year . $date_delimiter . $date_end_month . $date_delimiter . $date_end_day;

} else if (gp_option('gp_date_format') == 'l, j m Y') {

    // Monday, 01 02 2000
    $date_day_name			= date('l', $date_timestamp);
    $date_day   			= date('j', $date_timestamp);
    $date_month				= date('m', $date_timestamp);
    $date_year				= date('Y', $date_timestamp);

    $date_end_day_name	    = date('l', $date_end_timestamp);
    $date_end_day		    = date('j', $date_end_timestamp);
    $date_end_month			= date('m', $date_end_timestamp);
    $date_end_year			= date('Y', $date_end_timestamp);

    switch($date_day_name) {

        case 'Monday':
            $date_day_name  = __('Monday', 'gp');
            break;
        case 'Tuesday':
            $date_day_name  = __('Tuesday', 'gp');
            break;
        case 'Wednesday':
            $date_day_name  = __('Wednesday', 'gp');
            break;
        case 'Thursday':
            $date_day_name  = __('Thursday', 'gp');
            break;
        case 'Friday':
            $date_day_name  = __('Friday', 'gp');
            break;
        case 'Saturday':
            $date_day_name  = __('Saturday', 'gp');
            break;
        case 'Sunday':
            $date_day_name  = __('Sunday', 'gp');
            break;
        default:
            $date_day_name  = '';
            break;

    }

    switch($date_end_day_name) {

        case 'Monday':
            $date_end_day_name      = __('Monday', 'gp');
            break;
        case 'Tuesday':
            $date_end_day_name      = __('Tuesday', 'gp');
            break;
        case 'Wednesday':
            $date_end_day_name      = __('Wednesday', 'gp');
            break;
        case 'Thursday':
            $date_end_day_name      = __('Thursday', 'gp');
            break;
        case 'Friday':
            $date_end_day_name      = __('Friday', 'gp');
            break;
        case 'Saturday':
            $date_end_day_name      = __('Saturday', 'gp');
            break;
        case 'Sunday':
            $date_end_day_name      = __('Sunday', 'gp');
            break;
        default:
            $date_end_day_name      = '';
            break;

    }

    $date_full				= $date_day_name . ', ' . $date_day . $date_delimiter . $date_month . $date_delimiter . $date_year;
    $date_end_full		    = $date_end_day_name . ', ' . $date_end_day . $date_delimiter . $date_end_month . $date_delimiter . $date_end_year;

} else if (gp_option('gp_date_format') == 'F j, Y') {

    // January 1, 2000
    $date_day				= date('j', $date_timestamp);
    $date_month				= date('F', $date_timestamp);
    $date_year				= date('Y', $date_timestamp);

    $date_end_day		    = date('j', $date_end_timestamp);
    $date_end_month			= date('F', $date_end_timestamp);
    $date_end_year			= date('Y', $date_end_timestamp);

    switch($date_month) {

        case 'January':
            $date_month		= __('January', 'gp');
            break;
        case 'February':
            $date_month		= __('February', 'gp');
            break;
        case 'March':
            $date_month		= __('March', 'gp');
            break;
        case 'April':
            $date_month		= __('April', 'gp');
            break;
        case 'May':
            $date_month		= __('May', 'gp');
            break;
        case 'June':
            $date_month		= __('June', 'gp');
            break;
        case 'July':
            $date_month		= __('July', 'gp');
            break;
        case 'August':
            $date_month		= __('August', 'gp');
            break;
        case 'September':
            $date_month		= __('September', 'gp');
            break;
        case 'October':
            $date_month		= __('October', 'gp');
            break;
        case 'November':
            $date_month		= __('November', 'gp');
            break;
        case 'December':
            $date_month		= __('December', 'gp');
            break;
        default:
            $date_month		= '';
            break;

    }

    switch($date_end_month) {

        case 'January':
            $date_end_month = __('January', 'gp');
            break;
        case 'February':
            $date_end_month = __('February', 'gp');
            break;
        case 'March':
            $date_end_month = __('March', 'gp');
            break;
        case 'April':
            $date_end_month = __('April', 'gp');
            break;
        case 'May':
            $date_end_month = __('May', 'gp');
            break;
        case 'June':
            $date_end_month = __('June', 'gp');
            break;
        case 'July':
            $date_end_month = __('July', 'gp');
            break;
        case 'August':
            $date_end_month = __('August', 'gp');
            break;
        case 'September':
            $date_end_month = __('September', 'gp');
            break;
        case 'October':
            $date_end_month = __('October', 'gp');
            break;
        case 'November':
            $date_end_month = __('November', 'gp');
            break;
        case 'December':
            $date_end_month = __('December', 'gp');
            break;
        default:
            $date_end_month = '';
            break;

    }

    $date_full				= $date_month . ' ' . $date_day . ', ' . $date_year;
    $date_end_full			= $date_end_month . ' ' . $date_end_day . ', ' . $date_end_year;

} else if (gp_option('gp_date_format') == 'j M, Y') {

    // 1 Jan, 2000
    $date_day				= date('j', $date_timestamp);
    $date_month				= date('M', $date_timestamp);
    $date_year				= date('Y', $date_timestamp);

    $date_end_day		    = date('j', $date_end_timestamp);
    $date_end_month			= date('M', $date_end_timestamp);
    $date_end_year			= date('Y', $date_end_timestamp);

    switch($date_month) {

        case 'Jan':
            $date_month		= __('Jan', 'gp');
            break;
        case 'Feb':
            $date_month		= __('Feb', 'gp');
            break;
        case 'Mar':
            $date_month		= __('Mar', 'gp');
            break;
        case 'Apr':
            $date_month		= __('Apr', 'gp');
            break;
        case 'May':
            $date_month		= __('May', 'gp');
            break;
        case 'Jun':
            $date_month		= __('Jun', 'gp');
            break;
        case 'Jul':
            $date_month		= __('Jul', 'gp');
            break;
        case 'Aug':
            $date_month		= __('Aug', 'gp');
            break;
        case 'Sep':
            $date_month		= __('Sep', 'gp');
            break;
        case 'Oct':
            $date_month		= __('Oct', 'gp');
            break;
        case 'Nov':
            $date_month		= __('Nov', 'gp');
            break;
        case 'Dec':
            $date_month		= __('Dec', 'gp');
            break;
        default:
            $date_month		= '';
            break;

    }

    switch($date_end_month) {

        case 'Jan':
            $date_end_month = __('Jan', 'gp');
            break;
        case 'Feb':
            $date_end_month = __('Feb', 'gp');
            break;
        case 'Mar':
            $date_end_month = __('Mar', 'gp');
            break;
        case 'Apr':
            $date_end_month = __('Apr', 'gp');
            break;
        case 'May':
            $date_end_month = __('May', 'gp');
            break;
        case 'Jun':
            $date_end_month = __('Jun', 'gp');
            break;
        case 'Jul':
            $date_end_month = __('Jul', 'gp');
            break;
        case 'Aug':
            $date_end_month = __('Aug', 'gp');
            break;
        case 'Sep':
            $date_end_month = __('Sep', 'gp');
            break;
        case 'Oct':
            $date_end_month = __('Oct', 'gp');
            break;
        case 'Nov':
            $date_end_month = __('Nov', 'gp');
            break;
        case 'Dec':
            $date_end_month = __('Dec', 'gp');
            break;
        default:
            $date_end_month = '';
            break;

    }

    $date_full				= $date_day . ' ' . $date_month . ', ' . $date_year;
    $date_end_full			= $date_end_day . ' ' . $date_end_month . ', ' . $date_end_year;

} else {

    // Default // 01 02 2000
    $date_full				= $date_day . $date_delimiter . $date_month . $date_delimiter . $date_year;
    $date_end_full  		= $date_end_day . $date_delimiter . $date_end_month . $date_delimiter . $date_end_year;

}

if (!empty($date) && !empty($date_end)) {

    if ($date == $date_end) {
        echo $date_full;
    } else {
        echo $date_full . ' - ' . $date_end_full;
    }

} else if (!empty($date)) {

    echo $date_full;

}