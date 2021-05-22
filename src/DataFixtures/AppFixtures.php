<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\LikePost;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    protected $_user = [];
    protected $_article = [];

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $user = new User();
        $user->setEmail('admin@admin.com');

        $password = $this->encoder->encodePassword($user, '123456');
        $user->setPassword($password);
        $manager->persist($user);
        $_user[] = $user;
        for ($i = 1; $i <= 5; $i++) {
            $user = new User();
            $user->setEmail(sprintf('admin%s@admin.com', $i));
            $password = $this->encoder->encodePassword($user, '123456');
            $user->setPassword($password);
            $manager->persist($user);
            $_user[] = $user;
        }

        for ($i = 1; $i <= 6; $i++) {
            $article = new Article();
            $article->setTitre(sprintf('mon super titre %s', $i));
            $article->setContenu($faker->text(200));
            $article->setUser($faker->randomElement($_user));
            $manager->persist($article);
            $_article[] = $article;
        }
       

        $manager->flush();
    }
}
