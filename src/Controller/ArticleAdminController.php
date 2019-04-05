<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Entity\Article;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of ArticleAdminController
 *
 * @author Dev04
 */
class ArticleAdminController extends AbstractController
{



    /**
     * @Route("/admin/article/new")
     */
    public function new(EntityManagerInterface $em)
    {

        die('Todo');
/*
        return new Response(sprintf(
                        'Hiya! New Article id: #%d slug: %s',
                        $article->getId(),
                        $article->getSlug()
        ));*/
    }

}
