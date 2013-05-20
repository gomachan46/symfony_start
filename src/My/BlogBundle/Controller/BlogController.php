<?php

namespace My\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * @Route("/blog")
 * @Template()
 */
class BlogController extends Controller
{
    /**
     * @Route("/", name="blog_index")
     */
    public function indexAction()
    {
        $em = $this->get('doctrine')->getManager();
        $posts = $em->getRepository('MyBlogBundle:Post')->findAll();
        return array('posts' => $posts);
    }

    /**
     * showAction 
     * 
     * @param mixed $id 
     * @access public
     * @return void
     * @Route("/show/{id}", name="blog_show")
     */
    public function showAction($id)
    {
        $em = $this->get('doctrine')->getManager();
        $post = $em->getRepository('MyBlogBundle:Post')->find($id);
        
        if (!$post) {
            throw $this->createNotFoundException('The post does not exist');
        }
        
        return array('post' => $post);
    }    
}
