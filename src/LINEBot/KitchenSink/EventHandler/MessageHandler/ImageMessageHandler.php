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

namespace LINE\LINEBot\KitchenSink\EventHandler\MessageHandler;

use LINE\LINEBot;
use LINE\LINEBot\Event\MessageEvent\ImageMessage;
use LINE\LINEBot\KitchenSink\EventHandler;
use LINE\LINEBot\KitchenSink\EventHandler\MessageHandler\Util\UrlBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;

class ImageMessageHandler implements EventHandler
{
    /** @var LINEBot $bot */
    private $bot;
    /** @var \Monolog\Logger $logger */
    private $logger;
    /** @var \Slim\Http\Request $logger */
    private $req;
    /** @var ImageMessage $imageMessage */
    private $imageMessage;

    /**
     * ImageMessageHandler constructor.
     * @param LINEBot $bot
     * @param \Monolog\Logger $logger
     * @param \Slim\Http\Request $req
     * @param ImageMessage $imageMessage
     */
    public function __construct($bot, $logger, \Slim\Http\Request $req, ImageMessage $imageMessage)
    {
        $this->bot = $bot;
        $this->logger = $logger;
        $this->req = $req;
        $this->imageMessage = $imageMessage;
    }

    public function handle()
    {
error_log("----- ImageMessageHandler::handle()");
        $contentId = $this->imageMessage->getMessageId();
        $image = $this->bot->getMessageContent($contentId)->getRawBody();

        $tmpfilePath = tempnam($_SERVER['DOCUMENT_ROOT'] . '/static/tmpdir', 'image-');
        unlink($tmpfilePath);
        $filePath = $tmpfilePath . '.jpg';
        $filename = basename($filePath);
error_log("----- " . $filePath);
error_log("----- " . $filename);

        $fh = fopen($filePath, 'x');
if ($fh==FALSE) {
error_log("----- fopen failed");
}
        fwrite($fh, $image);
        fclose($fh);

        $replyToken = $this->imageMessage->getReplyToken();

        $url = UrlBuilder::buildUrl($this->req, ['static', 'tmpdir', $filename]);

        // NOTE: You should pass the url of small image to `previewImageUrl`.
        // This sample doesn't treat that.
        $this->bot->replyMessage($replyToken, new ImageMessageBuilder($url, $url));
error_log("+++++ ImageMessageHandler::handle()");
    }
}
