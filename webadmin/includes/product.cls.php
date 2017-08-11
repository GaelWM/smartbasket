<?php
include_once("_framework/_zori.list.cls.php");
/*
ALTER TABLE `tblProduct` drop FOREIGN KEY `tblProduct.strProductCategory`;
ALTER TABLE `tblProduct` ADD CONSTRAINT `tblProduct.strProductCategory` FOREIGN KEY (`refProductCategoryID`) REFERENCES `tblProductCategory` (`ProductCategoryID`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `tblProduct` drop FOREIGN KEY `tblProduct.strStore`;
ALTER TABLE `tblProduct` ADD CONSTRAINT `tblProduct.strStore` FOREIGN KEY (`refStoreID`) REFERENCES `tblStore` (`StoreID`) ON UPDATE CASCADE ON DELETE CASCADE;
*/
class Product extends ZoriList
{
   private $ID = 0;

   public function __construct($DataKey)
   {
      $this->Filters[frSearch]->Type = "varchar";
      $this->Filters[frSearch]->VALUE = "";
      $this->Filters[frSearch]->html->placeholder = "Product ID, Product, Store";
      $this->Filters[frSearch]->html->title = "Search on: Product ID, Product, Store";

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
         $Where .= " AND (tblProduct.ProductID $like OR tblProduct.strProduct $like OR tblStore.strStore $like)";
      }

      if($this->Filters[frStatus]->VALUE != -1)
      {
         $Where .= " AND tblProduct.blnActive = ". $this->Filters[frStatus]->html->value;
      }

      $this->ListSQL("
         SELECT tblProduct.ProductID, tblProduct.strProduct AS Product, tblStore.strStore AS Store
         , tblProductCategory.strProductCategory AS 'Product Category', tblProduct.strProductCode AS 'Product Code', tblProduct.strStatus AS Status
         , tblProduct.dblCost AS 'Product Cost', tblProduct.blnActive AS Active, tblProduct.strLastUser AS 'Last User'
         , tblProduct.dtLastEdit AS 'Last Edit'
         FROM tblProduct 
         INNER JOIN tblProductCategory ON tblProductCategory.ProductCategoryID = tblProduct.refProductCategoryID 
         INNER JOIN tblStore ON tblStore.StoreID = tblProduct.refStoreID
         WHERE 1=1 $Where
         GROUP BY tblProduct.strProduct
         ORDER BY tblProduct.strProduct ASC",0);

      return $this->renderTable("Product List");
   }

   public static function Save(&$ProductID)
   {
      global $xdb, $SystemSettings;
      $db = new ZoriDatabase("tblProduct", $ProductID, null, 0);

      $db->SetValues($_POST);
      $db->Fields[strLastUser] = $_SESSION[USER]->USERNAME;

      $result = $db->Save();
      if($ProductID == 0) $ProductID = $db->ID[ProductID];

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
            //$xdb->doQuery("DELETE FROM tblProduct WHERE ProductID = ". $xdb->qs($key));
            $xdb->doQuery("UPDATE tblProduct SET blnActive = 0 WHERE ProductID = ". $xdb->qs($key));
         }
         return "Records Deleted. ";
      }
   }
}
?>