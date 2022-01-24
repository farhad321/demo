<?php

namespace App\Http\Livewire\Front\Panel\User;

use Livewire\Component;

class PanelLogout extends Component
{
 public function logout()
 {
  auth()->logout();
  return redirect()
   ->route('front.home')
   ->with('success', 'با موفقیت خارج شدید.');
 }

 public function render()
 {
  return view('livewire.front.panel.user.panel-logout');
 }
}