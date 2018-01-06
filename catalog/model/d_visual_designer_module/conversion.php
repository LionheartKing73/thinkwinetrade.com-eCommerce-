<?php
class ModelDVisualDesignerModuleConversion extends Model
{

    public function getConversions($description_id){
        $sql = "SELECT type, sum(count) as total FROM oc_dvdl_conversion WHERE description_id= '".$description_id."' GROUP BY type UNION SELECT TYPE, SUM(COUNT) FROM ( SELECT description_id, IF(TYPE <> 'view', 'all', 'view') AS TYPE, COUNT, date_added FROM oc_dvdl_conversion WHERE type<>'all') c WHERE description_id = '".$description_id."' GROUP BY type";
        $query = $this->db->query($sql);

        $conversion_data = array();

        if($query->num_rows){
            foreach ($query->rows as $row) {
                $conversion_data[$row['type']] = $row['total'];
            }
        }

        return $conversion_data;
    }

    public function addConversion($description_id, $type){
        $this->user = new Cart\User($this->registry);
        if (!$this->user->isLogged()) {
            $query = $this->db->query("SELECT * FROM ".DB_PREFIX."dvdl_conversion WHERE description_id='".$description_id."' AND type='".$type."' AND date_added=CURDATE()");
            if($query->num_rows){
                $this->db->query("UPDATE ".DB_PREFIX."dvdl_conversion SET count=count+1 WHERE description_id='".$description_id."' AND type='".$type."'");
            }
            else{
                $this->db->query("INSERT INTO ".DB_PREFIX."dvdl_conversion SET description_id='".$description_id."', type='".$type."', count='1', date_added =NOW()");
            }
        }
    }
}
