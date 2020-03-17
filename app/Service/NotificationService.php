<?php

namespace App\Service;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;
use Auth;
use App\Mail\RequestArchiveRewardMemberMail;
use App\Mail\RequestArchiveRewardAdminMail;
use App\Rank;
use App\Mail\AccApproveRewardMail;
use Illuminate\Support\Facades\DB;
use App\models\GotReward;
use App\Employeer;
use App\Mail\UpRankMemberMail;
use App\Mail\UpRankAdminMail;

class NotificationService extends Notification
{
    public static function getNotification(){
        $notification = self::with('user')->where('isRead',0)->orderBy('created_at', 'desc')->paginate(5);
        return $notification;
    }

    public function readNotif($id){
        self::where('id',$id)->update(
            array('isRead' => 1)
        );
    }

    public static function getTotalNotif(){
        $notification = self::with('user')->where('isRead',0)->orderBy('created_at', 'desc')->get()->count();
        return $notification;
    }

    public static function getData(){
        $notification = self::with(['user' => function($q)
                                        {
                                            $q->select(['id','username']);
                                        }
                                    ]
                            )->orderBy('notification.created_at', 'desc')
                            ->select(['notification.id','desc','member_id', 'notification.created_at', 'isRead']);
        return $notification;
    }

    public function store($data, $description, $nominal){
        self::insert($data);

        $dataEmail = (object) [
            'description' => 'Selamat anda telah melakukan klaim reward, mohon menunggu approval dari pihak bitrexgo dan customer service bitrexgo akan menghubungi anda',
        ];
        if (filter_var(Auth::user()->email, FILTER_VALIDATE_EMAIL)) {
            Mail::to(Auth::user()->email)->send(new RequestArchiveRewardMemberMail($dataEmail));
        }

        $rank = Rank::where('id', Auth::user()->rank_id)->first();

        $dataEmailAdm = (object) [
            'description' => $description,
            'nominal' => $nominal,
            'rank'  => $rank->name,
            'username' => Auth::user()->username,
        ];

        Mail::to('cs@bitrexgo.co.id ')->send(new RequestArchiveRewardAdminMail($dataEmailAdm));

        return;
    }

    public function sendEmail($reward)
    {
        $dataEmail = (object) [
            'description' => 'Congratulations '.$reward->member->username,
            'nominal' => 'anda telah mendapatkan reward '. $reward->reward->description,
        ];
        Mail::to($reward->member->email)->cc('cs@bitrexgo.co.id ')->send(new AccApproveRewardMail($dataEmail));
        return;
    }

    public function sendEmailRank()
    {
        $notif = Notification::where('type',1)->with('user')->where('send_email',0)->first();

        if (isset($notif)) {

            $rank = Rank::where('id', $notif->user->rank_id)->first();
            $reward = GotReward::where('member_id', $notif->user->id)->with('reward')->orderBy('id','desc')->first();

            $dataEmail = (object) [
                'description' => 'Anda telah naik peringkat tetap semangat untuk mencari downline agar anda bisa naik ke peringkat selanjutnya',
            ];
            Mail::to($notif->user->email)->send(new UpRankMemberMail($dataEmail));

            $email = (object) [
                'username' => $notif->user->username,
                'rank'     => $rank->name,
                'reward'   => $reward->reward->description
            ];
            Mail::to('cs@bitrexgo.co.id')->send(new UpRankAdminMail($email));

            self::findOrFail($notif->id)->update([
                'send_email' => 1
            ]);
        }
    }
}
