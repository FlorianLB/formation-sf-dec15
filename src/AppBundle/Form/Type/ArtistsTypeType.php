<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Artist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtistsTypeType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => [
                'Solo' => Artist::TYPE_SOLO,
                'Band' => Artist::TYPE_BAND
            ]
        ]);
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}
