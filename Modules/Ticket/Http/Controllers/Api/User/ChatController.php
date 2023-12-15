<?php
/**
 * @package ChatController
 * @author TechVillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 30-04-2023
 */

namespace Modules\Ticket\Http\Controllers\Api\User;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Ticket\Http\Requests\MessageRequest;

class ChatController extends Controller
{
    /**
     * Instance of chat class
     *
     * @var \Modules\Ticket\Http\Controllers\ChatController
     */
    protected $userChat;

    public function __construct()
    {
        $this->userChat = new \Modules\Ticket\Http\Controllers\ChatController();
    }

    /**
     * create chat
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createChat(Request $request)
    {
        return $this->userChat->createChat($request);
    }


    /**
     * Return the chat conversations
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getConversations(Request $request)
    {
        return $this->userChat->getConversations($request);
    }


    /**
     * Store chat message
     * @param MessageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeMessage(MessageRequest $request)
    {
        return $this->userChat->storeMessage($request);
    }


    /**
     * Returns updated inbox
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function inboxRefresh(Request $request)
    {
        return $this->userChat->inboxRefresh($request);
    }



    /**
     * Send product details to vendor
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendProductDetails(Request $request)
    {
        return $this->userChat->sendProductDetails($request);
    }


    /**
     * Initiates chat with vendor
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function initiateChatWithVendor(Request $request)
    {
        return $this->userChat->initiateChatWithVendor($request);
    }
}
