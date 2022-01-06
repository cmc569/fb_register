<?php
namespace App\Services;

@session_start();

use Facebook\Facebook;
use Illuminate\Support\Facades\Log;

class FacebookService {
    private $fb, $helper, $acess_token;

    public function __construct() 
    {
        $this->fb = new Facebook([
            'app_id'                => config('facebook.app_id'),
            'app_secret'            => config('facebook.app_secret'),
            'default_graph_version' => config('facebook.app_graph_version'),
        ]);

        $this->helper = $this->fb->getRedirectLoginHelper();
    }

    /**
     * get facebook login url
     * @param  array  $permissions
     * @return string url
     */
    public function getUrl(Arrary $permissions=null):String
    {
        $permissions = $permissions ?? ['email', 'pages_messaging', 'pages_show_list', 'pages_manage_ads', 'pages_manage_engagement', 'pages_manage_metadata', 'pages_manage_posts', 'pages_read_engagement', 'pages_read_user_content'];
        return $this->helper->getLoginUrl(config('facebook.callback_url'), $permissions);
    }

    /**
     * get access token
     */
    public function getAccessToken():Void
    {
        $this->access_token = $this->helper->getAccessToken();

        if (empty($this->access_token)) {
            if ($this->helper->getError()) {
                $error_message = $this->helper->getErrorDescription().'('.$this->helper->getErrorCode().')';
            } else {
                $error_message = '未知的錯誤';
            }

            abort(400, $error_message);
        }
    }

    /**
     * get page list
     */
    public function getPages():Array
    {
        $request = $this->fb->get('me/accounts', $this->access_token);
        $body = $request->getGraphEdge();

        if (empty($body)) {
            return [];
        }

        $pages = [];
        foreach ($body as $v) {
            $pages[] = $v->asArray();
        }

        return $pages;
    }

    /**
     * subscribe a page
     */
    public function subscribe(Int $page, Int $app)
    {
        $page = $this->getPageDetail($page);
        
        $data = [];
        if (empty($page)) {
            abort(400, 'page not founded');
        } else {
            $data['page'] = $page;
        }

        $data['app']['id'] = config('facebook.app_id');
        $data['app']['secret'] = config('facebook.app_secret');

        if ($this->subscribePage($page)) {
            $data['subscribe'] = '粉絲專頁綁定完成';
        } else {
            $data['subscribe'] = '粉絲專頁綁定未完成';
        }

        if ($this->setGreeting($page)) {
            $data['say_hello'] = '招呼語設定完成';
        } else {
            $data['say_hello'] = '招呼語設定未完成';
        }

        if ($this->setGetStart($page)) {
            $data['get_start'] = '開始使用按鈕設定完成';
        } else {
            $data['get_start'] = '開始使用按鈕設定未完成';
        }
        
        return $data;
    }

    /**
     * get page detail
     */
    private function getPageDetail(Int $page_id):Array
    {
        $pages = \Session::get('pages');

        $detail = [];
        foreach ($pages as $page) {
            if ($page_id == $page['id']) {
                $detail = [
                    'id'            => $page['id'],
                    'name'          => $page['name'],
                    'access_token'  => $page['access_token'],
                ];

                break;
            }
        }

        return $detail;
    }

    /**
     * subscribe page
     */
    private function subscribePage(Array $page):Bool
    {
        $this->deletePage($page);
        $this->addPage($page);

        return true;
    }

    /**
     * unsubscribe a page
     */
    private function deletePage(Array $page):String
    {
        $cmd = 'curl -X DELETE "https://graph.facebook.com/'.config('facebook.app_graph_version').'/'.$page['id'].'/subscribed_apps?access_token='.$page['access_token'].'"';
        $json = shell_exec($cmd);

        Log::info('cmd: '.$cmd.', response: '.$json);
        return $json;
    }

    /**
     * subscribe a page
     */
    private function addPage(Array $page):Bool
    {
        $options = 'feed,conversations,messages,messaging_postbacks,messaging_optins,message_deliveries,message_reads,messaging_account_linking,messaging_referrals,message_echoes';
        $cmd = 'curl -X POST -d "subscribed_fields='.$options.'" "https://graph.facebook.com/'.config('facebook.app_graph_version').'/'.$page['id'].'/subscribed_apps?access_token='.$page['access_token'].'"';
        $json = shell_exec($cmd);

        $response = json_decode($json);
        if ($response->success) {
            Log::info('cmd: '.$cmd.', response: '.$json);
            return true;
        } else {
            Log::error('cmd: '.$cmd.', response: '.$json);
            return false;
        }
    }

    /**
     * set messenger greeting
     */
    private function setGreeting(Array $page):Bool
    {
        $cmd = 'curl -X POST -H "Content-Type: application/json" --data "{\"greeting\":[{\"locale\":\"default\",\"text\":\"Hello!\"}]}" https://graph.facebook.com/'.config('facebook.app_graph_version').'/me/messenger_profile?access_token='.$page['access_token'];
        $json = shell_exec($cmd);

        $response = json_decode($json);
        if ($response->result == 'success') {
            Log::info('cmd: '.$cmd.', response: '.$json);
            return true;
        } else {
            Log::error('cmd: '.$cmd.', response: '.$json);
            return false;
        }
    }

    /**
     * set get start button
     */
    private function setGetStart(Array $page):Bool
    {
        $cmd = 'curl -X POST -H "Content-Type: application/json" --data "{\"get_started\":{\"payload\":\"開始使用\"}}" https://graph.facebook.com/'.config('facebook.app_graph_version').'/me/messenger_profile?access_token='.$page['access_token'];
        $json = shell_exec($cmd);

        $response = json_decode($json);
        if ($response->result == 'success') {
            Log::info('cmd: '.$cmd.', response: '.$json);
            return true;
        } else {
            Log::error('cmd: '.$cmd.', response: '.$json);
            return false;
        }
    }
}
