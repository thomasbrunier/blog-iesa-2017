<?php

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use JoliBlogBundle\Entity\Post;

class LoadPostFixtures implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $i = 1;

        while ($i <= 100) {
            $post = new Post();
            $post->setTitle('Titre du post n°' . $i);
            $post->setBody('Corps du post');
            $post->setIsPublished($i%2);

            $manager->persist($post);

            $i++;
        }

        $manager->flush();
    }
}
