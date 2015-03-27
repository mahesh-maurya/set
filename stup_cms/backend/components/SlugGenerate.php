<?php
class SlugGenerate
{

    public static function getCriteriaForArray($tablename, $select = array(), $condition =
        array(), $params = array(), $operation = "AND", $order = array())
    {
        $result = Yii::app()->db->createCommand();
        if ($operation == null)
            $operation = "AND";
        if (isset($select) && count($select) > 0)
        {
            $result->select(implode(", ", $select));
        } else
        {
            $result->select = "*";
        }

        $result->from($tablename);

        if (isset($condition) && isset($params) && count($params) > 0 && count($params) ==
            count($condition))
        {
            $count = count($condition);
            $where = '';
            foreach ($condition as $key => $cond)
            {
                $where .= $cond . "=:" . $cond;
                if ($count != 1)
                    $where .= " " . $operation . " ";

                $params[':' . $cond] = $params[$cond];
                $count--;
            }
            $result->where($where, $params);
        }

        if (isset($order) && isset($order['order_feild']) && isset($order['order']))
        {
            $order_statement = implode(", ", $order['order_feild']);
            $order_statement .= " " . $order['order'];
            $result->order($order_statement);
        }

        return $result;
    }


    public static function getSlug($tablename, $condition = array(), $params = array
        (), $select)
    {
        //$select = array('title','slug','id');
        $order['order_feild'] = array('id');
        $order['order'] = 'desc';
        $result = SlugGenerate::getCriteriaForArray($tablename, $select, $condition, $params, null, null);
        $resultRow = $result->queryAll();

        if (isset($resultRow) && $resultRow != null)
        {
           // echo'<pre>'; print_r($resultRow); exit;
            $slug = $resultRow[count($resultRow)-1][$select[0]] . " " . $resultRow[count($resultRow)-1][$select[2]];
            $obj = new SlugGenerate();
            $slug = $obj->getFormattedSlug($slug);
            return $slug;
        } 
		else
        {
            return "NO-MATCH";
        }

    }

    public static function getFormattedSlug($title)
    {
        $title = strip_tags($title);
        $title = mb_convert_encoding($title,'HTML-ENTITIES','UTF-8');
        $title = str_replace('%', '', $title);
        $title = str_replace(',', '', $title);
        $title = str_replace('?', '', $title);
        $title = str_replace('.', '-', $title);
        $title = str_replace('!', '-', $title);
        $title = str_replace('"', '', $title);
        $title = str_replace('\'', '', $title);
        $title = str_replace('/', '', $title);
        $title = str_replace('\\', '', $title);
		$title = str_replace(':', '-', $title);
        
        $title = preg_replace('/\s+/', '-', $title);
        $title = preg_replace('/&.+?;\'/', '', $title); // kill entities
        $title = preg_replace("/&#?[a-z0-9]{2,8};/i", "", $title);
        $title = str_replace('&', 'and', $title);
        
        //$title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
        $title = preg_replace('|-+|', '-', $title);
        $title = trim($title, '-');
        $title = strtolower($title);
        return $title;
    }
}

?>