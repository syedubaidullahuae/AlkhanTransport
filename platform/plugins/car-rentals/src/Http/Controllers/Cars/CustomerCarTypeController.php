<?php

namespace Botble\CarRentals\Http\Controllers\Cars;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\CarRentals\Forms\CustomerCarTypeForm;
use Botble\CarRentals\Http\Requests\CustomerCarTypeRequest;
use Botble\CarRentals\Models\CustomerCarType;
use Botble\CarRentals\Tables\CustomerCarTypeTable;

class CustomerCarTypeController extends BaseController
{
    /**
     * List car amenities
     *
     * @group Car Rentals
     */
   public function __construct()
    {
        $this->breadcrumb()
            ->add("Register From Car Type")
            ->add("Register From Car Type", route('car-rentals.car-amenities.index'));
    }

    public function index(CustomerCarTypeTable $table)
    {
        $this->pageTitle(trans('plugins/car-rentals::car-rentals.attribute.car_type.name'));

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/car-rentals::car-rentals.attribute.car_type.create'));

        return CustomerCarTypeForm::create()->renderForm();
    }

    public function store(CustomerCarTypeRequest $request)
    {
        $form = CustomerCarTypeForm::create()->setRequest($request);
        $form->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('car-rentals.customer-car-types.index'))
            ->setNextUrl(route('car-rentals.customer-car-types.edit', $form->getModel()->getKey()))
            ->withCreatedSuccessMessage();
    }

    public function edit(CustomerCarType $customerCarType)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $customerCarType->name]));

        return CustomerCarTypeForm::createFromModel($customerCarType)->renderForm();
    }

    public function update(CustomerCarType $customerCarType, CustomerCarTypeRequest $request)
    {
        CustomerCarTypeForm::createFromModel($customerCarType)
            ->setRequest($request)
            ->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('car-rentals.customer-car-types.index'))
            ->withUpdatedSuccessMessage();
    }

    public function destroy(CustomerCarType $customerCarType)
    {
        return DeleteResourceAction::make($customerCarType);
    }
}
