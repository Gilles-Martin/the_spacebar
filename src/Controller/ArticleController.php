<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Entity\Article;
use App\Service\SlackClient;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of ArticleController
 *
 */
class ArticleController extends AbstractController
{

    /**
     * @var bool
     */
    private $isDebug;

    public function __construct(bool $isDebug)
    {

        $this->isDebug = $isDebug;
    }

    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {
        return $this->render('article/homepage.html.twig');
    }

    /**
     * @Route("/news/{slug}", name="article_show")
     */
    public function show($slug, SlackClient $slack, EntityManagerInterface $em)
    {

        if ($slug === 'khaaaaaan') {
            $slack->sendMessage('Gilles', 'Ah, Kirk, my old friend... Version 2 from symfony');
        }
        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];

        $repository = $em->getRepository(Article::class);
        /** @var Article $article */
        $article = $repository->findOneBy(['slug' => $slug]);

        if (!$article) {
            throw $this->createNotFoundException(sprintf('No article for slug "%s"', $slug));
        }


        return $this->render('article/show.html.twig', [
                    'article' => $article,
                    'comments' => $comments,
        ]);
    }

    /**
     * 
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart($slug, LoggerInterface $logger)
    {
        $logger->info('Article is being hearted!');
        // TODO - actually heart/unheart the article!
        return new JsonResponse(['hearts' => rand(5, 100)]);
    }

}
