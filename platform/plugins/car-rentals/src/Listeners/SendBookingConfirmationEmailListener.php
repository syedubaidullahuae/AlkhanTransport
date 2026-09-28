<?php

namespace Botble\CarRentals\Listeners;

use Botble\Base\Facades\EmailHandler;
use Botble\CarRentals\Events\BookingCreated;
use Botble\CarRentals\Models\Customer;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendBookingConfirmationEmailListener implements ShouldQueue
{
    public function handle(BookingCreated $event): void
    {
        $mailer = EmailHandler::setModule(CAR_RENTALS_MODULE_SCREEN_NAME);

        $booking = $event->booking;
        $bookingCar = $booking->car;
        $vehicleType = $bookingCar->vehicle_type_id
            ? $bookingCar->vehicleType->name
            : '';
        $rentalStartDate = $bookingCar->rental_start_date?->format('M d, Y') ?? '';
        $rentalEndDate = $bookingCar->rental_end_date?->format('M d, Y') ?? '';
        $rentalDuration = null;

        if ($bookingCar->rent_type === 'monthly' && (float) $bookingCar->no_of_months > 0) {
            $months = (float) $bookingCar->no_of_months;
            $formattedMonths = rtrim(rtrim(number_format($months, 2, '.', ''), '0'), '.');
            $rentalDuration = $formattedMonths . ' ' . ($months === 1.0 ? __('month') : __('months'));
        }

        $mailer->setVariableValues([
            'booking_code' => $booking->booking_number,
            'customer_name' => $booking->customer_name,
            'customer_email' => $booking->customer_email,
            'customer_phone' => $booking->customer_phone,
            'car_name' => $bookingCar->vehicle_type_id ? '' : $bookingCar->car_name,
            'vehicle_type' => $vehicleType,
            'rental_duration' => $rentalDuration,
            'payment_method' => $booking->payment ? $booking->payment->payment_channel->label() : 'N/A',
            'pickup_address' => $bookingCar->pickup_address_text,
            'return_address' => $bookingCar->return_address_text,
            'rental_start_date' => $rentalStartDate,
            'rental_end_date' => $rentalEndDate,
            'note' => $booking->note,
        ]);

        $mailer->sendUsingTemplate('booking-confirm', $booking->customer_email);
        $mailer->sendUsingTemplate('booking-notice-to-admin', null, [
            'replyTo' => $booking->customer_email,
        ]);

        if ($booking->car->vendor_id) {
            $vendor = Customer::query()->where('id', $booking->car->vendor_id)
                ->where('is_vendor', true)
                ->first();

            if ($vendor && $vendor->email) {
                $mailer->setVariableValues([
                    'vendor_name' => $vendor->name,
                    'booking_code' => $booking->booking_number,
                    'customer_name' => $booking->customer_name,
                    'customer_email' => $booking->customer_email,
                    'customer_phone' => $booking->customer_phone,
                    'car_name' => $bookingCar->vehicle_type_id ? '' : $bookingCar->car_name,
                    'vehicle_type' => $vehicleType,
                    'rental_duration' => $rentalDuration,
                    'payment_method' => $booking->payment ? $booking->payment->payment_channel->label() : 'N/A',
                    'pickup_address' => $bookingCar->pickup_address_text,
                    'return_address' => $bookingCar->return_address_text,
                    'rental_start_date' => $rentalStartDate,
                    'rental_end_date' => $rentalEndDate,
                    'note' => $booking->note,
                ]);

                $mailer->sendUsingTemplate('booking-notice-to-vendor', $vendor->email);
            }
        }
    }
}
