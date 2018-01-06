<?php
class ModelModuleDVisualDesignerLanding extends Model {

    public function getPageByVariation($variation_id) {
        $sql = "SELECT DISTINCT *, v.variation_id as variation_id
        FROM " . DB_PREFIX . "dvdl_page p
        LEFT JOIN ".DB_PREFIX."dvdl_page_description pd
        ON pd.page_id = p.page_id
        LEFT JOIN ".DB_PREFIX."dvdl_page_to_store ps
        ON ps.page_id = p.page_id
        LEFT JOIN ".DB_PREFIX."dvdl_variation v 
        ON v.page_id = p.page_id
        LEFT JOIN ".DB_PREFIX."dvdl_variation_description vd 
        ON v.variation_id = vd.variation_id WHERE v.variation_id = '".$variation_id."' AND pd.language_id = '".$this->config->get('config_language_id')."' AND
        vd.language_id = '".$this->config->get('config_language_id')."' AND ps.store_id = '".(int)$this->config->get('config_store_id')."'
        AND p.status = '1'";

        $query = $this->db->query($sql);

        return $query->row;
    }

    public function addView($variation_id){
        $this->db->query("UPDATE ".DB_PREFIX."dvdl_variation SET view = view+1 WHERE variation_id='".(int)$variation_id."'");
    }

    public function getCurrentVariation($page_id){
        $results = $this->getVariations($page_id);

        $random = array();
        foreach ($results as $variation_id => $variation) {
            if($variation['status']){
                $random[] = $variation_id;
            }
        }
        shuffle($random);

        $variation_id = current($random);
        return $variation_id;
    }

    public function getVariations($page_id){
        $query = $this->db->query("SELECT *, char((SELECT count(*) FROM oc_dvdl_variation v2 WHERE v2.variation_id < v.variation_id AND v2.page_id = v.page_id)+65) as symbol FROM ".DB_PREFIX."dvdl_variation v LEFT JOIN `".DB_PREFIX."dvdl_variation_description` vd ON v.variation_id = vd.variation_id WHERE v.page_id = '".$page_id."' AND vd.language_id='".(int)$this->config->get('config_language_id')."'");
        $variation_data = array();
        if($query->num_rows){
            foreach ($query->rows as $row) {
                $variation_data[$row['variation_id']] = array(
                    'variation_id' => $row['variation_id'],
                    'status' => $row['status'],
                    'symbol' => $row['symbol']
                    );
            }
        }
        return $variation_data;
    }

    public function editVariation($variation_id, $description){
        $this->db->query("UPDATE ".DB_PREFIX."dvdl_variation_description SET description = '".$this->db->escape($description)."' WHERE variation_id='".$variation_id."' AND language_id='".$this->config->get('config_language_id')."'");
    }

    public function getCurrentURL() {
        if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $url = "https://";
        } else {
            $url = 'http://';
        }
        
        $url .= $this->request->server['SERVER_NAME'] . $this->request->server['REQUEST_URI'];

        $url = str_replace('&', '&amp;', str_replace('&amp;', '&', $url));
        
        return $url;
    }
    public function getSEOKeyword($route) {
        $seo_keyword = '';
        
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE query LIKE '" . $this->db->escape($route) . "%'");

        foreach ($query->rows as $result) {
            $query_arr = explode("&language_id=", $result['query']);
            
            if (!isset($query_arr[1])) {
                $seo_keyword = $result['keyword'];
            }
        }
        
        foreach ($query->rows as $result) {
            $query_arr = explode("&language_id=", $result['query']);
            
            if (isset($query_arr[1]) && $query_arr[1] == $this->config->get('config_language_id')) {
                $seo_keyword = $result['keyword'];
            }
        }
        
        return $seo_keyword;
    }

    public function getURLForLanguage($link, $language_code) {

        $link = str_replace($this->url->link('common/home', '', true), '', $link);
        
        $url_info = parse_url(str_replace('&amp;', '&', $link));

        $data = array();

        if (isset($url_info['query'])){
            parse_str($url_info['query'], $data);
        }

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "language WHERE code = '" . $language_code . "'");

        $language_id = $query->row['language_id'];
        
        if (isset($data['_route_'])) {
            $parts = explode('/', $data['_route_']);

            // remove any empty arrays from trailing
            if (utf8_strlen(end($parts)) == 0) {
                array_pop($parts);
            }

            foreach ($parts as $part) {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE keyword = '" . $this->db->escape($part) . "'");
                foreach ($query->rows as $result) {
                    $query_arr = explode("&language_id=", $result['query']);
                    if (!isset($query_arr[1])) {
                        $route = $query_arr[0];
                    }
                }
                
                foreach ($query->rows as $result) {
                    $query_arr = explode("&language_id=", $result['query']);
                    if (isset($query_arr[1]) && $query_arr[1] == $this->config->get('config_language_id')) {
                        $route = $query_arr[0];
                    }
                }

                if (isset($route)) {
                    $route = explode('=', $route);

                    if ($route[0] == 'vdl_page_id') {
                        $data['page_id'] = $route[1];
                    }

                    if (preg_match('/[A-Za-z0-9]+\/[A-Za-z0-9]+/i', $route[0])) {
                        $data['route'] = $route[0];
                    }
                } else {
                    $data['route'] = 'error/not_found';

                    break;
                }
            }
        }
        
        $params = array();

        if (isset($data['page_id'])) {
            $data['route'] = 'module/d_visual_designer_landing';
            $params[] = 'page_id=' . $data['page_id'];
        }
        if (isset($data['route'])) {
            foreach($data as $param => $value) {
                if ($param != '_route_' && $param != 'route' && $param != 'page_id') {
                    $params[] = $param . '=' . $value;
                }
            }
            
            $config_language_id = $this->config->get('config_language_id');
            $this->config->set('config_language_id', $language_id); 
            
            $link = $this->url->link($data['route'], implode('&', $params), true);

            $this->config->set('config_language_id', $config_language_id);
        }

        return $link;
    }
}