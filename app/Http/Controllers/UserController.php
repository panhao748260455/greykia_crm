<?php namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Project;
use App\Models\Project_Task;
use App\Models\Funds;
use App\Models\User;
use Input,Redirect,Auth;
use App\Http\Requests;

class UserController extends Controller {

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

  public function avatar(){

    return view('auth.avatar');
    }
		public function setting()
		{
			return view('auth.setting');
		}

		public function changeAvatar(Requests\UploadAvatarRequest $request)
		    {
		        // 声明路径名
		        $destinationPath = 'uploads/';
		        // 取到图片
		        $file = $request->file('avatar');
		        // 获得图片的名称 为了保证不重复 我们加上userid和time
		        $file_name = \Auth::user()->id . '_' . time() . $file->getClientOriginalName();
		        // 执行move方法
		        $file->move($destinationPath, $file_name);
		        // 裁剪图片 生成200x200的缩略图
		        \Image::make($destinationPath . $file_name)->fit(200)->save();
		        // 保存到User
		        $user = User::findOrFail(\Auth::user()->id);
		        $user->avatar = '/' . $destinationPath . $file_name;
		        $user->save();
		        // 重定向
		        return redirect('/user/avatar');
		    }
				public function resetpassword()
				{
					User::where('id','=',$_POST['id'])->update(['email'=>$_POST['email'],'passowrd'=>bcrypt($_POST['passowrd'])]);
					return redirect('/user/setting');

				}


}
