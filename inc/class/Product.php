<?php

class Product extends Superobj {

    //var $Crumbs_local;
    var $crumbs = array("product_list.php" => array("商品管理" => "product_bcatalog.php"),
        "product_detail.php" => array("商品管理" => "product_bcatalog.php"),
        "product_detail_color.php" => array("商品管理" => "product_bcatalog.php")
    );
    protected $post_arr = array();
    protected $file_arr = array();
    protected $del_arr;
    protected $limit = 2; //上傳檔案大小
    protected $sort_where = "parent=0";
    protected $tbname = PRODUCT;
    protected $tbname_bc = BC;
    protected $tbname_image = PRODUCT_Image;
    var $myParent = 0;
    var $is_sort = false;
    var $sdir = PD_Image;
    var $back = './product_list.php?myParent=';
    var $s_size = array("m" => array("w" => 330, "h" => 330), "s" => array("w" => 140, "h" => 140), "ss" => array("w" => 600, "h" => 600));
    var $crumbs_front = array(); //前台麵包屑
    var $is_image = false;
    var $list_this;
    var $detail_this;
    var $layout;
    var $detail_id; //編輯細節ID
    var $this_Page = this_Page;
    var $resize;
    var $last_parent; //換分類之後，原先的父

    #############################################################################################

    function __construct($debug = false) {

        $this->post_arr = (is_array($_POST)) ? $_POST : "";
        $this->file_arr = (is_array($_FILES)) ? $_FILES : "";
        $this->del_arr = (isset($_REQUEST['delid_product'])) ? $_REQUEST['delid_product'] : "";
        $this->detail_id = (is_numeric($_GET['id'])) ? $_GET['id'] : "";
        //$this->last_parent	=	$_POST['last_parent'];
        $parent = (is_numeric($_REQUEST['myParent'])) ? $_REQUEST['myParent'] : $_REQUEST['parent'];

        $this->set_parent($parent);


        parent::__construct($debug);

        if (trim($this->tbname) != '')
            $this->set_field($this->tbname);
    }

    function set_parent($parent) {

        if (is_numeric($parent))
            $this->myParent = $parent;
    }

    function get_all($parent = "") {

        $parent = (trim($parent) == '') ? $this->myParent : $parent;

        if (is_numeric($_GET['sale']))
            $sale = " and a.sale='" . $_GET['sale'] . "'";

        //父類有父
        $this->list_this = "select a.*, cc.title as cctitle, cc.id as ccid, bc.title as bctitle, bc.id as bcid, d.image as image 
							from " . $this->tbname . " as a 
							left join " . $this->tbname_bc . " as cc on a.parent=cc.id 
							left join " . $this->tbname_bc . " as bc on cc.parent=bc.id 
							left join " . $this->tbname_image . " as d on d.parent = a.id and d.active =1 
							where a.parent=" . $parent . " " . $sale . " order by a.model asc";

        return parent::get_list($this->list_this);
    }

    function get_all_delete($parent = "") {

        $parent = (trim($parent) == '') ? $this->myParent : $parent;


        //父類有父
        $this->list_this = "select a.id
							from " . $this->tbname . " as a 
							where a.parent=" . $parent;

        return parent::get_list($this->list_this);
    }

    function get_all_menu($parent = "") {

        $parent = (trim($parent) == '') ? $this->myParent : $parent;

        $this->list_this = "select * from " . $this->tbname_bc . " where parent=" . $parent . " order by sequ asc";
        return parent::get_list($this->list_this);
    }

    function get_detail($pk) {

        $pk = (trim($pk) != '') ? $pk : $this->detail_id;

        if (trim($pk) != '')
            $this->detail_this = "select * from " . $this->tbname . " where " . $this->PK . "=" . $pk;

        $ret = parent::get_list($this->detail_this, 1);

        if ($this->detail_id != '')
            $this->set_parent($ret['parent']);



        return $ret;
    }

    function get_menu($parent = 0, $active = 0) {

        $active = (trim($active) != '' && $active != 0) ? $active : $this->myParent;
        $menu = self::get_all_menu($parent);
        foreach ($menu as $k => $v) {

            $class = null;

            if ($menu[$k]['parent'] == 0)
                $link = 'product_catalog';
            else
                $link = 'product_list';

            if ($menu[$k]['id'] == $active)
                $class = ' active';

            $this->layout.='<li><a href="' . $link . '.php?myParent=' . $menu[$k]['id'] . '" class="icon folder-s' . $class . '">' . $menu[$k]['title'] . '</a><ul class="sub-nav">';

            self::get_menu($menu[$k]['id'], $active);

            $this->layout.='</ul></li>';
        }

        return $this->layout;
    }

    function bc_crumbs($parent = '') { //子分類麵包屑
        $parent = (trim($parent) != '') ? $parent : $this->myParent;

        $menu = $this->join_list_crumbs($parent);

        $this->crumbs['product_list.php'][$menu['bctitle']] = 'product_catalog.php?myParent=' . $menu['bcid'];
        $this->crumbs['product_list.php'][$menu['title']] = '';

        if (trim($menu['bctitle']) != '') {
            $this->crumbs['product_detail.php'][$menu['bctitle']] = 'product_catalog.php?myParent=' . $menu['bcid'];
            $this->crumbs['product_detail.php'][$menu['title']] = 'product_list.php?myParent=' . $menu['id'];
        } elseif ($menu['title'] != '') {
            $this->crumbs['product_detail.php'][$menu['title']] = 'product_catalog.php?myParent=' . $menu['id'];
        }

        $this->crumbs['product_detail.php']['編輯商品'] = '';

        return parent::crumbs($this->this_Page);
    }

    function crumbs() {

        return parent::crumbs($this->this_Page);
    }

    function join_list_crumbs($parent) { //商品麵包屑	查詢父類是否有父
        $this->join_list_crumbs = "select a.*,b.title as bctitle, b.id as bcid from " . $this->tbname_bc . " as a left join " . $this->tbname_bc . " as b on a.parent = b.id where a.id =" . $parent . "  order by a.sequ asc";

        return parent::get_list($this->join_list_crumbs, 1);
    }

    function join_list() { //子分類顯示用
        if (is_numeric($_GET['sale']))
            $sale = " and a.sale='" . $_GET['sale'] . "'";

        $this->join_list = "select a.*,b.title as bctitle from " . $this->tbname_bc . " as a left join " . $this->tbname_bc . " as b on a.parent = b.id where a.parent =" . $this->myParent . " " . $sale . " order by a.sequ asc";

        return parent::get_list($this->join_list);
    }

    ########################################################################################

    function get_all_front($parent = "") {

        $parent = (trim($parent) == '') ? $this->myParent : $parent;


        //父類有父
        $this->list_this = "select a.*, cc.title as cctitle, cc.id as ccid, bc.title as bctitle, bc.id as bcid, d.image as image 
							from " . $this->tbname . " as a 
							left join " . $this->tbname_bc . " as cc on a.parent=cc.id 
							left join " . $this->tbname_bc . " as bc on cc.parent=bc.id 
							left join " . $this->tbname_image . " as d on d.parent = a.id and d.active =1 
							where a.parent=" . $parent . " and a.sale='1' order by a.model asc";

        return parent::get_list($this->list_this);
    }

    function get_search_front($qry = '') {

        $parent = (trim($parent) == '') ? $this->myParent : $parent;

        $qry = urldecode($_GET['q']);

        if ($qry != '')
            $wheres = " and (a.title like '%" . $qry . "%' or a.model like '%" . $qry . "%' or a.content like '%" . $qry . "%')";

        //父類有父
        $this->list_this = "select a.*, cc.title as cctitle, cc.id as ccid, bc.title as bctitle, bc.id as bcid, d.image as image 
							from " . $this->tbname . " as a 
							left join " . $this->tbname_bc . " as cc on a.parent=cc.id 
							left join " . $this->tbname_bc . " as bc on cc.parent=bc.id 
							left join " . $this->tbname_image . " as d on d.parent = a.id and d.active =1 
							where a.sale='1' " . $wheres . " order by a.dates desc";

        return parent::get_list($this->list_this);
    }

    function get_detail_front($pk) {

        $pk = (trim($pk) != '') ? $pk : $this->detail_id;

        if (trim($pk) != '') {
            $this->detail_this = "select a.* , d.image as image 
								from " . $this->tbname . " as a 
								left join " . $this->tbname_image . " as d on d.parent = a.id and d.active =1 
								where a.sale='1' and a." . $this->PK . "=" . $pk;
        }

        $ret = parent::get_list($this->detail_this, 1);

        if ($this->detail_id != '')
            $this->set_parent($ret['parent']);



        return $ret;
    }

    function get_detail_inq($pk) {

        $pk = (trim($pk) != '') ? $pk : $this->detail_id;

        if (trim($pk) != '') {
            $this->detail_this = "select a.content,a.title,a.model , d.image as image 
								from " . $this->tbname . " as a 
								left join " . $this->tbname_image . " as d on d.parent = a.id and d.active =1 
								where a.sale='1' and a." . $this->PK . "=" . $pk;
        }

        $ret = parent::get_list($this->detail_this, 1);

        return $ret;
    }

    function get_all_menu_front($parent = "") {

        $parent = (trim($parent) == '') ? $this->myParent : $parent;

        $this->list_this = "select * from " . $this->tbname_bc . " where parent=" . $parent . " and sale='1' order by sequ asc";
        return parent::get_list($this->list_this);
    }

    function crumbs_front($parent) { //商品麵包屑	查詢父類是否有父
        $parent = (trim($parent) == '') ? $this->myParent : $parent;

        $sql = "select id,title,parent from " . $this->tbname_bc . " where id=" . $parent . " and sale='1'";
        $ret = parent::get_list($sql, 1);

        $this->crumbs_front[$ret['title']] = $ret['parent'];

        if ($ret['parent'] != '0')
            self::crumbs_front($ret['parent']);
        else
            $this->crumbs_front[$ret['title']] = $ret['id'];

        return array_reverse($this->crumbs_front);
    }

    function get_menu_front($parent = 0, $active = 0) {

        $active = (trim($active) != '' && $active != 0) ? $active : $this->myParent;
        $menu = self::get_all_menu_front($parent);
        foreach ($menu as $k => $v) {

            $class = null;

            if ($menu[$k]['parent'] == 0)
                $link = 'bcatalog';
            else
                $link = 'scatalog';

            if ($menu[$k]['id'] == $active)
                $class = 'class= "active"';

            $child = self::get_all_menu_front($menu[$k]['id']);

            $this->layout.='<li><a href="' . $link . '.php?myParent=' . $menu[$k]['id'] . '" ' . $class . '>' . $menu[$k]['title'] . '</a>';

            if (count($child) > 0)//有子類則ul
                $this->layout.='<ul class="catalog-sub-list">';

            self::get_menu_front($menu[$k]['id'], $active);

            if (count($child) > 0)//有子類則ul
                $this->layout.='</ul>';

            $this->layout.='</li>';
        }

        return $this->layout;
    }

    ##########################################################################

    function renew() {

        /* $_parent=$this->join_list_crumbs($this->myParent);
          if($_parent['parent']!='0') //父為子分類
          $this->back	=	$this->back.$_parent['id'];
          else
          $this->back	=	"./product_catalog.php?myParent=".$this->myParent;
         */



        parent::renew($this->post_arr, $this->file_arr, $this->sdir, $this->resize);

        if (trim($this->post_arr['id']) == '')
            $nid = mysql_insert_id();
        else
            $nid = $this->post_arr['id'];

        $this->back = "./product_detail.php?id=" . $nid;
    }

    function move_sequ() {


        if (($_GET['sequid']) != '' && $_GET['move'] != '') {
            $sequid = $_GET['sequid'];
            $move = $_GET['move'];
            parent::move_sequ($sequid, $move, $this->sort_where);
        }
    }

    function resort() {

        parent::resort($this->sort_where);
    }

    function killu() {

        $this->back .= $this->myParent;
        parent::killu($this->del_arr, $this->is_image, $this->sdir);

        //刪除此商品相關資料
        foreach ($this->del_arr as $k => $v) {

            //echo $k.'<br>';

            $killall = new Product_image;
            $killall->killall($k);

            $killall = new Product_spec;
            $killall->killall($k);

            $killall = new Product_package;
            $killall->killall($k);

            $killall = new Product_color;
            $killall->killall($k);

            unset($killall);
        }
    }

    function sale() {

        $this->back .= $this->myParent;
        foreach ($this->del_arr as $k => $v) {
            $sql = "update " . $this->tbname . " set sale='" . $this->post_arr['sale'] . "' where " . $this->PK . "=" . $k;
            //echo $sql;
            if (!$this->qry($sql)) {
                $this->alert = "刪除失敗";
                break;
            }
        }
    }

    function pd_copy() {
        if (!(is_numeric($_GET['id']) && $_GET['id'] > 0))
            $this->alert = "刪除失敗";
        else {

            $ret = self::get_detail($_GET['id']);
            $this->sor_id = $ret[$this->PK];
            foreach ($ret as $k => $v)
                $this->post_arr[$k] = $v;

            $this->post_arr['sale'] = 0;
            unset($this->post_arr[$this->PK], $this->post_arr['dates']); #刪除主KEY

            $this->renew();
            $this->new_id = mysql_insert_id();
            if ($this->is_sort)
                $this->resort();

            ##################################

            $c = new Catalog;
            $ret = $c->get_detail($this->post_arr['parent']);
            $this->back = ($ret['parent'] == 0) ? './product_catalog' : './product_list';
            $this->back.='.php?myParent=' . $this->post_arr['parent'];



            ####################################
            $color = new Product_color;
            $ret = $color->get_all($this->sor_id);

            foreach ($ret as $v) {
                foreach ($v as $k => $v2)
                    $color->post_arr[$k] = $v2;

                $color->post_arr['parent'] = $this->new_id;
                unset($color->post_arr[$this->PK]);
                $color->renew();
                unset($color->post_arr);
            }
            unset($color, $ret);
            #######################################

            $image = new Product_image;
            self::copy_image($image);
            unset($image, $ret);
            ##########################################

            $package = new Product_package;
            self::copy_image($package);
            unset($package);
			
			##########################################

            $spec = new Product_spec;
            self::copy_image($spec);
            unset($spec);
        }
        return;
    }

    function copy_image($oo) {

        $ret = $oo->get_all($this->sor_id);
        $prefix = explode("_", $this->tbname);
        foreach ($ret as $v) {
            foreach ($v as $k => $v2)
                $oo->post_arr[$k] = $v2;

            sleep(1);
            $sExtension = Extension($oo->post_arr['image']);
            $sFileName = $prefix[1] . '_' . date("U") . $sExtension;

            if (copy($oo->sdir . $oo->post_arr['image'], $oo->sdir . $sFileName)) {

                @copy($oo->sdir . 's_' . $oo->post_arr['image'], $oo->sdir . 's_' . $sFileName);
                @copy($oo->sdir . 'ss_' . $oo->post_arr['image'], $oo->sdir . 'ss_' . $sFileName);

                $oo->post_arr['image'] = $sFileName;
                $oo->post_arr['parent'] = $this->new_id;
                unset($oo->post_arr[$this->PK]);
                $oo->renew();
                unset($oo->post_arr);
            }
        }
        unset($oo, $ret);
    }

}