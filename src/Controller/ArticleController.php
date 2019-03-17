<?php
/**
 * Created by PhpStorm.
 * User: wilsonc
 * Date: 3/14/19
 * Time: 2:32 PM
 */

namespace App\Controller;


use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
  /**
   * @Route("/", name="app_homepage")
   */
  public function homepage() {
    return $this->render('homepage.html.twig');
  }

  /**
   * @Route("/news/{slug}", name="article_show")
   */
  public function show($slug) {

    $comments = [
      'I ate a normal rock once. It did NOT taste like bacon!',
      'Woohoo! I\'m going on an all-asteroid diet!',
      'I like bacon too! Buy some from my site! bakinsomebacon.com',
    ];

    return $this->render('article/show.html.twig', [
      'title' => ucwords(str_replace('-', ' ', $slug)),
      'slug' => $slug,
      'comments' => $comments,
    ]);
  }

  /**
   * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
   */
  public function toggleArticleHeart($slug, LoggerInterface $logger) {

    // TODO: add toggle to database

    $logger->info("Article is being hearted.");

    return $this->json(['hearts' => rand(5, 100)]);
  }
}