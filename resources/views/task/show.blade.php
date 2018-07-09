@extends('layouts.default')
@section('content')
<!-- begin #content -->
<div id="content" class="content content-full-width">
    <!-- begin vertical-box -->
    <div class="vertical-box table">
      <ol class="bwizard-steps clearfix clickable" >
        <?php
        $tk=App\Models\Project_Task_attr::where('project_id','=',$data->id)->get();
         ?>
        @foreach($tk as $ts)
        <?php
        $tp=App\Models\Project_Task::where('project_id','=',$data->id)->where('task_type','=',$ts->task_level)->where('status','=',null)->count();
         ?>
          <li role="tab" aria-selected="false" @if($ts->task_type==$task_type )style="background: #00acac!important;"@endif ><span class="label">{{$ts->task_type}}</span><a href="/task/show/{{$ts->project_id}}_{{$ts->task_type}}" class="hidden-phone">
              {{App\Models\Task_attr::where('project_level','=',$data->project_type)->where('task_level','=',$ts->task_type)->first()->task_type}}
            </a><a href="/task/show/{{$ts->project_id}}_{{$ts->task_type}}" class="hidden-phone"><small><a href="/task/show/{{$ts->project_id}}_{{$ts->task_type}}">还有<b style="color:red">{{$ts->num}}</b>个任务待完成</small></a></a></li>
          @endforeach
        </ol>

    </div>
    <div class="vertical-box">
        <!-- begin vertical-box-column -->
        <div class="vertical-box-column width-250">
            <!-- begin wrapper -->
                <div class="wrapper bg-silver text-center">
                    <a  class="btn btn-success p-l-40 p-r-40 btn-sm">
                        {{$data->project_name}}
                    </a>
                </div>
                <?php
                $sum=App\Models\Project_Task::where('project_id','=',$data->id)->count();
                $complete=App\Models\Project_Task::where('project_id','=',$data->id)->where('status','=',1)->count();
                 ?>
            <!-- end wrapper -->
            <!-- begin wrapper -->
                <div class="wrapper">
                    <p><b>项目简介</b></p>
                    <ul class="nav nav-pills nav-stacked nav-sm">
                      {{$data->desction}}
                    </ul>
                    <p><b>项目进度</b></p>
                    <div class="progress progress-striped active">
                        <div class="progress-bar" style="width: {{round(($complete?$complete:'0')/($sum?$sum:'1000')*100)}}%">{{round(($complete?$complete:'0')/($sum?$sum:'1000')*100)}}%</div>
                    </div>
                    <p><b>项目开始日期</b></p>
                    <ul class="nav nav-pills nav-stacked nav-sm m-b-0">
                        <li><a style="background: #ffffff;" href="javascript:;"><i class="fa fa-fw m-r-5 fa-circle text-inverse"></i>{{$data->start_time}}</a></li>

                    </ul>
                    <p><b>项目结束日期</b></p>
                    <ul class="nav nav-pills nav-stacked nav-sm m-b-0">
                        <li><a style="background: #ffffff;" href="javascript:;"><i class="fa fa-fw m-r-5 fa-circle text-inverse"></i>{{$data->end_time}}</a></li>

                    </ul>
                    <p><b>创建人</b></p>
                    <ul class="nav nav-pills nav-stacked nav-sm m-b-0">
                        <li><a style="background: #ffffff;" href="javascript:;"><i class="fa fa-fw m-r-5 fa-circle text-inverse"></i>{{$data->create_user}}</a></li>

                    </ul>
                    <p><b>项目执行人</b></p>
                    <ul class="nav nav-pills nav-stacked nav-sm m-b-0">
                        <li><a style="background: #ffffff;" href="javascript:;"><i class="fa fa-fw m-r-5 fa-circle text-primary"></i>{{$data->exec_user}}</a></li>

                    </ul>
                    <p><b>添加经费</b></p>
                    <ul class="nav nav-pills nav-stacked nav-sm m-b-0">
                        <li><a data-toggle="modal" href="#modal-product-add_plan" class="btn btn-success p-l-40 p-r-40 btn-sm">
                            添加经费
                        </a></li>

                    </ul>
                </div>
            <!-- end wrapper -->
        </div>

        <!-- end vertical-box-column -->
        <!-- begin vertical-box-column -->
        <div class="vertical-box-column">
            <!-- begin wrapper -->
                <div class="wrapper bg-silver-lighter">
                    <!-- begin btn-toolbar -->
                    <div class="btn-toolbar">
                      <div class="btn-group">
                        <a href="/task/create/{{$data->id}}" class="btn btn-success p-l-40 p-r-40 btn-sm">
                            添加任务
                        </a>
                        <a data-toggle="modal" href="#modal-product-edit_product" class="btn btn-success p-l-40 p-r-40 btn-sm ">
                            更改状态
                        </a>

                      </div>
                        <!-- begin btn-group -->
                        <div class="btn-group pull-right">
                            {!! $task->links() !!}
                        </div>
                        <!-- end btn-group -->
                    </div>
                    <!-- end btn-toolbar -->
                </div>
            <!-- end wrapper -->
            <!-- begin list-email -->
                <ul class="list-group list-group-lg no-radius list-email">
                  @foreach($task as $t)
                  <?php
                  $role=App\Models\User::where('name','=',$t->exec_user)->first();
                   ?>
                    <li class="list-group-item inverse" style="background-color:
                    @if($t->status=='1')
                    #b0ebca
                    @elseif($t->status=='0')
                    #f8b2b2
                    @endif
                    ">
                        <a href="email_detail.html" class="email-user">
                            <img src="{{$role->avatar}}" alt="" />
                        </a>
                        <div class="email-info">
                            <span class="email-time" style="color:#707478">开始：{{$t->start_time}}</span>

                            <h5 class="email-title">
                                <a href="/task/detail/{{$t->id}}">{{$t->task_name}}</a>
                                <span
                                @if($role=='client')
                                class="label label-danger f-s-10"
                                @elseif($role=='sponsorer')
                                class="label label-warning f-s-10"
                                @else
                                class="label label-inverse f-s-10"
                                @endif
                                 >{{$t->exec_user}}</span>
                            </h5>
                            <span class="email-time" style="color:#707478">计划完成：{{$t->end_time}}</span>
                            <p class="email-desc">
                              {{$t->task_desction}}
                            </p>
                            @if($t->end_time==date("Y-m-d") && $t->status!==1)
                            <span class="email-time" style="color:red"><b>你有一个计划需要今天完成</b></span>
                            @endif
                        </div>
                    </li>
                    @endforeach

                </ul>
            <!-- end list-email -->
            <!-- begin wrapper -->
                <div class="wrapper bg-silver-lighter clearfix">
                    <div class="btn-group pull-right">

                    </div>
                    <div class="m-t-5">{{App\Models\Project_Task::where('project_id','=',$data->id)->count()}} messages</div>
                </div>
            <!-- end wrapper -->
        </div>
        <div class="vertical-box-column">
          <div class="wrapper bg-silver-lighter">
              <!-- begin btn-toolbar -->
              <div class="btn-toolbar">
                <div class="btn-group">
                  <a  class="btn btn-success p-l-40 p-r-40 btn-sm">
                      bug反馈
                  </a>
                </div>
                  <!-- begin btn-group -->
                  <!-- end btn-group -->
              </div>
              <!-- end btn-toolbar -->
          </div>
          <div class="col-md-12">
              <!-- begin panel -->
              <div class="panel panel-inverse" data-sortable-id="index-2">
                  <div class="panel-heading">
                      <h4 class="panel-title">
                          Bug反馈 <span class="label label-success pull-right">{{App\Models\Project_bug::where('status','=',0)->where('project_id','=',$data->id)->count()}} message</span></h4>
                  </div>
                  <div class="panel-body bg-silver">
                      <div data-scrollbar="true" data-height="600px">
                          <ul class="chats">
                            @foreach($bug as $v)
                            <?php
                            $u=App\Models\User::where('name','=',$v->create_user)->first();
                             ?>
                              <li
                              @if($v->create_user==Auth::user()->name)
                              class="right"
                              @else
                              class="left"
                              @endif
                              ><span class="date-time">{{$v->created_at}}</span> <a href="javascript:;"
                                  class="name">{{$v->create_user}}</a> <a href="javascript:;" class="image">
                                      <img alt="" src="{{$u->avatar}}" /></a>
                                  <div class="message">
                                      <p>{{$v->message}}</p>
                                    @if($v->status==1)
                                    <span style="color:blue">已解决(from {{$v->complete_user}})</span>
                                    @else
                                    <span style="color:red">未解决</span>
                                    @endif
                                    @if($v->status==0)
                                    <a href="#" onclick="alert('问题没有解决，不能隐藏')"><i class="fa fa-question-circle fa-lg"></i>
                                      @else
                                    <a onclick="if(!confirm('是否隐藏?')){return false;}" href="/project/bug_hide/{{$v->id}}"><i class="fa fa-question-circle fa-lg"></i>
                                      @endif
                                    </a> <a onclick="if(!confirm('是否修复bug?')){return false;}" href="/project/bug_success/{{$v->id}}"><i class="fa fa-check-square fa-lg"></i></a>
                                  </div>
                              </li>
                              @endforeach

                          </ul>
                      </div>
                  </div>
                  <div class="panel-footer">
                      <form name="send_message_form" data-id="message-form" action="/project/bug_add" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="project_id" value="{{$data->id}}">
                      <div class="input-group">
                          <input type="text" class="form-control input-sm" name="message" placeholder="请输入你的问题">
                          <span class="input-group-btn">
                              <button  class="btn btn-primary btn-sm" type="submit">
                                  Send</button>
                          </span>
                      </div>
                      </form>
                  </div>
              </div>
              <!-- end panel -->
          </div>
        </div>
      </div>
        <!-- end vertical-box-column -->
        <form class="form-horizontal" method="POST" action="/funds/add">
            {!! csrf_field() !!}
            <div class="modal fade" id="modal-product-add_plan">
              <input type="hidden" name="project_id" value="{{$data->id}}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">添加经费</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">经费明细</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="funds_name" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">费用</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" name="funds_money" value="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-success" type="submit">提交</button>
                            <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">取消</a>
                        </div>


                    </div>
                </div>
            </div>
        </form>

        <form class="form-horizontal" method="POST" action="/project_task_attr_edit" onsubmit="return false" id="form1">
            {!! csrf_field() !!}
            <div class="modal fade" id="modal-product-edit_product">
              <input type="hidden" name="project_id" value="{{$data->id}}">
              <input type="hidden" name="task_type" value="
              @if(App\Models\Project_Task_attr::where('project_id','=',$data->id)->where('status','=',0)->orderby('task_type')->first())
              {{App\Models\Task_attr::where('project_level','=',$data->project_type)->where('task_level','=',App\Models\Project_Task_attr::where('project_id','=',$data->id)->where('status','=',0)->orderby('task_type')->first()->task_type)->first()->task_level}}
              @endif
              ">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">更改状态</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">当前状态</label>
                                <div class="col-md-9">
                                      <label class="col-md-12 form-control" >
                                        @if(App\Models\Project_Task_attr::where('project_id','=',$data->id)->where('status','=',0)->orderby('task_type')->first())
                                        {{App\Models\Task_attr::where('project_level','=',$data->project_type)->where('task_level','=',App\Models\Project_Task_attr::where('project_id','=',$data->id)->where('status','=',0)->orderby('task_type')->first()->task_type)->first()->task_type}}</label>
                                        @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">下一状态</label>
                                <div class="col-md-9">
                                  <label class="col-md-12 form-control">
                                    @if(App\Models\Project_Task_attr::where('project_id','=',$data->id)->where('status','=',0)->orderby('task_type')->first())

                                    @if(App\Models\Task_attr::where('project_level','=',$data->project_type)->where('task_level','=',App\Models\Project_Task_attr::where('project_id','=',$data->id)->where('status','=',0)->orderby('task_type')->first()->task_type)->first()->task_level!==App\Models\Task_attr::where('project_level','=',$data->project_type)->orderby('task_level','desc')->first()->task_level)
                                    {{App\Models\Task_attr::where('project_level','=',$data->project_type)->where('task_level','=',App\Models\Project_Task_attr::where('project_id','=',$data->id)->where('status','=',0)->orderby('task_type')->first()->task_type+1)->first()->task_type}}</label>
                                    @endif
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">未完成任务</label>
                                <div class="col-md-6 ">
                                  @if(App\Models\Project_Task_attr::where('project_id','=',$data->id)->where('status','=',0)->orderby('task_type')->first())
                                  @foreach(App\Models\Project_Task::where('status','=',null)->where('project_id','=',$data->id)->where('task_type','=',App\Models\Task_attr::where('project_level','=',$data->project_type)->where('task_level','=',App\Models\Project_Task_attr::where('project_id','=',$data->id)->where('status','=',0)->orderby('task_type')->first()->task_type)->first()->task_level)->get() as $v)
                                    <label class="col-md-12 " style="color:red" id="task_name">{{$v->task_name}}</label>
                                    @endforeach
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                              <button onclick="return fnc()"  class="btn btn-sm btn-success" type="submit">提交</button>
                            <a href="javascript:;"  class="btn btn-sm btn-white" data-dismiss="modal">取消</a>
                        </div>


                    </div>
                </div>
            </div>
        </form>
        <script type="text/javascript">
        function fnc(){
          var task_name = document.getElementById("task_name");
          console.log(task_name);
          if(task_name){
            alert('还有任务没有完成')
            return false;
          }else{
            document.getElementById("form1").submit();
          }

              }
        </script>
    </div>
    <!-- end vertical-box -->
</div>
<!-- end #content -->
@endsection
