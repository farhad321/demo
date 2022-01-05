<?php

namespace App\Http\Controllers\TelegramController\Ads;
use App\Http\Controllers\TelegramController\Ads\EditFields\City;
use App\Http\Controllers\TelegramController\Ads\EditFields\Content;
use App\Http\Controllers\TelegramController\Ads\EditFields\Media;
use App\Http\Controllers\TelegramController\Ads\EditFields\State;
use App\Http\Controllers\TelegramController\Ads\EditFields\Title;

trait Edit
{
 use Title, Content, State, City, Media;
}