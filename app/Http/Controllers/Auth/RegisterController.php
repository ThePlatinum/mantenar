<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Invite;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

  use RegistersUsers;

  /**
   * Where to redirect users after registration.
   *
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest');
  }

  public function setup_administrator(Request $request)
  {

    $this->validator($request->all())->validate();

    event(new Registered($user = $this->admin_create($request->all())));

    $this->guard()->login($user);

    if ($response = $this->registered($request, $user)) {
      return $response;
    }

    return $request->wantsJson()
      ? new JsonResponse([], 201)
      : redirect($this->redirectPath());
  }


  public function register(Request $request)
  {
    $this->validator($request->all())->validate();

    event(new Registered($user = $this->create($request->all())));

    $this->guard()->login($user);

    if ($response = $this->registered($request, $user)) {
      return $response;
    }

    return $request->wantsJson()
      ? new JsonResponse([], 201)
      : redirect($this->redirectPath());
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data)
  {
    return Validator::make($data, [
      'firstname' => ['required', 'string', 'max:255'],
      'lastname' => ['required', 'string', 'max:255'],
      'job_title' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8'],
    ]);
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\Models\User
   */
  protected function create(array $data)
  {
    $invite = Invite::find($data['invite_id']);

    if (!$invite || $invite->invite_email != $data['email']) abort(403, 'Please use the invited email only');

    $user =  User::create([
      'firstname' => $data['firstname'],
      'lastname' => $data['lastname'],
      'job_title' => $data['job_title'],
      'email' => $data['email'],
      'is_admin' => false,
      'password' => Hash::make($data['password']),
    ]);

    if ($user) $invite->delete();

    return $user;
  }

  protected function admin_create(array $data)
  {
    return User::create([
      'firstname' => $data['firstname'],
      'lastname' => $data['lastname'],
      'job_title' => $data['job_title'],
      'email' => $data['email'],
      'is_admin' => true,
      'password' => Hash::make($data['password']),
    ]);
  }
}
