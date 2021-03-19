<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\FightInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArenaController extends AbstractController 
{    
    /**
     * @Route("/arena", name="arena")
     */
    public function fight($knight1 = NULL, $knight2 = NULL)
    {
        if (!isset($knight1) || !isset($knight2)) {
            $em = $this->getDoctrine()->getManager();

            $knight1 = $em->getRepository('App:Knight')->find(1);
            $knight2 = $em->getRepository('App:Knight')->find(2);
        }

        $powerKnight1 = $this->calculatePowerLevel($knight1);
        $powerKnight2 = $this->calculatePowerLevel($knight2);

        if ($powerKnight1 > $powerKnight2) {
            $result = 1;
        } elseif ($powerKnight1 < $powerKnight2) {
            $result = -1;
        } else {
            $result = 0;
        }

        return new Response($result);
    }

    public function calculatePowerLevel($knight)
    {
        $strength = $knight->getStrength();
        $weapon = $knight->getWeaponPower();

        $all = $strength + $weapon;

        return $all;
    }
}
