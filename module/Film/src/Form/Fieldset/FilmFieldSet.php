<?php
/**
 * User: youcef_l
 * Date: 20/02/2017
 * Time: 11:28
 */
declare(strict_types = 1);


namespace Film\Form\Fieldset;


use Actor\Entity\Actor;
use Category\Entity\Category;
use Doctrine\ORM\EntityManager;
use DoctrineModule\Form\Element\ObjectSelect;
use Film\Entity\Film;
use Zend\Filter\StringToUpper;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\Form\Element\Date;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Validator\StringLength;


class FilmFieldSet extends Fieldset implements InputFilterProviderInterface
{

    private $objectManger;

    public function __construct(EntityManager $objectManager)
    {
        $this->objectManger = $objectManager;
        parent::__construct();
    }

    public function init()
    {
        $this->setHydrator(new DoctrineHydrator($this->objectManger))
             ->setObject(new Film());

        $this->add(
           [
              'name' => 'id',
              'type' => Hidden::class
           ]
        );
        $this->add(
            [
                'name'    => 'synopsis',
                'type'    => Textarea::class,
                'options' => [
                    'label' => 'Synopsis',
                ],
            ]
        );
        $this->add(
            [
                'name'    => 'title',
                'type'    => Text::class,
                'options' => [
                    'label' => 'Titre',
                ],
            ]
        );
        $this->add(
            [
                'name'    => 'director',
                'type'    => Text::class,
                'options' => [
                    'label' => 'Rélisateur',
                ],
            ]
        );

        $this->add(
            [
                'name'    => 'dtRelease',
                'type'    => Date::class,
                'options' => [
                    'label' => 'Date de sortie',
                    'format' => 'Y-m-d'
                ],
            ]
        );

        $this->add(
            [
                'name'    => 'category',
                'type'    => ObjectSelect::class,
                'options' => [
                    'label' => 'Categories',
                    'target_class'   => Category::class,
                    'object_manager' => $this->objectManger,
                    'is_method'      => true,
                    'property' => 'title',
                    'find_method'        => [
                        'name'   => 'getCategories',
                    ],
                    'display_empty_item' => true,
                    'empty_option'  => '--- select une catégorie ---',
                ],
            ]
        );

        $this->add(
            [
                'name'    => 'actor',
                'type'    => ObjectSelect::class,
                'attributes' => [
                    'multiple' => true,
                ],
                'options' => [
                    'label' => 'Acteurs',
                    'target_class'   => Actor::class,
                    'object_manager' => $this->objectManger,
                    'is_method'      => true,
                    'property' => 'firstName',
                    'find_method'        => [
                        'name'   => 'getActors',
                    ],
                    'display_empty_item' => true,
                    'empty_option'  => '--- select un ou plusieurs acteurs ---',
                ],
            ]
        );
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return [
            'id' => [
                'require' => true,
                'filters' => [
                    ['name' => ToInt::class ]
                ]
            ],
            'genre' => [
                'require' => true,
                'filters' => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                    ['name' => StringToUpper::class],
                ],
                'validators' => [
                    [
                        'name'    => StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ],
                    ],
                ]
            ],
            'title' => [
                'require' => true,
                'filters' => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    [
                        'name'    => StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ],
                    ],
                ]
            ]
        ];
    }
}
