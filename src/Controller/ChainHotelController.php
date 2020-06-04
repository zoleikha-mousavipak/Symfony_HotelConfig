<?php

namespace App\Controller;

use App\Service\HotelService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ChainHotelController extends AbstractController
{

    /** @var HotelService */
    protected $hotelService;

    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function getHotels(Request $request)
    {
        $groupId = $request->get('groupId');

        $hotels = $this->hotelService->getHotelsByGroupId($groupId);

        if (empty($hotels)) {
            throw new NotFoundHttpException('Group not found!');
        }

        return new Response(json_decode($hotels));
    }
}
