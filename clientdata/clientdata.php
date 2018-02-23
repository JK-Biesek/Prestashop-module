<?php

if (!defined('_PS_VERSION_'))
  exit;

  class clientdata extends Module{

  public function __construct(){
    $this->name = 'clientdata';
    $this->tab = 'administration';
    $this->version = '1.0.0';
    $this->author = 'Jakub Biesek';
    $this->need_instance = 0;
    $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    $this->bootstrap = true;


    parent::__construct();

    $this->displayName = $this->l('clientdata');
    $this->description = $this->l('This module display information about customer date of birth and first purchase.');

    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
   }

  public function install(){

     if (!parent::install() ||
     !$this->registerHook('displayHome')||
     !$this->registerHook('displayAdminOrder')
       )
         return false;
    return true;
    }

  public function uninstall(){
      if (!parent::uninstall())
              return false;
           return true;
    }



  public function getContent(){
      $output = null;
      $output.='</br>'.$this->info_page();

      return $output;
     }



  public function hookdisplayAdminOrder($params) {

      $id_order = Tools::getValue('id_order'); // get id_order
      $order = new Order($id_order);
      $id_customer = $order->id_customer; //get customer id
      $customer = new Customer($id_customer);
      $orders = Order::getCustomerOrders($id_customer);
      $customerStats = $customer->getStats();
      $total_paid = $customerStats['total_orders'];
      $total_paid = number_format((float)$total_paid, 2, '.', '');

      $sql_guest = 'SELECT id_guest from '._DB_PREFIX_.'guest ';
      $sql_guest .= ' WHERE id_customer = '.(int)$id_customer;
      $run = Db::getInstance()->getValue($sql_guest);
      if($run){
        $id_guest = $run;
        $sql_visit = 'SELECT date_add from '._DB_PREFIX_.'connections ';
        $sql_visit .= 'WHERE id_guest = '.$id_guest;
        $row = Db::getInstance()->getRow($sql_visit);
        if($row){
          foreach ($row as $date => $connected) {
          $last_visit = $connected;
          }
        }
      }
  	   $this->context->smarty->assign(array(
        'customer' =>$customer,
        'order_number' =>count($orders),
        'paid' =>$total_paid,
        'connect'=>$last_visit,
        ));

          return $this->display(__FILE__, 'customer_details.tpl', $this->getCacheId('customer_details'));
  	  }

  public function hookdisplayHome(){
         $logged_customer = $this->context->customer->logged;

         if($logged_customer){
          $id_customer = $this->context->customer->id;
         }else {
           return false;
         }

         $customer = new Customer($id_customer);
    	   $this->context->smarty->assign(array(
            'customer' =>$customer
                ));

           return $this->display(__FILE__, 'displayHome.tpl', $this->getCacheId('displayHome'));
      }


  public function info_page(){
		return $this->display(__FILE__, 'info.tpl', $this->getCacheId('info'));
	  }
}
