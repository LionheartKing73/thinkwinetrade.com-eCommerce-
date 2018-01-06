<?php
class ModelModuleRatings extends Model {
    
    public function add($data)
    {
        $this->db->query("INSERT INTO " . DB_PREFIX . "ratings SET `name` = '".addslashes($data['name'])."',`type` = '".$data['type']."',"
                . "rangemin = '".$data['rangemin']."',rangemax='".$data['rangemax']."'");
        
        $id = $this->db->getLastId();
        
        if($data['type'] == 'award_places' && !empty($data['place']))
        {
            $insert = FALSE;
            $sql = "INSERT INTO ". DB_PREFIX ."ratings_values (`rating_id`,`value`) VALUES";
            foreach($data['place'] as $p)
            {
                if(!empty($p))
                {
                    $sql .= "('$id','$p'),";
                    $insert = TRUE;
                }
            }
            $sql = rtrim($sql,",");
            if($insert)
            {
                $this->db->query($sql);
            }         
        }
        return $id;
    }
    
    public function getAll()
    {
        $data = array();
        $query = $this->db->query("SELECT * FROM ".DB_PREFIX."ratings");   
        foreach($query->rows as $r)
        {
            
            switch($r['type'])
            {
                case 'stars':
                    $type = "Star rating";
                    break;
                
                case 'points':
                    $type = "Points";
                    break;
                
                case 'award':
                    $type = "Award";
                    break;
                
                case 'award_places':
                    $type = "Award with places";
                    break;
                
            }
            
            $data[] = array(
                'id'        => $r['id'],
                'name'      => $r['name'],
                'type'      => $r['type'],
                'range'     => $r['type'] == "points"||$r['type'] == "stars"?$r['rangemin'].' - '.$r['rangemax']:'-',
                'typeH'     => $type,
                'edit'      => $this->url->link('module/ratings/edit', 'token=' . $this->session->data['token'].'&id='.$r['id'], 'SSL'),
                'delete'    => $this->url->link('module/ratings/delete', 'token=' . $this->session->data['token'].'&id='.$r['id'], 'SSL')
            );
        }
        
        return $data;
        
    }
    
    public function deleteRating($id)
    {
        $this->db->query("DELETE FROM ".DB_PREFIX."ratings WHERE id='$id'");
    }
    
    public function getRating($id)
    {
        $data = array();
        
        $query  = $this->db->query("SELECT * FROM ".DB_PREFIX."ratings WHERE id = '$id'"); 
        $query2 = $this->db->query("SELECT * FROM ".DB_PREFIX."ratings_values WHERE rating_id = '$id'");
        
        $data['rating']         = $query->row;
        $data['rating_values']  = $query2->rows;

        return $data;
    }
    
    public function editRating($data, $id)
    {
        $this->db->query("UPDATE " . DB_PREFIX . "ratings SET `name` = '".addslashes($data['name'])."',`type` = '".$data['type']."',"
                . "rangemin = '".$data['rangemin']."',rangemax='".$data['rangemax']."' WHERE id = '$id'");
        
        if($data['type'] == 'award_places')
        {
            $this->db->query("DELETE FROM ". DB_PREFIX ."ratings_values WHERE rating_id = '$id'");
            $insert = FALSE;
            $sql = "INSERT INTO ". DB_PREFIX ."ratings_values (`rating_id`,`value`) VALUES";
            foreach($data['place'] as $p)
            {
                if(!empty($p))
                {
                    $sql .= "('$id','$p'),";
                    $insert = TRUE;
                }
            }
            $sql = rtrim($sql,",");
            if($insert)
            {
                $this->db->query($sql);
            }         
        }
        
    }
    
    public function getRatingsQ(){
        $data = $this->db->query("SELECT r.*, GROUP_CONCAT(rv.id,'::',rv.value SEPARATOR '{|}') AS `values`
                                  FROM oc_ratings r
                                  LEFT JOIN oc_ratings_values rv ON rv.rating_id = r.id
                                  GROUP BY r.id ORDER BY r.name ASC");
        return $data;
    }
 
    public function buildRatings($product_id = null)
    {
        $data = $this->getRatingsQ();
        
        if(empty($product_id)) {
            $html = $this->_addBuild($data);
        } else {
            $html = $this->_editBuild($data,$product_id);
        }
        
        return $html;
        
    }
    
    private function _addBuild($data){
        $custom_ratings = "<select name='customRating[]' class='form-control input-lg customRating'><option>No award</option>";
        
        foreach($data->rows as $r)
        {            
            $custom_ratings .= "<option value='".$r['id']."' data-values='".$r['values']."' data-type='".$r['type']."' data-min='".$r['rangemin']."' data-max='".$r['rangemax']."'>".$r['name']."</option>";
        }
        
        $custom_ratings .= "</select>";

        $html = "<div class='ratingHolder'>
                        <div class='input-group' style='float:left;'>$custom_ratings</div>
                        <div class='custom_rating_value' class='input-group' style='float:left;'></div>			
                </div>";
        
        return $html;
    }
    
    private function _editBuild($data,$product_id){
        $selected = $this->getByProduct($product_id);
        
        if(empty($selected)) {
            return $this->_addBuild($data);
        }
        
        $html = "";
        $i = 0;
        foreach($selected as $s)
        {
            $custom_ratings = "<select name='customRating[$i]' class='form-control input-lg customRating'><option></option>";

            foreach($data->rows as $r)
            {            
                if(!empty($s['rating_id']) && $s['rating_id'] === $r['id'])
                {
                    $sh = "selected";
                } else {
                    $sh = "";
                }
                
                $custom_ratings .= "<option $sh value='".$r['id']."' data-values='".$r['values']."' data-type='".$r['type']."' data-min='".$r['rangemin']."' data-max='".$r['rangemax']."'>".$r['name']."</option>";
            }

            $custom_ratings .= "</select>";

            $custom_value = "";
            
            switch ($s['type'])
            {
                case 'stars':
                    $custom_value = "<input value='{$s['value']}' class='form-control input-lg' type='number' name='ratingValue[$i]' placeholder='Étoiles (".$s['rangemin']."-".$s['rangemax'].")' min='".$s['rangemin']."' max='".$s['rangemax']."' />";
                break;

                case 'award_places':

                    $values = $this->db->query("SELECT id, value FROM ".DB_PREFIX."ratings_values WHERE rating_id = '{$s['rating_id']}'");

                    $custom_value = "<select name='ratingValue[$i]' class='form-control input-lg'>";

                    foreach($values->rows as $val)
                    {
                        if($val['id'] == $s['value_id'])
                            $custom_value .= "<option selected value='{$val['id']}'>{$val['value']}</option>";
                        else
                            $custom_value .= "<option value='{$val['id']}'>{$val['value']}</option>";  
                    }

                    $custom_value .= "</select>";

                break;
                case 'points':              
                    $custom_value = "<input value='{$s['value']}' class='form-control input-lg' type='number' name='ratingValue[$i]' placeholder='Points (".$s['rangemin']."-".$s['rangemax'].")' min='".$s['rangemin']."' max='".$s['rangemax']."' />";
                break;

            }
            
            if($i > 0)
            {
                $button = "<button type='button' class='btn btn-danger removeAward'><i class='fa fa-minus-circle'></i></button>";
            } else {
                $button = "";
            }
            
            $html .= "<div class='ratingHolder'>
                            <div class='input-group' style='float:left;'>$custom_ratings</div>
                            <div class='custom_rating_value' class='input-group' style='float:left;'>$custom_value</div>
                            $button
                    </div>";
            
            $i++;
        }
        
        return $html;
        
    }
    
    public function getByProduct($product_id)
    {
        $data = $this->db->query("SELECT pr.*, r.type, r.rangemin, r.rangemax
                                    FROM ".DB_PREFIX."product_ratings pr
                                    INNER JOIN ".DB_PREFIX."ratings r ON r.id = pr.rating_id
                                    WHERE product_id = '$product_id'");
        return !empty($data->rows)?$data->rows:null;
        
    }

}