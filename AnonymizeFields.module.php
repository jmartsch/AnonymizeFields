<?php namespace ProcessWire;

class AnonymizeFields extends Process {

  private $fillword;
  private $fieldsToAnonymize;
  public $textFields = array('FieldtypeTextarea', 'FieldtypeTextareaLanguage', 'FieldtypeTextLanguage', 'FieldtypeText');

  public function ready() {
    $this->addHook("LazyCron::everyDay", $this, 'anonymize');
  }

  public function anonymize() {
    $pages = wire('pages')->find("created<='-{$this->days} days'");
    foreach ($pages as $page) {
      $page->of(false);
      foreach ($this->fieldsToAnonymize as $item) {
        $theField = $page->fields->get($item);
        if (in_array($theField->type, $this->textFields)) {
          if ($theField->required) {
            $page->$item = $this->fillword;
          } else {
            $page->$item = "";
          }
        } elseif ($page->get($item) instanceof Pagefiles) {
          $page->$item->deleteAll();
        } elseif ($page->fields->get($item)->type instanceof FieldtypeEmail) {
          if ($theField->required) {
            $page->$item = $this->fillword . "@xyz.com";
          } else {
            $page->$item = "";
          }
        }
      }
      $page->save();
//      optional if you use MarkupActivityLog
//      $t = $this->database->query("DELETE FROM MarkupActivityLog WHERE `page_id` = $page->id"); // now delete the activity log if the module is installed
//      $this->log->prune('sent-mail', $this->days); // delete logs of the last $this->days, if there is personal identifiable data in it
    }
    $this->message(__("Fields with data older than $this->days have been anonymized."));
  }
}
