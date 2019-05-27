<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] 	= 'LoginController';
$route['404_override'] 			= '';
$route['translate_uri_dashes'] 	= FALSE;

$route['admin/login']	  = "LoginController/login";
$route['admin/logout']	  = "LoginController/logout";
$route['admin/dashboard'] = "LoginController/dashboard";
$route['check/user/auth'] = "LoginController/userAuth";

// menu
$route['admin/create/menu']			  = "MenuController/createMenu";
$route['admin/insert/menu']			  = "MenuController/insertMenu";
$route['admin/edit/menu/(:num)']	  = "MenuController/editMenu/$1";
$route['admin/update/menu/(:num)']	  = "MenuController/updateMenu/$1";
$route['admin/delete/menu/(:num)']	  = "MenuController/deleteMenu/$1";
$route['admin/create/submenu']		  = "MenuController/createSubMenu";
$route['admin/insert/submenu']		  = "MenuController/insertSubMenu";
$route['admin/edit/submenu/(:num)']	  = "MenuController/editSubMenu/$1";
$route['admin/update/submenu/(:num)'] = "MenuController/updateSubMenu/$1";
$route['admin/delete/submenu/(:num)'] = "MenuController/deleteSubMenu/$1";
$route['admin/menu/permission']		  = "MenuController/getMenuPermission";

// user
$route['user/activity/?(:num)?']		= "UserController/getUserActivity";
$route['admin/user/type']				= "UserController/userType";
$route['admin/create/user/type']		= "UserController/createUserType";
$route['admin/insert/user/type']		= "UserController/insertUserType";
$route['admin/edit/user/type/(:num)']	= "UserController/editUserType/$1";
$route['admin/update/user/type/(:num)']	= "UserController/updateUserType/$1";
$route['admin/delete/user/type/(:num)']	= "UserController/deleteUserType/$1";
$route['admin/user']					= "UserController/user";
$route['admin/create/user']				= "UserController/createUser";
$route['admin/insert/user']				= "UserController/insertUser";
$route['admin/edit/user/(:num)']		= "UserController/editUser/$1";
$route['admin/update/user/(:num)']		= "UserController/updateUser/$1";
$route['admin/delete/user/(:num)']		= "UserController/deleteUser/$1";
$route['admin/user/permission']			= "UserController/getUserPermission";

// Sales
$route['send/sms/order/confirmation/(:num)']="SalesController/sendSMS/$1/confirmation";
$route['send/sms/before/delivery/(:num)']="SalesController/sendSMS/$1/before";
$route['send/sms/due/(:num)']="SalesController/sendSMS/$1/due";
$route['send/sms/clear/(:num)']="SalesController/sendSMS/$1/clear";
$route['sales/create/item']="SalesController/item";
$route['sales/insert/item']="SalesController/insertItem";
$route['sales/edit/item/(:num)']="SalesController/editItem/$1";
$route['sales/update/item/(:num)']="SalesController/updateItem/$1";
$route['sales/delete/item/(:num)']="SalesController/deleteItem/$1";
$route['sales/create/item/name']="SalesController/createItemName";
$route['sales/insert/item/name']="SalesController/insertItemName";
$route['sales/edit/item/name/(:num)']="SalesController/editItemName/$1";
$route['sales/update/item/name/(:num)']="SalesController/updateItemName/$1";
$route['sales/delete/item/name/(:num)']="SalesController/deleteItemName/$1";
$route['sales/item/create/group']="SalesController/item/group";
$route['sales/item/insert/group']="SalesController/insertItem/group";
$route['sales/item/edit/group/(:num)']="SalesController/editItemGroup/$1";
$route['sales/item/update/group/(:num)']="SalesController/updateItemGroup/$1";
$route['sales/item/delete/group/(:num)']="SalesController/deleteItemGroup/$1";
$route['sales/create/person']="SalesController/createSalesPerson";
$route['sales/insert/person']="SalesController/insertSalesPerson";
$route['sales/edit/person/(:num)']="SalesController/editSalesPerson/$1";
$route['sales/update/person/(:num)']="SalesController/updateSalesPerson/$1";
$route['sales/delete/person/(:num)']="SalesController/deleteSalesPerson/$1";
$route['sales/create/order-by']="SalesController/createOrderBy";
$route['sales/insert/order-by']="SalesController/insertOrderBy";
$route['sales/edit/order-by/(:num)']="SalesController/editOrderBy/$1";
$route['sales/update/order-by/(:num)']="SalesController/updateOrderBy/$1";
$route['sales/delete/order-by/(:num)']="SalesController/deleteOrderBy/$1";
$route['sales/create/delivery-by']="SalesController/createDeliveryBy";
$route['sales/insert/delivery-by']="SalesController/insertDeliveryBy";
$route['sales/edit/delivery-by/(:num)']="SalesController/editDeliveryBy/$1";
$route['sales/update/delivery-by/(:num)']="SalesController/updateDeliveryBy/$1";
$route['sales/delete/delivery-by/(:num)']="SalesController/deleteDeliveryBy/$1";
$route['sales/create/factory']="SalesController/createFactory";
$route['sales/insert/factory']="SalesController/insertFactory";
$route['sales/edit/factory/(:num)']="SalesController/editFactory/$1";
$route['sales/update/factory/(:num)']="SalesController/updateFactory/$1";
$route['sales/delete/factory/(:num)']="SalesController/deleteFactory/$1";
$route['sales/fetch/invoice/item/code']="SalesController/fetchInvoiceItemCode";
$route['sales/invoice/export']="SalesController/exportInvoice";
$route['admin/invoice']="SalesController/invoice";
$route['admin/invoice/list']="SalesController/invoice/list";
$route['admin/invoice/edit/(:num)']="SalesController/invoice/edit/$1";
$route['admin/invoice/delete']="SalesController/invoice/delete";
$route['admin/invoice/fetch/stock/status']="SalesController/fetchStockStatus";
$route['admin/reports/invoice/?(:num)?']="SalesController/getInvoiceReport";
$route['admin/invoice/graph/reports']="SalesController/getInvoiceGraphReport";
$route['admin/reports/invoice/edit/(:num)']="SalesController/ReportsPaymentEdit/$1";
$route['admin/invoice/summery/reports/current-month']="SalesController/getInvoiceSummeryReport/current";
$route['admin/invoice/summery/reports/prev-month/(:num)/(:num)']="SalesController/getInvoiceSummeryReport/prev/$1/$2";
$route['admin/invoice/summery/reports/next-month/(:num)/(:num)']="SalesController/getInvoiceSummeryReport/next/$1/$2";

// Payment
$route['admin/payment/type'] 			   = "PaymentController/paymentType";
$route['admin/payment/insert/type'] 	   = "PaymentController/insertPaymentType";
$route['admin/payment/edit/type/(:num)']   = "PaymentController/editPaymentType/$1";
$route['admin/payment/update/type/(:num)'] = "PaymentController/updatePaymentType/$1";
$route['admin/payment/delete/type/(:num)'] = "PaymentController/deletePaymentType/$1";
$route['admin/payment'] 				   = "PaymentController/getPayment";
$route['admin/payment/list'] 			   = "PaymentController/getPayment/list";
$route['admin/payment/edit/(:num)'] 	   = "PaymentController/getPayment/edit/$1";
$route['admin/payment/delete'] 			   = "PaymentController/getPayment/delete";
$route['admin/reports/payment/?(:num)?']   = "PaymentController/getPaymentReport";
$route['admin/payment/graph/reports'] 	   = "PaymentController/getPaymentGraphReport";
$route['admin/payment/summery/reports/current-month'] = "PaymentController/getPaymentSummeryReport/current";
$route['admin/payment/summery/reports/prev-month/(:num)/(:num)'] = "PaymentController/getPaymentSummeryReport/prev/$1/$2";
$route['admin/payment/summery/reports/next-month/(:num)/(:num)'] = "PaymentController/getPaymentSummeryReport/next/$1/$2";

// Service
$route['service/create'] 		= "ServiceController/createService";
$route['service/get/invoice/information'] = "ServiceController/getInvoiceInfo";
$route['service/insert'] 		= "ServiceController/insertService";
$route['service/edit/(:num)'] 	= "ServiceController/editService/$1";
$route['service/update/(:num)'] = "ServiceController/updateService/$1";
$route['service/delete/(:num)'] = "ServiceController/deleteService/$1";
$route['service/list'] 			= "ServiceController/getServiceList";

// Expanse
$route['admin/expanse']="ExpanseController/expanse";
$route['admin/expanse/insert']="ExpanseController/insertExpanse";
$route['admin/edit/expanse/(:num)']="ExpanseController/editExpanse/$1";
$route['admin/update/expanse/(:num)']="ExpanseController/updateExpanse/$1";
$route['admin/delete/expanse/(:num)']="ExpanseController/deleteExpanse/$1";
$route['admin/expanse/category']="ExpanseController/expanse/category";
$route['admin/expanse/insert/category']="ExpanseController/insertExpanse/category";
$route['admin/expanse/edit/category/(:num)']="ExpanseController/editExpanseCategory/$1";
$route['admin/expanse/update/category/(:num)']="ExpanseController/updateExpanseCategory/$1";
$route['admin/expanse/delete/category/(:num)']="ExpanseController/deleteExpanseCategory/$1";
$route['admin/expanse/list/?(:num)?']="ExpanseController/expanseList";
$route['admin/expanse/list/details/?(:num)?']="ExpanseController/getExpenseListDetails";
$route['admin/create/new/expanse']="ExpanseController/createNewExpanse";
$route['admin/new/expanse/insert']="ExpanseController/insertNewExpanse";
$route['admin/new/expanse/edit/(:num)']="ExpanseController/editNewExpanse/$1";
$route['admin/new/expanse/update/(:num)']="ExpanseController/updateNewExpanse/$1";
$route['admin/new/expanse/delete/(:num)']="ExpanseController/deleteNewExpanse/$1";
$route['admin/expanse/report']="ExpanseController/expanseReport";
$route['admin/expanse/report/details/expanse']="ExpanseController/expanseReportDetails/expanse";
$route['admin/expanse/report/details/purchase']="ExpanseController/expanseReportDetails/purchase";
$route['admin/expanse/report/details/worker']="ExpanseController/expanseReportDetails/worker";
$route['admin/expanse/report/current-month']="ExpanseController/expanseReport/current";
$route['admin/expanse/report/prev-month']="ExpanseController/expanseReport/prev";
$route['admin/expanse/report/next-month']="ExpanseController/expanseReport/next";
$route['admin/expanse/summery/report']="ExpanseController/expanseSummeryReport/new";
$route['admin/expanse/summery/report/filter']="ExpanseController/expanseSummeryReport/filter";

// Account
$route['account/create/reference']="AccountController/createReference";
$route['account/insert/reference']="AccountController/insertReference";
$route['account/edit/reference/(:num)']="AccountController/editReference/$1";
$route['account/update/reference/(:num)']="AccountController/updateReference/$1";
$route['account/delete/reference/(:num)']="AccountController/deleteReference/$1";
$route['account/cashinflow']="AccountController/cashInflow";
$route['account/create/cashinflow']="AccountController/createCashInflow";
$route['account/insert/cashinflow']="AccountController/insertCashInflow";
$route['account/edit/cashinflow/(:num)']="AccountController/editCashInflow/$1";
$route['account/update/cashinflow/(:num)']="AccountController/updateCashInflow/$1";
$route['account/delete/cashinflow/(:num)']="AccountController/deleteCashInflow/$1";
$route['admin/account']="AccountController/createAccount";
$route['admin/insert/account']="AccountController/insertAccount";
$route['admin/account/edit/(:num)']="AccountController/editAccount/$1";
$route['admin/account/update/(:num)']="AccountController/updateAccount/$1";
$route['admin/account/delete/(:num)']="AccountController/deleteAccount/$1";
$route['admin/account/balance/reports/view']="AccountController/getAccountBalanceReports/view";
$route['admin/account/balance/reports']="AccountController/getAccountBalanceReports/current";
$route['admin/account/current/balance']="AccountController/getAccountBalance";
$route['admin/account/day/close']="AccountController/accountDayClose";
$route['admin/insert/account/day/close']="AccountController/insertAccountDayClose";
$route['admin/account/adjustment']="AccountController/accountAdjustment";
$route['admin/account/adjustment/insert']="AccountController/insertAccountAdjustment";
$route['admin/account/adjustment/update/(:num)']="AccountController/updateAccountAdjustment/$1";
$route['admin/account/withdraw']="AccountController/accountWithdraw";
$route['admin/account/withdraw/insert']="AccountController/accountWithdraw/insert";
$route['account/transfer']="AccountController/getTransferAccount";
$route['account/transfer/insert']="AccountController/insertTransferAccount";
$route['account/transfer/report']="AccountController/transferReport";
$route['account/incoming/reports/current-month']="AccountController/accountIncomingReports/current";
$route['account/incoming/reports/prev-month']="AccountController/accountIncomingReports/prev";
$route['account/incoming/reports/next-month']="AccountController/accountIncomingReports/next";
$route['account/outgoing/reports/current-month']="AccountController/accountOutgoingReports/current";
$route['account/outgoing/reports/prev-month']="AccountController/accountOutgoingReports/prev";
$route['account/outgoing/reports/next-month']="AccountController/accountOutgoingReports/next";

// Purchase
$route['purchase/item']="PurchaseController/item";
$route['purchase/item/insert']="PurchaseController/insertItem";
$route['purchase/item/edit/(:num)']="PurchaseController/editItem/$1";
$route['purchase/item/update/(:num)']="PurchaseController/updateItem/$1";
$route['purchase/item/delete/(:num)']="PurchaseController/deleteItem/$1";
$route['purchase/create/item/name']="PurchaseController/createItemName";
$route['purchase/insert/item/name']="PurchaseController/insertItemName";
$route['purchase/edit/item/name/(:num)']="PurchaseController/editItemName/$1";
$route['purchase/update/item/name/(:num)']="PurchaseController/updateItemName/$1";
$route['purchase/delete/item/name/(:num)']="PurchaseController/deleteItemName/$1";
$route['purchase/item/group']="PurchaseController/item/group";
$route['purchase/item/group/insert']="PurchaseController/insertItem/group";
$route['purchase/item/group/edit/(:num)']="PurchaseController/editItemGroup/$1";
$route['purchase/item/group/update/(:num)']="PurchaseController/updateItemGroup/$1";
$route['purchase/item/group/delete/(:num)']="PurchaseController/deleteItemGroup/$1";
$route['purchase/supplier']="PurchaseController/supplier";
$route['purchase/supplier/report']="PurchaseController/supplierReport";
$route['purchase/supplier/get/report']="PurchaseController/getSupplierReport";
$route['purchase/supplier/type']="PurchaseController/supplier/new_supplier_type";
$route['purchase/supplier/insert']="PurchaseController/insertSupplier";
$route['purchase/supplier/edit/(:num)']="PurchaseController/editSupplier/$1";
$route['purchase/supplier/update/(:num)']="PurchaseController/updateSupplier/$1";
$route['purchase/supplier/delete/(:num)']="PurchaseController/deleteSupplier/$1";
$route['purchase/supplier/type/insert']="PurchaseController/insertSupplier/type";
$route['purchase/supplier/type/edit/(:num)']="PurchaseController/editSupplierType/$1";
$route['purchase/supplier/type/update/(:num)']="PurchaseController/updateSupplierType/$1";
$route['purchase/supplier/type/delete/(:num)']="PurchaseController/deleteSupplierType/$1";
$route['purchase/bill/?(:num)?']="PurchaseController/getBill";
$route['purchase/create/bill']="PurchaseController/createBill";
$route['purchase/insert/bill']="PurchaseController/insertBill";
$route['purchase/edit/bill/(:num)']="PurchaseController/editBill/$1";
$route['purchase/update/bill/(:num)']="PurchaseController/updateBill/$1";
$route['purchase/delete/bill/(:num)']="PurchaseController/deleteBill/$1";
$route['purchase/pay/bill/?(:num)?']="PurchaseController/getPayBill";
$route['purchase/pay/bill/balance']="PurchaseController/getPayBillBalance";
$route['purchase/pay/bill/supplier/balance']="PurchaseController/getPayBillSupplierBalance";
$route['purchase/create/pay/bill']="PurchaseController/createPayBill";
$route['purchase/insert/pay/bill']="PurchaseController/insertPayBill";
$route['purchase/edit/pay/bill/(:num)']="PurchaseController/editPayBill/$1";
$route['purchase/update/pay/bill/(:num)']="PurchaseController/updatePayBill/$1";
$route['purchase/delete/pay/bill/(:num)']="PurchaseController/deletePayBill/$1";
$route['fetch/purchase/item/code']="PurchaseController/fetchPurchaseItemCode";
$route['purchase/report']="PurchaseController/purchaseReport/new";
$route['purchase/report/filter']="PurchaseController/purchaseReport/filter";
$route['purchase/summery/report/current-month']="PurchaseController/purchaseSummeryReport/current";
$route['purchase/summery/report/prev-month']="PurchaseController/purchaseSummeryReport/prev";
$route['purchase/summery/report/next-month']="PurchaseController/purchaseSummeryReport/next";

// Worker Management
$route['worker/workers']="WorkerManagementController/showWorker";
$route['worker/insert/type']="WorkerManagementController/insertWorkerType";
$route['worker/create']="WorkerManagementController/createWorker";
$route['worker/insert']="WorkerManagementController/insertWorker";
$route['worker/edit/(:num)']="WorkerManagementController/editWorker/$1";
$route['worker/update/(:num)']="WorkerManagementController/updateWorker/$1";
$route['worker/delete/(:num)']="WorkerManagementController/deleteWorker/$1";
$route['worker/bill']="WorkerManagementController/getBill";
$route['worker/create/bill']="WorkerManagementController/createBill";
$route['worker/insert/bill']="WorkerManagementController/insertBill";
$route['worker/edit/bill/(:num)']="WorkerManagementController/editBill/$1";
$route['worker/update/bill/(:num)']="WorkerManagementController/updateBill/$1";
$route['worker/delete/bill/(:num)']="WorkerManagementController/deleteBill/$1";
$route['worker/pay/bill']="WorkerManagementController/getPayBill";
$route['worker/pay/bill/balance']="WorkerManagementController/workerPayBillBalance";
$route['worker/pay/bill/poid']="WorkerManagementController/workerPayBillPOID";
$route['worker/create/pay/bill']="WorkerManagementController/createPayBill";
$route['worker/insert/pay/bill']="WorkerManagementController/insertPayBill";
$route['worker/edit/pay/bill/(:num)']="WorkerManagementController/editPayBill/$1";
$route['worker/update/pay/bill/(:num)']="WorkerManagementController/updatePayBill/$1";
$route['worker/delete/pay/bill/(:num)']="WorkerManagementController/deletePayBill/$1";
$route['fetch/worker/bill/item/code']="WorkerManagementController/workerBillItemCode";
$route['worker/bill/report']="WorkerManagementController/getWorkerBillReport/new";
$route['worker/bill/report/filter']="WorkerManagementController/getWorkerBillReport/filter";
$route['worker/paybill/report']="WorkerManagementController/getWorkerPaybillReport/new";
$route['worker/paybill/report/filter']="WorkerManagementController/getWorkerPaybillReport/filter";
$route['worker/summery/report/current-month']="WorkerManagementController/getWorkerSummeryReport/current";
$route['worker/summery/report/prev-month']="WorkerManagementController/getWorkerSummeryReport/prev";
$route['worker/summery/report/next-month']="WorkerManagementController/getWorkerSummeryReport/next";

// Production
$route['production/activity']="ProductionController/activity";
$route['production/insert/activity']="ProductionController/insertActivity";
$route['production/edit/activity/(:num)']="ProductionController/editActivity/$1";
$route['production/update/activity/(:num)']="ProductionController/updateActivity/$1";
$route['production/delete/activity/(:num)']="ProductionController/deleteActivity/$1";
$route['production/item/activity']="ProductionController/itemActivity";
$route['production/create/item/activity']="ProductionController/createItemActivity";
$route['production/insert/item/activity']="ProductionController/insertItemActivity";
$route['production/edit/item/activity/(:num)']="ProductionController/editItemActivity/$1";
$route['production/update/item/activity/(:num)']="ProductionController/updateItemActivity/$1";
$route['production/delete/item/activity/(:num)']="ProductionController/deleteItemActivity/$1";
$route['production/process/?(:num)?']="ProductionController/productionProcess";
$route['production/create/new/process']="ProductionController/createProductionProcess/new_item";
$route['production/fetch/item/activity/process']="ProductionController/createProductionProcess/new";
$route['production/stock/fetch/item/activity/process/itemname']="ProductionController/fetchStockProductionProcessItemName";
$route['production/stock/fetch/item/activity/process/itemcode']="ProductionController/fetchStockProductionProcessItemCode";
$route['production/fetch/item/activity/process/itemname']="ProductionController/fetchProductionProcessItemName";
$route['production/fetch/item/activity/process/itemcode']="ProductionController/fetchProductionProcessItemCode";
$route['production/create/process']="ProductionController/createProductionProcess";
$route['production/insert/process']="ProductionController/insertProductionProcess";
$route['production/edit/process/(:num)']="ProductionController/editProductionProcess/$1";
$route['production/update/process/(:num)']="ProductionController/updateProductionProcess/$1";
$route['production/delete/process/(:num)']="ProductionController/deleteProductionProcess/$1";
$route['production/budget']="ProductionController/budget";
$route['production/get/existing/item/budget']="ProductionController/getExistingItemBudget";
$route['production/create/budget']="ProductionController/createBudget/new_item";
$route['production/fetch/create/budget']="ProductionController/createBudget/new";
$route['production/insert/budget']="ProductionController/insertBudget";
$route['production/edit/budget/(:num)']="ProductionController/editBudget/$1";
$route['production/update/budget/(:num)']="ProductionController/updateBudget/$1";
$route['production/delete/budget/(:num)']="ProductionController/deleteBudget/$1";
$route['production/cost']="ProductionController/cost";
$route['production/create/cost']="ProductionController/createCost/new_item";
$route['production/fetch/create/cost']="ProductionController/createCost/new";
$route['production/insert/cost']="ProductionController/insertCost";
$route['production/edit/cost/(:num)']="ProductionController/editCost/$1";
$route['production/update/cost/(:num)']="ProductionController/updateCost/$1";
$route['production/delete/cost/(:num)']="ProductionController/deleteCost/$1";

// Stock
$route['stock/create/adjustment'] = "StockController/createAdjustment";
$route['stock/insert/adjustment'] = "StockController/insertAdjustment";
$route['stock/report'] 			  = "StockController/report";

// Marketing
$route['marketing/send/sms/view'] 		 = "MarketingController/viewSendMarketingSMS";
$route['marketing/send/sms'] 	  		 = "MarketingController/sendMarketingSMS";
$route['marketing/list/sms'] 	  		 = "MarketingController/viewMarketingSMSList";
$route['marketing/send/single/sms/view'] = "MarketingController/viewSendSingleSMS";
$route['marketing/send/single/sms'] 	 = "MarketingController/sendSingleSMS";