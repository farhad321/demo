<?php

namespace App\Http\Controllers\TelegramController;

use App\Http\Controllers\TelegramController\Ads\AcceptTheRules;
use App\Http\Controllers\TelegramController\Ads\Index;
use App\Models\Ad\Ad;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Psy\Util\Str;
use stdClass;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Button;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Objects\EditedMessage;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;
use App\Http\Controllers\TelegramController\Ads\Create;
use App\Http\Controllers\TelegramController\Ads\Edit;

trait Ads
{
 use Index, Create, Edit, AcceptTheRules;
}