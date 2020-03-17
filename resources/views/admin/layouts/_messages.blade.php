<li class="dropdown messages-menu" id="message">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="livicon" data-name="message-flag" data-loop="true" data-color="#42aaca" data-hovercolor="#42aaca" data-size="28"></i>
            <span class="label label-success">{{getJmlNotif() < 100 ? getJmlNotif() : '99+'}}</span>
        </a>
        <ul class="dropdown-menu dropdown-messages pull-right">
            <li class="dropdown-title">{{getJmlNotif() < 100 ? getJmlNotif() : '99+'}} New Messages</li>
            @foreach (getNotif() as $item)
                    <li class="unread message">
                        <a href="/backoffice/readChat" class="message"> <i class="pull-right" data-toggle="tooltip" data-placement="top" title="Mark as Read"><span class="pull-right ol livicon" data-n="adjust" data-s="10" data-c="#287b0b"></span></i>
                            <div class="message-body">
                                <strong>{{$item->user->username}}</strong>
                                <br>{{$item->title}}
                                <br>
                                <small>
                                    @php
                                        $date = date_diff($item->created_at,now());
                                        if ($date->d > 3) {
                                            echo "more than 3 days ago";
                                        }elseif ($date->d <= 3 and $date->d > 0) {
                                            echo $date->d."days ago";
                                        }elseif ($date->d <= 0 and $date->h > 0) {
                                            echo $date->h."hours ago";
                                        }else{
                                            echo $date->i."minutes ago";
                                        }
                                    @endphp
                                </small>
                            </div>
                        </a>
                    </li>
            @endforeach
            <li class="footer">
                <a href="#">View all</a>
            </li>
        </ul>
</li>
