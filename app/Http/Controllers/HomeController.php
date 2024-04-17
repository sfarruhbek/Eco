<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\participants;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function welcome(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $languages=Language::all();
        return view('welcome',['languages'=>$languages]);
    }
    public function language(Request $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $request->validate([
            'lan'=>"required|integer"
        ]);
        $data=Language::find($request->lan);
        return response($data);
    }

    public function main(Request $request)
    {
        $request->validate([
            'lan'=>'required|integer'
        ]);
        $lan=Language::find($request->lan);
        $data=[
            'uz'=>[
                'btn1'=>"Ekologiya uchun",
                't1'=>"Har bir kiritish uchun ekologiyaga 10 so'm ajratiladi",
                'btn2'=>"Raqamni kiriting",
                't2'=>"Qimmatbaho sovg'alar yutib olishingiz uchun raqamingizni kiritng",
            ],
            'en'=>[
                'btn1'=>"For the environment",
                't1'=>"For each bottle, 10 sum will be credited to the ecology account",
                'btn2'=>"Enter your phone",
                't2'=>"To win valuable gifts, enter your phone number",
            ],
            'ru'=>[
                'btn1'=>"Для экологии",
                't1'=>"За каждую баклашку 10 сум будет зачислиться на счёт экологии",
                'btn2'=>"Введите номер",
                't2'=>"Чтобы выиграть дорогоценные подарки введите номер телефона",
            ]
        ];
        return response($data[$lan->lan]);
    }
    public function phone(Request $request)
    {
        $request->validate([
            'lan'=>'required|integer'
        ]);
        $lan=Language::find($request->lan);
        $data=[
            'uz'=>[
                'btn1'=>"Keyingi",
                'btn2'=>"Ortga",
            ],
            'en'=>[
                'btn1'=>"Next",
                'btn2'=>"Cancel",
            ],
            'ru'=>[
                'btn1'=>"Далее",
                'btn2'=>"Назад",
            ]
        ];
        return response($data[$lan->lan]);
    }
    public function accept(Request $request)
    {
        $request->validate([
            'lan'=>'required|integer'
        ]);
        $lan=Language::find($request->lan);
        $data=[
            'uz'=>[
                'btn1'=>"Yuborish",
                'title'=>"Muvaffaqiyatli qabul qilindi",
                'text'=>"Tabriklaymiz! Siz aksiyada ishtirokchisiga aylandingiz, aksiya haqida batafsil eco.unusual.uz saytida bilib olishingiz mumkin!!!",
                'title_null'=>"Hech narsa kiritilmagan",
                'text_null'=>"Mahsulot kiritish uchun cancel ni bosing, davom etish uchun OK tugmasini bosing!",
            ],
            'en'=>[
                'btn1'=>"Send",
                'title'=>"Accepted successfully",
                'text'=>"Congratulation! You have become a participant in the campaign, you can find out more about the campaign at eco.unusual.uz!!!",
                'title_null'=>"Nothing entered",
                'text_null'=>"Click Cancel to enter the product, click OK to continue!",
            ],
            'ru'=>[
                'btn1'=>"Отправить",
                'title'=>"Принято успешно",
                'text'=>"Поздравляем! Вы стали участником акции, подробнее об акции вы можете узнать на сайте eco.unusual.uz!!!",
                'title_null'=>"Ничего не введено",
                'text_null'=>"Нажмите «Cancel», чтобы войти в продукт, нажмите «ОК», чтобы продолжить!",
            ]
        ];
        return response($data[$lan->lan]);
    }
    public function JustAccept(Request $request)
    {
        $request->validate([
            'lan'=>'required|integer'
        ]);
        $lan=Language::find($request->lan);
        $data=[
            'uz'=>[
                'btn1'=>"Yuborish",
                'title'=>"Muvaffaqiyatli qabul qilindi",
                'text'=>"Rahmat! Siz ekologiya uchun o\'z hissangizni qo\'shdingiz!!!",
                'title_null'=>"Hech narsa kiritilmagan",
                'text_null'=>"Mahsulot kiritish uchun cancel ni bosing, davom etish uchun OK tugmasini bosing!",
            ],
            'en'=>[
                'btn1'=>"Send",
                'title'=>"Accepted successfully",
                'text'=>"Thank you! You have done your part for the environment!!!",
                'title_null'=>"Nothing entered",
                'text_null'=>"Click Cancel to enter the product, click OK to continue!",
            ],
            'ru'=>[
                'btn1'=>"Отправить",
                'title'=>"Принято успешно",
                'text'=>"Спасибо! Вы внесли свой вклад в защиту окружающей среды!!!",
                'title_null'=>"Ничего не введено",
                'text_null'=>"Нажмите «Cancel», чтобы войти в продукт, нажмите «ОК», чтобы продолжить!",
            ]
        ];
        return response($data[$lan->lan]);
    }
    public function phone_incorrectly(Request $request)
    {
        $request->validate([
            'lan'=>'required|integer'
        ]);
        $lan=Language::find($request->lan);
        $data=[
            'uz'=>[
                'text'=>"Telefon nomer noto'g'ri kiritilgan!",
            ],
            'en'=>[
                'text'=>"The phone number was entered incorrectly!",
            ],
            'ru'=>[
                'text'=>"Номер телефона введен неверно!",
            ]
        ];
        return response($data[$lan->lan]);
    }
    public function save_data(Request $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $request->validate([
            'phone'=>"required|integer",
            'product_number'=>"required|integer"
        ]);
        $data=new Participants();

        $data->phone=$request->phone;
        $data->product_number=$request->product_number;

        $data->save();
        return response($request);
    }

}
