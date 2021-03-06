<?php

namespace Drupal\embargoes\Plugin\Condition;

use Drupal\Core\Condition\ConditionPluginBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\Context\ContextDefinition;

/**
 * Provides a 'Node is embargoed (embargoes)' condition to enable a condition based in module selected status.
 *
 * @Condition(
 *   id = "embargoes_embargoed_condition",
 *   label = @Translation("Node is embargoed"),
 *   context = {
 *     "node" = @ContextDefinition("entity:node", required = TRUE , label = @Translation("Node"))
 *   }
 * )
 *
 */
class EmbargoesEmbargoedCondition extends ConditionPluginBase {

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $instance = parent::create($container, $configuration, $plugin_id, $plugin_definition);
    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form['filter'] = [
      '#type' => 'radios',
      '#title' => $this->t('Filter'),
      '#default_value' => $this->configuration['filter'],
      '#description' => $this->t('Select the scope of embargo to trigger on.'),
      '#options' => [
        'off' => 'Always trigger regardless of embargo status',
        'all' => 'All embargoes on node',
        'current' => 'Current embargoes on node (ignore expired)',
        'active' => 'Active embargoes on node (ignore bypassed)',
      ],
    ];
    return parent::buildConfigurationForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    $this->configuration['filter'] = $form_state->getValue('filter');
    parent::submitConfigurationForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return ['filter' => 'off'] + parent::defaultConfiguration();
  }

  /**
   * Evaluates the condition and returns TRUE or FALSE accordingly.
   *
   * @return bool
   *   TRUE if the condition has been met, FALSE otherwise.
   */
  public function evaluate() {
    $node = \Drupal::routeMatch()->getParameter('node');
    if ($node instanceof \Drupal\node\NodeInterface) {

      $embargo_service = \Drupal::service('embargoes.embargoes');
      switch ($this->configuration['filter']) {
        case 'off':
          $embargoed = TRUE;
          break;
        case 'all':
          $embargoed = $embargo_service->getAllEmbargoesByNids(array($node->id()));
          break;
        case 'current':
          $embargoed = $embargo_service->getCurrentEmbargoesByNids(array($node->id()));
          break;
        case 'active':
          $ip = \Drupal::request()->getClientIp();
          $user = \Drupal::currentUser();
          $embargoed = $embargo_service->getActiveEmbargoesByNids(array($node->id()), $ip, $user);
          break;
      }

    }
    else {
      $embargoed = FALSE;
    }

    return $embargoed;
  }

  /**
   * Provides a human readable summary of the condition's configuration.
   */
  public function summary() {
  }

}
