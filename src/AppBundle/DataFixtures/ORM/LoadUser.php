<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class LoadUser implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        /** @var EncoderFactoryInterface */
        $factory = $this->container->get('security.encoder_factory');

        $john = new User();
        $john->setUsername('john');
        $john->setEmail('john@spotizer.com');
        $john->setRoles(array('ROLE_USER'));
        $john->setEnabled(true);
        $encoder = $factory->getEncoder($john);
        $password = $encoder->encodePassword('john', $john->getSalt());
        $john->setPassword($password);
        $john->setApiToken('abcdefgh');
        $manager->persist($john);

        $sofia = new User();
        $sofia->setUsername('sofia');
        $sofia->setEmail('sofia@spotizer.com');
        $sofia->setRoles(array('ROLE_USER'));
        $sofia->setEnabled(true);
        $encoder = $factory->getEncoder($sofia);
        $password = $encoder->encodePassword('sofia', $sofia->getSalt());
        $sofia->setPassword($password);
        $sofia->setApiToken('1234567');
        $manager->persist($sofia);


        $manager->flush();
    }
}