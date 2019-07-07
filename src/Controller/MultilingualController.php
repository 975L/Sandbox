<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MultilingualController extends Controller
{
//HOME
    /**
     * @Route("/")
     * @Method({"GET", "HEAD"})
     */
    public function redirectHome()
    {
        return $this->redirectToRoute('pageedit_home');
    }

//PAGES
    /**
     * @Route("/pages")
     * @Method({"GET", "HEAD"})
     */
    public function redirectPages()
    {
        return $this->redirectToRoute('pageedit_home');
    }

//SPECIFIC PAGE
    /**
     * @Route("/pages/{page}",
     *      requirements={"page": "([a-z0-9\-]+)"})
     * @Method({"GET", "HEAD"})
     */
    public function redirectPage($page)
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
    public function redirectContact()
    {
        return $this->redirectToRoute('contactform_display');
    }

//LOGIN
    /**
     * @Route("/login")
     * @Route("/signin")
     * @Method({"GET", "HEAD"})
     */
    public function redirectUserSignin()
    {
        return $this->redirectToRoute('user_signin');
    }

//CREDITS
    /**
     * @Route("/purchase-credits")
     * @Method({"GET", "HEAD"})
     */
    public function redirectPurchaseCredits()
    {
        return $this->redirectToRoute('purchasecredits_purchase');
    }

//TRANSACTIONS
    /**
     * @Route("/purchase-credits/transactions")
     * @Method({"GET", "HEAD"})
     */
    public function redirectTransactions()
    {
        return $this->redirectToRoute('purchasecredits_transactions');
    }
}