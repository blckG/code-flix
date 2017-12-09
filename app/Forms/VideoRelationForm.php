<?php

namespace CodeFlix\Forms;

use CodeFlix\Models\Category;
use CodeFlix\Models\Serie;
use Kris\LaravelFormBuilder\Form;

class VideoRelationForm extends Form
{
    public function buildForm()
    {
        $this->add('categories', 'entity', [
            'label' => 'Categorias',
            'class' => Category::class,
            'property' => 'name',
            'multiple' => true,
            'attr' => [
                'name' => 'categories[]'
            ],
            'rules' => 'required|exists:categories,id'
        ])
            ->add('serie_id', 'entity', [
                'label' => 'Série',
                'class' => Serie::class,
                'property' => 'title',
                'empty_value' => 'Selecione a serie',
                'rules' => 'nullable|exists:series,id'
            ]);
    }
}
