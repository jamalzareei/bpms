<?php
$userComposer = auth()->user();
$notifications = \App\Models\Notification::where('user_id', auth()->id())->whereNull('readed_at')->with('user')->latest()->paginate(5);
?>
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
      <div class="bookmark-wrapper d-flex align-items-center">
        <ul class="nav navbar-nav d-xl-none">
          <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
        </ul>
        <ul class="nav navbar-nav bookmark-icons">
          <li class="nav-item d-none d-lg-block">
            <a class="btn btn-primary" href="{{ route('pages.pi.create') }}" data-toggle="tooltip" data-placement="top" title="Email">
              Add PI
            </a>
          </li>
        </ul>
        <ul class="nav navbar-nav">
          {{-- <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i class="ficon text-warning" data-feather="star"></i></a>
            <div class="bookmark-input search-input">
              <div class="bookmark-input-icon"><i data-feather="search"></i></div>
              <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0" data-search="search">
              <ul class="search-list search-list-bookmark"></ul>
            </div>
          </li> --}}
        </ul>
      </div>
      <ul class="nav navbar-nav align-items-center ml-auto">
        {{-- <li class="nav-item dropdown dropdown-language"><a class="nav-link dropdown-toggle" id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span class="selected-language">English</span></a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="javascript:void(0);" data-language="en"><i class="flag-icon flag-icon-us"></i> English</a><a class="dropdown-item" href="javascript:void(0);" data-language="fr"><i class="flag-icon flag-icon-fr"></i> French</a><a class="dropdown-item" href="javascript:void(0);" data-language="de"><i class="flag-icon flag-icon-de"></i> German</a><a class="dropdown-item" href="javascript:void(0);" data-language="pt"><i class="flag-icon flag-icon-pt"></i> Portuguese</a></div>
        </li> --}}
        {{-- <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
        <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>
          <div class="search-input">
            <div class="search-input-icon"><i data-feather="search"></i></div>
            <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="-1" data-search="search">
            <div class="search-input-close"><i data-feather="x"></i></div>
            <ul class="search-list search-list-main"></ul>
          </div>
        </li> --}}
        
        <li class="nav-item dropdown dropdown-notification mr-25"><a class="nav-link" href="javascript:void(0);" data-toggle="dropdown">
          <i class="ficon" data-feather="bell"></i><span class="badge badge-pill badge-danger badge-up">{{$notifications->total()}}</span></a>
          <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
            <li class="dropdown-menu-header">
              <div class="dropdown-header d-flex">
                <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                <div class="badge badge-pill badge-light-info">{{$notifications->total()}} New</div>
              </div>
            </li>
            <li class="scrollable-container media-list">
              @forelse ($notifications as $not)
                <a class="d-flex" href="javascript:void(0)">
                  <div class="media d-flex align-items-start">
                    <div class="media-left">
                      <div class="avatar"><img src="https://ui-avatars.com/api/?name={{$not->user->name}}&background=00bfd6" alt="avatar" width="32" height="32"></div>
                    </div>
                    <div class="media-body">
                      <strong class="w-100">{{$not->title}}</strong>
                      <br>
                      <small class="w-100 text-muted font-small-1"> {{$not->message}}</small>
                    </div>
                    <div class="media-right">
                        <span class="custom-control- custom-switch  custom-switch-success mr-2 mb-1" title="read">
                          <input type="checkbox" class="custom-control-input" name="actived_at" id="checkbox{{$not->id}}" {{ $not->readed_at ? 'checked' : ''}} onchange="changeStatus('{{route('pages.notification.change.status', ['id'=>$not->id])}}', this)">
                          <label class="custom-control-label" for="checkbox{{$not->id}}">
                              <span class="switch-text-left">✔</span>
                              <span class="switch-text-right">✘</span>
                          </label>
                      </span>
                    </div>
                  </div>
                </a>
              @empty
                  
              @endforelse
                
            </li>
            {{-- <li class="dropdown-menu-footer"><a class="btn btn-info btn-block" href="javascript:void(0)">Read all notifications</a></li> --}}
          </ul>
        </li>
        <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">{{$userComposer->name ?? ''}}</span><span class="user-status"></span></div><span class="avatar"><img class="round" src="https://ui-avatars.com/api/?name={{$userComposer->name ?? ''}}&background=00bfd6" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span></a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
            {{-- <a class="dropdown-item" href="page-profile.html"><i class="mr-50" data-feather="user"></i> Profile</a>
            <a class="dropdown-item" href="app-email.html"><i class="mr-50" data-feather="mail"></i> Inbox</a>
            <a class="dropdown-item" href="app-todo.html"><i class="mr-50" data-feather="check-square"></i> Task</a>
            <a class="dropdown-item" href="app-chat.html"><i class="mr-50" data-feather="message-square"></i> Chats</a> --}}
            {{-- <a class="dropdown-item" href="page-account-settings.html"><i class="mr-50" data-feather="settings"></i> Settings</a>
            <a class="dropdown-item" href="page-pricing.html"><i class="mr-50" data-feather="credit-card"></i> Pricing</a>
            <a class="dropdown-item" href="page-faq.html"><i class="mr-50" data-feather="help-circle"></i> FAQ</a> --}}
            {{-- <div class="dropdown-divider"></div> --}}
            <a class="dropdown-item" href="{{ route('log.out') }}"><i class="mr-50" data-feather="power"></i> Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  