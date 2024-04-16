<?php

namespace App\Http\Controllers;

use App\Http\Requests\InviteRequest;
use App\Jobs\SendInvite;
use App\Models\Invite;

class InviteController extends Controller
{
    public function invite(InviteRequest $request)
    {
        $invite = $this->store($request);
        SendInvite::dispatch($invite);

        return response()->json($this->toArray());
    }

    public function store(InviteRequest $request): Invite
    {
        $invitedUserId = $request->input('invitedUserId');
        $invitedChatId = $request->input('invitedChatId');

        return Invite::create([
            'text' => $this->getInviteText(),
            'user_id' => $invitedUserId,
            'chat_id' => $invitedChatId,
            'is_invite' => true,
        ]);
    }

    private function getInviteText(): string
    {
        $user = auth()->user();

        return sprintf('You are invited by the %s user to a chat.', $user['name']);
    }

    public function toArray(): array
    {
        return [
            'success' => true,
            'message' => 'Invite created and sent.',
        ];
    }
}
