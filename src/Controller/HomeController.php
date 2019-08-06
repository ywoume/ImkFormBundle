<?php

namespace App\Controller;

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
    public function index(FormFields $formField, LoadConfigFactory $formBuilder, Request $request)
    {
        dd($formBuilder->getFormsNamespace());
        die;
        die;
        $resp = $formField->fields('form_inscription')->buildDataRender();
        dd($resp);
        die;
        // $this->createForm(null, null);
        $formName = 'formName';
        $form = $imkForm->formProcess($formName, $request);

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
