@extends('layouts.default')
@section('content')
		<!-- begin #content -->
		<div id="content" class="content content-full-width">
		    <!-- begin vertical-box -->
		    <div class="vertical-box">

		        <!-- begin vertical-box-column -->
		        <div class="vertical-box-column bg-white">
		            <!-- begin wrapper -->
                    <div class="wrapper bg-silver-lighter clearfix">
                        <div class="btn-group m-r-5">
                          <a href="javascript:" class="btn btn-white btn-sm" onclick="self.location=document.referrer;"><i class="fa fa-reply"></i></a>
                        </div>
                        <div class="btn-group m-r-5">
                            <a href="/task/complete/{{$data->id}}" onclick="if(!confirm('确定完成?')){return false;}" @if($data->status=='1' || $data->status=='0' || $data->exec_user!==Auth::user()->name)disabled="disabled" @endif class="btn btn-white btn-sm p-l-20 p-r-20"><i class="fa fa-check-square"></i></a>
                            <a href="/task/cancle/{{$data->id}}" onclick="if(!confirm('确定取消?')){return false;}" @if($data->status=='1' || $data->status=='0'|| $data->exec_user!==Auth::user()->name)disabled="disabled" @endif class="btn btn-white btn-sm p-l-20 p-r-20"><i class="fa fa-times-circle"></i></a>
                        </div>
                    </div>
		            <!-- end wrapper -->
		            <!-- begin wrapper -->
                    <div class="wrapper">
                        <h4 class="m-b-15 m-t-0 p-b-10 underline">{{$data->task_name}}</h4>
                        <ul class="media-list underline m-b-20 p-b-15">
                            <li class="media media-sm clearfix">
                                <a href="javascript:;" class="pull-left">
																	<?php  $u=App\Models\User::where('name','=',$data->create_user)->first();?>
                                    <img class="media-object rounded-corner" alt="" src="{{$u->avatar}}" />
                                </a>
                                <div class="media-body">
                                    <span class="email-from text-inverse f-w-600">
                                        from {{$data->create_user}}
                                    </span><span class="text-muted m-l-5"><i class="fa fa-clock-o fa-fw"></i> {{$data->created_at}}</span><br />

                                </div>
                            </li>
													</ul>
													<p class="f-s-12 " style="color:red">
															任务开始日期：{{$data->start_time}}
															</p>
															<p class="f-s-12 " style="color:red">
																	任务计划完成日期：{{$data->end_time}}
																	</p>
																	<p><br></p>
                        <p class="f-s-12 text-inverse">
                            {{$data->task_desction}}
                        </p>
                    </div>
		            <!-- end wrapper -->
		            <!-- begin wrapper -->
                    <div class="wrapper bg-silver-lighter text-right clearfix">
                        <div class="btn-group m-l-5">
                            <a href="/task/del/{{$data->id}}" onclick="if(!confirm('是否删除本任务?')){return false;}" class="btn btn-white btn-sm"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
		            <!-- end wrapper -->
		        </div>
		        <!-- end vertical-box-column -->
		    </div>
		    <!-- end vertical-box -->
		</div>
		<!-- end #content -->
@endsection
