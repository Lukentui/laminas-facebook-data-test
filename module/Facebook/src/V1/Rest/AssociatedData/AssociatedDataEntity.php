<?php
namespace Facebook\V1\Rest\AssociatedData;

class AssociatedDataEntity
{
    private $fb;

    function __construct($access_token) {
        $this->fb = new \Facebook\Facebook([
            'app_id' => '743594913051145',
            'app_secret' => 'e576a9dec21f61561fdff5f82be5fc64',
            'default_graph_version' => 'v7.0',
            'default_access_token' => $access_token,
        ]);
    }

    public function getAssociatedData() {
        $me = $this->getMe();
        $accounts = $this->getAccountsList();

        $instagramAccounts = [];

        foreach ($accounts['data'] as $account) {
            array_push($instagramAccounts, $this->getInstagramAccountInfo($account['connected_instagram_account']['id']));
        }

        return [
            'user' => [
                'name' => $me->getName(),
                'picture' => $me->getPicture()->getUrl(),
            ],

            'instagram_accounts' => $instagramAccounts,
        ];
    }

    private function getMe() {
        return $this->fb->get('/me?fields=picture{url},name')->getGraphUser();
    }

    private function getAccountsList() {
        return $this->fb->get('/me/accounts?fields=connected_instagram_account')->getDecodedBody();
    }

    private function getInstagramAccountInfo($id) {
        $igInfo = $this->fb->get("/$id?fields=name,username,followers_count,follows_count,biography,media.limit(3)")->getDecodedBody();
        $mediaList = [];

        foreach ($igInfo['media']['data'] as $media) {
            array_push($mediaList, $this->getInstagramMedia($media['id']));
        }
        $igInfo['media'] = $mediaList;

        return $igInfo;
    }

    private function getInstagramMedia($id) {
        return $this->fb->get("/$id?fields=caption,media_url,like_count,comments_count")->getDecodedBody();
    }
}
