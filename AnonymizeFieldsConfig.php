<?php namespace ProcessWire;

class AnonymizeFieldsConfig extends ModuleConfig {
  public function getDefaults() {
    return array(
      'fillword' => 'anonymous',
      'fields' => array(),
      'days' => '60'
    );
  }

  public function getInputfields() {
    $inputfields = parent::getInputfields();

    $f = $this->modules->get('InputfieldText');
    $f->attr('name', 'fillword');
    $f->label = __('Fill word (e.g. anonymous)');
    $f->required = true;
    $inputfields->add($f);

    $f = $this->modules->get('InputfieldAsmSelect');
    // $f->type = 'InputfieldAsmSelect';
    $f->attr('name', 'fieldsToAnonymize');
    $f->label = 'Fields';
    $f->description = 'Which fields should be filled with the fillword?';

    $fieldArray = array();

    // $allowedFieldtypes = array('InputfieldTextarea', 'FieldtypeTextareaLanguage', 'InputfieldFile', 'InputfieldImage', 'FieldtypeTextLanguage', 'FieldtypeText', 'FieldtypeEmail');

    foreach ($this->pages->find('template=bewerbung')->fields as $field) {

      // if (in_array($field->type, $allowedFieldtypes)) {
      $fieldArray[ "$field->name" ] = "{$field->getLabel()} [$field->name]";
      // $fieldArray["$field->name"] = "$field->name";

      // }
    }

    $f->options = $fieldArray;
    $inputfields->add($f);

    $f = wire('modules')->get('InputfieldInteger');
    $f->attr('name', 'days');
    $f->label = 'Anonymize after days';
    $f->value = '60';
    $inputfields->add($f);

    return $inputfields;
  }
}
