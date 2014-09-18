<?php

namespace Plu\PhorgBundle\Controller;

use Plu\PhorgBundle\Editor\FileEditor;
use Plu\PhorgBundle\Entity\File;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class FileController extends Controller
{
    /**
     * @Route("/files", name="files")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager()->getRepository("PluPhorgBundle:File");
        $files = $em->findAll();

        return array("files" => $files);
    }

    /**
     * @Route("/file/new", name="file_new")
     * @Template()
     */
    public function newAction()
    {
        return array();
    }

    /**
     * @Route("/file/create", name="file_create")
     */
    public function createAction()
    {
        $file = new File;
        $em = $this->getDoctrine()->getManager();
        $em->persist($file);
        $em->flush();

        return $this->redirect($this->generateUrl('file_edit', array('id' => $file->getId())));
    }

    /**
     * @Route("/file/edit/{id}", name="file_edit")
     * @Template()
     */
    public function editAction(File $file)
    {

        $editor = new FileEditor($this->getDoctrine()->getManager());
        $tags = $editor->getAvailableTagsFor($file);

        return array('file' => $file, 'availableTags' => $tags);
    }

}
