<?php

namespace CodeFlix\Forms;

use CodeFlix\Models\Plan;
use Kris\LaravelFormBuilder\Form;
use CodeFlix\Models\PayPalWebProfile;

class PlanForm extends Form
{
    public function buildForm()
    {
        $durations = [
            Plan::DURATION_MONTHLY => 'Mensal',
            Plan::DURATION_YEARLY => 'Anual'
        ];

        $this->add('duration', 'select', [
            'label' => 'Duração',
            'choices' => $durations,
            'rules' => 'required|in:' . implode(',', array_keys($durations))
        ])
        ->add('paypal_web_profile_id', 'entity', [
            'class' => PayPalWebProfile::class,
            'property' => 'name',
            'empty_value' => 'Selecione o perfil PayPal',
            'label' => 'Perfil web PayPal',
            'rules' => 'required|exists:paypal_web_profiles,id'
        ])
        ->add('name', 'text', [
            'label' => 'Nome',
            'rules' => 'required|max:255'
        ])
        ->add('description', 'text', [
            'label' => 'Descrição',
            'rules' => 'required|max:255'
        ])
        ->add('value', 'text', [
            'label' => 'Valor',
            'rules' => 'required|numeric'
        ]);
    }
}
