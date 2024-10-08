<?php

namespace App\Snippets;

use Illuminate\Support\Facades\DB;
use Doctrine\DBAL\Driver\PDO\Exception;
use Illuminate\Database\Query\Expression;

class SqlSnippet
{    

    public static function members_count(): Expression
    {
        $db_conn = config('database.default');
        
        if ($db_conn == 'sqlite') {
            $date_compare = "datetime(hm.death_date) > datetime('" . date('Y-m-d') . "')";
        } else if ($db_conn == 'mysql') {
            $date_compare = "hm.death_date > '" . date('Y-m-d') . "'";
        } else {
            throw new Exception("DB driver does not support");
        }

        $sql = "( ";
        $sql.= "select count(*) ";
        $sql.= "from household_members as hm ";
        $sql.= "where hm.household_id = households.id and (hm.death_date is null  or $date_compare ) ";
        $sql.= ") as members_count";
        
        return DB::raw($sql);     
    }


    public static function household_head(): Expression
    {
        $db_conn = config('database.default');
        
        if ($db_conn == 'sqlite') {
            $head = "hm.surname || ' ' || hm.name || ' ' || hm.patronymic";
        } else if ($db_conn == 'mysql') {
            $head = "CONCAT(hm.surname, ' ', hm.name, ' ', hm.patronymic)";
        } else {
            throw new Exception("DB driver does not support");
        }        

        $sql = "( ";
        $sql.= "select $head ";
        $sql.= "from household_members hm ";
        $sql.= "inner join family_relationship_types frt on frt.id = hm.family_relationship_type_id ";
        $sql.= "where hm.household_id  = households.id and frt.name = 'голова домогосподарства' ";
        $sql.= ") as head";
        
        return DB::raw($sql);
    }   

    public static function household_head_full_name(): Expression
    {
        $db_conn = config('database.default');
        
        if ($db_conn == 'sqlite') {
            $sql = "head.surname || ' ' || head.name || ' ' || head.patronymic as household_head " ;
        } else if ($db_conn == 'mysql') {
            $sql = "CONCAT(head.surname, ' ', head.name, ' ', head.patronymic) as household_head ";
        } else {
            throw new Exception("DB driver does not support");
        }        

        return DB::raw($sql);
    }   
    
    public static function memberFullAgeRange(): string
    {
        $db_conn = config('database.default');

        if ($db_conn == 'sqlite') {

            $sql = "strftime('%Y', DATE('now')) - strftime('%Y', birthdate) + ";		
            $sql.= "case ";
            $sql.= "  when(strftime('%m', DATE('now')) - strftime('%m', birthdate) ) < 0  then -1 ";
            $sql.= "  when (strftime('%m', DATE('now')) - strftime('%m', birthdate) ) = 0 then ";
            $sql.= "    case ";
            $sql.= "      when (strftime('%d', DATE('now')) - strftime('%d', birthdate) ) < 0 then -1 ";
            $sql.= "      else 0 ";
            $sql.= "    end ";
            $sql.= "  else 0 ";
            $sql.= "end  between ? and  ?";

        } else if ($db_conn == 'mysql') {

            $sql = "YEAR(CURDATE()) - YEAR (birthdate) + ";
            $sql.= "case ";
            $sql.= "  when ( MONTH(CURDATE()) - MONTH(birthdate) ) < 0 then -1 ";
            $sql.= "  when ( MONTH(CURDATE()) - MONTH(birthdate) ) = 0 then ";
            $sql.= "    case ";
            $sql.= "      when ( DAY(CURDATE()) - DAY(birthdate) ) < 0 then -1 ";
            $sql.= "      else 0 ";
            $sql.= "    end ";
            $sql.= "  else 0 ";
            $sql.= " end between ? and ?";
        }

        return $sql;
    }

    /**
     * Return part of SQL code for checking for presence of setted additional
     * parameter(s) [$parameters] for  $model.
     *
     * @param string $model         Model name with namespace
     * @param string $owner         Field in base table (usually 'id')
     * @param string $value_type    Type of additinal parameter value (boolean, string, number)
     * @param mixed $parameters     Additional parameter code. Can be an array or a string
     * @return string               SQL code
     */
    public static function filled_additional_params(string $model, string $owner, string $value_type, mixed $parameters): string
    {
        $db_conn = config('database.default');
        
        // If MySQL is used, then we need to escape '\' symbol in model name
        // e.g. 'App\Models\Household' => 'App\\Models\\Household'
        if ($db_conn == 'mysql') {
            $model = str_replace("\\", "\\\\", $model);           
        }  

        if (!is_array($parameters)) {
            $parameters = explode(',', $parameters);
        }
        $params = "'" . implode("','", $parameters) . "'"; 

        $sql  =" EXISTS ( ";
        $sql .= "SELECT 1 ";
        $sql .= "FROM additional_param_values apv ";
        $sql .= "INNER JOIN additional_params ap ON apv.param_id = ap.id ";
        $sql .= "INNER JOIN additional_param_categories apc ON apc.id = ap.category_id ";
        $sql .= "INNER JOIN additional_param_value_types apvt on apvt.id = ap.value_type_id ";
        $sql .= "WHERE apv.owner_id = $owner ";
        $sql .= "AND apc.code = '$model' ";
        $sql .= "AND apvt.code = '$value_type' ";
        $sql .= "AND ap.code IN (" . $params . ") ";
        $sql .= ")";

        return $sql;
    }
}