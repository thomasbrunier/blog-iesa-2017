<?php

namespace JoliBlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/{name}", name="ma_jolie_route")
     * @param string $name
     * @return Response
     */
    public function indexAction(string $name): Response
    {
        $router = $this->get('router');
        $url = $router->generate('ma_jolie_route', ['name' => $name], UrlGeneratorInterface::ABSOLUTE_URL);

        switch ($name){
            case 'facebook':
            case 'twitter':
            case 'google':
                return $this->redirect("http://".$name.".fr");
            break;

            default:
                return $this->render('JoliBlogBundle:Default:index.html.twig', [
                    'name' => $name,
                    'url' => $url,
                ]);
            break;
        }
    }
}
