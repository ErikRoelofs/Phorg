<?php

namespace Plu\PhorgBundle\Controller;

use Plu\PhorgBundle\Editor\FileEditor;
use Plu\PhorgBundle\Entity\File;
use Plu\PhorgBundle\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ProtoMetaController extends Controller
{
    /**
     * @Route("/protometa", name="protometa")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager()->getRepository("PluPhorgBundle:ProtoMeta");
        $meta = $em->findAll();

        return array("protometa" => $meta);
    }
}
