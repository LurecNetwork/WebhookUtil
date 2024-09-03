# WebhookUtil

A utility plugin used to send or edit Discord Webhook messages

# Usage

- Send 
```php
Webhook::sendDiscordMessage("webhook URL", EmbedUtil::createEmbed("Title", "Description", "0x00ff00", "Footer", "Footer Icon", "Image", "Thumbnail", "Author", "Author Icon", "Author URL", [
            ["name" => "Field 1", "value" => "Value 1", "inline" => false],
            ["name" => "Field 2", "value" => "Value 2", "inline" => true]
        ]), "Content");
```

- Edit
```php
Webhook::editDiscordMessage("webhook ID", "webhook Token", "message ID", EmbedUtil::createEmbed("New Title", "New Description", "0xff0000", "New Footer", "New Footer Icon", "New Image", "New Thumbnail", "New Author", "New Author Icon", "New Author URL", [
            ["name" => "New Field 1", "value" => "New Value 1", "inline" => false],
            ["name" => "New Field 2", "value" => "New Value 2", "inline" => true]
        ]), "New Content");
```