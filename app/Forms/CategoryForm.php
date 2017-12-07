<?php

namespace CodeFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class CategoryForm extends Form
{
    public function buildForm()
    {
       $this->add('name', 'text', [
          'label' => 'Nome da categoria',
          'rules' => 'required|max:100'
       ]);
    }
}
