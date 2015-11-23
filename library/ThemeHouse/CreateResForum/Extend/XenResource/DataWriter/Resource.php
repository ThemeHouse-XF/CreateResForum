<?php

/**
 *
 * @see XenResource_DataWriter_Resource
 */
class ThemeHouse_CreateResForum_Extend_XenResource_DataWriter_Resource extends XFCP_ThemeHouse_CreateResForum_Extend_XenResource_DataWriter_Resource
{

    /**
     *
     * @see XenForo_DataWriter::getMergedData()
     */
    protected function _postSave()
    {
        if (!isset($GLOBALS['XenResource_DataWriter_Resource'])) {
            $GLOBALS['XenResource_DataWriter_Resource'] = $this;
        }

        return parent::_postSave();
    } /* END _postSave */
}