<?php

namespace Botble\CarRentals\Http\Controllers\Settings;

use Botble\CarRentals\Forms\Settings\AppInfoSettingForm;
use Botble\CarRentals\Http\Requests\Settings\AppInfoSettingRequest;
use Illuminate\Http\Request;

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
        return $this->performUpdate($request->validated());
    }
}
