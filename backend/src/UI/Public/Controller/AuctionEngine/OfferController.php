<?php

declare(strict_types=1);

namespace H2P\UI\Public\Controller\AuctionEngine;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;
use Webmozart\Assert\Assert;

class OfferController extends AbstractController
{

    public function __construct()
    {
    }

    /**
     * @throws \JsonException
     */
    #[Route("auctions/{id}/bid", name: "make-bid", methods: ["POST"])]
    public function __invoke(Request $request, HubInterface $hub): Response
    {
        $auctionId = $request->attributes->get('id');
        $body = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        Assert::keyExists($body, 'bid');
        $winnerBid = $body['bid'];

        try {
            $update = new Update(
                'auctions-' . $auctionId,
                json_encode([
                    'winnerBid' => $winnerBid
                ], JSON_THROW_ON_ERROR)
            );

            $hub->publish($update);
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return new Response('published!');
    }
}


