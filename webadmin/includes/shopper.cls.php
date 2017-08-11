<?php
include_once("_framework/_zori.list.cls.php");
/*
ALTER TABLE `tblShopper` drop FOREIGN KEY `tblShopper.strTitle`;
ALTER TABLE `tblShopper` ADD CONSTRAINT `tblShopper.strTitle` FOREIGN KEY (`refTitleID`) REFERENCES `tblTitle` (`TitleID`) ON UPDATE CASCADE ON DELETE CASCADE;
*/
class Shopper extends ZoriList
{
   private $ID = 0;

   public function __construct($DataKey)
   {
      $this->Filters[frSearch]->Type = "varchar";
      $this->Filters[frSearch]->VALUE = "";
      $this->Filters[frSearch]->html->placeholder = "Shopper ID, Shopper, Email";
      $this->Filters[frSearch]->html->title = "Search on: Shopper ID, Shopper, Email";

      $this->Filters[frStatus]->Type = "select";
      $this->Filters[frStatus]->VALUE = -1;
      $this->Filters[frStatus]->Control->html->class = "form-control input-sm";
      $this->Filters[frStatus]->sql = "SELECT -1 AS ControlValue, '- All -' AS ControlText
                           UNION ALL
                        SELECT 1 AS ControlValue, 'Active' AS ControlText
                           UNION ALL
                        SELECT 0 AS ControlValue, 'Inactive' AS ControlText
                        ORDER BY ControlText ASC";

      parent::__construct($DataKey);
   }

   public function getList()
   {
      if($this->Filters[frSearch]->VALUE != "")
      {
         $like = "LIKE(". $this->db->qs("%".$this->Filters[frSearch]->html->value."%") .")";
         $Where .= " AND (tblShopper.ShopperID $like OR tblShopper.strShopper $like OR tblShopper.strEmail $like)";
      }

      if($this->Filters[frStatus]->VALUE != -1)
      {
         $Where .= " AND tblShopper.blnActive = ". $this->Filters[frStatus]->html->value;
      }

      $this->ListSQL("
         SELECT tblShopper.ShopperID, tblShopper.strShopper AS Shopper, tblShopper.strName AS Name
         , tblShopper.strSurname AS Surname, tblShopper.strEmail AS Email, tblShopper.strTel AS Tel
         , tblShopper.strCell AS Cell, tblShopper.txtAddress AS Address, tblShopper.txtNotes AS Notes, tblShopper.dtDateRegistered AS 'Date Registered', tblShopper.blnActive AS Active
         , tblShopper.strLastUser AS 'Last User', tblShopper.dtLastEdit AS 'Last Edit'
         FROM tblShopper
         WHERE 1=1 $Where
         GROUP BY tblShopper.strShopper
         ORDER BY tblShopper.strShopper",0);

      return $this->renderTable("Shopper List");
   }

   public static function Save(&$ShopperID)
   {
      global $xdb, $SystemSettings;
      $db = new ZoriDatabase("tblShopper", $ShopperID, null, 0);

      print_rr($_POST);die("iugyiu");

      $db->SetValues($_POST);
      ## Save shopper profile pic.
      // if($_FILES['Profile:PicturePath']['name'] != "" && $ShopperID != 0)
      // {//current: cel_a/wa/_ need to go to cel_a/training/profilepictures/
      //    chmod($_FILES['Profile:PicturePath']['tmp_name'] , 0777);
      //    $strFileName = str_pad($ShopperID, 5,"0", STR_PAD_LEFT) ."_". $_FILES["Profile:PicturePath"]["name"];

      //    $strPath = $SystemSettings[ProfileImageDirAdmin]; //$strPath = "../../profliepictures/";
      //    //print_rr($strPath);

      //    $db->Fields["Profile:PicturePath"] = $strFileName;

      //    move_uploaded_file($_FILES['Profile:PicturePath']['tmp_name'], $strPath . $strFileName);

      // }

      $db->Fields[strPassword] = md5($_POST[strPassword]);
      $db->Fields[strLastUser] = $_SESSION[USER]->USERNAME;
      print_rr($db->Fields);die("dfuihu");

      $result = $db->Save();
      if($ShopperID == 0) $ShopperID = $db->ID[ShopperID];

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
      //print_rr($chkSelect);
      if(count($chkSelect) > 0){
         foreach($chkSelect as $key => $value)
         {
            //$xdb->doQuery("DELETE FROM tblShopper WHERE ShopperID = ". $xdb->qs($key));
            $xdb->doQuery("UPDATE tblShopper SET blnActive = 0 WHERE ShopperID = ". $xdb->qs($key));
         }
         return "Records Deleted. ";
      }
   }
}
?>