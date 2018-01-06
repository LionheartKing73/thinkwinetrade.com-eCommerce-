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
}
