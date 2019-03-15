<?php
/**
 * Created by PhpStorm.
 * User: wilsonc
 * Date: 3/14/19
 * Time: 2:32 PM
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController
{
  /**
   * @Route("/")
   */
  public function homepage() {
    return new Response('OMG! My first page already! Woo!');
  }

  /**
   * @Route("/news/{slug}")
   */
  public function show($slug) {
    return new Response(sprintf(
      "Future page to show one space article: %s",
      $slug
    ));
  }
}