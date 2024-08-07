<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Nestedsetbie
{
    protected $params;
    protected $checked;
    protected $data;
    protected $count;
    protected $count_level;
    protected $lft;
    protected $rgt;
    protected $level;

    public function __construct($params = null)
    {
        $this->params = $params;
        $this->checked = null;
        $this->data = null;
        $this->count = 0;
        $this->count_level = 0;
        $this->lft = null;
        $this->rgt = null;
        $this->level = null;
    }

    public function get()
    {
        try {
            $foreignkey = $this->params['foreignkey'] ?? 'post_catalogue_id';
            $moduleExtract = explode('.', $this->params['table']);
            $result = DB::table($this->params['table'] . ' as tb1')
                ->select('tb1.id', 'tb2.name', 'tb1.parentid', 'tb1.lft', 'tb1.rgt', 'tb1.level', 'tb1.order')
                ->join($moduleExtract[0] . '_catalogue_language as tb2', 'tb1.id', '=', 'tb2.' . $foreignkey)
                ->where('tb2.language_id','=', $this->params['language_id'])->whereNull('tb1.delete_at')
                ->orderBy('tb1.lft', 'asc')
                ->get()
                ->toArray();
            
            $this->data = $result;
            // dd($this->data);
        } catch (\Exception $e) {
            // Handle the exception
        }
    }

    public function set()
    {
        if (isset($this->data) && is_array($this->data)) {
            $arr = [];
            foreach ($this->data as $val) {
                $arr[$val->id][$val->parent_id] = 1;
                $arr[$val->parent_id][$val->id] = 1;
            }
            return $arr;
        }
        return null;
    }

    public function recursive($start = 0, $arr = null)
    {
        $this->lft[$start] = ++$this->count;
        $this->level[$start] = $this->count_level;
        if (isset($arr) && is_array($arr)) {
            foreach ($arr as $key => $val) {
                if ((isset($arr[$start][$key]) || isset($arr[$key][$start])) && (!isset($this->checked[$key][$start]) && !isset($this->checked[$start][$key]))) {
                    $this->count_level++;
                    $this->checked[$start][$key] = 1;
                    $this->checked[$key][$start] = 1;
                    $this->recursive($key, $arr);
                    $this->count_level--;
                }
            }
        }
        $this->rgt[$start] = ++$this->count;
    }

    public function action()
    {
        if (isset($this->level, $this->lft, $this->rgt) && is_array($this->level) && is_array($this->lft) && is_array($this->rgt)) {
            $data = [];
            foreach ($this->level as $key => $val) {
                if ($key == 8) continue;

                $data[] = [
                    'id' => $key,
                    'level' => $val,
                    'lft' => $this->lft[$key],
                    'rgt' => $this->rgt[$key],
                    'user_id' => Auth::id(),
                ];

            }

            if (!empty($data)) {
                DB::table($this->params['table'])->upsert($data, 'id', ['level', 'lft', 'rgt']);
            }
        }
    }

    public function dropdown($param = null)
    {
        $this->get();
        if (isset($this->data) && is_array($this->data)) {
            $temp = [];
            $temp[0] = $param['text'] ?? 'Root';
            foreach ($this->data as $val) {
                $temp[$val->id] = str_repeat('-', max(0, $val->level - 1)) . $val->name;
            }
            return $temp;
        }
        return null;
    }
}
