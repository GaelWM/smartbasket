<?php
include_once("_framework/_zori.list.cls.php");
/*
ALTER TABLE `tblShoppingList` drop FOREIGN KEY `tblShoppingList.strShoppingListCategory`;
ALTER TABLE `tblShoppingList` ADD CONSTRAINT `tblShoppingList.strShoppingListCategory` FOREIGN KEY (`refShoppingListCategoryID`) REFERENCES `tblShoppingListCategory` (`ShoppingListCategoryID`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `tblShoppingList` drop FOREIGN KEY `tblShoppingList.strStore`;
ALTER TABLE `tblShoppingList` ADD CONSTRAINT `tblShoppingList.strStore` FOREIGN KEY (`refStoreID`) REFERENCES `tblStore` (`StoreID`) ON UPDATE CASCADE ON DELETE CASCADE;
*/
class ShoppingList extends ZoriList
{
   private $ID = 0;

   public function __construct($DataKey)
   {
      $this->Filters[frSearch]->Type = "varchar";
      $this->Filters[frSearch]->VALUE = "";
      $this->Filters[frSearch]->html->placeholder = "ShoppingList ID, ShoppingList";
      $this->Filters[frSearch]->html->title = "Search on: ShoppingList ID, ShoppingList";

      $this->Filters[frStatus]->Type = "select";
      $this->Filters[frStatus]->VALUE = -1;
      $this->Filters[frStatus]->html->class = "form-control input-sm";
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
         $Where .= " AND (tblShoppingList.ShoppingListID $like OR tblShoppingList.strShoppingList $like OR tblStore.strStore $like)";
      }

      if($this->Filters[frStatus]->VALUE != -1)
      {
         $Where .= " AND tblShoppingList.blnActive = ". $this->Filters[frStatus]->html->value;
      }

      $this->ListSQL("
         SELECT tblShoppingList.ShoppingListID, tblShoppingList.strShoppingList AS 'Shopping List', tblShoppingList.intNumItems AS 'No of Items'
         , tblShoppingList.dtDateCreated AS 'Date Created', tblShoppingList.dblTotalCost AS 'Total Cost', tblShoppingList.blnActive AS Active
         , tblShoppingList.blnPurchased AS Purchased, tblShoppingList.strLastUser AS 'Last User', tblShoppingList.dtLastEdit AS 'Last Edit'
         FROM tblShoppingList 
         WHERE 1=1 $Where
         GROUP BY tblShoppingList.strShoppingList
         ORDER BY tblShoppingList.strShoppingList ASC",0);

      return $this->renderTable("ShoppingList List");
   }

   public static function Save(&$ShoppingListID)
   {
      global $xdb, $SystemSettings;
      $db = new ZoriDatabase("tblShoppingList", $ShoppingListID, null, 0);

      $db->SetValues($_POST);
      $db->Fields[strLastUser] = $_SESSION[USER]->USERNAME;

      $result = $db->Save();
      if($ShoppingListID == 0) $ShoppingListID = $db->ID[ShoppingListID];

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
            //$xdb->doQuery("DELETE FROM tblShoppingList WHERE ShoppingListID = ". $xdb->qs($key));
            $xdb->doQuery("UPDATE tblShoppingList SET blnActive = 0 WHERE ShoppingListID = ". $xdb->qs($key));
         }
         return "Records Deleted. ";
      }
   }
}
?>