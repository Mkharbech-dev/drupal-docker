<?php

namespace Drupal\custom_config\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a social links block.
 *
 * @Block(
 *   id = "custom_config_social_links",
 *   admin_label = @Translation("Social links"),
 *   category = @Translation("Custom"),
 * )
 */
final class SocialLinksBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $config = \Drupal::config('custom_config.settings');

    // Récupérer l'url de facebook
    $facebook = $config->get('facebook');
    // Récupérer l'url de twitter
    $twitter = $config->get('twitter');
    // Récupérer l'url de linkedin
    $linkedin = $config->get('linkedin');
    // Utiliser une template
    return [
      '#theme' => 'social_links',
      '#facebook'=> $facebook,
      '#twitter' => $twitter,
      '#linkedin' => $linkedin,
      '#cache' => [
        'max-age' => 0,
      ]
    ];
  }

}
