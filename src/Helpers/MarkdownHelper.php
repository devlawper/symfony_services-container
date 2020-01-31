<?php


namespace App\Helpers;


use cebe\markdown\Markdown;

class MarkdownHelper
{
    // Création de la variable $parser
    protected $parser;

    // Dans le constructeur on crée une instance de cebe\markdown\Markdown qu'on passe à notre variable
    public function __construct(Markdown $parser)
    {
        $this->parser = $parser;
    }

    // Dans cette fonction on dispose donc du parser !
    public function parsedPosts(array $posts) : array
    {
        $parsedPosts = [];

        foreach ($posts as $post) {
            $parsedPosts[] = [
                'title' => $post->getTitle(),
                'content' => $this->parser->parse($post->getContent())
            ];
        }

        return $parsedPosts;
    }
}