<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Register extends Component
{
 public $email;
 public $phone;
 public $password;
// public $password_confirmation;
 protected $rules = [
  'email' => 'required|email|unique:users,email',
  'phone' => 'required|numeric|unique:users,phone',
  'password' => [
   'required',
   'min:6',
   'alpha_num',
//   'regex:/^.*(.{3,})(.*[a-zA-Z])(.*[0-9])(.*[\d\x])(.*[!$#%]).*$/',
//   'confirmed'
  ],
 ];

 public function updated($propertyName)
 {
  $this->validateOnly($propertyName);
 }

 public function register()
 {
  $this->validate();
  $user = User::create([
                        'email' => $this->email,
                        'phone' => $this->phone,
                        'password' => bcrypt($this->password),
                       ]);
  auth()->login($user);
  return redirect()->intended('front.panel.user.ad.index');
 }

 public function render()
 {
  return view('livewire.front.auth.register');
 }
}
