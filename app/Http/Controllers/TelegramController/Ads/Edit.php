<?php

namespace App\Http\Controllers\TelegramController\Ads;
use App\Http\Controllers\TelegramController\Ads\Fields\City;
use App\Http\Controllers\TelegramController\Ads\Fields\Content;
use App\Http\Controllers\TelegramController\Ads\Fields\Media;
use App\Http\Controllers\TelegramController\Ads\Fields\State;
use App\Http\Controllers\TelegramController\Ads\Fields\Title;

trait Edit
{
 use Title, Content, State, City, Media;
}