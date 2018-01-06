<?php
// ------------------------------------------------------
// Product SKU Auto Generator for Opencart 2.0
// By P.K Solutions
// enquiries@p-k-solutions.co.uk
// ------------------------------------------------------

class ModelCatalogskuautogen extends Model {

   public function check_db() {
	 $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "pksolutions_skuautogen (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `condition1` int(11) NULL,
  `condition2` int(11) NULL,
  `conditionUser` varchar(7) NULL,
  `sequential` int(11) NOT NULL,
  `useHyphens` bool NOT NULL,  
  PRIMARY KEY (`id`));");	
	 
	$query=$this->db->query("SELECT * FROM " . DB_PREFIX . "pksolutions_skuautogen");	
	
	if ($query->row['id'] < 1) {
	 
	$this->db->query("INSERT INTO " . DB_PREFIX . "pksolutions_skuautogen SET condition1=1, condition2=2, conditionUser='', sequential=1000, useHyphens=1");
	}
   }
   
     public function getValues() {
		 
	$query=$this->db->query("SELECT * FROM " . DB_PREFIX . "pksolutions_skuautogen");	
	
	return $query->row;
	 }
	 
	 public function updateValues($data) {
	
		$this->db->query("UPDATE " . DB_PREFIX . "pksolutions_skuautogen SET condition1 = '".
            (int)$data['condition1']."', condition2 = '".
            (int)$data['condition2']."', conditionUser = '".
            $this->db->escape($data['conditionUser']).
            "', sequential = '".(int)$data['sequential'].
            "', useHyphens = '".(int)$data['useHyphens']."'");
}		

	public function getLastProdId() {
	$query=$this->db->query("SELECT MAX(product_id) FROM " . DB_PREFIX . "product");	
	
	return $query->row;		
		
	}
	
	 public function updateAll() {	
	 
		$skucode = $this->db->query("SELECT * FROM " . DB_PREFIX . "pksolutions_skuautogen");
		
		$condition1 = $skucode->row['condition1'];
		$condition2 = $skucode->row['condition2'];
		$conditionUser = $skucode->row['conditionUser'];
		$sequential = $skucode->row['sequential'];
		$useHyphens = $skucode->row['useHyphens'];	 
		
		$query = $this->db->query("SELECT " . DB_PREFIX . "product.product_id, category_id FROM " . DB_PREFIX . "product, " . DB_PREFIX . "product_to_category WHERE " . DB_PREFIX . "product_to_category.product_id = " . DB_PREFIX . "product.product_id ORDER BY " . DB_PREFIX . "product.product_id, " . DB_PREFIX . "product_to_category.category_id DESC");	
	
		foreach ($query->rows as $queries) {

		$prodcode = $queries['product_id'];	
		$catid = $queries['category_id']; 
		
		if ($useHyphens == 0) {$hyphen = '';} else {$hyphen = '-';};//set value of hyphen char
		if ($condition1 == 1) { 
		$this->db->query("UPDATE " . DB_PREFIX . "product SET sku = '".(int)$catid.$hyphen.(int)$prodcode.$hyphen.(int)$sequential."' WHERE product_id = '".(int)$prodcode."'");				
		}
		else
		{	
		$this->db->query("UPDATE " . DB_PREFIX . "product SET sku = '".(int)$prodcode.$hyphen.(int)$catid.$hyphen.(int)$sequential."' WHERE product_id = '".(int)$prodcode."'");		
	 	}
		if ($conditionUser != '') //check if condition user value is set, if so this becomes priority
		{
		$this->db->query("UPDATE " . DB_PREFIX . "product SET sku = '".$conditionUser.$hyphen.(int)$sequential."' WHERE product_id = '".(int)$prodcode."'");		
		}
		$this->db->query("UPDATE " . DB_PREFIX . "pksolutions_skuautogen SET sequential = '".(int)$sequential."'");
		$sequential = $sequential + 1;
		}
		$this->db->query("UPDATE " . DB_PREFIX . "pksolutions_skuautogen SET sequential = '".(int)$sequential."'");		
		
		return true;
	 }
	 
      public function updateSKUProduct($prodcode) {	
	 
		$skucode = $this->db->query("SELECT * FROM " . DB_PREFIX . "pksolutions_skuautogen");
   
		
		$condition1 = $skucode->row['condition1'];
		$condition2 = $skucode->row['condition2'];
		$conditionUser = $skucode->row['conditionUser'];
		$sequential = $skucode->row['sequential'];
		$useHyphens = $skucode->row['useHyphens'];	 
		
		$query = $this->db->query("SELECT " . DB_PREFIX . "product.product_id,
                                 category_id FROM " . DB_PREFIX . "product, " .
                                  DB_PREFIX . "product_to_category WHERE " .
                                 DB_PREFIX . "product_to_category.product_id = " .
                              DB_PREFIX . "product.product_id and sku='' and oc_product.product_id=".
                              $prodcode);	
	
   
		foreach ($query->rows as $queries) {
          
    	$catid = $queries['category_id']; 
         
		if ($useHyphens == 0) {$hyphen = '';} else {$hyphen = '-';};//set value of hyphen char
		
		if ($conditionUser != '') //check if condition user value is set, if so this becomes priority
		{
		    $this->db->query("UPDATE " . DB_PREFIX . "product SET sku = '".$conditionUser.$hyphen.(int)$sequential."' WHERE product_id = '".(int)$prodcode."'");		
		}		
		else if ($condition1 == 1) { 
		$this->db->query("UPDATE " . DB_PREFIX . "product SET sku = '".(int)$catid.$hyphen.(int)$prodcode.$hyphen.(int)$sequential."' WHERE product_id = '".(int)$prodcode."'");				
		}
		else
		{	
		$this->db->query("UPDATE " . DB_PREFIX . "product SET sku = '".(int)$prodcode.$hyphen.(int)$catid.$hyphen.(int)$sequential."' WHERE product_id = '".(int)$prodcode."'");		
	 	}
		
		$this->db->query("UPDATE " . DB_PREFIX . "pksolutions_skuautogen SET sequential = '".(int)$sequential."'");
		$sequential = $sequential + 1;
		}
		$this->db->query("UPDATE " . DB_PREFIX . "pksolutions_skuautogen SET sequential = '".(int)$sequential."'");		
		return true;
	 }	
     
	 public function updateNew() {	
	 
		$skucode = $this->db->query("SELECT * FROM " . DB_PREFIX . "pksolutions_skuautogen");
   
		
		$condition1 = $skucode->row['condition1'];
		$condition2 = $skucode->row['condition2'];
		$conditionUser = $skucode->row['conditionUser'];
		$sequential = $skucode->row['sequential'];
		$useHyphens = $skucode->row['useHyphens'];	 
		
		$query = $this->db->query("SELECT " . DB_PREFIX . "product.product_id, category_id FROM " . DB_PREFIX . "product, " . DB_PREFIX . "product_to_category WHERE " . DB_PREFIX . "product_to_category.product_id = " . DB_PREFIX . "product.product_id AND sku = '' ORDER BY " . DB_PREFIX . "product.product_id, " . DB_PREFIX . "product_to_category.category_id DESC");	
	
		foreach ($query->rows as $queries) {

		$prodcode = $queries['product_id'];	
		$catid = $queries['category_id']; 
         
		if ($useHyphens == 0) {$hyphen = '';} else {$hyphen = '-';};//set value of hyphen char
		
		if ($conditionUser != '') //check if condition user value is set, if so this becomes priority
		{
		$this->db->query("UPDATE " . DB_PREFIX . "product SET sku = '".$conditionUser.$hyphen.(int)$sequential."' WHERE product_id = '".(int)$prodcode."'");		
		}		
		else if ($condition1 == 1) { 
		$this->db->query("UPDATE " . DB_PREFIX . "product SET sku = '".(int)$catid.$hyphen.(int)$prodcode.$hyphen.(int)$sequential."' WHERE product_id = '".(int)$prodcode."'");				
		}
		else
		{	
		$this->db->query("UPDATE " . DB_PREFIX . "product SET sku = '".(int)$prodcode.$hyphen.(int)$catid.$hyphen.(int)$sequential."' WHERE product_id = '".(int)$prodcode."'");		
	 	}
		
		$this->db->query("UPDATE " . DB_PREFIX . "pksolutions_skuautogen SET sequential = '".(int)$sequential."'");
		$sequential = $sequential + 1;
		}
		$this->db->query("UPDATE " . DB_PREFIX . "pksolutions_skuautogen SET sequential = '".(int)$sequential."'");		
		return true;
	 }	 
}
?>