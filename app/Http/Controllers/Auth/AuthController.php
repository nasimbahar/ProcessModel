<?php

namespace App\Http\Controllers\Auth;
use App\Models\nextbook\Company;
use App\Models\Packagess;
use App\Models\Phd;
use App\Models\Users;
use App\Models\UserRoles;
use Carbon\Carbon;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    protected $loginView = 'admin::login';
    protected $registerView='auth.register';
    public $company_id;


    public function getLogin()
    {
        if ($this->guard()->check()) {
            return redirect($this->redirectPath());
        }

        return view($this->loginView);
    }

    public function getRegister(){

         return view($this->registerView);
    }
    public function postRegister(Request $request){
        $this->RegisterValidator($request->all())->validate();
        $school=new Phd();
        $school->name=$request['school_name'];
        $school->contact_number=$request['contactnumber'];
        $school->email=$request['email'];
        $school->user_name=$request['username'];
        if($school->save()){
        $user=new Users();
        $user->username=$request['username'];
        $user->name=$request['username'];
        $user->password=bcrypt($request['password']);
        $user->email=$request['email'];
        $user->school_id=$school->id;
        $user->is_first_login=0;
        if($user->save()){
            $userroles=new UserRoles();
            $userroles->user_id=$user->id;
            $userroles->role_id=3;
            $userroles->save();
            $package=new Packagess();
            $package->school_id=$school->id;
            $package->package_type_id=1;
            $package->expire_date=calculate_expriation_date();
            $package->save();
            return $this->FirstLogin($request);
        }
        }
        return back()->withInput()->withErrors();
    }


     protected function RegisterValidator(array $data)
    {
        return Validator::make($data, [
            $this->username()   => ['required', 'max:50', 'unique:admin_users'],
            'password'          => ['required', 'string', 'min:6', 'confirmed'],
             'email' => ['required', 'string', 'email', 'max:255', 'unique:admin_users'],
            'school_name'=>'required',
            'contactnumber'=>['required', 'numeric']
        ]);

    }

    public function postLogin(Request $request)
    {
        $this->loginValidator($request->all())->validate();

        $credentials = $request->only([$this->username(), 'password']);
        $remember = $request->get('remember', false);

        if ($this->guard()->attempt($credentials, $remember)) {
            return $this->sendLoginResponse($request);
        }

        return back()->withInput()->withErrors([
            $this->username() => $this->getFailedLoginMessage(),
        ]);
    }

    public function FirstLogin($request){
        $credentials = $request->only([$this->username(), 'password']);
        if ($this->guard()->attempt($credentials, false)) {
           // $this->insertDefultchartofaccounts();
            return $this->sendLoginResponse($request);
        }
        return back()->withInput()->withErrors([
            $this->username() => $this->getFailedLoginMessage(),
        ]);
    }


    protected function loginValidator(array $data)
    {
        return Validator::make($data, [
            $this->username()   => 'required',
            'password'          => 'required',
        ]);
    }


   private function insertDefultchartofaccounts(){

//
   }
    /**
     * User logout.
     *
     * @return Redirect
     */
    public function getLogout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect(config('admin.route.prefix'));
    }


    public function getSetting(Content $content)
    {
        $form = $this->settingForm();
        $form->tools(
            function (Form\Tools $tools) {
                $tools->disableList();
                $tools->disableDelete();
                $tools->disableView();
            }
        );

        return $content
            ->title(trans('admin.user_setting'))
            ->body($form->edit(Admin::user()->id));
    }


    public function putSetting()
    {
        return $this->settingForm()->update(Admin::user()->id);
    }
    protected function settingForm()
    {
        $class = config('admin.database.users_model');
        $form = new Form(new $class());
        $form->display('username', trans('admin.username'));
        $form->text('name', trans('admin.name'))->rules('required');
        $form->image('avatar', trans('admin.avatar'));
        $form->password('password', trans('admin.password'))->rules('confirmed|required');
        $form->password('password_confirmation', trans('admin.password_confirmation'))->rules('required')
            ->default(function ($form) {
                return $form->model()->password;
            });

        $form->setAction(admin_url('auth/setting'));

        $form->ignore(['password_confirmation']);

        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = bcrypt($form->password);
            }
        });

        $form->saved(function () {
            admin_toastr(trans('admin.update_succeeded'));

            return redirect(admin_url('auth/setting'));
        });

        return $form;
    }

    /**
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed')
            ? trans('auth.failed')
            : 'These credentials do not match our records.';
    }

    /**
     * Get the post login redirect path.
     *
     * @return string
     */
    protected function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : config('admin.route.prefix');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        admin_toastr(trans('admin.login_successful'));

     //  dd( $request->session()->regenerate());

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    protected function username()
    {
        return 'username';
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Admin::guard();
    }

}
