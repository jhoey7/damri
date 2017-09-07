<?php

if (!function_exists('element'))
{
    function flashdata(){
        return flashdata_notification().flashdata_alert().flashdata_error();
    }

    function flashdata_notification()
    {
        $CI = & get_instance();
        return $CI->session->flashdata('notification') != NULL ?
                '<div class="notification">'
                . $CI->session->flashdata('notification')
                . '</div>' : '';
    }

    function flashdata_alert()
    {
        $CI = & get_instance();
        return $CI->session->flashdata('alert') != NULL ?
                '<div class="alert">'
                . $CI->session->flashdata('alert')
                . '</div>' : '';
    }

    function flashdata_error()
    {
        $CI = & get_instance();
        return $CI->session->flashdata('error') != NULL ?
                '<div class="error">'
                . $CI->session->flashdata('error')
                . '</div>' : '';
    }

}