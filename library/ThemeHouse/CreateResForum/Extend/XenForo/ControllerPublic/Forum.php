<?php

/**
 *
 * @see XenForo_ControllerPublic_Forum
 */
class ThemeHouse_CreateResForum_Extend_XenForo_ControllerPublic_Forum extends XFCP_ThemeHouse_CreateResForum_Extend_XenForo_ControllerPublic_Forum
{

    /**
     *
     * @see XenForo_ControllerPublic_Forum::actionForum()
     */
    public function actionForum()
    {
        $response = parent::actionForum();

        if ($response instanceof XenForo_ControllerResponse_View) {
            $forum = $response->params['forum'];

            /* @var $resourceCategoryModel XenResource_Model_Category */
            $resourceCategoryModel = $this->getModelFromCache('XenResource_Model_Category');

            $categories = $resourceCategoryModel->getCategoriesForThreadNodeId($forum['node_id']);

            foreach ($categories as $resourceCategoryId => $category) {
                if (!$resourceCategoryModel->canAddResource($category)) {
                    unset($categories[$resourceCategoryId]);
                }
            }

            if (count($categories) == 1) {
                $resourceCategory = reset($categories);
                $response->params['resourceCategory'] = $resourceCategory;
                $response->params['resourceAddParams'] = array(
                    'resource_category_id' => $resourceCategory['resource_category_id'],
                    'redirect_to_thread' => 1
                );
            } else {
                $response->params['resourceCategories'] = $categories;
                $response->params['resourceAddParams'] = array(
                    'thread_node_id' => $forum['node_id']
                );
            }
        }

        return $response;
    } /* END actionForum */
}