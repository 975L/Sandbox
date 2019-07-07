<?php

namespace App\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use c975L\PurchaseCreditsBundle\Entity\Transaction;
use c975L\UserBundle\Entity\UserAbstract;
use c975L\UserBundle\Event\UserEvent;

class UserListener implements EventSubscriberInterface
{
    private $container;
    protected $em;

    public function __construct(
        \Symfony\Component\DependencyInjection\ContainerInterface $container,
        \Doctrine\ORM\EntityManagerInterface $em
    )
    {
        $this->container = $container;
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return array(
            UserEvent::USER_SIGNEDUP => 'userSignedup',
            UserEvent::USER_DELETE => 'userDelete',
        );
    }

    public function userSignedup($event)
    {
        $user = $event->getUser();
        $request = $event->getRequest();

        //Gets translator
        $translator = $this->container->get('translator');
        $description = $translator->trans('label.account_creation', array(), 'transactions');

        //Provide credits for limited time offers
        $dateTimeOffer = '2016-11-30';
        $defaultCredits = 3;
        $offerCredits = 5;
        $credits = new \DateTime() < new \DateTime($dateTimeOffer) ? $offerCredits : $defaultCredits;

        //Adds Transaction for offered credits
        $transaction = new Transaction();
        $transaction
            ->setCredits($credits)
            ->setDescription($description . ' (' . $credits . ')')
            ->setUserId($user->getId())
            ->setUserIp($request->getClientIp())
            ->setCreation(new \DateTime())
        ;
        $this->em->persist($transaction);

        //Adds credits to user
        $user->setCredits($credits);
        $this->em->persist($user);

        //Flush DB
        $this->em->flush();
    }

    public function userDelete($event)
    {
        $user = $event->getUser();

        if (is_subclass_of($user, 'c975L\UserBundle\Entity\UserAbstract')) {
            //Gets the repository
            $repository = $this->em->getRepository('AppBundle:Shortcut');

            //Gets Service
            $shortcutService = $this->container->get(\App\Service\ShortcutService::class);

            //Gets the lists of shortcuts linked to user
            $shortcuts = $repository->findByUserId($user->getId());

            //Unlink shortcuts and update files
            foreach ($shortcuts as $shortcut) {
                //Updates DB
                $shortcut->setUserId(null);
                $this->em->persist($shortcut);
            }

            //Flush DB
            $this->em->flush();
        }
    }
}