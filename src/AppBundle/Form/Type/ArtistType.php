<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Artist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class ArtistType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ArtistsTypeType::class)
            ->add('genre', TextType::class)
            ->add('picture', UrlType::class)
            ->add('venues', CollectionType::class, [
                'entry_type'  => VenueType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false
            ])
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $artist = $event->getData();
            $form = $event->getForm();

            if (null === $artist || null === $artist->getId()) {
                $form->add('name', TextType::class);
            }
        });
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Artist'
        ));
    }
}
