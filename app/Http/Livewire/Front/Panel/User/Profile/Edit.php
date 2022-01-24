<?php

namespace App\Http\Livewire\Front\Panel\User\Profile;

use App\Http\Livewire\Front\Panel\User\Profile\Edit\Media;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
 use WithFileUploads, Media;

 public User $user;
 public $password = '';
 public $newPassword = '';
 public $newPassword_confirmation = '';
 protected $rules = [
  'user.name' => '',
  'user.first_name' => 'required|min:3',
  'user.last_name' => 'required|min:3',
  'user.address' => 'nullable|min:3',
  'user.description' => 'nullable|min:3',
  'user.email' => 'required|email',
  'password' => 'current_password',
  'newPassword' => 'confirmed|required_with:password|alpha_num',
  'newPassword_confirmation' => 'required_with:password,newPassword',
 ];
 protected $validationAttributes = [
  'email' => 'ایمیل',
  'name' => 'نام نمایشی',
  'password' => 'گذرواژه پیشین',
  'newPassword' => 'گذرواژه جدید',
  'newPassword_confirmation' => 'تکرار گذرواژه جدید',
 ];

 public function mount()
 {
  $user = auth()->user();
  $this->user = $user;
  $this->previewAvatar = $user?->getFirstMedia('profile')?->getUrl('avatar');
 }
//
// public function updatedUserName()
// {
//  $this->validate(['user.name' => $this->user->name], [
//   'user.name' => [
//    'required',
//    'min:3',
//    Rule::unique('users', 'name')
//        ->ignore(auth()->id()),
//   ]
//  ],              $this->validationAttributes);
// }
 public function store()
 {
  $this->validationAll();
  $user = $this->user;
  if ($this->newPassword) {
   $user->password = bcrypt($this->newPassword);
  }
  $user->update($user->attributesToArray());
  if (count($user->getChanges())) {
   $this->dispatchBrowserEvent('swal:modal', [
    'icon' => 'success',
    'title' => 'پروفایل شما با موفقیت ویرایش شد.',
    'timerProgressBar' => true,
    'timer' => 20000,
    'confirmButtonText' => '<i class="fa fa-thumbs-up"></i> متوجه شدم',
    'width' => 300
   ]);
  }
 }

 public function render()
 {
  return view('livewire.front.panel.user.profile.edit');
 }

 public function validationAll()
 {
  $this->rules['user.name'] = [
   'required',
   'min:3',
   Rule::unique('users', 'name')
       ->ignore(auth()->id()),
  ];
  $this->rules['user.email'] = [
   'required',
   'min:3',
   Rule::unique('users', 'email')
       ->ignore(auth()->id()),
  ];
  return $this->validate($this->rules, [], $this->validationAttributes);
 }
}