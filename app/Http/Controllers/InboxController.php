<?php

namespace App\Http\Controllers;

use App\Message;
use App\Repositories\MessageRepository;
use Illuminate\Http\Request;
use Auth;

class InboxController extends Controller
{

    /**
     * @var MessageRepository
     */
    protected $message;
    /**
     * InboxController constructor.
     */
    public function __construct(MessageRepository $message)
    {
        $this->middleware('auth');
        $this->message = $message;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $messages = $this->message->getAllMessages();
        return view('inbox.index',['messages' => $messages->groupBy('dialog_id')]);
    }

    /**
     * @param $dialogId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($dialogId)
    {
        $messages = $this->message->getDialogMessagesBy($dialogId);
        $messages->markAsRead();
        return view('inbox.show',['messages' => $messages,'dialogId' => $dialogId]);
    }

    /**
     * @param $dialogId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($dialogId)
    {
        $message = $this->message->getSingleMessageBy($dialogId);
        $toUserId = $message->from_user_id === user()->id ? $message->to_user_id : $message->from_user_id;
        $this->message->create([
            'from_user_id' => user()->id,
            'to_user_id' => $toUserId,
            'body' => \request('body'),
            'dialog_id' => $dialogId
        ]);

        return back();
    }
}