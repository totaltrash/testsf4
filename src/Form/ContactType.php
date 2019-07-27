<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Organisation;
use App\Form\Contact\EmailType;
use App\Form\Contact\PhoneType;
use App\Form\Contact\AddressType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('surname')
            ->add('notes', null, ['attr' => ['rows' => '4']])
            ->add('emails', CollectionType::class, [
                'entry_type' => EmailType::class,
                'entry_options' => ['label' => false],
                'allow_delete' => true,
                'allow_add' => true,
                'by_reference' => false,
            ])
            ->add('phones', CollectionType::class, [
                'entry_type' => PhoneType::class,
                'entry_options' => ['label' => false],
                'allow_delete' => true,
                'allow_add' => true,
                'by_reference' => false,
            ])
            ->add('addresses', CollectionType::class, [
                'entry_type' => AddressType::class,
                'entry_options' => ['label' => false],
                'allow_delete' => true,
                'allow_add' => true,
                'by_reference' => false,
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $contact = $event->getData();
                $form = $event->getForm();
                
                if ($contact->getId() === null) {
                    // when adding a contact, show a text box with autocomplete
                    $form->add('organisation', TextType::class, [
                        'mapped' => false,
                        'attr' => [
                            'autocomplete' => 'off',
                            'list' => 'organisation-names',
                        ]
                    ]);
                } else {
                    // when editing a contact, show a select
                    $form->add('organisation', EntityType::class, [
                        'class' => Organisation::class,
                        'query_builder' => function (EntityRepository $er) {
                            return $er->findActiveQueryBuilder();
                        },
                        'choice_label' => 'name',
                    ]);
                }
            })
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
