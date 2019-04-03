<?php
class NavMenu
{

  private $id;
  private $menuItems = array();

  public function __construct($id = 'mainnav', $rows = null)
  {
    $this->id = $id;
    if (!empty($rows)) {
      $this->loadRows($rows);
    }
  }

  private function loadRows($rows)
  {
    foreach ($rows as $item) {
      $this->addItem($item['key'], $item['label'], $item['order']);
    }
  }

  public function loadData($sql)
  {
    $pdo = $GLOBALS['pdo'];
    $this->loadRows($pdo->query($sql));
  }

  public function __toString()
  {
    $output = '<nav id="' . $this->id . '">';
    foreach ($this->menuItems as $item) {
      $output .= '<a class="' . ($item['active'] ? 'active' : 'inactive') . '" href="?p=' . $item['key'] . '">' .
        $item['label'] . '</a>';
    }
    $output .= '</nav>';
    return $output;
  }

  public function setActive($key = '')
  {
    foreach ($this->menuItems as $i => $item) {
      if ($item['key'] == $key) {
        $this->menuItems[$i]['active'] = true;
      } else {
        $this->menuItems[$i]['active'] = false;
      }
    }
  }

  public function addItem($key, $label, $order = 0)
  {
    $key = trim(strtolower(str_replace(' ', '', $key)));
    $this->menuItems[] = array(
      'key' => $key,
      'label' => $label,
      'order' => $order,
      'active' => false
    );

    usort($this->menuItems, function ($a, $b) {
      if ($a['order'] == $b['order']) {
        return 0;
      }

      if ($a['order'] > $b['order']) {
        return 1;
      }

      return -1;
    });
  }
}
