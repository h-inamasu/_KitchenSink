<?php

/**
 * Copyright 2016 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

namespace LINE\LINEBot\KitchenSink\EventHandler;

use LINE\LINEBot;
use LINE\LINEBot\Event\FollowEvent;
use LINE\LINEBot\KitchenSink\EventHandler;

class FollowEventHandler implements EventHandler
{
    /** @var LINEBot $bot */
    private $bot;
    /** @var \Monolog\Logger $logger */
    private $logger;
    /** @var FollowEvent $followEvent */
    private $followEvent;

    /**
     * FollowEventHandler constructor.
     * @param LINEBot $bot
     * @param \Monolog\Logger $logger
     * @param FollowEvent $followEvent
     */
    public function __construct($bot, $logger, FollowEvent $followEvent)
    {
        $this->bot = $bot;
        $this->logger = $logger;
        $this->followEvent = $followEvent;
    }

    public function handle()
    {
        $message="お友達登録ありがとうございます\n" .
                 "いつでもお気軽にお問い合わせメッセージをお送りください！\n" .
                 "シューワのお水をご利用中のお客様は\n" .
                 "■お客様番号（チラシに記載の番号）\n" .
                 "このメッセージにお送りください！\n" .
                 "お送り頂いた方にはもれなくお水12ℓ一本プレゼント！\n" .
                 "みなさまのご返信おまちしております";

        $this->bot->replyText($this->followEvent->getReplyToken(),$message);
//        $this->bot->replyText($this->followEvent->getReplyToken(),"お友達登録ありがとうございます");
//        $this->bot->replyText($this->followEvent->getReplyToken(),'いつでもお気軽にお問い合わせメッセージをお送りください！');
//        $this->bot->replyText($this->followEvent->getReplyToken(),'シューワのお水をご利用中のお客様は');
//        $this->bot->replyText($this->followEvent->getReplyToken(),'■お客様番号（チラシに記載の番号）');
//        $this->bot->replyText($this->followEvent->getReplyToken(),'このメッセージにお送りください！');
//        $this->bot->replyText($this->followEvent->getReplyToken(),'お送り頂いた方にはもれなくお水12ℓ一本プレゼント！');
//        $this->bot->replyText($this->followEvent->getReplyToken(),'みなさまのご返信おまちしております');
    }
}
