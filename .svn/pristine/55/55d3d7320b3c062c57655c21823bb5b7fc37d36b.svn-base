@extends('layouts.default')
@section('content')
		<!-- begin #content -->
		<div id="content" class="content content-full-width">
		    <!-- begin vertical-box -->
		    <div class="vertical-box">

		        <!-- begin vertical-box-column -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-2">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">预算清单</h4>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>项目名称</th>
                                <th>经费说明</th>
                                <th>总金额</th>
                                <th>创建时间</th>
                                <th>创建人</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($funds as $v)
                            <tr>
                                <td>{{$v->project_id}}</td>
                                <td>{{$v->funds_name}}</td>
                                <td>{{$v->funds_money}}</td>
                                <td>{{$v->created_at}}</td>
                                <td>{{$v->create_user}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                        {!! $funds->links() !!}
                    </table>
                </div>
            </div>
		    </div>
		    <!-- end vertical-box -->
		</div>
		<!-- end #content -->
@endsection
