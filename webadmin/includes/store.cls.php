<?php
include_once("_framework/_zori.list.cls.php");
/*
ALTER TABLE `tblStore` drop FOREIGN KEY `tblStore.strTitle`;
ALTER TABLE `tblStore` ADD CONSTRAINT `tblStore.strTitle` FOREIGN KEY (`refTitleID`) REFERENCES `tblTitle` (`TitleID`) ON UPDATE CASCADE ON DELETE CASCADE;
*/
class Store extends ZoriList
{
   private $ID = 0;

   public function __construct($DataKey)
   {
      $this->Filters[frSearch]->Type = "varchar";
      $this->Filters[frSearch]->VALUE = "";
      $this->Filters[frSearch]->html->placeholder = "Store ID, Store, Email";
      $this->Filters[frSearch]->html->title = "Search on: Store ID, Store, Email";

      $this->Filters[frStatus]->Type = "select";
      $this->Filters[frStatus]->VALUE = "";
      $this->Filters[frStatus]->Control->html->class = "form-control input-sm";
      $this->Filters[frStatus]->sql = "SELECT '' AS ControlValue, '- All -' AS ControlText
                           UNION ALL
                        SELECT 'Opened' AS ControlValue, 'Opened' AS ControlText
                           UNION ALL
                        SELECT 'Closed' AS ControlValue, 'Closed' AS ControlText
                           UNION ALL
                        SELECT 'In Maintenance' AS ControlValue, 'In Maintenance' AS ControlText
                        ORDER BY ControlText ASC";

      parent::__construct($DataKey);
   }

   public function getList()
   {
      if($this->Filters[frSearch]->VALUE != "")
      {
         $like = "LIKE(". $this->db->qs("%".$this->Filters[frSearch]->html->value."%") .")";
         $Where .= " AND (tblStore.StoreID $like OR tblStore.strStore $like OR tblStore.strEmail $like)";
      }

      if($this->Filters[frStatus]->VALUE != "")
      {
         $Where .= " AND tblStore.strStatus = ". $this->Filters[frStatus]->html->value;
      }

      $this->ListSQL("
         SELECT tblStore.StoreID, tblStore.strStore AS Store, tblStore.strStatus AS Status, tblStore.strCountry AS Country
         , tblStore.strCity AS City, tblStore.blnActive AS Active, tblStore.strLastUser AS 'Last User', tblStore.dtLastEdit AS 'Last Edit'
         FROM tblStore
         WHERE 1=1 $Where
         GROUP BY tblStore.strStore
         ORDER BY tblStore.strStore ASC",0);

      return $this->renderTable("Store List");
   }

   public static function Save(&$StoreID)
   {
      global $xdb, $SystemSettings;
      $db = new ZoriDatabase("tblStore", $StoreID, null, 0);

      $db->SetValues($_POST);
      $db->Fields[strLastUser] = $_SESSION[USER]->USERNAME;

      $result = $db->Save();
      if($StoreID == 0) $StoreID = $db->ID[StoreID];

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
            //$xdb->doQuery("DELETE FROM tblStore WHERE StoreID = ". $xdb->qs($key));
            $xdb->doQuery("UPDATE tblStore SET blnActive = 0 WHERE StoreID = ". $xdb->qs($key));
         }
         return "Records Deleted. ";
      }
   }
}
?>