# MageSpecialist Notifier Framework for Magento 2

## Quick and dirty

Ok, if you do not have time to read this guide... here you have the short version:

```
composer require msp/module-notifier-all
bin/magento setup:upgrade
```

Then open your admin under `System > MSP Notifier` menù and enjoy it ;)

## Introduction

MSP Notifier is a framework for Magento 2 allowing users and developers to **easily integrate a wide set
of communication channels** to their stores.

Communication channels can be injected via DI mechanism and quickly configured via Magento admin.

### Project philosophy

MSP Notifier Project is an extensible module projected around the **Domain Driven Development** best practices.
In other word: it can be considered a **set of smaller modules** with well defined responsibilities.
You can decide to install the whole set of modules or just the ones you need.

Each single component is provided with a full set of API allowing features replacements with full guaranteed backward
compatibility.

### Installing it

Before trying to install this package, make sure you are using a **Magento version greater than 2.2.0**.
This module is not backward compatible with 2.0 or 2.1.

#### Installing the whole package:

Open your SSH console and install via composer:

```
composer require msp/module-notifier-all
bin/magento setup:upgrade
```

This will install all the core modules provided by MageSpecialist:

- `msp/module-notifier`: The basic framework
- `msp/module-notifier-core-adapters`: A set of basic communication channels adapters
    - Telegram
    - Slack
    - Email
- `msp/module-notifier-admin-push-adapter`: A browser push notification system for Magento admin 
- `msp/module-notifier-event`: An event handler to connect any Magento event to a channel
- `msp/module-notifier-template`: Twig template manager for messages
- `msp/module-notifier-queue`: An asynchronous message dispatcher based on Magento cron

#### Installing single packages

If you want to install single packages you can require just the modules you need. Composer will handle all
the required dependencies.

Example:

```
composer require msp/module-notifier msp/module-notifier-template
bin/magento setup:upgrade
```

## How does it work?

We divide notifier engine into 2 main entities:

- Adapters
- Channels

An adapter is a set of classes created by a Magento developer to **integrate an external messaging software**
(i.e.: Telegram, Slack, email, ...).

A channel is an **adapter configured** with a certain set of parameters
(e.g.: Telegram Message to John Doe, Slack message to Jane Doe).

If we want for example to send a **Telegram message** to an imaginary user **John Doe**, we should create a channel
of type `Telegram` and configure it with John Doe `chat id` destination.

### Specs

One adapter can have multiple channels, while a channel have one and only one adapter.

Each adapter or channel are identified by an alphanumeric string called `code`.
Adapters codes are wired in the Magento code by their developers, while channels codes can be freely assigned
by the Magento administrator via backend.

# The other modules constellation

## MageSpecialist Notifier Core Adapters Module

GitHub: https://github.com/magespecialist/notifier-core-adapters<br />
Composer: `composer require msp/module-notifier-core-adapters`

... // TODO

## MageSpecialist Notifier Admin Push Notification Module

GitHub: https://github.com/magespecialist/notifier-admin-push-adapter<br />
Composer: `composer require msp/module-notifier-admin-push-adapter`

... // TODO

## MageSpecialist Notifier Template Module

GitHub: https://github.com/magespecialist/notifier-template<br />
Composer: `composer require msp/module-notifier-template`

... // TODO

## MageSpecialist Event Manager Module

GitHub: https://github.com/magespecialist/notifier-event<br />
Composer: `composer require msp/module-notifier-event`

... // TODO

## MageSpecialist Asynchronous Queue Manager Module

GitHub: https://github.com/magespecialist/notifier-queue<br />
Composer: `composer require msp/module-notifier-queue`

... // TODO

# For developers

## Sending a message directly from your code

With basic framework you can decide to manually send messages from your code.
Of course this is a developer only feature, if you need something mor human usable, please refer
to the other modules (e.g.: `msp/module-notifier-event`). 

```
...
public function __construct(MSP\NotifierApi\Api\SendMessageInterface $sendMessage)
{
    $this->sendMessage = $sendMessage;
}
...
public function execute()
{
    ... // Your code
    try {
        $this->sendMessage->execute('my_channel_code', 'Hello world!');
    } catch (\Exception $e) {
        // Do error management here... maybe your channel does not exist?
    }
    ... // Your code
}
``` 

### Extending with more adapters

You can create your custom adapters and inject them via Magento DI mechanism in `MSP\Notifier\Model\AdapterRepository` class.
A quick and simple example can be found in the `msp/module-notifier-core-adapters` (https://github.com/magespecialist/notifier-core-adapters).

A validation and custom parameters mechanism is **provided via VirtualTypes**.

**NOTE:** In the previous example, a channel with code `my_channel_code` must be configured from Magento backend.

 A set of **Web API** is also available if you wish to remotely handle it.
 
## Sending a message from console

A command line interface is provided to easily integrate this framework from the sysadmin point of view:

`bin/magento msp:notifier:send my_channel_code "Hello world!"`
