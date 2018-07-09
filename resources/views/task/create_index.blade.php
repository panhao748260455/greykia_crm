@extends('layouts.default')
@section('content')
<!-- begin #content -->
<div id="content" class="content">
  <!-- begin breadcrumb -->
  <ol class="breadcrumb pull-right">
    <li><a href="javascript:;">Home</a></li>
    <li><a href="javascript:;">Form Stuff</a></li>
    <li class="active">Form Validation</li>
  </ol>
  <!-- end breadcrumb -->
  <!-- begin page-header -->
  <h1 class="page-header">添加任务 <small>header small text goes here...</small></h1>
  <!-- end page-header -->

  <!-- begin row -->
  <div class="row">
            <!-- begin col-6 -->
      <div class="col-md-12">
          <!-- begin panel -->
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">添加任务</h4>
                    </div>
                    <div class="panel-body panel-form">
              <form action="{{route('create_task')}}" method="POST" class="form-horizontal form-bordered" data-parsley-validate="true" name="demo-form">
                <input type="hidden" name="project_id" value="{{$data->id}}">
                {{ csrf_field() }}
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4" for="fullname">任务名称:</label>
              <div class="col-md-6 col-sm-6">
                <input class="form-control" type="text" id="fullname" name="task_name" placeholder="任务名称" data-parsley-required="true" />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4" for="email">任务类型 :</label>
              <div class="col-md-6 col-sm-6">
                <select class="form-control" name="task_type">
                  @foreach(App\Models\Task_attr::where('project_level','=',$data->project_type)->get() as $v)
                  <option  value="{{$v->task_level}}">{{$v->task_type}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4" for="email">任务开始日期 :</label>
              <div class="col-md-6 col-sm-6">
                <input class="form-control" name="start_time" placeholder="点击选择时间" onclick="laydate({istime: true, format: 'YYYY-MM-DD '})">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4" for="email">任务结束日期 :</label>
              <div class="col-md-6 col-sm-6">
                <input class="form-control" name="end_time" placeholder="点击选择时间" onclick="laydate({istime: true, format: 'YYYY-MM-DD '})">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4" for="email">创建人 :</label>
              <div class="col-md-6 col-sm-6">
                <input class="form-control" type="text" disabled id="email" name="create_user"  placeholder="创建人" value="{{Auth::user()->name}}" data-parsley-required="true" />
                <input class="form-control" type="hidden" id="email" name="create_user"  placeholder="创建人" value="{{Auth::user()->name}}" data-parsley-required="true" />

              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4" for="email">执行人 :</label>
              <div class="col-md-6 col-sm-6">
                <select class="form-control" name="exec_user">
                  @foreach(App\Models\User::get() as $v)
                  <option  value="{{$v->name}}">{{$v->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4" for="message">描述 (20 chars min, 200 max) :</label>
              <div class="col-md-6 col-sm-6">
                <textarea class="form-control" id="message" name="task_desction" rows="4" data-parsley-range="[20,200]" placeholder="Range from 20 - 200"></textarea>
              </div
            </div>
          </div>


            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4"></label>
              <div class="col-md-6 col-sm-6">
                <button type="submit" class="btn btn-primary">提交</button>
                <a onclick="self.location=document.referrer;" type="submit" class="btn btn-primary">返回</a>
              </div>

            </div>



                        </form>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-6 -->

        </div>
        <!-- end row -->
</div>
<!-- end #content -->



@endsection
