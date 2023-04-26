<?php

if (!function_exists('my_domestic_travel_claim')) {
    function my_domestic_travel_claim($a, $b, $c)
    {

        $ci = &get_instance();
        $ci->db->select_sum('Amount', 'total_amount');
        $ci->db->select('status');
        $ci->db->from('jeol_travelexp_tbl');
        $ci->db->where('sheet_id', $a);
        $ci->db->where('sheet_type', $b);
        $ci->db->where('acc_code !=', $c);
        return $ci->db->get()->row_array();
    }
}
