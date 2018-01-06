<?php
/*
*    location: admin/model
*/

class ModelModuleDVisualDesignerlanding extends Model {

    public $codename = 'd_visual_designer_landing';
    
    public function installModule(){

        $this->db->query("CREATE TABLE IF NOT EXISTS `".DB_PREFIX."dvdl_page` (
            `page_id` INT(11) NOT NULL AUTO_INCREMENT,
            `status` INT(11) NOT NULL,
            `header_status` TINYINT(4) NOT NULL,
            `footer_status` TINYINT(4) NOT NULL,
            `display_title` TINYINT(1) NOT NULL,
            `full_width` TINYINT(1) NOT NULL,
            `sort_order` INT(11) NOT NULL,
            PRIMARY KEY (`page_id`)
            ) COLLATE='utf8_general_ci' ENGINE=MyISAM;
            ");
        $this->db->query("CREATE TABLE IF NOT EXISTS`".DB_PREFIX."dvdl_page_description` (
            `page_id` INT(11) NOT NULL,
            `language_id` INT(11) NOT NULL,
            `title` VARCHAR(256) NOT NULL,
            `meta_title` VARCHAR(256) NULL DEFAULT NULL,
            `meta_description` TEXT NULL,
            `meta_keyword` TEXT NULL,
            PRIMARY KEY (`page_id`, `language_id`)
            ) COLLATE='utf8_general_ci' ENGINE=MyISAM;
            ");
        $this->db->query("CREATE TABLE IF NOT EXISTS`".DB_PREFIX."dvdl_page_to_store` (
            `page_id` INT(11) NOT NULL,
            `store_id` INT(11) NOT NULL,
            PRIMARY KEY (`page_id`, `store_id`)
            ) COLLATE='utf8_general_ci' ENGINE=MyISAM;
            ");
        $this->db->query("CREATE TABLE IF NOT EXISTS`".DB_PREFIX."dvdl_variation` (
            `variation_id` INT(11) NOT NULL AUTO_INCREMENT,
            `page_id` INT(11) NOT NULL,
            `sort_order` INT(11) NOT NULL,
            `status` TINYINT(1) NOT NULL,
            `view` INT(11) NOT NULL,
            PRIMARY KEY (`variation_id`)
            ) COLLATE='utf8_general_ci' ENGINE=MyISAM;
            ");
        $this->db->query("CREATE TABLE IF NOT EXISTS`".DB_PREFIX."dvdl_variation_description` (
            `variation_id` INT(11) NOT NULL,
            `language_id` INT(11) NOT NULL,
            `description` LONGTEXT NULL,
            PRIMARY KEY (`variation_id`, `language_id`)
            ) COLLATE='utf8_general_ci' ENGINE=MyISAM;
            ");
        $this->db->query("CREATE TABLE  IF NOT EXISTS `".DB_PREFIX."dvdl_conversion` (
            `description_id` VARCHAR(50) NOT NULL,
            `type` VARCHAR(50) NOT NULL,
            `count` INT(11) NOT NULL,
            `date_added` DATE NOT NULL
            )
            COLLATE='utf8_general_ci' ENGINE=MyISAM;
            ");
    }
    
    public function uninstallModule(){
        $this->load->model('extension/event');
        $this->model_extension_event->deleteEvent($this->codename);
        
        $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX."dvdl_page");
        $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX."dvdl_page_description");
        $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX."dvdl_page_to_store");
        $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX."dvdl_variation");
        $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX."dvdl_variation_description");
        $this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX."dvdl_conversion");
        $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query LIKE '%vdl_page_id=%'");
    }

    public function saveSEOExtensions($seo_extensions) {
        $this->load->model('setting/setting');
        
        $setting['d_seo_extension_install'] = $seo_extensions;
        
        $this->model_setting_setting->editSetting('d_seo_extension', $setting);
    }
    
    /*
    *   Return list of SEO extensions.
    */
    public function getSEOExtensions() {
        $this->load->model('setting/setting');

        $installed_extensions = array();
        
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "extension ORDER BY code");
        
        foreach ($query->rows as $result) {
            $installed_extensions[] = $result['code'];
        }
        
        $installed_seo_extensions = $this->model_setting_setting->getSetting('d_seo_extension');
        $installed_seo_extensions = isset($installed_seo_extensions['d_seo_extension_install']) ? $installed_seo_extensions['d_seo_extension_install'] : array();
        
        $seo_extensions = array();
        
        $files = glob(DIR_APPLICATION . 'controller/d_seo_module/*.php');
        
        if ($files) {
            foreach ($files as $file) {
                $seo_extension = basename($file, '.php');
                
                if (in_array($seo_extension, $installed_extensions) && in_array($seo_extension, $installed_seo_extensions)) {
                    $seo_extensions[] = $seo_extension;
                }
            }
        }
        
        return $seo_extensions;
    }

    public function getAliases($data){
        $sql = "SELECT * FROM `".DB_PREFIX."url_alias`";
        $implode = array();

        if(!empty($data['filter_keyword'])){
            $implode[] = "keyword = '".$data['filter_keyword']."'";
        }

        if(!empty($data['filter_query'])){
            $implode[] = "query = '".$data['filter_query']."'";
        }

        if(count($implode) > 0){
            $sql .= " WHERE ".implode(' AND ', $implode);
        }
        $query = $this->db->query($sql);
        $aliaces_data = array();
        if($query->num_rows){
            foreach ($query->rows as $row) {
                $aliaces_data[] = array(
                    'route' => $row['query'],
                    'keyword' => $row['keyword']
                    );
            }
        }
        return $aliaces_data;
    }
    
    public function addPage($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "dvdl_page SET 
            sort_order = '" . (int)$data['sort_order'] . "',
            header_status = '" .(int)$data['header_status'] . "', 
            footer_status = '" .(int)$data['footer_status'] . "', 
            display_title = '" .(int)$data['display_title'] . "', 
            full_width = '" .(int)$data['full_width'] . "', 
            status = '" . (int)$data['status'] . "'");

        $page_id = $this->db->getLastId();

        foreach ($data['page_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "dvdl_page_description SET 
                page_id = '" . (int)$page_id . "',
                language_id = '" . (int)$language_id . "',
                title = '" . $this->db->escape($value['title']) . "',
                meta_title = '" . $this->db->escape($value['meta_title']) . "',
                meta_description = '" . $this->db->escape($value['meta_description']) . "',
                meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'
                ");
        }

        if (isset($data['page_store'])) {
            foreach ($data['page_store'] as $store_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "dvdl_page_to_store SET page_id = '" . (int)$page_id . "', store_id = '" . (int)$store_id . "'");
            }
        }

        $this->savePageSEOKeyword($page_id, $data);

        $this->cache->delete('page');

        return $page_id;
    }

    public function editPage($page_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "dvdl_page SET 
            sort_order = '" . (int)$data['sort_order'] . "', 
            header_status = '" .(int)$data['header_status'] . "', 
            footer_status = '" .(int)$data['footer_status'] . "', 
            display_title = '" .(int)$data['display_title'] . "', 
            full_width = '" .(int)$data['full_width'] . "', 
            status = '" . (int)$data['status'] . "'
            WHERE page_id = '" . (int)$page_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "dvdl_page_description WHERE page_id = '" . (int)$page_id . "'");

        foreach ($data['page_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "dvdl_page_description SET 
                page_id = '" . (int)$page_id . "',
                language_id = '" . (int)$language_id . "',
                title = '" . $this->db->escape($value['title']) . "',
                meta_title = '" . $this->db->escape($value['meta_title']) . "',
                meta_description = '" . $this->db->escape($value['meta_description']) . "',
                meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "dvdl_page_to_store WHERE page_id = '" . (int)$page_id . "'");

        if (isset($data['page_store'])) {
            foreach ($data['page_store'] as $store_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "dvdl_page_to_store SET 
                    page_id = '" . (int)$page_id . "', 
                    store_id = '" . (int)$store_id . "'");
            }
        }

        $this->savePageSEOKeyword($page_id, $data);

        $this->cache->delete('information');
    }

    public function deletePage($page_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "dvdl_page WHERE page_id = '" . (int)$page_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "dvdl_page_description WHERE page_id = '" . (int)$page_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "dvdl_page_to_store WHERE page_id = '" . (int)$page_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "dvdl_variation_description 
            WHERE variation_id IN (SELECT v.variation_id FROM ".DB_PREFIX."dvdl_variation v WHERE v.page_id = '" . (int)$page_id . "')");
        $this->db->query("DELETE FROM " . DB_PREFIX . "dvdl_variation WHERE page_id = '" . (int)$page_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query LIKE '%vdl_page_id=" . (int)$page_id . "%'");

        $this->cache->delete('page');
    }

    public function savePageSEOKeyword($page_id, $data) {
        if (isset($data['keyword'])) {
            $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query LIKE 'vdl_page_id=" . (int)$page_id . "%'");
            
            foreach ($data['keyword'] as $language_id => $seo_keyword) {
                if ($seo_keyword) {
                    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE query NOT LIKE 'vdl_page_id=" . (int)$page_id . "%' AND keyword = '" . $this->db->escape($seo_keyword) . "'");
                    
                    if (!$query->rows) {
                        $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'vdl_page_id=" . (int)$page_id . "&language_id=" . (int)$language_id . "', keyword = '" . $this->db->escape($seo_keyword) . "'");
                    }
                }
            }
        }
        $this->cache->delete('url_rewrite');
    }
    
    public function deleteVariation($variation_id){
        $this->db->query("DELETE FROM " . DB_PREFIX . "dvdl_variation WHERE variation_id = '" . (int)$variation_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "dvdl_variation_description WHERE variation_id = '" . (int)$variation_id . "'");
    }
    
    public function saveVariations($data, $active_variation_id, $page_id){

        foreach ($data as $variation_id => $variation_data) {

            $old_variation_id = $variation_id;
            
            if(!empty($variation_data['new'])){
                $variation_id = $this->addVariation($page_id, $variation_data);
            }
            else{
                $this->editVariation($page_id, $variation_id, $variation_data);
            }
        }
    }

    public function addVariation($page_id, $data){
        $this->db->query("INSERT INTO " . DB_PREFIX . "dvdl_variation SET 
            page_id = '" . (int)$page_id . "',
            status = '" . (int)$data['status'] . "',
            view = '0',
            sort_order = '" . (int)$data['sort_order'] . "'");
        
        $variation_id = $this->db->getLastId();
        
        if(!empty($data['description'])){
            foreach ($data['description'] as $language_id => $value) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "dvdl_variation_description SET 
                    language_id = '" . (int)$language_id . "',
                    variation_id = '" . (int)$variation_id . "',
                    description = '" . $this->db->escape($value['description']) . "'");
            }
        }    
        return $variation_id;
    }
    public function editVariation($variation_id, $data){
        $this->db->query("UPDATE " . DB_PREFIX . "dvdl_variation SET 
            sort_order = '" . (int)$data['sort_order'] . "',
            status = '".(int)$data['status']."'
            WHERE variation_id = '" . (int)$variation_id . "'");
        
        $this->db->query("DELETE FROM ".DB_PREFIX."dvdl_variation_description WHERE variation_id='".$variation_id."'");
        
        if(!empty($data['description'])){
            foreach ($data['description'] as $language_id => $value) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "dvdl_variation_description SET 
                    language_id = '" . (int)$language_id . "',
                    variation_id = '" . (int)$variation_id . "',
                    description = '" . $this->db->escape($value['description']) . "'");
            }
        }
    }
    public function copyVariation($variation_id){
        $this->db->query("INSERT INTO " . DB_PREFIX . "dvdl_variation (page_id, sort_order, status, view) 
            SELECT page_id, sort_order, status, '0' as view
            FROM ".DB_PREFIX."dvdl_variation
            WHERE variation_id = '" . (int)$variation_id . "'");

        $variation_id = $this->db->getLastId();

        $this->db->query("INSERT INTO " . DB_PREFIX . "dvdl_variation_description (language_id, variation_id, description) 
            SELECT language_id, '".$variation_id."' as variation_id, description
            FROM ".DB_PREFIX."dvdl_variation_description
            WHERE variation_id = '" . (int)$variation_id . "'");
    }

    public function setStatus($variation_id, $status){
        $this->db->query("UPDATE ".DB_PREFIX."dvdl_variation SET status='".(int)$status."' WHERE variation_id='".(int)$variation_id."'");
    }

    public function getVariations($page_id){
        $query = $this->db->query("SELECT *, char((SELECT count(*) FROM oc_dvdl_variation v2 WHERE v2.variation_id < v.variation_id AND v2.page_id = v.page_id)+65) as symbol  FROM ".DB_PREFIX."dvdl_variation v WHERE page_id = '".$page_id."'");

        $variation_data = array();
        if($query->num_rows){
            foreach ($query->rows as $row) {
                $variation_data[$row['variation_id']] = array(
                    'variation_id' => $row['variation_id'],
                    'sort_order' => $row['sort_order'],
                    'symbol' => $row['symbol'],
                    'status' => $row['status'],
                    'view' => $row['view']
                    );
            }
        }
        return $variation_data;
    }
    
    public function getVariation($variation_id){
        $query = $this->db->query("SELECT *, char((SELECT count(*) FROM oc_dvdl_variation v2 WHERE v2.variation_id < v.variation_id AND v2.page_id = v.page_id)+65) as symbol FROM ".DB_PREFIX."dvdl_variation v WHERE v.variation_id = '".$variation_id."'");

        return $query->row;
    }
    public function getLastSymbol($page_id){
        $query = $this->db->query("SELECT char((SELECT count(*) FROM oc_dvdl_variation v2 WHERE v2.variation_id < v.variation_id AND v2.page_id = v.page_id)+65) as symbol FROM ".DB_PREFIX."dvdl_variation v WHERE page_id='".$page_id."' ORDER BY variation_id DESC LIMIT 1");
        if($query->num_rows > 0){
            return $query->row['symbol'];
        }
        else{
            return 'A';
        }
    }

    public function getVariationDescription($variation_id){
        $query = $this->db->query("SELECT * FROM ".DB_PREFIX."dvdl_variation v
            LEFT JOIN ".DB_PREFIX."dvdl_variation_description vd ON v.variation_id = vd.variation_id WHERE v.variation_id = '".$variation_id."'");
        $variation_data = array();
        if($query->num_rows){
            foreach ($query->rows as $row) {
                $variation_data[$row['language_id']] = array(
                    'variation_id' => $row['variation_id'],
                    'description' => html_entity_decode($row['description'], ENT_QUOTES, 'UTF-8')
                    );
            }
        }
        return $variation_data;
    }
    
    public function getPage($page_id) {
        $query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'vdl_page_id=" . (int)$page_id . "' LIMIT 1) AS keyword FROM " . DB_PREFIX . "dvdl_page WHERE page_id = '" . (int)$page_id . "'");

        return $query->row;
    }
    
    public function getPageDescriptions($page_id) {
        $page_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "dvdl_page_description WHERE page_id = '" . (int)$page_id . "'");

        foreach ($query->rows as $result) {
            $page_description_data[$result['language_id']] = array(
                'title'            => $result['title'],
                'meta_title'       => html_entity_decode($result['meta_title'], ENT_QUOTES, 'UTF-8'),
                'meta_description' => html_entity_decode($result['meta_description'], ENT_QUOTES, 'UTF-8'),
                'meta_keyword'     => html_entity_decode($result['meta_keyword'], ENT_QUOTES, 'UTF-8')
                );
        }

        return $page_description_data;
    }
    
    public function getPageStores($page_id) {
        $page_store_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "dvdl_page_to_store WHERE page_id = '" . (int)$page_id . "'");

        foreach ($query->rows as $result) {
            $page_store_data[] = $result['store_id'];
        }

        return $page_store_data;
    }
    
    public function getPages($data = array()){

        if($data){
            $sql = "SELECT * FROM ".DB_PREFIX."dvdl_page p
            LEFT JOIN ".DB_PREFIX."dvdl_page_description pd
            ON pd.page_id = p.page_id
            WHERE pd.language_id = '".(int)$this->config->get('config_language_id')."'";
            $sort_data = array(
                'pd.title',
                'p.sort_order'
                );

            if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                $sql .= " ORDER BY " . $data['sort'];
            } else {
                $sql .= " ORDER BY pd.title";
            }

            if (isset($data['order']) && ($data['order'] == 'DESC')) {
                $sql .= " DESC";
            } else {
                $sql .= " ASC";
            }

            if (isset($data['start']) || isset($data['limit'])) {
                if ($data['start'] < 0) {
                    $data['start'] = 0;
                }

                if ($data['limit'] < 1) {
                    $data['limit'] = 20;
                }

                $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
            }
            $query = $this->db->query($sql);
            
            return $query->rows;
        }else{
            $page_data = $this->cache->get('landing_page.' . (int)$this->config->get('config_language_id'));

            if (!$page_data) {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "dvdl_page p LEFT JOIN " . DB_PREFIX . "dvdl_page_description pd ON (p.page_id = pd.page_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY pd.title");

                $page_data = $query->rows;

                $this->cache->set('landing_page.' . (int)$this->config->get('config_language_id'), $information_data);
            }

            return $page_data;
        }
    }
    
    public function getTotalPages(){
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "dvdl_page");

        return $query->row['total'];
    }
    
    public function ajax($link){
        return str_replace('&amp;', '&', $link);
    }
    
    public function getGroupId(){
        if(VERSION == '2.0.0.0'){
            $user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE user_id = '" . $this->user->getId() . "'");
            $user_group_id = (int)$user_query->row['user_group_id'];
        }else{
            $user_group_id = $this->user->getGroupId();
        }

        return $user_group_id;
    }
    
    public function getLink($route,$args,$catalog = false){
        $https = $this->request->server['HTTPS'];
        if(!empty($https)){
            if($catalog){
                $url = HTTPS_CATALOG;
            }else {
                $url = HTTPS_SERVER;
            }
        }
        else{
            if($catalog){
                $url = HTTP_CATALOG;
            }else {
                $url = HTTP_SERVER;
            }
        }
        
        $url .= 'index.php?route=' . $route;
        
        if ($args) {
            if (is_array($args)) {
                $url .= '&amp;' . http_build_query($args);
            } else {
                $url .= str_replace('&', '&amp;', '&' . ltrim($args, '&'));
            }
        }
        
        return $url;
    }

    public function getPageSEOKeyword($page_id){
        $seo_keyword = array();
        
        $languages = $this->getLanguages();
        
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE query LIKE 'vdl_page_id=" . (int)$page_id . "%'");
        
        foreach ($query->rows as $result) {
            $query_arr = explode("&language_id=", $result['query']);
            
            if (!isset($query_arr[1])) {
                foreach($languages as $language) {
                    $seo_keyword[$language['language_id']] = $result['keyword'];
                }
            }
        }   
        
        foreach ($query->rows as $result) {
            $query_arr = explode("&language_id=", $result['query']);
            
            if (isset($query_arr[1])) {
                $seo_keyword[$query_arr[1]] = $result['keyword'];
            }
        }

        return $seo_keyword;
    }

    public function getLanguages() {
        $this->load->model('localisation/language');
        
        $languages = $this->model_localisation_language->getLanguages();
        
        foreach ($languages as $key => $language) {
            $languages[$key]['flag'] = 'language/' . $language['code'] . '/' . $language['code'] . '.png';
        }
        
        return $languages;
    }
    
}