<?php namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Project;
use App\Models\Project_Task;
use App\Models\Project_bug;
use App\Models\Funds;
use App\Models\Task_attr;
use App\Models\Project_Task_attr;
use App\Models\Log;
use Input,Redirect,Auth;

class ProjectController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Project Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	 public function index_1()
 	{
		$data=Project::all();
 		return view('project.index')->withData($data);
 	}
	public function index()
	{
		$data=Project::all();
		return view('project.show')->withData($data);
	}

  public function create_index()
  {
    return view('project.create_index');
  }
  public function table($id)
  {
		$log=Log::where('project_id','=',$id)->get();
		$attr=Project_Task_attr::where('project_id','=',$id)->orderby('task_type','asc')->get();
		foreach($attr as $v){
			if($v->status==0){
				$task=Project_Task::where('project_id','=',$id)->where('task_type','=',$v->task_type)->paginate(8);
				break;
			}
		}
		if(!isset($task)){
			$task=Project_Task::where('project_id','=',$id)->paginate(8);
		}
		$data=Project::where('id','=',$id)->first();
		$funds=Funds::where('project_id','=',$id)->get();
		$bug=Project_bug::where('project_id','=',$id)->where('hide','=',1)->get();
    return view('project.table')->withData($data)->withTask($task)->withFunds($funds)->withBug($bug)->withLog($log);
  }
	public function create()
	{
		$project=new Project;
		$project->project_name=$_POST['project_name'];
		$project->create_user=Auth::user()->name;
		$project->desction=$_POST['desction'];
		$project->exec_user=implode(',',$_POST['exec_user']);
		$project->project_type=$_POST['project_type'];
		$project->start_time=$_POST['start_time'];
		$project->end_time=$_POST['end_time'];
		$project->save();
		return Redirect::to('/');
	}
	public function bug_add()
	{
		$bug=new Project_bug;
		$bug->project_id=$_POST['project_id'];
		$bug->message=$_POST['message'];
		$bug->create_user=Auth::user()->name;
		$bug->status=0;
		$bug->save();
		return Redirect::to('/project/'.$_POST['project_id']);
	}
	public function bug_success($id)
	{
		$project_id=Project_bug::where('id','=',$id)->first();
		Project_bug::where('id','=',$id)->update(['complete_user'=>Auth::user()->name,'status'=>'1']);
		return Redirect::to('/project/'.$project_id->project_id);
	}
	public function bug_hide($id)
	{
		$project_id=Project_bug::where('id','=',$id)->first();
		Project_bug::where('id','=',$id)->update(['hide'=>'0']);
		return Redirect::to('/project/'.$project_id->project_id);
	}
	public function project_task_attr_edit()
	{
		Project_Task_attr::where('project_id','=',$_POST['project_id'])->where('task_type','=',$_POST['task_type'])->update(['status'=>1]);
		$log=new Log;
		$log->project_id=$_POST['project_id'];
		$log->task_attr='更改了项目状态('.$_POST['task_type'].')';
		$log->edit_user=Auth::user()->name;
		$log->save();
		return Redirect::to('/project/'.$_POST['project_id']);
	}
}
