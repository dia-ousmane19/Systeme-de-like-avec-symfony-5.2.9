<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\LikePost;
use App\Repository\ArticleRepository;
use App\Repository\LikePostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index")
     */
    public function index(ArticleRepository $article): Response
    {
        return $this->render('home/index.html.twig', [
            'articles' => $article->findAll()
        ]);
    }
    /**
     * @Route("/{id}/like",name="like_post")
     */
    public function like(Article $article, EntityManagerInterface $em, LikePostRepository $like): Response
    {
        if (!$this->getUser()) {
            return $this->json(
                [
                    'message' => 'Vous n\'est pas connecter'
                ],
                200
            );
        }
        if ($article->isLikeByUser($this->getUser())) {
            $likeToRemove = $like->findOneBy(['article' => $article]);

            $em->remove($likeToRemove);
            $em->flush();
            return $this->json(
                [
                    'message' => 'Vous avez disliker cet article'
                ],
                200
            );
        }

        $like = new LikePost();
        $like->setUser($this->getUser());
        $like->setArticle($article);

        $em->persist($like);
        $em->flush();
        return $this->json(
            [
                'message' => 'Vous avez liker cet article'
            ],
            200
        );
    }
}
