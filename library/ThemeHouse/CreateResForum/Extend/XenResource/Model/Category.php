<?php

/**
 *
 * @see XenResource_Model_Category
 */
class ThemeHouse_CreateResForum_Extend_XenResource_Model_Category extends XFCP_ThemeHouse_CreateResForum_Extend_XenResource_Model_Category
{

    public function getCategoriesForThreadNodeId($threadNodeId)
    {
        return $this->fetchAllKeyed(
            '
			SELECT resource_category.*
			FROM xf_resource_category AS resource_category
            WHERE thread_node_id = ?
			ORDER BY resource_category.lft
		', 'resource_category_id', $threadNodeId);
    } /* END getCategoriesForThreadNodeId */
}