<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <a href="javascript:;">
                        <img src="{{Auth::user()->avatar }}" alt="" /></a>
                </div>
                <div class="info">
                    {{Auth::user()->name}} <small>Front end developer</small>
                </div>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header">Navigation</li>
            <li class="has-sub active">
              <a href="javascript:;">
  						    <b class="caret pull-right"></b>
  						    <i class="fa fa-align-left"></i>
  						    <span>项目</span>
  						</a>
  						<ul class="sub-menu">
  							<li class="has-sub">
  								<a href="javascript:;">
  						            <b class="caret pull-right"></b>
  						            项目总览
  						        </a>
  								<ul class="sub-menu">
                    @foreach(App\Models\Project::all() as $v)
  									<li><a href="/project/{{$v->id}}">{{$v->project_name}}</a></li>
                    @endforeach
  								</ul>
  							</li>
                <li><a href="/project/create">新建项目</a></li>
                <li ><a href="#">编辑项目</a></li>
  						</ul>
            </li>

            <li class="has-sub"><a href="javascript:;"><span class="badge pull-right">10</span>
                <i class="fa fa-inbox"></i><span>任务</span> </a>
                <ul class="sub-menu">
                    <li><a href="#">任务列表</a></li>
                    <li><a href="#">新建任务</a></li>
                </ul>
            </li>
            <li class="has-sub"><a href="javascript:;"><b class="caret pull-right"></b>
                <i class="fa fa-inbox"></i><span>经费</span> </a>
                <ul class="sub-menu">
                  <li><a href="#modal-product-add_plan">添加经费</a></li>
                    <li><a href="/funds/index">经费清单</a></li>
                </ul>
            </li>
            <li class="has-sub"><a href="javascript:;"><b class="caret pull-right"></b><i class="fa fa-suitcase">
            </i><span>日志 <span class="label label-theme m-l-5">NEW</span></span> </a>
                <ul class="sub-menu">
                    <li><a href="ui_general.html">General</a></li>
                    <li><a href="ui_typography.html">Typography</a></li>
                    <li><a href="ui_tabs_accordions.html">Tabs & Accordions</a></li>
                    <li><a href="ui_modal_notification.html">Modal & Notification</a></li>
                    <li><a href="ui_widget_boxes.html">Widget Boxes</a></li>
                    <li><a href="ui_media_object.html">Media Object</a></li>
                    <li><a href="ui_buttons.html">Buttons</a></li>
                    <li><a href="ui_icons.html">Icons</a></li>
                    <li><a href="ui_simple_line_icons.html">Simple Line Icons</a></li>
                    <li><a href="ui_ionicons.html">Ionicons <i class="fa fa-paper-plane text-theme m-l-5">
                    </i></a></li>
                </ul>
            </li>


            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i
                class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg">
</div>

<!-- end #sidebar -->
