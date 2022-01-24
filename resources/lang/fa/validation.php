<?php
return [
 /*
 |--------------------------------------------------------------------------
 | Validation Language Lines
 |--------------------------------------------------------------------------
 |
 | The following language lines contain the default error messages used by
 | the validator class. Some of these rules have multiple versions such
 | as the size rules. Feel free to tweak each of these messages here.
 |
 */
 "accepted" => ":attribute باید پذیرفته شده باشد.",
 "active_url" => "آدرس :attribute معتبر نیست",
 "after" => ":attribute باید تاریخی بعد از :date باشد.",
 "alpha" => ":attribute باید شامل حروف الفبا باشد.",
 "alpha_dash" => ":attribute باید شامل حروف الفبا و عدد و خظ تیره(-) باشد.",
 "alpha_num" => ":attribute باید شامل حروف الفبا و عدد باشد.",
 "array" => ":attribute باید شامل آرایه باشد.",
 "before" => ":attribute باید تاریخی قبل از :date باشد.",
 "between" => [
  "numeric" => ":attribute باید بین :min و :max باشد.",
  "file" => ":attribute باید بین :min و :max کیلوبایت باشد.",
  "string" => ":attribute باید بین :min و :max کاراکتر باشد.",
  "array" => ":attribute باید بین :min و :max آیتم باشد.",
 ],
 "boolean" => "فیلد :attribute فقط میتواند صحیح و یا غلط باشد",
 "confirmed" => ":attribute با تاییدیه مطابقت ندارد.",
 'current_password' => 'رمز عبور اشتباه است.',
 "date" => ":attribute یک تاریخ معتبر نیست.",
 "date_format" => ":attribute با الگوی :format مطاقبت ندارد.",
 "different" => ":attribute و :other باید متفاوت باشند.",
 "digits" => ":attribute باید :digits رقم باشد.",
 "digits_between" => ":attribute باید بین :min و :max رقم باشد.",
 "email" => "فرمت :attribute معتبر نیست.",
 "exists" => ":attribute انتخاب شده، معتبر نیست.",
 "filled" => "فیلد :attribute الزامی است",
 "image" => ":attribute باید تصویر باشد.",
 "in" => ":attribute انتخاب شده، معتبر نیست.",
 "integer" => ":attribute باید نوع داده ای عددی (integer) باشد.",
 "ip" => ":attribute باید IP آدرس معتبر باشد.",
 "max" => [
  "numeric" => ":attribute نباید بزرگتر از :max باشد.",
  "file" => ":attribute نباید بزرگتر از :max کیلوبایت باشد.",
  "string" => ":attribute نباید بیشتر از :max کاراکتر باشد.",
  "array" => ":attribute نباید بیشتر از :max آیتم باشد.",
 ],
 "mimes" => ":attribute باید یکی از فرمت های :values باشد.",
 "min" => [
  "numeric" => ":attribute نباید کوچکتر از :min باشد.",
  "file" => ":attribute نباید کوچکتر از :min کیلوبایت باشد.",
  "string" => ":attribute نباید کمتر از :min کاراکتر باشد.",
  "array" => ":attribute نباید کمتر از :min آیتم باشد.",
 ],
 "not_in" => ":attribute انتخاب شده، معتبر نیست.",
 "numeric" => ":attribute باید شامل عدد باشد.",
 "regex" => ":attribute یک فرمت معتبر نیست",
 "required" => "فیلد :attribute الزامی است",
 "required_if" => "فیلد :attribute هنگامی که :other برابر با :value است، الزامیست.",
 "required_with" => ":attribute الزامی است زمانی که :values موجود است.",
 "required_with_all" => ":attribute الزامی است زمانی که :values موجود است.",
 "required_without" => ":attribute الزامی است زمانی که :values موجود نیست.",
 "required_without_all" => ":attribute الزامی است زمانی که :values موجود نیست.",
 "same" => ":attribute و :other باید مانند هم باشند.",
 "size" => [
  "numeric" => ":attribute باید برابر با :size باشد.",
  "file" => ":attribute باید برابر با :size کیلوبایت باشد.",
  "string" => ":attribute باید برابر با :size کاراکتر باشد.",
  "array" => ":attribute باسد شامل :size آیتم باشد.",
 ],
 "string" => "The :attribute must be a string.",
 "timezone" => "فیلد :attribute باید یک منطقه صحیح باشد.",
 "unique" => ":attribute قبلا انتخاب شده است.",
 "url" => "فرمت آدرس :attribute اشتباه است.",
 'gt' => [
  'numeric' => ':attribute باید بزرگتر از :value باشد.',
  'file' => ':attribute باید بیشتر از کیلوبایت :value باشد.',
  'string' => ':attribute باید بزرگتر از کاراکترهای :value باشد.',
  'array' => ':attribute باید بیش از موارد :value داشته باشد.',
 ],
 'gte' => [
  'numeric' => ':attribute باید بزرگتر یا مساوی با :value باشد.',
  'file' => ':attribute باید بزرگتر یا مساوی با :value کیلوبایت باشد.',
  'string' => ':attribute باید بزرگتر یا مساوی با نویسه های :value باشد.',
  'array' => ':attribute باید دارای آیتم های :value یا بیشتر باشد.',
 ],
 'lt' => [
  'numeric' => ':attribute باید کمتر از :value باشد.',
  'file' => ':attribute باید کمتر از :value کیلوبایت باشد.',
  'string' => ':attribute باید کمتر از کاراکترهای :value باشد.',
  'array' => ':attribute باید کمتر از موارد :value داشته باشد.',
 ],
 'lte' => [
  'numeric' => ':attribute باید کمتر یا مساوی با :value باشد.',
  'file' => ':attribute باید کمتر یا مساوی :value کیلوبایت باشد.',
  'string' => 'صفت : باید کمتر یا مساوی با نویسه های :value باشد.',
  'array' => ':attribute نباید بیش از موارد :value داشته باشد.',
 ],
 /*
 |--------------------------------------------------------------------------
 | Custom Validation Language Lines
 |--------------------------------------------------------------------------
 |
 | Here you may specify custom validation messages for attributes using the
 | convention "attribute.rule" to name the lines. This makes it quick to
 | specify a specific custom language line for a given attribute rule.
 |
 */
 'custom' => [
  'iran_mobile_09***' => 'باید فیلد :attribute  مانند شماره تلفن  09998887766 باشد. '
 ],
 'persian_number' => 'عدد وارد شده باید فارسی باشد.',
 'persian_alphabet' => 'حروف وارد شده باید فارسی باشد.',
 'persian_alphabet_number' => 'حروف و عدد وارد شده باید فارسی باشد.',
 'iran_mobile' => 'شماره همراه قابل قبول نیست.',
 'sheba_number' => 'شماره شبا قابل قبول نیست.',
 'melli_code' => 'کد ملی قابل قبول نیست.',
 'is_not_persian' => 'حروف غیر لاتین قابل قبول نیست.',
 'iran_phone' => 'شماره تلفن قابل قبول نیست.',
 'iran_phone_area' => 'شماره تلفن قابل قبول نیست.',
 'card_number' => 'شماره کارت قابل قبول نیست.',
 'iran_address' => 'آدرس وارد شده قابل قبول نیست.',
 'iran_postal_code' => 'کدپستی وارد شده قابل قبول نیست.',
 /*
 |--------------------------------------------------------------------------
 | Custom Validation Attributes
 |--------------------------------------------------------------------------
 |
 | The following language lines are used to swap attribute place-holders
 | with something more reader friendly such as E-Mail Address instead
 | of "email". This simply helps us make messages a little cleaner.
 |
 */
 'attributes' => [
  "name" => "نام",
  "username" => "نام کاربری",
  "email" => "پست الکترونیکی",
  "first_name" => "نام",
  "last_name" => "نام خانوادگی",
  "family" => "نام خانوادگی",
  "password" => "رمز عبور",
  "password_confirmation" => "تاییدیه ی رمز عبور",
  "city" => "شهر",
  "country" => "کشور",
  "address" => "نشانی",
  "phone" => "تلفن",
  "mobile" => "تلفن همراه",
  "age" => "سن",
  "sex" => "جنسیت",
  "gender" => "جنسیت",
  "day" => "روز",
  "month" => "ماه",
  "year" => "سال",
  "hour" => "ساعت",
  "minute" => "دقیقه",
  "second" => "ثانیه",
  "title" => "عنوان",
  "text" => "متن",
  "body" => "متن",
  "content" => "محتوا",
  "description" => "توضیحات",
  "excerpt" => "گلچین کردن",
  "date" => "تاریخ",
  "time" => "زمان",
  "available" => "موجود",
  "size" => "اندازه",
  "file" => "فایل",
  "image" => "عکس",
  "full_name" => "نام کامل",
//        'iran_mobile' => 'شماره همراه قابل قبول نیست.',
//        'sheba_number' => 'شماره شبا قابل قبول نیست.',
  'melli_code' => 'کد ملی',
//        'is_not_persian' => 'حروف غیر لاتین قابل قبول نیست.',
//        'iran_phone' => 'شماره تلفن قابل قبول نیست.',
//        'iran_phone_area' => 'شماره تلفن قابل قبول نیست.',
//        'card_number' => 'شماره کارت',
//        'iran_address' => 'آدرس',
//        'iran_postal_code' => 'کدپستی وارد شده قابل قبول نیست.',
  'place_lat' => 'طول جغرافیایی',
  'place_lng' => 'عرض جغرافیایی',
  'field_of_study_name' => 'نام رشته تحصیلی',
  'field_of_study_profile_name' => 'نام شاخه رشته تحصیلی',
  'field_of_study_profile_start_date' => 'تاریخ شروع دوره شاخه رشته تحصیلی',
  'field_of_study_profile_end_date' => 'تاریخ پایان دوره شاخه رشته تحصیلی',
  'area' => 'مساحت',
  'value' => 'مقدار',
  'type_buy' => 'نوع خرید',
  'otp_number' => 'کد ارسال شده',
  'national_code' => 'کد ملی',
  'discount_code' => 'کد تخفیف',
 ],
];
