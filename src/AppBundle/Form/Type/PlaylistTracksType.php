<?php

namespace AppBundle\Form\Type;

use AppBundle\Repository\TrackRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaylistTracksType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        return $resolver->setDefaults([
                'class'        => 'AppBundle:Track',
                'choice_label' => 'title',
                'multiple'     => true,
                'expanded'     => true,
                'query_builder' => function (TrackRepository $er) {
                    return $er->findAllOrderedByTitleQueryBuilder();
                }
        ]);
    }

    public function getParent()
    {
        return EntityType::class;
    }
}
