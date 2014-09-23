<?php

namespace Plu\PhorgBundle\Controller;

use Plu\PhorgBundle\Editor\TagEditor;
use Plu\PhorgBundle\Entity\Tag;
use Plu\PhorgBundle\Form\Type\TagType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class TagController extends Controller
{
    /**
     * @Route("/tags", name="tags")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager()->getRepository("PluPhorgBundle:Tag");
        $tags = $em->findAll();

        return array("tags" => $tags);
    }

    /**
     * @Route("/tag/new", name="tag_new")
     * @Template()
     */
    public function newAction( Request $request )
    {
        $entity = new Tag();
        $this->getDoctrine()->getManager()->persist($entity);
        $form = $this->createForm(new TagType(), $entity);

        if( $request->getMethod() == "POST" ) {
            $form->handleRequest($request);
            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $parentTag = $form->get('primaryParent')->getData();
                $editor = new TagEditor($em);
                $editor->makeNewTag($entity,$parentTag);
                $em->flush();
            }
        }

        return array("form" => $form->createView());
    }

}
