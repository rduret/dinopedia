<?php

namespace App\Controller;

use App\Entity\Localization;
use App\Form\LocalizationType;
use App\Repository\LocalizationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/localization")
 */
class LocalizationController extends AbstractController
{
    /**
     * @Route("/", name="localization_index", methods={"GET"})
     */
    public function index(LocalizationRepository $localizationRepository): Response
    {
        return $this->render('localization/index.html.twig', [
            'localizations' => $localizationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="localization_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $localization = new Localization();
        $form = $this->createForm(LocalizationType::class, $localization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($localization);
            $entityManager->flush();

            return $this->redirectToRoute('localization_index');
        }

        return $this->render('localization/new.html.twig', [
            'localization' => $localization,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="localization_show", methods={"GET"})
     */
    public function show(Localization $localization): Response
    {
        return $this->render('localization/show.html.twig', [
            'localization' => $localization,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="localization_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Localization $localization): Response
    {
        $form = $this->createForm(LocalizationType::class, $localization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('localization_index');
        }

        return $this->render('localization/edit.html.twig', [
            'localization' => $localization,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="localization_delete", methods={"POST"})
     */
    public function delete(Request $request, Localization $localization): Response
    {
        if ($this->isCsrfTokenValid('delete'.$localization->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($localization);
            $entityManager->flush();
        }

        return $this->redirectToRoute('localization_index');
    }
}
