<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Logout extends Component
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
  return view('livewire.logout');
 }
}
