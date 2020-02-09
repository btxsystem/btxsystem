<li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="livicon" data-name="bell" data-loop="true" data-color="#e9573f"
           data-hovercolor="#e9573f" data-size="28"></i>
        <span class="label label-warning">{{getJmlNotif() < 100 ? getJmlNotif() : '99+'}}</span>
    </a>
    <ul class="notifications dropdown-menu drop_notify">
        <li class="dropdown-title">You have {{getJmlNotif() < 100 ? getJmlNotif() : '99+'}} notifications</li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
                @foreach (getNotif() as $item)
                    <li>
                        <i class="livicon danger" data-n="timer" data-s="20" data-c="white"
                        data-hc="white"></i>
                        <br>
                        <strong>{{$item->user->username}}</strong> {{$item->desc}}
                        <small class="pull-right">
                            <span class="livicon paddingright_10" data-n="timer" data-s="10"></span>
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
                    </li>
                @endforeach
            </ul>
        </li>
        <li class="footer">
            <a href="/backoffice/notification">View all</a>
        </li>
    </ul>
</li>
