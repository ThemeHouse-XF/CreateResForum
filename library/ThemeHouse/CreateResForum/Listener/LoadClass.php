<?php

class ThemeHouse_CreateResForum_Listener_LoadClass extends ThemeHouse_Listener_LoadClass
{

    protected function _getExtendedClasses()
    {
        return array(
            'ThemeHouse_CreateResForum' => array(
                'controller' => array(
                    'XenForo_ControllerPublic_Forum',
                    'XenResource_ControllerPublic_Resource',
                    'ThemeHouse_SocialGroups_ControllerPublic_SocialCategory'
                ), /* END 'controller' */
                'model' => array(
                    'XenResource_Model_Category'
                ), /* END 'model' */
                'datawriter' => array(
                    'XenResource_DataWriter_Resource'
                ), /* END 'datawriter' */
            ), /* END 'ThemeHouse_CreateResForum' */
        );
    } /* END _getExtendedClasses */

    public static function loadClassController($class, array &$extend)
    {
        $loadClassController = new ThemeHouse_CreateResForum_Listener_LoadClass($class, $extend, 'controller');
        $extend = $loadClassController->run();
    } /* END loadClassController */

    public static function loadClassModel($class, array &$extend)
    {
        $loadClassModel = new ThemeHouse_CreateResForum_Listener_LoadClass($class, $extend, 'model');
        $extend = $loadClassModel->run();
    } /* END loadClassModel */

    public static function loadClassDataWriter($class, array &$extend)
    {
        $loadClassDataWriter = new ThemeHouse_CreateResForum_Listener_LoadClass($class, $extend, 'datawriter');
        $extend = $loadClassDataWriter->run();
    } /* END loadClassDataWriter */
}