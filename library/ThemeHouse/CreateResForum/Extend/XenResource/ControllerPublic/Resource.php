<?php

/**
 *
 * @see XenResource_ControllerPublic_Resource
 */
class ThemeHouse_CreateResForum_Extend_XenResource_ControllerPublic_Resource extends XFCP_ThemeHouse_CreateResForum_Extend_XenResource_ControllerPublic_Resource
{

    public function actionAdd()
    {
        $response = parent::actionAdd();

        if ($response instanceof XenForo_ControllerResponse_View) {
            $threadNodeId = $this->_input->filterSingle('thread_node_id', XenForo_Input::UINT);

            if ($threadNodeId && !empty($response->params['categories'])) {
                foreach ($response->params['categories'] as $resourceCategoryId => $category) {
                    if ($category['thread_node_id'] != $threadNodeId) {
                        unset($response->params['categories'][$resourceCategoryId]);
                    }
                }

                $response->params['redirectToThread'] = true;
            } else {
                $redirectToThread = $this->_input->filterSingle('redirect_to_thread', XenForo_Input::UINT);

                if ($redirectToThread) {
                    $response->params['redirectToThread'] = true;
                }
            }

            $addOns = XenForo_Application::get('addOns');
            if (!empty($addOns['ThemeHouse_SocialGroups'])) {
                $socialForumId = $this->_input->filterSingle('social_forum_id', XenForo_Input::UINT);

                if ($socialForumId) {
                    $response->params['socialForumId'] = $socialForumId;
                }
            }
        }

        return $response;
    } /* END actionAdd */

    public function actionSave()
    {
        $response = parent::actionSave();

        if ($response instanceof XenForo_ControllerResponse_Redirect) {
            $redirectToThread = $this->_input->filterSingle('redirect_to_thread', XenForo_Input::UINT);
            if ($redirectToThread && isset($GLOBALS['XenResource_DataWriter_Resource'])) {
                /* @var $resourceDw XenResource_DataWriter_Resource */
                $resourceDw = $GLOBALS['XenResource_DataWriter_Resource'];
                $resource = $resourceDw->getMergedData();

                $resourceId = $resource['resource_id'];
                $resource = $this->_getResourceModel()->getResourceById($resourceId);

                if ($resource['discussion_thread_id']) {
                    $thread = array(
                    	'title' => $resource['title'],
                        'thread_id' => $resource['discussion_thread_id']
                    );

                    return $this->responseRedirect(
                        XenForo_ControllerResponse_Redirect::SUCCESS,
                        XenForo_Link::buildPublicLink('threads', $thread)
                    );
                }
            }
        }

        return $response;
    } /* END actionSave */
}