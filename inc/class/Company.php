<?php

class Company extends Superobj
{

    //var $Crumbs_local;
    var $crumbs = array(
        "company_detail.php" => array(
            "公司簡介" => "company_list.php",
            "編輯簡介" => ""),
        "company_list.php" => array(
            "公司簡介" => "company_list.php",
            "簡介列表" => "")
    );
    protected $post_arr = array();
    protected $file_arr = array();
    protected $del_arr;
    protected $limit = 2; //上傳檔案大小
    protected $sort_where = " 1 ";
    protected $tbname = COMPANY;
    // var $sdir=NEWS_Image;
    var $back = './company_list.php';
    // var	$s_size=array("m"=>array("w"=>700,"h"=>6000),"s"=>array("w"=>150,"h"=>2000));
    var $is_image = false;
    var $list_this;
    var $is_sort = true;
    var $detail_this;
    var $this_Page = this_Page;
    var $detail_id; //編輯細節ID

    function __construct($debug = false)
    {
        $this->post_arr = (is_array($_POST)) ? $_POST : "";
        $this->file_arr = (is_array($_FILES)) ? $_FILES : "";
        $this->del_arr = (isset($_REQUEST['delid'])) ? $_REQUEST['delid'] : "";
        $this->detail_id = (is_numeric($_GET['id'])) ? $_GET['id'] : "";

        parent::__construct($debug);

        if (trim($this->tbname) != '')
            $this->set_field($this->tbname);
    }

    function get_all()
    {
        $this->list_this = "SELECT * FROM " . $this->tbname . " ORDER BY `sequ` ASC, `dates` DESC";
        return parent::get_list($this->list_this);
    }

    function get_front()
    {
        $this->list_this = "SELECT * FROM " . $this->tbname . " ORDER BY `sequ` ASC, `dates` DESC LIMIT 5";
        return parent::get_list($this->list_this);
    }

    function get_detail($pk)
    {
        $pk = (trim($pk) != '') ? $pk : $this->detail_id;

        if (trim($pk) != '')
            $this->detail_this = "SELECT * FROM " . $this->tbname . " WHERE " . $this->PK . "=" . $pk;

        return parent::get_list($this->detail_this, 1);
    }

    function renew()
    {
        parent::renew($this->post_arr, $this->file_arr, $this->sdir, $this->s_size);
    }

    function killu()
    {
        return parent::killu($this->del_arr, $this->is_image, $this->sdir);
    }

    function crumbs()
    {
        return parent::crumbs($this->this_Page);
    }

    function move_sequ()
    {
        if (($_GET['sequid']) != '' && $_GET['move'] != '')
        {
            $sequid = $_GET['sequid'];
            $move = $_GET['move'];
            parent::move_sequ($sequid, $move, $this->sort_where);
        }
    }

}
