<?php

namespace Botble\CarImport\Http\Controllers;

use Illuminate\Routing\Controller;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Botble\CarImport\Forms\ImportForm;
use Botble\CarImport\Http\Requests\ImportRequest;
use Botble\Base\Supports\Breadcrumb;
use Botble\CarImport\Helpers\SmartRelationMapper;
use Botble\CarRentals\Models\Car;
use Botble\CarRentals\Models\CarMake;
use Botble\CarRentals\Models\CarType;
use Botble\CarRentals\Models\CarFuel;
use Botble\CarRentals\Models\CarCategory;
use Botble\CarRentals\Models\CarTag;
use Botble\CarRentals\Models\CarColor;
use Botble\CarRentals\Models\CarAmenity;
use Botble\Location\Models\Country;
use Botble\Location\Models\State;
use Botble\Location\Models\City;
use Botble\CarRentals\Enums\ModerationStatusEnum;
use Botble\CarRentals\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class CarImportController extends BaseController
{
    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add('Import Cars', route('import.index'));
    }

    public function index()
    {
        $this->pageTitle('Import Cars');
        return ImportForm::create()
            ->setUrl(route('import.store'))
            ->renderForm();
        //return view('car-import::import');
    }

    public function store(ImportRequest $request)
    {
        $file = $request->file('csv_file');
        $rows = array_map('str_getcsv', file($file->getRealPath()));
        $header = array_map('trim', $rows[0]);
        unset($rows[0]);
        $total = count($rows);
        $success = 0;
        $failed = [];

        
        foreach ($rows as $index => $row) {

            $rowNumber = $index + 2;
            try {

                $data = array_combine($header, $row);
               
                
                // 🧩 Map relations using SmartRelationMapper
                $data['make_id'] = SmartRelationMapper::mapSingle(CarMake::class, $data['make'] ?? null);
                
                $data['vehicle_type_id'] = SmartRelationMapper::mapSingle(CarType::class, $data['vehicle_type'] ?? null);
                
                $data['fuel_type_id'] = SmartRelationMapper::mapSingle(CarFuel::class, $data['fuel_type'] ?? null);
                
                $categoryIds = SmartRelationMapper::mapMultiple(CarCategory::class, $data['categories'] ?? null);
                
                $tagIds = SmartRelationMapper::mapMultiple(CarTag::class, $data['tags'] ?? null);
                $colorIds = SmartRelationMapper::mapMultiple(CarColor::class, $data['colors'] ?? null);
                $amenityIds = SmartRelationMapper::mapMultiple(CarAmenity::class, $data['amenities'] ?? null);

                $countryId = SmartRelationMapper::mapSingle(Country::class, $data['country'] ?? null);
                $stateId = SmartRelationMapper::mapSingle(State::class, $data['state'] ?? null);
                $cityId = SmartRelationMapper::mapSingle(City::class, $data['city'] ?? null);

                // Create Car
                $car = new Car();
                $car->fill([
                    'name' => $data['name'] ?? null,
                    'description' => $data['description'] ?? null,
                    'content' => $data['content'] ?? null,
                    'location' => $data['location'] ?? null,
                    'country_id' => $countryId,
                    'state_id' => $stateId,
                    'city_id' => $cityId,
                    'address' => $data['address'] ?? null,
                    'make_id' => $data['make_id'] ?? null,
                    'vehicle_type_id' => $data['vehicle_type_id'] ?? null,
                    'transmission_id' => $data['transmission_id'] ?? null,
                    'fuel_type_id' => $data['fuel_type_id'] ?? null,
                    'year' => $data['year'] ?? null,
                    'mileage' => $data['mileage'] ?? null,
                    'horsepower' => $data['horsepower'] ?? null,
                    'number_of_seats' => $data['number_of_seats'] ?? null,
                    'number_of_doors' => $data['number_of_doors'] ?? null,
                    'luggage_capacity' => $data['luggage_capacity'] ?? null,
                    'rental_rate' => $data['rental_rate'] ?? null,
                    'rental_type' => $data['rental_type'] ?? null,
                    'monthly_rent' => $data['monthly_rent'] ?? null,
                    'tax_id' => $data['tax_id'] ?: null,
                    'license_plate' => $data['license_plate'] ?? null,
                    'vin' => $data['vin'] ?? null,
                    'images' => !empty($data['images']) ? explode('|', $data['images']) : [],
                    'status' => $data['status'] ?? 'published',
                    'author_id' => 1,
                    'moderation_status' => 'approved',
                ]);
                $car->save();

                // Sync relations
                if ($categoryIds) $car->categories()->sync($categoryIds);
                if ($tagIds) $car->tags()->sync($tagIds);
                if ($colorIds) $car->colors()->sync($colorIds);
                if ($amenityIds) $car->amenities()->sync($amenityIds);

                $success++;
            } catch (\Exception $e) {
                $failed[] = [
                    'row' => $rowNumber,
                    'error' => $e->getMessage(),
                ];
            }
        }

        return view('plugins/car-import::report', compact('success', 'failed','total'));
    }

    private function mapSingle(Model $model, ?string $name): ?int
    {
        if (empty($name)) {
            return null;
        }

        $record = $model::firstOrCreate([
            'name' => trim($name),
        ]);

        return $record->id;
    }
}
