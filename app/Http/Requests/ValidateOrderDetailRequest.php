<?php

namespace App\Http\Requests;

use App\AttributeProduct;
use Illuminate\Foundation\Http\FormRequest;

class ValidateOrderDetailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        // $rules = [
        //     'orderDetails' => 'array|required',
        //     'order_id' => 'required|string|exists:orders,id',
        //     //'description' => 'required|string|min:3',
        // ];

        // if (!empty($this->request->get('orderDetails')) && is_array($this->request->get('orderDetails'))) {

        //     foreach ($this->request->get('orderDetails') as $orderDetail => $quantity) {
        //         dd('orderDetails.' . $orderDetail . '.id');

        //         $rules['orderDetails.' . $orderDetail . '.id'] = 'required|numeric|exists:purchases,id';
        //         $rules['orderDetails.' . $orderDetail . '.quantity'] = 'required|string|max:200|min:2';

        //     }

        // }

        // return $rules;

        $rules = [
            'order_id' => 'required|string|exists:orders,id',
            'orderDetails' => [
                'required',
                'min:1', // make sure the input array is not empty <= edited
                'array',
                function ($attribute, $value, $fail) {
                    // index arr
                    $ids = [];
                    for ($i = 0; $i < count($value); $i++) {
                        array_push($ids, array_keys($value[$i]));
                    }
<<<<<<< HEAD
                    $ids = array_unique($ids, SORT_REGULAR);

                    // query to check if array keys is not valid
                    $AttributeProducttWithinArrIDs = AttributeProduct::whereIn('id', $ids)->count();

=======

                    // query to check if array keys is not valid
                    $AttributeProducttWithinArrIDs = AttributeProduct::whereIn('id', $ids)->count();
>>>>>>> a90f05ca68e2264c685a9477281ef51e4d16983b
                    if ($AttributeProducttWithinArrIDs != count($ids)) {
                        return $fail($attribute . ' is invalid.');
                    }

                    // -> "orderDetails is invalid"
                },
            ],

            'orderDetails.*' => [
                'required',
                'min:1', //
                function ($attribute, $value, $fail) {

                    foreach ($value as $id => $quantity) {

                        $attributeProduct = AttributeProduct::find($id);

                        if (!empty($attributeProduct->available_stock)) {

                            if (($attributeProduct->available_stock - $quantity) < 0) {

                                return $fail($attribute . ' quantity(' . $quantity . ') exceeded the available stock(' . $attributeProduct->available_stock . ') ');

                            }
                        }

                    }

                },
            ],

        ];

        return $rules;

    }

}
