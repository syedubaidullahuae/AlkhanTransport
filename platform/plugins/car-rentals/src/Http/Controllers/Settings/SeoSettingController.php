<?php

namespace Botble\CarRentals\Http\Controllers\Settings;

use Botble\CarRentals\Forms\Settings\SeoSettingForm;
use Botble\CarRentals\Http\Requests\Settings\SeoSettingRequest;
use Botble\CarRentals\Models\Service;
use Botble\Base\Facades\MetaBox;
use Botble\Blog\Models\Post;
use Botble\CarRentals\Models\Car;
use Botble\CarRentals\Models\CarMake;
use Botble\Page\Models\Page;
use Illuminate\Http\Request;

class SeoSettingController extends SettingController
{
    public function edit()
    {
        $this->pageTitle('Seo Setting');

        $form =   SeoSettingForm::create();


        return view('plugins/car-rentals::settings.whatsapp', compact('form'));
    }

    public function update(SeoSettingRequest $request)
    {
        $data = $request->validated();

        $seoMode = $data['seo_global_robots'] ?? 'index';

        Page::query()->chunk(100, function ($pages) use ($seoMode) {
            foreach ($pages as $page) {
                $seoMeta = MetaBox::getMetaData($page, 'seo_meta', true);
                
                $seoMeta = is_array($seoMeta) ? $seoMeta : [];
                
                $seoMeta['index'] = $seoMode;

                // Save back to meta_boxes
                MetaBox::saveMetaBoxData($page, 'seo_meta', $seoMeta);
            }
        });


        
        Service::query()->chunk(100, function ($services) use ($seoMode) {
            foreach ($services as $service) {
                $seoMeta = MetaBox::getMetaData($service, 'seo_meta', true);
                
                $seoMeta = is_array($seoMeta) ? $seoMeta : [];
                
                $seoMeta['index'] = $seoMode;

                // Save back to meta_boxes
                MetaBox::saveMetaBoxData($service, 'seo_meta', $seoMeta);
            }
        });

        Car::query()->chunk(100, function ($cars) use ($seoMode) {
            foreach ($cars as $car) {
                $seoMeta = MetaBox::getMetaData($car, 'seo_meta', true);
                
                $seoMeta = is_array($seoMeta) ? $seoMeta : [];
                
                $seoMeta['index'] = $seoMode;

                // Save back to meta_boxes
                MetaBox::saveMetaBoxData($car, 'seo_meta', $seoMeta);
            }
        });

        Post::query()->chunk(100,function ($blogs) use ($seoMode) {
            foreach ($blogs as $blog) {
                $seoMeta = MetaBox::getMetaData($blog, 'seo_meta', true);
                
                $seoMeta = is_array($seoMeta) ? $seoMeta : [];
                
                $seoMeta['index'] = $seoMode;

                // Save back to meta_boxes
                MetaBox::saveMetaBoxData($blog, 'seo_meta', $seoMeta);
            }
        });

        CarMake::query()->chunk(100,function ($carMakes) use ($seoMode) {
            foreach ($carMakes as $carMake) {
                $seoMeta = MetaBox::getMetaData($carMake, 'seo_meta', true);
                
                $seoMeta = is_array($seoMeta) ? $seoMeta : [];
                
                $seoMeta['index'] = $seoMode;

                // Save back to meta_boxes
                MetaBox::saveMetaBoxData($carMake, 'seo_meta', $seoMeta);
            }
        });

        return $this->performUpdate($data);
    }
}