<?php

namespace App\Http\Livewire\Front\Ad;

use App\Models\Ad\Ad;
use App\Models\User;
use Cookie;
use Livewire\Component;

class Show extends Component
{
 use Favorite;

 public Ad $ad;
 public string $email = '';
 public string $name = '';
 public string $comment = '';
 protected $rules = [
  'email' => 'required|email',
  'name' => 'required|min:3',
  'comment' => 'required',
 ];
 protected $validationAttributes = [
  'email' => 'ایمیل',
  'name' => 'نام',
  'comment' => 'دیدگاه',
 ];
 protected $listeners = [
  'reportConfirm',
  'viewed'
 ];
 public $currentUrl;

 public function mount()
 {
  $this->mountFavorite();
 }

 public function storeComment()
 {
  $user = User::create([
                        'email' => $this->email,
                        'name' => $this->name,
                        'rule' => 'subscriber'
                       ]);
  $this->ad->reviews()
           ->create([
                     'content' => $this->comment,
                     'user_id' => $user->id,
                    ]);
 }

 public function showContactInfo()
 {
  $this->dispatchBrowserEvent('swal:modal', [
   'title' => 'اطلاعات تماس',
   'timerProgressBar' => true,
   'timer' => 20000,
   'html' => "شماره تماس:<br>
   {$this->ad->user->phone}
   <br>
   ایمیل:
   <br>
      {$this->ad->user->email}

   ",
   'confirmButtonText' => '<i class="fa fa-thumbs-up"></i> متوجه شدم',
   'width' => 300
  ]);
 }

 public function report()
 {
  $this->dispatchBrowserEvent('swal:confirm2', [
   'title' => 'دلیل گزارش خود را انتخاب کنید.',
   'timerProgressBar' => true,
   'timer' => 20000,
   'confirmButtonText' => ' ارسال',
   'cancelButtonText' => ' صرف نظر',
   'showCancelButton' => true,
   'width' => 600,
   'input' => 'select',
   'inputOptions' => [
    'محتوای آگهی نامناسب است.' => 'محتوای آگهی نامناسب است.',
    'اطلاعات آگهی گمراه کننده یا دروغ است.' => 'اطلاعات آگهی گمراه کننده یا دروغ است.',
    ' آگهی اسپم است و چندین بار پست شده است.' => ' آگهی اسپم است و چندین بار پست شده است.',
    'آگهی در دسته بندی نامناسب قرار گرفته است.' => 'آگهی در دسته بندی نامناسب قرار گرفته است.',
    ' خدمات کالا یا املاک دیگر موجود نیست.' => ' خدمات کالا یا املاک دیگر موجود نیست.',
    'کالا یا خدمات قرار گرفته مشمول فهرست مصادیق محتوای مجرمانه می باشد.' => 'کالا یا خدمات قرار گرفته مشمول فهرست مصادیق محتوای مجرمانه می باشد.',
    ' دلایل دیگر...' => ' دلایل دیگر...',
   ],
   'event' => 'reportConfirm'
  ]);
 }

 public function reportConfirm($a)
 {
  if ($a['isConfirmed']) {
   $this->ad->reports()
            ->create([
                      'title' => $a['value'],
                     ]);
   $this->dispatchBrowserEvent('swal:modal', [
    'icon' => 'success',
    'title' => 'گزارش شما با موفقیت ثبت شد.',
    'timerProgressBar' => true,
    'timer' => 20000,
    'confirmButtonText' => '<i class="fa fa-thumbs-up"></i> متوجه شدم',
    'width' => 300
   ]);
  }
 }

 public function viewed()
 {
  $this->ad->update(['views' => $this->ad->views + 1]);
 }

 public function render()
 {
  return view('livewire.front.ad.show');
 }
}