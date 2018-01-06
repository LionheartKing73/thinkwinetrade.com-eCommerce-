<?php
class ControllerDSEOModuleDVisualDesignerLanding extends Controller {
    private $codename = 'd_visual_designer_landing';
    private $route = 'module/d_visual_designer_landing';
    
    /*
    *   Functions for SEO Module.
    */
    public function seo_url() {
        $this->load->model($this->route);
        $this->load->model('setting/setting');

        if (!isset($this->request->get['route']) && isset($this->request->get['_route_'])) {
            $parts = explode('/', $this->request->get['_route_']);

                // remove any empty arrays from trailing
            if (utf8_strlen(end($parts)) == 0) {
                array_pop($parts);
            }

            foreach ($parts as $part) {
                unset($route);
                unset($language_id);
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE keyword = '" . $this->db->escape($part) . "'");

                foreach ($query->rows as $result) {
                    $query_arr = explode("&language_id=", $result['query']);

                    if (!isset($query_arr[1])) {
                        $route = $query_arr[0];
                        $language_id = $this->config->get('config_language_id');
                    }
                }

                foreach ($query->rows as $result) {
                    $query_arr = explode("&language_id=", $result['query']);

                    if (isset($query_arr[1])) {
                        $route = $query_arr[0];
                        $language_id = $query_arr[1];
                    }
                }

                foreach ($query->rows as $result) {
                    $query_arr = explode("&language_id=", $result['query']);

                    if (isset($query_arr[1]) && $query_arr[1] == $this->config->get('config_language_id')) {
                        $route = $query_arr[0];
                        $language_id = $query_arr[1];
                    }
                }

                if (isset($route)) {
                    $route = explode('=', $route);

                    if ($route[0] == 'vdl_page_id') {
                        $this->request->get['page_id'] = $route[1];
                    }

                    if (preg_match('/[A-Za-z0-9]+\/[A-Za-z0-9]+/i', $route[0])) {
                        $this->request->get['route'] = $route[0];
                    }
                } else {
                    $this->request->get['route'] = 'error/not_found';

                    break;
                }
            }

            if (isset($language_id)) {
                    $this->load->model($this->route);
                    $this->load->model('localisation/language');
                                        
                    $language_info = $this->model_localisation_language->getLanguage($language_id);
                            
                    if ($this->session->data['language'] != $language_info['code']) {
                        $this->session->data['language'] = $language_info['code'];
                        $this->response->redirect($this->{'model_module_' . $this->codename}->getCurrentURL(), '302');
                    }   
                }

            if (!isset($this->request->get['route'])) {
                if (isset($this->request->get['page_id'])) {
                    $this->request->get['route'] = 'module/d_visual_designer_landing';
                }
            }
        }

        if (isset($this->request->get['route'])) {
            if ($this->request->get['route'] == 'module/d_visual_designer_landing') {
                if (isset($this->request->get['page_id'])) {
                    $page_id = (int)$this->request->get['page_id'];
                } else {
                    $page_id = 0;
                }

                if ($page_id) {

                    $url_data['page_id'] = $page_id;
                    
                    if ($this->url->link($this->request->get['route'], http_build_query($url_data), true) != $this->{'model_module_' . $this->codename}->getCurrentURL()&&!isset($this->request->get['variation_id'])) {
                        $this->response->redirect($this->url->link($this->request->get['route'], http_build_query($url_data), true), '301');
                    }
                }
            }
        }
    }

    public function seo_url_rewrite($link) {

        $this->load->model($this->route);
        
        $url_info = parse_url(str_replace('&amp;', '&', $link));

        $url = '';

        $data = array();
        
        if (isset($url_info['query'])) {
            parse_str($url_info['query'], $data);

            if (isset($data['route'])) {
                foreach ($data as $key => $value) {
                    if (isset($data['route'])) {
                        if ($data['route'] == 'module/d_visual_designer_landing' && $key == 'page_id') {
                            
                            $route = 'vdl_page_id=' . $value;
                            $seo_keyword = $this->{'model_module_' . $this->codename}->getSEOKeyword($route);
                            if ($seo_keyword) {
                                $url .= '/' . $seo_keyword;

                                unset($data[$key]);
                            }
                        }
                    }
                }
            }

        
            if ($url) {
                unset($data['route']);

                $query = '';

                if ($data) {
                    foreach ($data as $key => $value) {
                        $query .= '&' . rawurlencode((string)$key) . '=' . rawurlencode((is_array($value) ? http_build_query($value) : (string)$value));
                    }

                    if ($query) {
                        $query = '?' . str_replace('&', '&amp;', trim($query, '&'));
                    }
                }
                return $url_info['scheme'] . '://' . $url_info['host'] . (isset($url_info['port']) ? ':' . $url_info['port'] : '') . str_replace('/index.php', '', $url_info['path']) . $url . $query;
            }
        }
        return $link;
    }

    public function seo_url_language() {
        $this->load->model($this->route);
        
        if (isset($this->request->post['redirect'])) {
            $this->request->post['redirect'] = $this->{'model_module_' . $this->codename}->getURLForLanguage($this->request->post['redirect'], $this->session->data['language']);
        }
    }
}