<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Participants;
use DB;

class Messages extends Model
{
    //
    protected $table = "messages";
    protected $primaryKey = "m_id";

    public function getMessages($LOGGED_USER_ID, $TO_CHAT_WITH_ID)
    {
        $user_one = Messages::where(['sender_id' => $LOGGED_USER_ID, 'reciever_id' => $TO_CHAT_WITH_ID]);
        $user_two = Messages::where(['reciever_id' => $LOGGED_USER_ID, 'sender_id' => $TO_CHAT_WITH_ID]);

        return $user_one->union($user_two)->orderby('m_id', 'ASC');
    }

    public static function getMessagesForReact($LOGGED_USER_ID, $TO_CHAT_WITH_ID)
    {
        // return DB::select("
        // SELECT *, IF(messages.sender_id = '$LOGGED_USER_ID', 1, 0) as amISender FROM messages WHERE (sender_id = '$LOGGED_USER_ID' AND reciever_id = '$TO_CHAT_WITH_ID') or (sender_id = '$TO_CHAT_WITH_ID' AND reciever_id = '$LOGGED_USER_ID')
        // ", [1]);

        return DB::select("


        SELECT messages.*,participants.user_one, participants.user_two,
user_sender.name as sender_name, user_sender.profile_image as sender_profile_image,
user_rec.name as rec_name, user_rec.profile_image as rec_profile_image,
IF(messages.sender_id = '$LOGGED_USER_ID', 1, 0) as amISender,
(select count(*) from participants where chat_id = messages.chat_id AND user_one = '$LOGGED_USER_ID' ) as amIUserOne
FROM messages

LEFT JOIN users as user_sender ON user_sender.`user_id` = messages.sender_id
LEFT JOIN users as user_rec ON user_rec.user_id = messages.`reciever_id`
LEFT JOIN participants on participants.chat_id = messages.chat_id
WHERE (sender_id = '$LOGGED_USER_ID' AND reciever_id = '$TO_CHAT_WITH_ID') or (sender_id = '$TO_CHAT_WITH_ID' AND reciever_id = '$LOGGED_USER_ID')
ORDER BY m_id ASC
        ", [1]);
    }


    public static function getMessageForReact($LOGGED_USER_ID, $message_id)
    {


        return DB::select("


            SELECT messages.*,participants.user_one, participants.user_two,
    user_sender.name as sender_name, user_sender.profile_image as sender_profile_image,
    user_rec.name as rec_name, user_rec.profile_image as rec_profile_image,
    IF(messages.sender_id = '$LOGGED_USER_ID', 1, 0) as amISender,
    (select count(*) from participants where chat_id = messages.chat_id AND user_one = '$LOGGED_USER_ID' ) as amIUserOne
    FROM messages

    LEFT JOIN users as user_sender ON user_sender.`user_id` = messages.sender_id
    LEFT JOIN users as user_rec ON user_rec.user_id = messages.`reciever_id`
    LEFT JOIN participants on participants.chat_id = messages.chat_id
    WHERE m_id = '$message_id' LIMIT 1
            ", [1]);
    }

    public function checkParticipants($LOGGED_USER_ID, $TO_CHAT_WITH_USER_ID)
    {
        $user_one = Participants::where(['user_one' => $LOGGED_USER_ID, 'user_two' => $TO_CHAT_WITH_USER_ID]);
        $user_two = Participants::where(['user_two' => $LOGGED_USER_ID, 'user_one' => $TO_CHAT_WITH_USER_ID]);
        $union = $user_one->union($user_two);
        if ($union->count() > 0) {
            return $union->first();
        } else {
            return false;
        }
    }

    public function getLastMessage($chat_id)
    {
        $chats = Messages::where(['chat_id' => $chat_id]);
        return $chats;
    }

    public function getUnReadMessagesCount($chat_id, $user_id)
    {
        $chats = Messages::where(['chat_id' => $chat_id, 'reciever_id' => $user_id, 'isRead' => '0'])->count();
        return $chats;
    }

    public static function getUserOneAndTwo($user_id, $rec_id)
    {
        return DB::select("SELECT * FROM participants WHERE (user_one = '$user_id' AND user_two='$rec_id') OR (user_one = '$rec_id' AND user_two='$user_id') ", [1]);
    }
}
