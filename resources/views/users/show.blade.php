@extends('layouts.app')

@section('title', $user->name . ' 的个人中心')

@section('content')

  <div class="row">

    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
      <div class="card ">
        <img class="card-img-top"
             src="
             @if($user->avatar)
               {{ $user->avatar }}
             @else
               https://cdn.learnku.com/uploads/images/201709/20/1/PtDKbASVcz.png?imageView2/1/w/600/h/600
             @endif
               "
             alt="{{ $user->name }}">
        <div class="card-body">
          <h5><strong>{{ __("users.Personal Profile") }}</strong></h5>
          <p>{{ $user->introduction }} </p>
          <hr>
          <h5><strong>{{ __("users.Registered on") }}</strong></h5>
          <p>{{ $user->created_at->diffForHumans() }}</p>
        </div>
      </div>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <div class="card ">
        <div class="card-body">
          <h1 class="mb-0" style="font-size:22px;">{{ $user->name }} <small>{{ $user->email }}</small></h1>
        </div>
      </div>
      <hr>

      {{-- 用户发布的内容 --}}
      <div class="card ">
        <div class="card-body">
          <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active bg-transparent" href="#">@lang("users.User Topics")</a></li>
            <li class="nav-item"><a class="nav-link" href="#">@lang("users.User Replies")</a></li>
          </ul>
          @include('users._topics', ['topics' => $user->topics()->recent()->paginate(5)])
        </div>
      </div>

    </div>
  </div>
@stop
