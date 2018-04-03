<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MultilingualController extends Controller
{
//PAGES
    /**
     * @Route("/pages")
     * @Method({"GET", "HEAD"})
     */
    public function redirectPagesAction()
    {
        return $this->redirectToRoute('pageedit_home');
    }

//SPECIFIC PAGE
    /**
     * @Route("/pages/{page}",
     *      requirements={"page": "([a-z0-9\-]+)"})
     * @Method({"GET", "HEAD"})
     */
    public function redirectPageAction($page)
    {
        return $this->redirectToRoute('pageedit_display',
            array(
                'page' => $page
            ));
    }

//CONTACT
    /**
     * @Route("/contact")
     * @Method({"GET", "HEAD"})
     */
    public function redirectContactAction()
    {
        return $this->redirectToRoute('contactform_display');
    }

//LOGIN
    /**
     * @Route("/login")
     * @Route("/signin")
     * @Method({"GET", "HEAD"})
     */
    public function redirectUserSigninAction()
    {
        return $this->redirectToRoute('user_signin');
    }

//CREDITS
    /**
     * @Route("/purchase-credits")
     * @Method({"GET", "HEAD"})
     */
    public function redirectPurchaseCreditsAction()
    {
        return $this->redirectToRoute('purchasecredits_purchase');
    }

//TRANSACTIONS
    /**
     * @Route("/purchase-credits/transactions")
     * @Method({"GET", "HEAD"})
     */
    public function redirectTransactionsAction()
    {
        return $this->redirectToRoute('purchasecredits_transactions');
    }
}