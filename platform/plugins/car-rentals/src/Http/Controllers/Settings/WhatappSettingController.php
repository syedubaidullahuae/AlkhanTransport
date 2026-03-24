<?php

namespace Botble\CarRentals\Http\Controllers\Settings;

use Botble\CarRentals\Forms\Settings\WhatsappSettingForm;
use Botble\CarRentals\Http\Requests\Settings\WhatsappSettingRequest;
use Illuminate\Http\Request;

class WhatappSettingController extends SettingController
{
    public function edit()
    {
        $this->pageTitle('WhatsApp Booking Settings');

        $form =   WhatsappSettingForm::create();


        return view('plugins/car-rentals::settings.whatsapp', compact('form'));
    }

    public function update(WhatsappSettingRequest $request)
    {
        return $this->performUpdate($request->validated());
    }
}
