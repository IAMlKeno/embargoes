<?php

namespace Drupal\embargoes\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the IP Range entity.
 *
 * @ConfigEntityType(
 *   id = "embargoes_ip_range_entity",
 *   label = @Translation("IP Range"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\embargoes\EmbargoesIpRangeEntityListBuilder",
 *     "form" = {
 *       "add" = "Drupal\embargoes\Form\EmbargoesIpRangeEntityForm",
 *       "edit" = "Drupal\embargoes\Form\EmbargoesIpRangeEntityForm",
 *       "delete" = "Drupal\embargoes\Form\EmbargoesIpRangeEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\embargoes\EmbargoesIpRangeEntityHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "embargoes_ip_range_entity",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/config/content/embargoes/settings/ips/{embargoes_ip_range_entity}",
 *     "add-form" = "/admin/config/content/embargoes/settings/ips/add",
 *     "edit-form" = "/admin/config/content/embargoes/settings/ips/{embargoes_ip_range_entity}/edit",
 *     "delete-form" = "/admin/config/content/embargoes/settings/ips/{embargoes_ip_range_entity}/delete",
 *     "collection" = "/admin/config/content/embargoes/settings/ips"
 *   }
 * )
 */
class EmbargoesIpRangeEntity extends ConfigEntityBase implements EmbargoesIpRangeEntityInterface {

  /**
   * The IP Range ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The IP Range label.
   *
   * @var string
   */
  protected $label;

  /**
   * The IP Range range.
   *
   * @var string
   */
  protected $range;

  /**
   * The IP Range proxy URL.
   *
   * @var string
   */
  protected $proxy_url;

  public function id() {
    return $this->get('id');
  }

  public function label() {
    return $this->get('label');
  }

  public function getRange() {
    return $this->get('range');
  }

  public function setRange($range) {
    $this->set('range', $range);
    return $this;
  }

  public function getProxyUrl() {
    return $this->get('proxy_url');
  }

  public function setProxyUrl($proxy_url) {
    $this->set('proxy_url', $proxy_url);
    return $this;
  }


}
