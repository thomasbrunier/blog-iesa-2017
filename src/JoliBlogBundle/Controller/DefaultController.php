<?php

namespace JoliBlogBundle\Controller;

use JoliBlogBundle\Entity\Post;
use JoliBlogBundle\Form\PostFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="list_posts")
     */
    public function listPostsAction()
    {
        $postRepository = $this->getDoctrine()->getRepository(Post::class);

        $posts = $postRepository->findAll();

        return $this->render('@JoliBlog/articles/list.html.twig', [
            'posts' => array_reverse($posts),
        ]);
    }

    /**
     * @Route("/nouvel-article", name="new_post")
     * @param Request $request
     * @return Response
     */
    public function newPostAction(Request $request)
    {
        $post = new Post();
        $post->setIsPublished(false);

        $form = $this->createForm(PostFormType::class, $post);

        if ($request->getMethod() === 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($post);
                $entityManager->flush();

                $this->get('session')->getFlashBag()->add('success', 'Votre article a bien été enregistré');

                return $this->redirectToRoute('list_posts');
            } else {
                return $this->render('@JoliBlog/articles/new.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }

        return $this->render('@JoliBlog/articles/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

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
