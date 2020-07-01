<?php

namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;
use Grav\Common\Config\Config;
use Grav\Common\Grav;
use Grav\Plugin\Form;
use Grav\Plugin\VuePHP\VuePHP;
use RocketTheme\Toolbox\Event\Event;

class VueEmailPlugin extends Plugin
{
    protected $email;
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
            'onFormProcessed' => ['onFormProcessed', 0]
        ];
    }

    public function autoload(): ClassLoader
    {
        return require getcwd() . '/vendor/autoload.php';
    }

    public function onPluginsInitialized()
    {
        if ($this->isAdmin()) {
            return;
        }
        require_once __DIR__ . '/classes/VuePHP.php';

        $this->enable([
            'onFormProcessed' => ['onFormProcessed', 0]
        ]);
    }

    public function onFormProcessed(Event $event)
    {

        $grav = Grav::instance();
        $form = $event['form'];
        $action = $event['action'];
        $params = $event['params'];

        switch ($action) {
            case 'vueEmail':
                $vars = array(
                    'form' => $form
                );

                $grav->fireEvent('onEmailSend', new Event(['params' => &$params, 'vars' => &$vars]));
                $message = $this->buildMessage($params, $vars);
                $this->email = new VuePHP($message);
                $this->email->send();
                break;
        }
    }
    protected function buildMessage(array $params, array $vars = array())
    {

        $twig = $this->grav['twig'];
        $params += array(
            'body' => $this->config->get('plugins.email.body', '{% include "forms/data.txt.twig" %}'),
            'from' => $this->config->get('plugins.email.from'),
            'from_name' => $this->config->get('plugins.email.from_name'),
            'to' => $this->config->get('plugins.email.to'),
            'to_name' => $this->config->get('plugins.email.to_name'),
            'process_markdown' => false,
        );

        $message = [];

        if (!$params['to']) {
            throw new \RuntimeException($this->grav['language']->translate('PLUGIN_EMAIL.PLEASE_CONFIGURE_A_TO_ADDRESS'));
        }
        if (!$params['from']) {
            throw new \RuntimeException($this->grav['language']->translate('PLUGIN_EMAIL.PLEASE_CONFIGURE_A_FROM_ADDRESS'));
        }

        foreach ($params as $key => $value) {
            switch ($key) {
                case 'body':
                    if (is_string($value)) {
                        $body = $twig->processString($value, $vars);

                        if ($params['process_markdown']) {
                            $parsedown = new \Parsedown();
                            $body = $parsedown->text($body);
                        }

                        $message['body'] = trim($body);
                    }
                    break;
                case 'from':
                    if (is_string($value) && !empty($params['from_name'])) {
                        $value = array(
                            'mail' => $twig->processString($value, $vars),
                            'name' => $twig->processString($params['from_name'], $vars),
                        );
                    } else {
                        $value = array(
                            'mail' => $twig->processString($value, $vars),
                            'name' => Grav::instance()['config']->get('site.title')
                        );
                    }
                    $message['from'] = $value;
                    break;

                    // case 'subject':
                    //     $message['subject'] = $twig->processString($this->grav['language']->translate($value), $vars);
                    //     break;

                case 'to':
                    if (is_string($value) && !empty($params['to_name'])) {
                        $value = array(
                            'mail' => $twig->processString($value, $vars),
                            'name' => $twig->processString($params['to_name'], $vars),
                        );
                    } else {
                        $value = array(
                            'mail' => $twig->processString($value, $vars),
                            'name' => Grav::instance()['config']->get('site.author.name')
                        );
                    }
                    $message['to'] = $value;
                    break;
            }
        }

        return $message;
    }
}
