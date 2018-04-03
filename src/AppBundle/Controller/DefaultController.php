<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
//REMOVE TRAILING SLASH
    /**
    * @Route("/{url}",
    *       name="remove_trailing_slash",
    *       requirements={"url": "^(?!en|fr|es).*\/$"})
    * @Method({"GET", "HEAD"})
    */
    public function removeTrailingSlashAction(Request $request)
    {
        $pathInfo = $request->getPathInfo();
        $requestUri = $request->getRequestUri();
        $url = str_replace($pathInfo, rtrim($pathInfo, ' /'), $requestUri);
        return $this->redirect($url);
    }

//HOME
    /**
     * @Route("/")
     * @Method({"GET", "HEAD"})
     */
    public function homeAction()
    {
        return $this->redirectToRoute('pageedit_home');
    }
}