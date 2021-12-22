<?php

namespace App\Policies\Ad;

use App\Models\Ad\Ad;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdPolicy
{
 use HandlesAuthorization;

 public function __construct()
 {
  //
 }

 public function viewAny(User $user): bool
 {
  return true;
 }

 public function view(User $user, Ad $ad): bool
 {
  return true;
 }

 public function create(User $user): bool
 {
  return true;
 }

 public function update(User $user, Ad $ad): bool
 {
  return true;
 }

 public function delete(User $user, Ad $ad): bool
 {
  return true;
 }

 public function restore(User $user, Ad $ad): bool
 {
  return true;
 }

 public function forceDelete(User $user, Ad $ad): bool
 {
  return true;
 }
}