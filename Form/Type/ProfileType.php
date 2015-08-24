<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Softlogo\CustomerBundle\Form\Type;

use Sonata\UserBundle\Model\UserInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfileType extends AbstractType
{
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('firstname', null, array(
                'label'    => 'form.label_firstname',
                'required' => false,
            ))
            ->add('lastname', null, array(
                'label'    => 'form.label_lastname',
                'required' => false,
            ))
            ->add('phone', null, array(
                'label'    => 'form.label_phone',
                'required' => false,
            ))
            ->add('email', null, array(
                'label'    => 'form.label_email',
                'required' => false,
            ))
            ->add('company')
            ->add('nip')
            ->add('regon')

			->add('addresses', 'collection', array(
				'type' => new \Softlogo\ShopBundle\Form\AddressType(), 
				'by_reference' => false,
				'allow_delete' => false,
				'allow_add'    => true,
			))

        ;
    }

    /**
     * {@inheritdoc}
     *
     * @deprecated Remove it when bumping requirements to Symfony 2.7+
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'softlogo_customer_profile';
    }
}
