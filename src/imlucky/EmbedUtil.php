<?php

namespace imlucky;

class EmbedUtil
{
    public static function createEmbed(string $title, string $description, string $color = "0x00ff00", string $footer = null, string $footerIcon = null, string $image = null, string $thumbnail = null, string $author = null, string $authorIcon = null, string $authorUrl = null, array $fields = []): array
    {
        $embed = [
            "title" => $title,
            "description" => $description,
            "color" => hexdec($color),
            "fields" => $fields
        ];

        if ($footer !== null) {
            $embed["footer"] = [
                "text" => $footer,
                "icon_url" => $footerIcon
            ];
        }

        if ($image !== null) {
            $embed["image"] = [
                "url" => $image
            ];
        }

        if ($thumbnail !== null) {
            $embed["thumbnail"] = [
                "url" => $thumbnail
            ];
        }

        if ($author !== null) {
            $embed["author"] = [
                "name" => $author,
                "icon_url" => $authorIcon,
                "url" => $authorUrl
            ];
        }

        return $embed;
    }
}
