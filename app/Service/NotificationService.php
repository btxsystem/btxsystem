<?php

namespace App\Service;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Auth;
use App\Mail\RequestArchiveRewardMemberMail;
use App\Mail\RequestArchiveRewardAdminMail;
use App\Rank;
use App\Mail\AccApproveRewardMail;
use App\Mail\BonusPairingMail;
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

    public function sendNotification(){
        $now = strtotime(now());
        $now = date('m-d',$now);
        $datas = Employeer::where('rank_id', '>', 3)->get();
        $data = [];
        foreach ($datas as $key => $value) {
            $birth_date = strtotime($value->birthdate);
            $birth_date = date('m-d',$birth_date);
            if ( $birth_date == $now ) {
                $data[$key]=$value;
            }
        }
        //$datas = Employeer::where('rank_id', '>', 3)->where(DB::raw('DATE_FORMAT(birthdate, "%m-%d")'),'<=',\Carbon\Carbon::today()->format('m-d'))->get();
       // dd($data);
        foreach ($data as $member) {
            self::insert([
               "title" => 'Birthdate',
               "desc" => 'ulang tahun hari ini. Jangan lupa kirimkan ucapan!',
               "isRead" => 0,
               "member_id" => $member->id,
               "type"   => 3,
               "created_at" => now(),
               "updated_at" => now(),
               "send_email" => 1,
            ]);
        }
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
                            )
                            ->where('isRead', '!=', 2)
                            ->orderBy('notification.created_at', 'desc')
                            ->select(['notification.id','desc','member_id', 'notification.created_at', 'isRead']);
        return $notification;
    }

    public function store($data, $description, $nominal){
        //self::insert($data);

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

        Mail::to('cs@bitrexgo.co.id')->send(new RequestArchiveRewardAdminMail($dataEmailAdm));

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
                'username' => $notif->user->username,
                'name' => $notif->user->first_name ?? '' . ' ' . $notif->user->last_name ?? '',
                'rank'     => $rank->name,
                'reward'   => $reward->reward->description
            ];

            if (filter_var($notif->user->email, FILTER_VALIDATE_EMAIL)) {
                Mail::to($notif->user->email)->send(new UpRankMemberMail($dataEmail));
            }

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

    //FUNCTION SEND EMAIL BONUS PAIRING
    public function sendEmailBonusPairing($idmember, $bonus_pairing) {
        $user = DB::table('employeers')->where('id',$idmember)->first();
        $dataEmail = (object) [
            'username' => $user->username,
            'nominal' => 'Rp.'. $bonus_pairing,
        ];
        Mail::to($user->email)->cc('cs@bitrexgo.co.id')->send(new BonusPairingMail($dataEmail));
        return;

    }
}
