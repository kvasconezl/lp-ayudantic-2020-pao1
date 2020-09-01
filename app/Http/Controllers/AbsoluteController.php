<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AbsoluteController extends Controller{

	function __construct(){
		parent::__construct();
	}

	/**
     * @param array $data
     * @return array
     */
    public function unwrapArray(array $data) {
        $tmp = array_reverse($data);
        $data = array_pop($tmp);
        return $data;
    }

    /**
     * @param array $data
     * @return array
     */
    public function unwrapObject(array $data) {
        $data = array_pop($data)[0];
        return $data;
    }
}
