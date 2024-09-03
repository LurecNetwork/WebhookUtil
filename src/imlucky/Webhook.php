<?php

namespace imlucky;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;

class Webhook extends PluginBase
{
    
    public funcion onEnable()
    {
        Webhook::sendDiscordMessage('webhook URL', EmbedUtils::cr
    }
    public static function sendDiscordMessage($webhookUrl, $embed, string $content = null)
    {
        Server::getInstance()->getAsyncPool()->submitTask(new class($webhookUrl, json_encode($embed), $content) extends AsyncTask
        {
            private $webhookUrl;
            private $embed;
            private $content;

            public function __construct($webhookUrl, $embed, $content)
            {
                $this->webhookUrl = $webhookUrl;
                $this->embed = $embed;
                $this->content = $content;
            }

            public function onRun(): void
            {
                $message = ($this->embed !== '[]') ? ['embeds' => [json_decode($this->embed, true)], 'content' => $this->content] : ['content' => $this->content];
                $ch = curl_init($this->webhookUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
                $response = curl_exec($ch);
                curl_close($ch);
                $this->setResult(json_decode($response, true));
            }
        });
    }

    public static function editDiscordMessage($webhookId, $webhookToken, $messageId, $newEmbed, $newMessage = null)
    {
        Server::getInstance()->getAsyncPool()->submitTask(new class($webhookId, $webhookToken, $messageId, json_encode($newEmbed), $newMessage) extends AsyncTask
        {
            private $webhookId;
            private $webhookToken;
            private $messageId;
            private $newEmbed;
            private $newMessage;

            public function __construct($webhookId, $webhookToken, $messageId, $newEmbed, $newMessage)
            {
                $this->webhookId = $webhookId;
                $this->webhookToken = $webhookToken;
                $this->messageId = $messageId;
                $this->newEmbed = $newEmbed;
                $this->newMessage = $newMessage;
            }

            public function onRun(): void
            {
                $url = "https://discord.com/api/webhooks/{$this->webhookId}/{$this->webhookToken}/messages/{$this->messageId}";
                $message = ['embeds' => [json_decode($this->newEmbed, true)], 'content' => $this->newMessage];
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
                $response = curl_exec($ch);
                curl_close($ch);
                $this->setResult(json_decode($response, true));
            }
        });
    }
}
