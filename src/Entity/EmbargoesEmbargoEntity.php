<?php

namespace Drupal\embargoes\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Embargo entity.
 *
 * @ConfigEntityType(
 *   id = "embargoes_embargo_entity",
 *   label = @Translation("Embargo"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\embargoes\EmbargoesEmbargoEntityListBuilder",
 *     "form" = {
 *       "add" = "Drupal\embargoes\Form\EmbargoesEmbargoEntityForm",
 *       "edit" = "Drupal\embargoes\Form\EmbargoesEmbargoEntityForm",
 *       "delete" = "Drupal\embargoes\Form\EmbargoesEmbargoEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\embargoes\EmbargoesEmbargoEntityHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "embargoes_embargo_entity",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/embargoes_embargo_entity/{embargoes_embargo_entity}",
 *     "add-form" = "/admin/structure/embargoes_embargo_entity/add",
 *     "edit-form" = "/admin/structure/embargoes_embargo_entity/{embargoes_embargo_entity}/edit",
 *     "delete-form" = "/admin/structure/embargoes_embargo_entity/{embargoes_embargo_entity}/delete",
 *     "collection" = "/admin/structure/embargoes_embargo_entity"
 *   }
 * )
 */
class EmbargoesEmbargoEntity extends ConfigEntityBase implements EmbargoesEmbargoEntityInterface {

  /**
   * The Embargo ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Embargo label.
   *
   * @var string
   */
  protected $label;

}
