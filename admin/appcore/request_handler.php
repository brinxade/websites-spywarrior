<?php

require_once 'config.php';
require_once CLIENT_HANDLER;
require_once DB_HANDLER;

if(!empty($_POST['_request']))
    $request_handler=new RequestHandler($_POST['_request']);
else
    echo "No request posted";

class RequestHandler
{
    private static $_requests_=array(
        'pPrayerRequest'=>array('id'=>'pPrayerRequest','name'=>'Send Prayer Request','authType'=>0),
        'pComment'=>array('id'=>'pComment','name'=>'Put Comment','authType'=>0),
        'gComments'=>array('id'=>'gComments','name'=>'Get Comments','authType'=>1),
        'gEventData'=>array('id'=>'gEventData','name'=>'Get Event Data','authType'=>0),
        'dEventData'=>array('id'=>'dEventData','name'=>'Delete Event Data','authType'=>1),
        'editComment'=>array('id'=>'editComment','name'=>'Edit Comment','authType'=>1),
        'gPrayerRequest'=>array('id'=>'gPrayerRequest','name'=>'Get Prayer Requests','authType'=>1),
        'gListings'=>array('id'=>'gListings','name'=>'Get Listings','authType'=>1),
        'gMovieWithComments'=>array('id'=>'gMovieWithComments','name'=>'Get Movies and associated comments','authType'=>0),
        'gMiniGallery'=>array('id'=>'gMiniGallery', 'name'=>'Get Mini Gallery Content', 'authType'=>0),
        'dListings'=>array('id'=>'dListings', 'name'=>'Delete Listing', 'authType'=>1),
        'replyToPrayer'=>array('id'=>'replyToPrayer', 'name'=>'Reply to Prayer Request', 'authType'=>1)
    );

    private $_response=['response'=>'','ok'=>'1','data'=>'','errors'=>array()];

    function __construct($_r)
    {
        $_request=$_r;
        if(!empty($_POST['_data']))
            $this::$_requests_[$_request]['data']=$_POST['_data'];
        else
            $this::$_requests_[$_request]['data']=NULL;

        if(array_key_exists($_request, $this::$_requests_))
        {
            if($this::$_requests_[$_request]['authType']==1)
            {
                $user=new User();
                if($user->logged_in)
                {
                    $this->process_request($this::$_requests_[$_request]);
                }
                else
                {
                    $this->_response['response']="Request Failed";
                    array_push($this->_response['errors'],"Authentication Required");
                    $this->_response['ok']=0;
                }
            }
            else
            {
                $this->process_request($this::$_requests_[$_request]);
            }
        }
        else
        {
            $this->_response['response']="400 - Bad Request";
            array_push($this->_response['errors'],"400 - Bad Request");
            $this->_response['ok']=0;
        }

        echo json_encode($this->_response);
    }

    function process_request($_r)
    {
        switch($_r['id'])
        {
            case 'pPrayerRequest':
                require_once RH_PRAYER_REQUEST;
                if(!is_null($this::$_requests_['pPrayerRequest']['data']))
                    $this->_response=r_putPrayerRequest($this->_response, $this::$_requests_['pPrayerRequest']['data']);
                break;

            case 'gPrayerRequest':
                require_once RH_PRAYER_REQUEST;
                if(!is_null($this::$_requests_['gPrayerRequest']['data']))
                    $this->_response=r_getPrayerRequests($this->_response, $this::$_requests_['gPrayerRequest']['data']);
                break;

            case 'gListings':
                require_once RH_LISTINGS;
                if(!is_null($this::$_requests_['gListings']['data']))
                    $this->_response=r_getListings($this->_response, $this::$_requests_['gListings']['data']);
                break;

            case 'gMiniGallery':
                require_once RH_MINI_GALLERY;
                if(!is_null($this::$_requests_['gMiniGallery']['data']))
                    $this->_response=r_getMiniGallery($this->_response, $this::$_requests_['gMiniGallery']['data']);
                break;

            case 'dListings':
                require_once RH_LISTINGS;
                if(!is_null($this::$_requests_['dListings']['data']))
                    $this->_response=r_deleteListings($this->_response, $this::$_requests_['dListings']['data']);
                break;

            case 'replyToPrayer':
                require_once RH_PRAYER_REQUEST;
                if(!is_null($this::$_requests_['replyToPrayer']['data']))
                    $this->_response=r_replyToPrayer($this->_response, $this::$_requests_['replyToPrayer']['data']);
                break;

            case 'gMovieWithComments':
                require_once RH_MOVIES;
                if(!is_null($this::$_requests_['gMovieWithComments']['data']))
                    $this->_response=r_getMoviesWithComments($this->_response, $this::$_requests_['gMovieWithComments']['data']);
                break;

            case 'gComments':
                require_once RH_COMMENTS;
                if(!is_null($this::$_requests_['gComments']['data']))
                    $this->_response=r_getComments($this->_response, $this::$_requests_['gComments']['data']);
                break;
            
            case 'editComment':
                require_once RH_COMMENTS;
                if(!is_null($this::$_requests_['editComment']['data']))
                    $this->_response=r_editComment($this->_response, $this::$_requests_['editComment']['data']);
                break;

            case 'pComment':
                require_once RH_COMMENTS;
                if(!is_null($this::$_requests_['pComment']['data']))
                    $this->_response=r_putComment($this->_response, $this::$_requests_['pComment']['data']);
                break;
            
            case 'gEventData':
                require_once RH_EVENTS;
                if(!is_null($this::$_requests_['gEventData']['data']))
                    $this->_response=r_getEventData($this->_response, $this::$_requests_['gEventData']['data']);
                break;

            case 'dEventData':
                require_once RH_EVENTS;
                if(!is_null($this::$_requests_['dEventData']['data']))
                    $this->_response=r_deleteEventData($this->_response, $this::$_requests_['dEventData']['data']);
                break;

            default:
                $this->_response['response']="Request is currently not supported";
                array_push($this->_response['errors'],"Request is currently not supported");
                $this->_response['ok']=0;
                break;
        }
    }
}

?>