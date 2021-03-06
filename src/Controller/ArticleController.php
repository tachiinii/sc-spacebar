<?php
/**
 * Created by PhpStorm.
 * User: wilsonc
 * Date: 3/14/19
 * Time: 2:32 PM
 */

namespace App\Controller;


use App\Service\MarkdownHelper;
use App\Service\SlackClient;
use Nexy\Slack\Client;
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
  public function show($slug, MarkdownHelper $markdownHelper, bool $isDebug, SlackClient $slack) {

    if ($slug == 'khaan') {
      $slack->sendMessage('Al Hosteen', 'What up, doge.');
    }

    $comments = [
      'I ate a normal rock once. It did NOT taste like bacon!',
      'Woohoo! I\'m going on an all-asteroid diet!',
      'I like bacon too! Buy some from my site! bakinsomebacon.com',
    ];

    $articleContent = <<<EOF
Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,
lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow
**turkey** shank eu pork belly meatball non cupim.

Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur
laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,
capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing
picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt
occaecat lorem meatball prosciutto quis strip steak.

Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak
mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon
strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur
cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck
fugiat.
EOF;

    $articleContent = $markdownHelper->parse($articleContent);

    return $this->render('article/show.html.twig', [
      'title' => ucwords(str_replace('-', ' ', $slug)),
      'articleContent' => $articleContent,
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