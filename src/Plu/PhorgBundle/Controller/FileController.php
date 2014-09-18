<?php

namespace Plu\PhorgBundle\Controller;

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

}
