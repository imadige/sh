<div class="hAMenu">
                	
                    <div class="title"><?=Yii::t('trans','ARA')?></div>
                    
                    <div class="item curnone clearfix">
                    	<div class="Xq clearfix">
                    		 <a href="javascript:;"><img src="<?=Yii::app()->baseUrl?>/images/icon/search.png" />	</a>
                             <span class="text left" ><?=CHtml::textField("searchSA",'', array('class'=>'searchSA'))?></span>
                     	 </div>
                    </div>
                    
                	<div class="title"><?=Yii::t('trans','ÖĞELERİM')?></div>
                    
                    <div class="item clearfix">
                     <a href="<?=Yii::app()->createUrl("customers/admin")?>">
                    	<div class="Xq clearfix">
                    		 <img src="<?=Yii::app()->baseUrl?>/images/icon/approve_user.png"/>		                     		<span class="text"><?=Yii::t('trans','Müşteriler')?></span>
                     	 </div>
                     </a>
                    </div>
                    
                    <div class="item clearfix">
                    <a href="<?=Yii::app()->createUrl("fcustomers/admin")?>">
                    	<div class="Xq clearfix">
                       	 <img src="<?=Yii::app()->baseUrl?>/images/icon/star.png"/>	
                   			<span class="text"><?=Yii::t('trans','Fırsatlar')?></span>
                    	</div>
                    </a>
                    </div>
                    
                    <div class="item clearfix">
                        <div class="xTab Xq marL clearfix">
                            <img src="<?=Yii::app()->baseUrl?>/images/icon/shopping_cart.png"/>	
                             <span class="text"><?=Yii::t('trans','Ürün')?></span>
                         </div>
                         
                         <div class="altF">
                         
                          
                             <a href="<?=Yii::app()->createUrl("products/admin")?>">
                                 <div class="Xf marL clearfix">
                                  <span class="text"><?=Yii::t('trans','Ürünleri Yönet')?></span>
                                 </div>
                             </a>
                             
                             <a href="<?=Yii::app()->createUrl("products/create")?>">
                                 <div class="Xf marL clearfix">
                                  <span class="text"><?=Yii::t('trans','Ürün Ekle')?></span>
                                 </div>
                             </a>
                             
                           
                             
                             <a href="<?=Yii::app()->createUrl("products/excelreader")?>">
                                 <div class="Xf marL clearfix">
                                  <span class="text"><?=Yii::t('trans','EXCEL Toplu Ürün Ekle')?></span>
                                 </div>
                             </a>
                             
                             <a href="<?=Yii::app()->createUrl("products/xmlreader")?>">
                                 <div class="Xf marL clearfix">
                                  <span class="text"><?=Yii::t('trans','XML Toplu Ürün Ekle')?></span>
                                 </div>
                             </a>
                             
                             
                             <a href="<?=Yii::app()->createUrl("productgroups")?>">
                                 <div class="Xf marL clearfix">
                                  <span class="text"><?=Yii::t('trans','Ürün Grubları')?></span>
                                 </div>
                             </a>
                             
                             <a href="<?=Yii::app()->createUrl("warehouse")?>">
                                 <div class="Xf marL clearfix">
                                  <span class="text"><?=Yii::t('trans','Depo')?></span>
                                 </div>
                             </a>
                         </div>
                    </div>
                    
                    <a href="<?=Yii::app()->createUrl("dealers/admin")?>">
                    <div class="item clearfix">
                    	<div class="Xq clearfix">
                       	 <img src="<?=Yii::app()->baseUrl?>/images/icon/bayi.png"/>	
                   			<span class="text"><?=Yii::t('trans','Bayiler')?></span>
                    	</div>
                    </div>
                    </a>
                    
                    
                    <div class="item clearfix">
                    
                      <a href="<?=Yii::app()->createUrl("employees/admin")?>">
                   		<div class="Xq clearfix">
                       	 <img src="<?=Yii::app()->baseUrl?>/images/icon/users.png"/>	
                   			<span class="text"><?=Yii::t('trans','Kullanıcılar')?></span>
                    	</div>
                      </a>
                    </div>
                    
                    <div class="title"><?=Yii::t('trans','NESNEL')?></div>
                    
                    
                    <div class="item clearfix">
                    	<div class="xTab Xq marL clearfix">
                       	 <img src="<?=Yii::app()->baseUrl?>/images/icon/directions.png"/>	
                   			<span class="text"><?=Yii::t('trans','Kullanıcı Yetkileri')?></span>
                    	</div>

                      <div class="altF">
                          <a href="<?=Yii::app()->createUrl("employees/worldemployees")?>">
                             <div class="Xf marL clearfix">
                              <span class="text"><?=Yii::t('trans','Kullanıcı izinleri')?></span>
                             </div>
                          </a>
                     
                          <a href="<?=Yii::app()->createUrl("employees/worldemployees")?>">
                             <div class="Xf marL clearfix">
                              <span class="text"><?=Yii::t('trans','Kullanıcıya uygulama atama')?></span>
                             </div>
                          </a>
                      </div>
                             
                    </div>


                    
                    <div class="item clearfix">
                    <a href="<?=Yii::app()->createUrl("customergroups/admin")?>">
                    	<div class="Xq clearfix">
                       	 <img src="<?=Yii::app()->baseUrl?>/images/icon/group.png"/>	
                   			<span class="text"><?=Yii::t('trans','Müşteri Grupları')?></span>
                    	</div>
                    </a>


                     <a href="<?=Yii::app()->createUrl("productgroups")?>">
                        <div class="Xq clearfix">
                           <img src="<?=Yii::app()->baseUrl?>/images/icon/group.png"/>  
                          <span class="text"><?=Yii::t('trans','Ürün Grupları')?></span>
                        </div>
                     </a>

                    
                    </div>
                    
                    <div class="title"><?=Yii::t('trans','OLAYLAR')?></div>
                    
                    <div class="item clearfix">
                    	 <div class="xTab Xq marL clearfix">
                            <img src="<?=Yii::app()->baseUrl?>/images/icon/satis.png"/>	
                             <span class="text"><?=Yii::t('trans','Satış')?></span>
                         </div>
                         
                         <div class="altF">
                         
                         	 <div class="Xt marL clearfix">
                              <span class="text"><img src="<?=Yii::app()->baseUrl?>/images/right.png" /> <?=Yii::t('trans','Müşteri')?></span>
                             </div>
                             <a href="<?=Yii::app()->createUrl("sales/customer")?>">
                                 <div class="Xf marL clearfix Z1">
                                  <span class="text"><?=Yii::t('trans','Müşteri Ürün Satış')?></span>
                                 </div>
                             </a>
                              <a href="<?=Yii::app()->createUrl("sales/fastcustomer")?>">
                                 <div class="Xf marL clearfix Z1">
                                  <span class="text"><?=Yii::t('trans','Hızlı Müşteri Ürün Satış')?></span>
                                 </div>
                             </a>
                            
                              <div class="Xt marL clearfix">
                              <span class="text"><img src="<?=Yii::app()->baseUrl?>/images/right.png" /> <?=Yii::t('trans','Bayi')?></span>
                             </div>
                            
                            
                             <a href="<?=Yii::app()->createUrl("sales/dealer")?>">
                                 <div class="Xf marL clearfix Z1">
                                  <span class="text"><?=Yii::t('trans','Bayi Ürün Satış')?></span>
                                 </div>
                             </a>
                              <a href="<?=Yii::app()->createUrl("sales/fastdealer")?>">
                                 <div class="Xf marL clearfix Z1">
                                  <span class="text"><?=Yii::t('trans','Hızlı Bayi Ürün Satış')?></span>
                                 </div>
                             </a>
                            
                         </div>
                    </div>
                    
                    
                    <div class="item clearfix">
                    	 <div class="xTab Xq marL clearfix">
                            <img src="<?=Yii::app()->baseUrl?>/images/icon/satisview.png"/>	
                             <span class="text"><?=Yii::t('trans','Satış Takip ve Fatura')?></span>
                         </div>
                         
                         <div class="altF">
                         
                          	<div class="Xt marL clearfix">
                              <span class="text"><img src="<?=Yii::app()->baseUrl?>/images/right.png" /> <?=Yii::t('trans','Müşteri')?></span>
                             </div>
                             <a href="<?=Yii::app()->createUrl("salescompletecustomer/customer")?>">
                                 <div class="Xf marL clearfix Z1">
                                  <span class="text"><?=Yii::t('trans','Müşteri Satışlar')?></span>
                                 </div>
                             </a>
                             
                           
                             <a href="<?=Yii::app()->createUrl("salescompletecustomer/warehousecustomeradmin")?>">
                                 <div class="Xf marL clearfix Z1">
                                  <span class="text"><?=Yii::t('trans','Müşteri Satış - Ürün Depo Ayarı')?></span>
                                 </div>
                             </a>
                             
                             
                             <div class="Xt marL clearfix">
                              <span class="text"><img src="<?=Yii::app()->baseUrl?>/images/right.png" /> <?=Yii::t('trans','Bayi')?></span>
                             </div>
                              <a href="<?=Yii::app()->createUrl("salescompletecustomer/dealer")?>">
                                 <div class="Xf marL clearfix Z1">
                                  <span class="text"><?=Yii::t('trans','Bayi Satışlar')?></span>
                                 </div>
                             </a>
                             
                             
                              <a href="<?=Yii::app()->createUrl("salescompletecustomer/warehousedealeradmin")?>">
                                 <div class="Xf marL clearfix Z1">
                                  <span class="text"><?=Yii::t('trans','Bayi Satış - Ürün Depo Ayarı')?></span>
                                 </div>
                             </a>
                         </div>
                    </div>
                    
                    
                      
                    <div class="item clearfix">
                    	 <div class="xTab Xq marL clearfix">
                            <img src="<?=Yii::app()->baseUrl?>/images/icon/database.png"/>	
                             <span class="text"><?=Yii::t('trans','Depo')?></span>
                         </div>
                         
                         
                         
                         <div class="altF">
                         
                         	<div class="Xt marL clearfix">
                              <span class="text"><img src="<?=Yii::app()->baseUrl?>/images/right.png" /> <?=Yii::t('trans','Stok')?></span>
                             </div>
                              <a href="<?=Yii::app()->createUrl("products/stockadmin")?>">
                                 <div class="Xf marL clearfix Z1">
                                  <span class="text"><?=Yii::t('trans','Stok Güncelleme')?></span>
                                 </div>
                             </a>
                            
                             <div class="Xt marL clearfix">
                              <span class="text"><img src="<?=Yii::app()->baseUrl?>/images/right.png" /> <?=Yii::t('trans','Satış - Depolar')?></span>
                             </div>
                           <?PHP
						   
						    $criteria=new CDbCriteria;
							$criteria->select='*';
							$criteria->order="name asc";
							$criteria->params=array(
								':companyID'=>yii::app()->user->getState('companyID'),
								':worldID'=>yii::app()->user->getState('worldID'),
								
							);;
											
							$modelWarehouse=Warehouse::model()->findAll($criteria);
							
							?>
                            <?PHP foreach($modelWarehouse as $key=>$value):?>
                           	<a href="<?=Yii::app()->createUrl("salescompletecustomer/warehouse")?>/<?=$value->warehouseID?>">
                                 <div class="Xf marL clearfix Z1">
                                  <span class="text"><?=$value->name?></span>
                                 </div>
                             </a>
                             <?PHP endforeach?>
                         </div>
                         
                          
                    </div>
                    
                    
                    
                    <div class="item clearfix">
                    	 <div class="xTab Xq marL clearfix">
                            <img src="<?=Yii::app()->baseUrl?>/images/icon/approve_comment.png"/>	
                             <span class="text"><?=Yii::t('trans','Ödeme Bildirimi')?></span>
                         </div>
                         
                         <div class="altF">
                         
                          
                             <a href="<?=Yii::app()->createUrl("paymentnotifications/admin")?>">
                                 <div class="Xf marL clearfix">
                                  <span class="text"><?=Yii::t('trans','Ödeme Bildirimleri')?></span>
                                 </div>
                             </a>
                             
                             <a href="<?=Yii::app()->createUrl("paymentnotifications/create")?>">
                                 <div class="Xf marL clearfix">
                                  <span class="text"><?=Yii::t('trans','Ödeme Bildirimi Ekle')?></span>
                                 </div>
                             </a>
                             
                             
                            
                         </div>
                    </div>
                    
                    <div class="item clearfix">
                    	
                
                         <div class="xTab Xq marL clearfix">
                             <img src="<?=Yii::app()->baseUrl?>/images/icon/truck.png"/>	
                              <span class="text"><?=Yii::t('trans','Ziyaretler')?></span>
                         </div>
                         
                         <div class="altF">
                         
                          	<div class="Xt marL clearfix">
                              <span class="text"><img src="<?=Yii::app()->baseUrl?>/images/right.png" /> <?=Yii::t('trans','Müşteri')?></span>
                             </div>
                             <a href="<?=Yii::app()->createUrl("visits/customersadmin")?>">
                                 <div class="Xf marL clearfix Z1">
                                  <span class="text"><?=Yii::t('trans','Müşteri Ziyaretler')?></span>
                                 </div>
                             </a>
                             
                             <div class="Xt marL clearfix">
                              <span class="text"><img src="<?=Yii::app()->baseUrl?>/images/right.png" /> <?=Yii::t('trans','Bayi')?></span>
                             </div>
                             
                             <a href="<?=Yii::app()->createUrl("visits/dealersadmin")?>">
                                 <div class="Xf marL clearfix Z1">
                                  <span class="text"><?=Yii::t('trans','Bayi Ziyaretler')?></span>
                                 </div>
                             </a>
                             
                         </div>
                      
                    </div>
                    
                    
                     <div class="item clearfix">
                    	 <div class="xTab Xq marL clearfix">
                            <img src="<?=Yii::app()->baseUrl?>/images/icon/calendar.png"/>	
                             <span class="text"><?=Yii::t('trans','Randevular')?></span>
                         </div>
                         
                         <div class="altF">
                         
                          	<div class="Xt marL clearfix">
                              <span class="text"><img src="<?=Yii::app()->baseUrl?>/images/right.png" /> <?=Yii::t('trans','Müşteri')?></span>
                             </div>
                             <a href="<?=Yii::app()->createUrl("appointments/customersadmin")?>">
                                 <div class="Xf marL clearfix Z1">
                                  <span class="text"><?=Yii::t('trans','Müşteri Randevuları')?></span>
                                 </div>
                             </a>
                             
                             <div class="Xt marL clearfix">
                              <span class="text"><img src="<?=Yii::app()->baseUrl?>/images/right.png" /> <?=Yii::t('trans','Bayi')?></span>
                             </div>
                             
                             <a href="<?=Yii::app()->createUrl("appointments/dealersadmin")?>">
                                 <div class="Xf marL clearfix Z1">
                                  <span class="text"><?=Yii::t('trans','Bayi Randevuları')?></span>
                                 </div>
                             </a>
                             
                             
                            
                         </div>
                    </div>
                   
                    
                    
                     <div class="item clearfix">
                    	 <div class="xTab Xq marL clearfix">
                            <img src="<?=Yii::app()->baseUrl?>/images/icon/tools.png"/>	
                             <span class="text"><?=Yii::t('trans','Servis')?></span>
                         </div>
                         
                         <div class="altF">
                         
                          
                             <a href="<?=Yii::app()->createUrl("problematicproducts/admin")?>">
                                 <div class="Xf marL clearfix">
                                  <span class="text"><?=Yii::t('trans','Sorunlu Ürünler')?></span>
                                 </div>
                             </a>
                            
                         </div>
                    </div>
                    
                    
                   
                    
                    
                    <div class="title"><?=Yii::t('trans','RAPORLAR')?></div>
                    
                    <div class="item clearfix">
                    	 <div class="xTab Xq marL clearfix">
                       	 <img src="<?=Yii::app()->baseUrl?>/images/icon/chart_pie.png"/>	
                   			<span class="text"><?=Yii::t('trans','Genel Raporlar')?></span>
                    	</div>
                         <div class="altF">
                          
                             <a href="<?=Yii::app()->createUrl("reports/index")?>">
                                 <div class="Xf marL clearfix">
                                  <span class="text"><?=Yii::t('trans','Genel Bakış')?></span>
                                 </div>
                             </a>
                             
                             <a href="<?=Yii::app()->createUrl("reports/malitablo")?>">
                                 <div class="Xf marL clearfix">
                                  <span class="text"><?=Yii::t('trans','Mali Tablolar')?></span>
                                 </div>
                             </a>
                             
                             
                              <div class="Xt marL clearfix">
                              <span class="text"><img src="<?=Yii::app()->baseUrl?>/images/right.png" /> <?=Yii::t('trans','Kitle')?></span>
                             </div>
                         
                             
                             <a href="<?=Yii::app()->createUrl("reports/customers")?>">
                                 <div class="Xf marL clearfix Z1">
                                  <span class="text"><?=Yii::t('trans','Müşteri Raporları')?></span>
                                 </div>
                             </a>
                             
                             <a href="<?=Yii::app()->createUrl("reports/dealers")?>">
                                 <div class="Xf marL clearfix Z1">
                                  <span class="text"><?=Yii::t('trans','Bayi Raporları')?></span>
                                 </div>
                             </a>
                             
                             <a href="<?=Yii::app()->createUrl("reports/employees")?>">
                                 <div class="Xf marL clearfix Z1">
                                  <span class="text"><?=Yii::t('trans','Kullanıcı Raporları')?></span>
                                 </div>
                             </a>



                              <div class="Xt marL clearfix">
                              <span class="text"><img src="<?=Yii::app()->baseUrl?>/images/right.png" /> <?=Yii::t('trans','Grup')?></span>
                             </div>

                             <a href="<?=Yii::app()->createUrl("reports/customergroups")?>">
                                 <div class="Xf marL clearfix Z1">
                                  <span class="text"><?=Yii::t('trans','Müşteri Grubları Raporu')?></span>
                                 </div>
                             </a>
                             
                             <a href="<?=Yii::app()->createUrl("reports/productgroups")?>">
                                 <div class="Xf marL clearfix Z1">
                                  <span class="text"><?=Yii::t('trans','Ürün Grupları Raporu')?></span>
                                 </div>
                             </a>

                              
                         </div>
                    </div>
                    
                    <div class="item clearfix">
                    	<div class="xTab Xq marL clearfix">
                       	 <img src="<?=Yii::app()->baseUrl?>/images/icon/chart.png"/>	
                   			<span class="text"><?=Yii::t('trans','Kıyaslamalar')?></span>
                    	</div>
                      
                       <div class="altF">
                         <a href="<?=Yii::app()->createUrl("reportskiyaslamalar/customers")?>">
                               <div class="Xf marL clearfix Z1">
                                <span class="text"><?=Yii::t('trans','Müşteri Bazlı')?></span>
                               </div>
                          </a>

                           <a href="<?=Yii::app()->createUrl("reportskiyaslamalar/dealers")?>">
                               <div class="Xf marL clearfix Z1">
                                <span class="text"><?=Yii::t('trans','Bayi Bazlı')?></span>
                               </div>
                          </a>


                           <a href="<?=Yii::app()->createUrl("reportskiyaslamalar/employees")?>">
                               <div class="Xf marL clearfix Z1">
                                <span class="text"><?=Yii::t('trans','Kullanıcı Bazlı')?></span>
                               </div>
                          </a>


                           <a href="<?=Yii::app()->createUrl("reportskiyaslamalar/products")?>">
                               <div class="Xf marL clearfix Z1">
                                <span class="text"><?=Yii::t('trans','Ürün Bazlı')?></span>
                               </div>
                          </a>


                           <a href="<?=Yii::app()->createUrl("reportskiyaslamalar/country")?>">
                               <div class="Xf marL clearfix Z1">
                                <span class="text"><?=Yii::t('trans','Ülke Bazlı')?></span>
                               </div>
                          </a>


                           <a href="<?=Yii::app()->createUrl("reportskiyaslamalar/city")?>">
                               <div class="Xf marL clearfix Z1">
                                <span class="text"><?=Yii::t('trans','Şehir Bazlı')?></span>
                               </div>
                          </a>
                        </div>
                    </div>
                    
                    <div class="item clearfix">
                     <a href="<?=Yii::app()->createUrl("reportsquery/index")?>">
                    	<div class="Xq  clearfix">
                       	 <img src="<?=Yii::app()->baseUrl?>/images/icon/chart_search.png"/>	
                   			<span class="text"><?=Yii::t('trans','Sorgulamalar')?></span>
                    	</div>
                      </a>
                    </div>
                    
                    
                    <div class="item clearfix">
                     <a href="<?=Yii::app()->createUrl("reportsquery/index")?>">
                      	<div class="Xq marL clearfix">
                         	 <img src="<?=Yii::app()->baseUrl?>/images/icon/progress.png"/>	
                     			<span class="text"><?=Yii::t('trans','Kaynaklar')?></span>
                      	</div>
                      </a>
                    </div>
                    
                    
                    <div class="item clearfix">
                    	<div class="Xq marL clearfix">
                       	 <img src="<?=Yii::app()->baseUrl?>/images/icon/history.png"/>	
                   			<span class="text"><?=Yii::t('trans','İçerik')?></span>
                    	</div>
                    </div>
                    
 </div>