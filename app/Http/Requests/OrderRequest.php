<?php

namespace CodeFlix\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use CodeFlix\PayPal\PaymentClient;
use CodeFlix\Models\Plan;

class OrderRequest extends FormRequest
{
    private $payementClient;

    public function __construct(PaymentClient $payementClient)
    {
        $this->payementClient = $payementClient;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $paymentId = $this->get('payment_id');
        if(!$paymentId) {
            return false;
        }
        $payment = $this->payementClient->get($paymentId);
        $planSku = $payment->getTransactions()[0]->getItemList()->getItems()[0]->getSku();
        $planId = Plan::getIdFromSku($planSku);
        return $planId == $this->route('plan')->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payer_id' => 'required'
        ];
    }
}
