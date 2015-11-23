<?php

class ThemeHouse_CreateResForum_Listener_TemplatePostRender extends ThemeHouse_Listener_TemplatePostRender
{

    protected function _getTemplates()
    {
        return array(
            'forum_view',
            'th_social_category_view_socialgroups'
        );
    } /* END _getTemplates */

    public static function templatePostRender($templateName, &$content, array &$containerData, XenForo_Template_Abstract $template)
    {
        $templatePostRender = new ThemeHouse_CreateResForum_Listener_TemplatePostRender($templateName, $content, $containerData, $template);
        list($content, $containerData) = $templatePostRender->run();
    } /* END templatePostRender */

    protected function _forumView()
    {
        $viewParams = $this->_fetchViewParams();

        if (!empty($viewParams['resourceCategory']) || !empty($viewParams['resourceCategories'])) {
            if (!empty($this->_containerData['topctrl'])) {
                $this->_appendTemplate('th_forum_view_topctrl_createresforum', $viewParams,
                    $this->_containerData['topctrl']);
            } else {
                $this->_containerData['topctrl'] = $this->_render('th_forum_view_topctrl_createresforum');
            }
        }
    } /* END _forumView */

    protected function _thSocialCategoryViewSocialgroups()
    {
        $this->_forumView();
    } /* END _thSocialCategoryViewSocialgroups */
}