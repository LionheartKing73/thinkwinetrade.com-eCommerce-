<?php
class ModelModuleRatings extends Model {
    
    public function getAwards($product_id, $limit = FALSE){
        if(!empty($limit)) {
            $sq = "LIMIT 1";
        } else {
            $sq = "";
        }
            
        $data = $this->db->query("SELECT pr.*, r.type, r.name, rv.value AS place
                                FROM ".DB_PREFIX."product_ratings pr
                                INNER JOIN ".DB_PREFIX."ratings r ON r.id = pr.rating_id
                                LEFT JOIN ".DB_PREFIX."ratings_values rv ON rv.id = pr.value_id
                                WHERE pr.product_id = '$product_id' $sq");

        if(!empty($data)){
            $awards = array(); $i = 0;
            foreach($data->rows as $r)
            {
                $awards[$i]['name'] = $r['name'];
                switch($r['type']){
                    case 'points':
                        $awards[$i]['value'] = $r['value'].' pts';
                    break;
                    case 'award_places':
                        $awards[$i]['value'] = $r['place'];
                    break;
                    case 'stars':
                        $html = '';
                        for($j = 1; $j <= $r['value']; ++$j)
                        {
                            $html.= '<span class="fa fa-stack"><i class="fa fa-star on fa-stack-1x"></i></span>';
                        }
                        $awards[$i]['value'] = $html;
                    break;
                    default:
                        $awards[$i]['value'] = null;
                    break;
                }
                
                $i++;
            }
            return $awards;
        } else {
            return null;
        }
        
    }
    
}