<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

final class ThemeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(SessionInterface $session): Response
    {
        $theme = $session->get('theme', 'theme1'); // Padrão é theme1
        return $this->render('home.html.twig', ['theme' => $theme]);
    }

    #[Route('/blog', name: 'blog')]
    public function blog(SessionInterface $session): Response
    {
        $theme = $session->get('theme', 'theme1');
        return $this->render('blog.html.twig', ['theme' => $theme]);
    }
    
    #[Route('/trocar-tema/{theme}', name: 'trocar_tema')]
    public function trocarTema(SessionInterface $session, string $theme): Response
    {
        if (!in_array($theme, ['theme1', 'theme2'])) {
            throw $this->createNotFoundException('Tema inválido.');
        }
        $session->set('theme', $theme);
        return $this->redirectToRoute('home');
    }
}
