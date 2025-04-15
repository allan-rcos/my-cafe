<?php

namespace App\Libraries;

use CodeIgniter\Entity\Entity;

helper('form');
helper('inflector');

/**
 * @template T of Entity
 */
class FormHandler
{
    /** @var T|null */
    private mixed $entity = null;

    /** @var array<string, string> */
    protected $classes = [
        'upload_container' => 'upload-container',
        'input_container'  => 'form-floating mb-3',
        'input'            => 'form-control',
        'upload'           => 'form-control-lg',
        'textarea'         => 'form-control',
        'select'           => 'form-select',
        'label'            => 'form-label',
        'floating_label'   => '',
        'submit_container' => 'd-grid col-12 col-md-8 mx-auto m-3',
        'submit'           => 'btn btn-primary btn-block'
    ];

    /**
     * @return T|null
     */
    public function getEntity(): mixed
    {
        return $this->entity;
    }

    /**
     * @param T|null $entity
     */
    public function setEntity(mixed $entity): void
    {
        $this->entity = $entity;
    }

    public function getEntityProperty(string $property): mixed
    {
        $old = old($property);
        if ($old !== null) return $old;
        else if ($this->isEdit()) return $this->entity->{$property};
        return null;
    }

    public function getErrors(): string
    {
        if ($error = session('error'))
            return view('validation/single', ['error' => $error]);
        return validation_list_errors();
    }

    public function getUpload(string $name, string $property_name, string $span_class = null): string
    {
        $class = '';
        if ($span_class)
            $class = 'class="'.$span_class.'"';
        $id = 'imageUploader';
        $filename = $this->getEntityProperty($property_name);
        $input = form_upload(array_merge(
            [
                'class'       => $this->classes['upload'],
                'id'          => $id,
                'name'        => $property_name,
                'placeholder' => $name
            ],
            $this->isEdit() ?
                []: [ 'required' => true ]
        ));
        $label = form_label("<span $class>$name</span>", $id, array_merge([ 'class' => $this->classes['label'] ],
            $filename?['style' =>
                esc("background-image: url(\"".$this->getBaseURL($filename)."\");".
                "background-size: cover;")]:[]));
        return $this->getContainer($label.$input, 'upload_container');
    }

    public function getFloatingInput(string $name, string $property_name, string $form_type='text', bool $required=true, bool $disabled=false): string
    {
        $id = 'floating'.ucfirst(camelize($property_name)).'Input';
        $input = form_input(
            array_merge([
                'class'       => $this->classes[$disabled?'input_disabled':'input']??$this->classes['input'],
                'id'          => $id,
                'name'        => $property_name,
                'placeholder' => $name,
                'step'        => '0.01'
            ],
            $disabled ? ['disabled' => true]: [],
            $required ? ['required' => true]: []),
            value: $this->getEntityProperty($property_name) ?? '',
            type: $form_type
        );
        $label = form_label($name, $id, ['class' => $this->classes['floating_label']]);
        return $this->getContainer($input.$label, 'input_container');
    }

    public function getFloatingTextArea(string $name, string $property_name, bool $required=true, bool $disabled=false): string
    {
        $id = 'floating'.pascalize($property_name).'TextArea';
        $input = form_textarea(
            array_merge([
                'class'       => $this->classes[$disabled?'textarea_disabled':'textarea']??$this->classes['textarea'],
                'id'          => $id,
                'name'        => $property_name,
                'placeholder' => $name
            ],
            $disabled ? ['disabled' => true]: [],
            $required ? ['required' => true]: []),
            value: $this->getEntityProperty($property_name) ?? ''
        );
        $label = form_label($name, $id, ['class' => $this->classes['floating_label']]);
        return $this->getContainer($input.$label, 'input_container');
    }

    /**
     * @param array<string, string> $options
     */
    public function getFloatingSelect(string $name, string $property_name, array $options, bool $disabled=false): string
    {
        $id = 'floating'.ucfirst(camelize($property_name)).'Select';
        $options = array_merge(['placeholder' => $name], $options);
        $input = form_dropdown(
            array_merge([
                'class'       => $this->classes[$disabled?'select_disabled':'select']??$this->classes['select'],
                'id'          => $id,
                'name'        => $property_name
            ], $disabled? ['disabled' => true]: []),
            options: $options,
            selected: [ 'id-'.$this->getEntityProperty($property_name) ?? 'placeholder' ],
        );
        $label = form_label($name, $id, ['class' => $this->classes['floating_label']]);
        return $this->getContainer($input.$label, 'input_container');
    }

    public function getSubmit(string $text = 'Salvar', bool $disabled=false): string
    {
        $submit = form_submit('', $text,
            array_merge(
                ['class'=>$this->classes[$disabled?'submit_disabled':'submit']??$this->classes['submit']],
                $disabled ? ['disabled'=>true] : []
            )
        );
        return $this->getContainer($submit, 'submit_container');
    }

    public function isEdit(): bool
    {
        return !($this->entity === null);
    }

    protected function getBaseUrl(string $filename): string
    {
        $base_url = base_url(service('file_manager')::URI.DIRECTORY_SEPARATOR.$filename);
        $base_url = htmlspecialchars(urldecode($base_url)); // unescape
        $base_url = str_replace(DIRECTORY_SEPARATOR, '/', $base_url); // change backslashes to slashes
        return htmlspecialchars(urldecode($base_url));
    }

    protected function getContainer(string $content, string $class_name = ''): string
    {
        $class = $class_name ? "class=\"{$this->classes[$class_name]}\"":'';
        return '<div '.$class.'>'.$content.'</div>';
    }
}