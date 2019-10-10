<?php

namespace App\Controller;

use Imk\AuthBundle\Factory\FileLoadConfig;
use Imk\FormBundle\Factory\Builder\FormBuilder;
use Imk\FormBundle\Factory\Form\Form;
use Imk\FormBundle\Factory\Form\FormFields;
use Imk\FormBundle\Factory\LoadConfigFactory;
use Imk\FormBundle\ImkFormInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     * @param Form    $form
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request, FileLoadConfig $config)
    {
        dd($config->getFormPath());
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/HomeController.php',
            //   'form' => $form->createView()
        ]);
    }

    public function functionAction()
    {
        // $formField->fields('form_inscription')->buildDataRender()
    }
}
