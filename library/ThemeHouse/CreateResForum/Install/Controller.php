<?php

class ThemeHouse_CreateResForum_Install_Controller extends ThemeHouse_Install
{

    protected $_resourceManagerUrl = 'http://xenforo.com/community/resources/create-resource-from-forum.2862/';

    protected function _getPrerequisites()
    {
        return array(
            'XenResource' => '1010000'
        );
    } /* END _getPrerequisites */
}