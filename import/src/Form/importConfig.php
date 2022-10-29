<?php

namespace Drupal\import\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\Url;
use Drupal\Core\Link;
use Drupal\Core\Render\Markup;
use \Drupal\node\Entity\Node;

/**
 * Configuration of manual configurations.
 */
class importConfiguration extends ConfigFormBase {

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $connection;

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a new CompletionRegister object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager, Connection $connection) {
    $this->entityTypeManager = $entity_type_manager;
    $this->connection = $connection;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager'), $container->get('database')
   );
  }

  /**
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'entity.common_settings';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_entity_configuration_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);

    $instructions = "<div style='background:lightblue;padding:10px;line-height:2;'>
      Please enter  Entity Type Name <br/>
    </div>";

    $form['custom_entity_instructions'] = [
      '#markup' => Markup::create($instructions),
    ];

    $form['entity_info'] = [
      '#type' => 'textarea',
      '#title' => 'Custom Entity Type ',
      '#description' => "Please refer above instructions.",
      '#default_value' => $config->get('entity_info'),
    ];
    $form['entity_type_name'] = [
      '#type' => 'textarea',
      '#title' => 'entity_type_name',
      '#description' => "Please Enter Entity Name.",
      '#default_value' => $config->get('entity_type_name'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

     $entity_type = 'node';
     $entity = entity_create($entity_type, array('type' => $form_state->getValue('entity_type_name')));
     $wrapper = entity_metadata_wrapper($entity_type, $entity);
     $wrapper->save();

     FieldStorageConfig::create(array(
        'field_name' => '_id',
        'entity_type' => 'node',
        'type' => 'text',
        'cardinality' => -1,
        ))->save();

      FieldConfig::create([
      'field_name' => '_id',
      'entity_type' => 'node',
      'bundle' => $form_state->getValue('entity_type_name'), // content type
      'label' => 'ID field',
      ])->save();
      // Manage form display
      $form_display = \Drupal::service('entity_display.repository')->getFormDisplay('node', $form_state->getValue('entity_type_name') );
      $form_display = $form_display->setComponent('_id', ['type' => 'text_textfield']);
      $form_display->save();
      // Manage view display
      $view_display = \Drupal::service('entity_display.repository')->getViewDisplay('node', $form_state->getValue('entity_type_name'));
      $view_display->setComponent('_id', ['type' => 'text_default']);
      $view_display->save();
      /** city */
      FieldStorageConfig::create(array(
        'field_name' => 'city',
        'entity_type' => 'node',
        'type' => 'text',
        'cardinality' => -1,
        ))->save();

      FieldConfig::create([
      'field_name' => 'city',
      'entity_type' => 'node',
      'bundle' => $form_state->getValue('entity_type_name'), // content type
      'label' => 'city field',
      ])->save();
      // Manage form display
      $form_display = \Drupal::service('entity_display.repository')->getFormDisplay('node', $form_state->getValue('entity_type_name') );
      $form_display = $form_display->setComponent('city', ['type' => 'text_textfield']);
      $form_display->save();
      // Manage view display
      $view_display = \Drupal::service('entity_display.repository')->getViewDisplay('node', $form_state->getValue('entity_type_name'));
      $view_display->setComponent('city', ['type' => 'text_default']);
      $view_display->save();

      /** loc */
      FieldStorageConfig::create(array(
        'field_name' => 'loc',
        'entity_type' => 'node',
        'type' => 'text',
        'cardinality' => -1,
        ))->save();

      FieldConfig::create([
      'field_name' => 'loc',
      'entity_type' => 'node',
      'bundle' => $form_state->getValue('entity_type_name'), // content type
      'label' => 'loc field',
      ])->save();
      // Manage form display
      $form_display = \Drupal::service('entity_display.repository')->getFormDisplay('node', $form_state->getValue('entity_type_name') );
      $form_display = $form_display->setComponent('loc', ['type' => 'text_textfield']);
      $form_display->save();
      // Manage view display
      $view_display = \Drupal::service('entity_display.repository')->getViewDisplay('node', $form_state->getValue('entity_type_name'));
      $view_display->setComponent('loc', ['type' => 'text_default']);
      $view_display->save();
      /** pop */
      FieldStorageConfig::create(array(
        'field_name' => 'pop',
        'entity_type' => 'node',
        'type' => 'text',
        'cardinality' => -1,
        ))->save();

      FieldConfig::create([
      'field_name' => 'pop',
      'entity_type' => 'node',
      'bundle' => $form_state->getValue('entity_type_name'), // content type
      'label' => 'pop field',
      ])->save();
      // Manage form display
      $form_display = \Drupal::service('entity_display.repository')->getFormDisplay('node', $form_state->getValue('entity_type_name') );
      $form_display = $form_display->setComponent('pop', ['type' => 'text_textfield']);
      $form_display->save();
      // Manage view display
      $view_display = \Drupal::service('entity_display.repository')->getViewDisplay('node', $form_state->getValue('entity_type_name'));
      $view_display->setComponent('pop', ['type' => 'text_default']);
      $view_display->save();

      /** State */
      FieldStorageConfig::create(array(
        'field_name' => 'state',
        'entity_type' => 'node',
        'type' => 'text',
        'cardinality' => -1,
        ))->save();

      FieldConfig::create([
      'field_name' => 'state',
      'entity_type' => 'node',
      'bundle' => $form_state->getValue('entity_type_name'), // content type
      'label' => 'state field',
      ])->save();
      // Manage form display
      $form_display = \Drupal::service('entity_display.repository')->getFormDisplay('node', $form_state->getValue('entity_type_name') );
      $form_display = $form_display->setComponent('state', ['type' => 'text_textfield']);
      $form_display->save();
      // Manage view display
      $view_display = \Drupal::service('entity_display.repository')->getViewDisplay('node', $form_state->getValue('entity_type_name'));
      $view_display->setComponent('state', ['type' => 'text_default']);
      $view_display->save();

    parent::submitForm($form, $form_state);
  }
}
