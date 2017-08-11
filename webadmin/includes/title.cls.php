<?php
include_once("_framework/_zori.list.cls.php");

class Title extends ZoriList
{
   private $ID = 0;

   public function __construct($DataKey)
   {
      $this->Filters[frSearch]->Type = "varchar";
      $this->Filters[frSearch]->VALUE = "";
      $this->Filters[frSearch]->html->class = "form-control input-sm";
      $this->Filters[frSearch]->html->title = "Search on:Title ID, Title";
      $this->Filters[frSearch]->html->placeholder = "Title ID, Title";

      parent::__construct($DataKey);
   }

   public function getList()
   {
      if($this->Filters[frSearch]->html->value != "")
      {
         $like = "LIKE(". $this->db->qs("%".$this->Filters[frSearch]->html->value."%") .")";
         $Where .= " AND (TitleID $like OR strTitle $like OR strLanguage $like )";
      }

      $this->ListSQL("SELECT TitleID, strTitle AS 'Title', strLanguage AS 'Language', blnActive AS 'Active'
         , strLastUser AS 'Last User', dtLastEdit AS 'Last Edit'
         FROM tblTitle 
         WHERE 1=1 $Where
         ORDER BY tblTitle.strTitle DESC",0);

      return $this->renderTable("Title List");
   }

   public static function Save(&$TitleID)
   {
      global $xdb, $SystemSettings;
      $db = new ZoriDatabase("tblTitle", $TitleID, null, 0);

      $db->SetValues($_POST);
      $db->Fields[strLastUser] = $_SESSION['USER']->USERNAME;
      //print_rr($db->Fields);die("dfuihu");

      $result = $db->Save();
      if($UserID == 0) $UserID = $db->ID[UserID];

      //print_rr($result);
      if($result->Error == 1){
         return $result->Message;
      }else{
         return "Details Saved.";
      }
   }


   
   public static function Delete($chkSelect)
   {
      global $xdb;

      if(count($chkSelect) > 0){
      foreach($chkSelect as $key => $value)
      {
         $xdb->doQuery("DELETE FROM tblTitle WHERE TitleID = ". $xdb->qs($key));
      }
         return "Records Deleted. ";
      }
   }
}
?>