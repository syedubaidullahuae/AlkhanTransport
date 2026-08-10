<?php

namespace Botble\CarRentals\Http\Controllers\Settings;

use Botble\CarRentals\Forms\Settings\AppInfoSettingForm;
use Botble\CarRentals\Http\Requests\Settings\AppInfoSettingRequest;
use Illuminate\Http\Request;
use Botble\Widget\Events\RenderingWidgetSettings;
use Botble\Widget\Facades\WidgetGroup;
use Botble\Widget\Models\Widget;

class AppinfoSettingController extends SettingController
{
    public function edit()
    {
        $this->pageTitle('App Info Setting');

        $form =   AppInfoSettingForm::create();


        return view('plugins/car-rentals::settings.whatsapp', compact('form'));
    }

    public function update(AppInfoSettingRequest $request)
    {

         $widget = Widget::query()
            ->where('widget_id', 'SiteInformationWidget')
            ->where('sidebar_id', 'footer_sidebar')
            ->first();

        $data = $widget->data;

        $data['description_3'] = $request->input('app_email');
        $data['description_4'] = '<a href="tel:' . $request->input('app_phone') . '">' . $request->input('app_phone') . '</a>';


        $data['description_1'] = $request->input('address');
        $data['description_2'] = $request->input('hour');

        $widget->data = $data;
        $widget->save();


         $header = Widget::query()->where('widget_id', 'ContactInformationWidget')
            ->where('sidebar_id', 'header_top_sidebar')
            ->first();
        $data = $header->data;

        $data['title_2'] = $request->input('app_email');
        $data['url_2'] = 'mailto:' . $request->input('app_email');

        $data['title_1'] =  $request->input('app_phone');
        $data['url_1'] = 'tel:' . $request->input('app_phone');
        $header->data = $data;
        $header->save();


        return $this->performUpdate($request->validated());
    }
}
