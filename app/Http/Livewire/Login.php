<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Login extends Component
{
 public $username;
 public $password;
 public $remember;
 protected $rules = [
  'username' => 'required',
  'password' => 'required',
 ];
 protected $validationAttributes = [
  'username' => 'ایمیل یا شماره موبایل'
 ];

 public function authUser()
 {
  $this->validate();
  $columnName = \Validator::make(['username' => $this->username], [
   'username' => 'email',
  ])
                          ->passes() ? 'email' : 'phone';
  if (auth()->attempt([
                       $columnName => $this->username,
                       'password' => $this->password,
                      ], $this->remember)) {
   request()
    ->session()
    ->regenerate();

//   return redirect()->route('front.panel.user.ad.index');
   return redirect()->intended(route('front.panel.user.ad.index'));
  }
  $this->addError('all', 'کاربری با این مشخصات وجود ندارد.');
//  return back()->withErrors([
//                             'email' => 'The provided credentials do not match our records.',
//                            ]);
 }

 public function render()
 {
  return view('livewire.front.auth.login');
 }
}
