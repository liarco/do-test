<?php

namespace App\Controller;

use App\Form\TestFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/", name="test")
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(TestFormType::class, [], [
            'csrf_protection' => false,
        ]);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            dd($form->getData());
        }

        return $this->render('test/index.html.twig', [
            'hostname' => gethostname(),
            'form' => $form->createView(),
        ]);
    }
}
