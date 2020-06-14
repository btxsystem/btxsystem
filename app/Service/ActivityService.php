<?php
namespace App\Service;

use DB;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityService
{
 
  public $actionCode = '000';

  public $actionName;

  public $actionFrom;

  public $status = true;

  public $userAgent = null;

  public $ipAddress = null;

  public function __construct()
  {
    $this->userAgent = \Request::header('User-Agent');
    $this->ipAddress = \Request::getClientIp(true);
  }

  public function record()
  {
    $activity = ActivityLog::insert([
      'action_code' => $this->actionCode,
      'action_name' => $this->actionName,
      'action_from' => $this->actionFrom,
      'user_agent' => $this->userAgent,
      'ip_address' => $this->ipAddress,
      'status' => $this->status,
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s'),
    ]);

    return $activity;
  }

  public function setActivity()
  {
    return $this;
  }

  public function setStatus($status)
  {
    $this->status = $status;
    return $this;
  }

  public function setCode($code)
  {
    $this->actionCode = $code;
    return $this;
  }

  public function setName($name)
  {
    $this->actionName = $name;
    return $this;
  }

  public function setFrom($from)
  {
    $this->actionFrom = $from;
    return $this;
  }

}