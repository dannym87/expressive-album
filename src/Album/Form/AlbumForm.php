<?php

namespace App\Album\Form;

use Aura\Session\CsrfToken;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class AlbumForm extends Form implements InputFilterProviderInterface
{
    /**
     * @param string|null $name
     * @param array|null $options
     */
    public function __construct($name = null, $options = [])
    {
        // we want to ignore the name passed
        parent::__construct('album', $options);

        $this->add([
            'name' => 'id',
            'type' => 'Hidden',
        ]);

        $this->add([
            'name'    => 'title',
            'type'    => 'Text',
            'options' => [
                'label' => 'Title',
            ],
        ]);

        $this->add([
            'name'    => 'artist',
            'type'    => 'Text',
            'options' => [
                'label' => 'Artist',
            ],
        ]);

        $this->add([
            'name'       => 'submit',
            'type'       => 'Submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submit-button',
            ],
        ]);

        $this->add([
            'name'       => '_csrf',
            'type'       => 'hidden',
            'attributes' => [
                'value' => $this->getOption('csrf')->getValue(),
            ],
        ]);
    }

    /**
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return [
            [
                'name'     => 'id',
                'required' => true,
                'filters'  => [
                    ['name' => 'Int'],
                ],
            ],
            [
                'name'       => 'artist',
                'required'   => true,
                'filters'    => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ],
                    ],
                ],
            ],
            [
                'name'       => 'title',
                'required'   => true,
                'filters'    => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ],
                    ],
                ],
            ],
            [
                'name'       => '_csrf',
                'require'    => true,
                'validators' => [
                    [
                        'name'     => 'callback',
                        'options'  => [
                            'callback'        => function ($value, $context, CsrfToken $csrf) {
                                if ($csrf->isValid($value)) {
                                    return true;
                                }

                                return false;
                            },
                            'callbackOptions' => [
                                $this->getOption('csrf'),
                            ],
                            'message' => 'The form submitted did not originate from the expected site',
                        ],
                    ],
                ],
            ],
        ];
    }
}
