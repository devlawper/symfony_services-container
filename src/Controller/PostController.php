<?php

namespace App\Controller;

use App\Helpers\MarkdownHelper;
use App\Repository\PostRepository;
use cebe\markdown\Markdown;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/", name="post")
     * @param PostRepository $repository
     * @param MarkdownHelper $helper
     * @return Response
     *
     * Pour connaitre les class dispo dans le container de services la commande importante pour les connaitre est :
     * php bin/console autowiring --all
     * On crée l'instance de la class PostRepository dans la fonction
     *
     * Pour Markdown, la class n'est pas dans le container de services d'office, il faut donc la déclarer dans le services.yaml
     */
    public function index(PostRepository $repository, MarkdownHelper $helper)
    {
        $posts = $repository->findAll();

/*        $parsedPosts = [];

        foreach ($posts as $post) {
            $parsedPosts[] = [
              'title' => $post->getTitle(),
              'content' => $parser->parse($post->getContent())
            ];
        }*/

        // $helper est une instance de MarkdownHelper que nous avons créé pour gerer le traintement
        $parsedPosts = $helper->parsedPosts($posts);

        return $this->render('post/index.html.twig', [
            'posts' => $parsedPosts
        ]);
    }
}
