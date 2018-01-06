<?php
class ModelModulePallets extends Model {

    public function updateShipping($data)
    {
      //$this->log->write($data);

      $this->db->query("DELETE FROM `" . DB_PREFIX . "pallet_shipping`");

      $countries = $data['country'];

      foreach($countries as $country_id => $country_data) {
        foreach($countries[$country_id] as $shipping_option => $shipping_price) {
          $this->db->query("INSERT INTO " . DB_PREFIX . "pallet_shipping SET country_id = '" . (int)$country_id . "', `key` = '" . $this->db->escape($shipping_option) . "', `value` = '" . $this->db->escape($shipping_price) . "'");
        }
      }
    }

    public function getShipping()
    {
      $data = array();

      $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pallet_shipping ps LEFT JOIN " . DB_PREFIX . "country c USING(country_id)");

      foreach ($query->rows as $result) {
        $data['countries'][$result['country_id']] = $result['iso_code_3'];
        $data[$result['country_id']][$result['key']] = $result['value'];
      }

      return $data;
    }
}
