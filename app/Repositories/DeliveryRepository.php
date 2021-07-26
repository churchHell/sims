<?php

namespace App\Repositories;

use Ixudra\Curl\Facades\Curl;
use App\Exceptions\NotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class DeliveryRepository extends Repository implements Contracts\DeliveryRepositoryContract
{

    public function getPrice(int $sid, int $qty): Collection {
        $delivery = $this->sendDeliveryQuery($this->getDeliveryData([compact('sid', 'qty')]))->first();
        throw_if(!$this->isDeliveryValid($delivery), NotFoundException::class, 'delivery');
        return $delivery;
    }
    
    public function getPrices(Collection $items): Collection
    {
        $deliveries = $this->sendDeliveryQuery($this->getDeliveryData($items->toArray()));
        $filtered = $deliveries->filter( fn($delivery) => $this->isDeliveryValid($delivery) );
        return $filtered;
    }
        

    // protected function addQtyToDelivery(object $deliveries, array $data): object
    // {
    //     foreach ($data as $d){
    //         if(empty($deliveries->{$d['sid']})){
    //             continue;
    //         }
    //         $deliveries->{$d['sid']}->qty = $d['qty'];
    //     }
    //     return $deliveries;
    // }
    
    protected function sendDeliveryQuery(array $data): Collection
    {
        return collect(Curl::to($this->getDeliveryPriceUrl())->withData($data)->asJson()->post())->mapInto(Collection::class);
    }

    protected function getDeliveryData(array $data): array {
        return [
            'settlement_id' => 193824312,
            'items' => $data,
        ];
    }

    protected function getDeliveryPriceUrl(): string {
        return config('api.url').'/delivery-calc/';
    }

    // public function getDeliveryUser() {
    //     $user = Curl::to($this->getDeliveryAddressUrl())
    //         ->withContentType('application/json')
    //         ->withOption('USERPWD', config('api.login').':'.config('api.pass'))
    //         ->asJson()
    //         ->get();
    //     try {
    //         dd($user);
    //         return $user->items[0];
    //     } catch (\Exception $e){
    //         throw new NotFoundException('user');
    //     }
    // }

    // protected function getDeliveryAddressUrl(): string {
    //     return config('api.url').'/user-delivery-address/';
    // }
    
    private function isDeliveryValid(Collection $delivery): bool
    {
        $validator = Validator::make($delivery->all(), [
            'sid' => 'required|integer|min:1',
            'cost' => 'required|numeric|min:0',
        ]);
        return $validator->passes();
    }
    
//    private function isDeliveryCorrect(int $id, object $delivery): bool
//    {
//        return !empty($delivery = $delivery->$id) && !empty($delivery->sid) && !empty($delivery->cost) && is_numeric($delivery->sid) && is_numeric($delivery->cost);
//    }
//    
//    private function isDeliveriesCorrect(Collection $deliveries): bool
//    {
////        $deliveries
//    }

}
