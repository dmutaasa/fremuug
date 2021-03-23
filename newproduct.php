		<?=template_header('Cart')?>
    <div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Add New Product</h3>
						<ul class="breadcrumb-tree">
							<li><a href="index.php">Home</a></li>
							<li class="active">Add New Product</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
				<br>          
       <?php if (isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])) { ?>
                        <div class="success-message" style="margin-bottom: 20px;font-size: 20px;color: green;"><?php echo $_SESSION['success_message']; ?></div>
                        <?php
                        unset($_SESSION['success_message']);
                    }
                    ?>
            <div class="form-panel">
              <div class="form">              	
 <form class="cmxform form-horizontal style-form" id="signupForm" method="post" 
 action="save.php", enctype="multipart/form-data">
                  <div class="form-group ">
                    <label for="Product_Name" class="control-label col-lg-2">Product Name</label>
                    <div class="col-lg-3">
                      <input class=" form-control" id="Product_Name" name="Product_Name" type="text" />
                    </div>
                     <label for="productbrand" class="control-label col-lg-2">Product Brand</label>
                    <div class="col-lg-3">
                      <select name="Product_Brand" id="Product_Brand" class="form-control ">
                      	 <option >Select Brand</option>
                      	 <optgroup label="Fashion">
                         <option value="Nike">Nike</option>
                         <option value="Louis_Vuitton">Louis Vuitton</option>
                         <option value="Adidas">Adidas</option>
                         <option value="Prada">Prada</option>
                         <option value="Ugandan">Ugandan</option>                         
                         </optgroup>
                         <optgroup label="Wines and Spirits">
                         <option value="Uganda_Waragi">Uganda Waragi</option>
                         <option value="Jamesons">Jamesons</option>
                         <option value="Imperail_Blue">Imperail Blue</option>
                         <option value="Four_Cousins">Four Cousins</option>
                         <option value="Black_Label">Black Label</option>                         
                         </optgroup>
                          </optgroup>
                         <optgroup label="Electronics">
                         <option value="LG">LG</option>
                         <option value="SONY">SONY</option>
                         <option value="SAMSUNG">SAMSUNG</option>
                         <option value="JBL">JBL</option>
                         <option value="PANASONIC">PANASONIC</option>
                         <option value="HISENSE">HISENSE</option> 
                         <option value="GENERIC">GENERIC</option>                        
                         </optgroup> 
                       <optgroup label="Mobile Devices">
                         <option value="APPLE">APPLE</option>
                         <option value="HUWAEI">HUWAEI</option>
                         <option value="SAMSUNG">SAMSUNG</option>
                         <option value="HTC">HTC</option>
                         <option value="NOKIA">NOKIA</option>
                         <option value="ONE_PLUS">ONE PLUS</option> 
                         <option value="TECHNO">TECHNO</option>
                         <option value="XIOMI">XIOMI</option>                        
                       </optgroup>                       
                       <optgroup label="Computing">
                         <option value="APPLE">APPLE</option>
                         <option value="HP">HP</option>
                         <option value="SAMSUNG">SAMSUNG</option>
                         <option value="DELL">DELL</option>
                         <option value="LENOVO">LENOVO</option>
                         <option value="ACCER">ACCER</option> 
                         <option value="ASSUS">ASSUS</option>
                         <option value="MICROSOFT">MICROSOFT</option>                                                 
                        </optgroup>
                        <optgroup label= "Health and Beauty">
                         <option value="Vaseline">VASELINE</option>
                         <option value="SARAYA">SARAYA</option>
                         <option value="DETTOL">DETTOL</option>
                         <option value="ARIEL">ARIEL</option>
                         <option value="ALWAYS">ALWAYS</option>
                         <option value="COLGATE">COLGATE</option> 
                         <option value="NIVEA">NIVEA</option>                                                 
                        </optgroup>
                          
                          <optgroup label="Gaming">
                         <option value="SONY">SONY</option>
                         <option value="X-BOX">X-BOX</option>
                                                                          
                        </optgroup>
                          <optgroup label="Camera">
                         <option value="SONY">Nixon</option>
                         <option value="X-BOX">Canon</option>
                         <option value="X-BOX">Andoer</option>
                                                                          
                        </optgroup>
                       </select>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="Product_Type" class="control-label col-lg-2">Product Type</label>
                    <div class="col-lg-3">
                      <input class=" form-control" id="Product_Type" name="Product_Type" type="text" />
                    </div>                 
                  
                    <label for="price" class="control-label col-lg-2">Price </label>
                    <div class="col-lg-2">
                      <input class="form-control " id="Product_Price" name="Product_Price" type="Number" />                       
                    </div>
                    <label class="control-label">UGX</label>
                  </div>
                  <div class="form-group ">
                    <label for="Category" class="control-label col-lg-2">Category</label>
                    <div class="col-lg-3">
                      <select name="Product_Category" id="Product_Category" class="form-control ">
                      	  <option value="Fashion">Select Category</option>
                         <option value="Fashion">Fashion</option>
                         <option value="Wines_Spirits">Wines and Spirits</option>
                         <option value="Electonis">Electronics</option>
                          <option value="Mobile Devices">Mobile Devices</option>
                          <option value="Health_Beauty">Health and Beauty</option>
                          <option value="Computing">Computing</option>
                          <option value="Gaming">Gaming</option>
                          <option value="Cameras">Cameras</option>
                          <option value="Accesories">Accesories</option>
                          
                       </select>
                    </div>
                 
                    <label for="Product_Status" class="control-label col-lg-2">Product Status</label>
                    <div class="col-lg-2">
                     <select name="Product_Status" id="Product_Status" class="form-control ">
                     	 <option>Select Status</option>
                         <option value="In_Stock">In Stock</option>
                         <option value="Out_of_Stock">Out of Stock</option>
                         <option value="Shipped">Shipped</option>
                          
                       </select>
                    </div>
                  </div>
                    <div class="form-group ">
                    <label for="Discount" class="control-label col-lg-2">Discount Percentage</label>
                    <div class="col-lg-3">
             <input class="form-control " id="Product_Discount" name="Product_Discount" type="number"  min "0" max "100"/>
                 
                    </div>
                 
                  <label for="Product_Description" class="control-label col-lg-2">Product Description</label>
                    <div class="col-lg-3">
                      <input class="form-control " id="Product_Description" name="Product_Description" type="text" />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="Quantity" class="control-label col-lg-2">Quantity</label>
                    <div class="col-lg-3">
                      <input class="form-control " id="Quantityl" name="Quantity" type="number" />
                    </div>
                    <label for="color" class="control-label col-lg-2">Colour</label>
                    <div class="col-lg-2">
                      <input class="form-control " id="Product_Color" name="Product_Color" type="text" />
                    </div>
                  </div>
                     <div class="form-group last">
                  <label class="control-label col-md-2">Main Image Upload</label>
                  <div class="col-md-5">
                    <div class="fileupload fileupload-new" data-provides="fileupload" >
                      <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" alt="" />
                      </div>
                      <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                      <div>
                        <span class="btn btn-theme02 btn-file">
                          <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                        <input type="file" class="default" accept="image/*"  name ="Main_Image"/>
                        </span>
                        <a href="productadd.php#" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Remove</a>
                      </div>
                    </div>
                    <span class="label label-info">NOTE!</span>
                   
                  </div>
                    <label class="control-label col-md-2">Side Image Upload</label>
                  <div class="col-md-5">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" alt="" />
                      </div>
                      <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                      <div>
                        <span class="btn btn-theme02 btn-file">
                          <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                        <input type="file" class="default" accept="image/*" name ="Side_image1" />
                        </span>
                        <a href="advanced_form_components.html#" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Remove</a>
                      </div>
                    </div>
                    
                   
                  </div>
                   <label class="control-label col-md-2">Side Image Upload</label>
                  <div class="col-md-5">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" alt="" />
                      </div>
                      <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                      <div>
                        <span class="btn btn-theme02 btn-file">
                          <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                        <input type="file" class="default" accept="image/*" name ="Side_image2"/>
                        </span>
                        <a href="advanced_form_components.html#" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Remove</a>
                      </div>
                    </div>
                    
                   
                  </div>
                   <label class="control-label col-md-2">Side Image Upload</label>
                  <div class="col-md-5">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" alt="" />
                      </div>
                      <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                      <div>
                        <span class="btn btn-theme02 btn-file">
                          <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                        <input type="file" class="default" accept="image/*" name ="Side_image3" />
                        </span>
                        <a href="advanced_form_components.html#" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Remove</a>
                      </div>
                    </div>
                    
                   
                  </div>
                </div>
                  <div class="form-group ">
                    <label for="product_specs" class="control-label col-lg-2 col-sm-3">Product Specifications</label>
                    <div class="col-lg-6 col-sm-6">
                      <textarea class="form-control" name="product_specs" id="product_specs" placeholder="Product Specifications" rows="5" data-rule="required" data-msg="Please add  specifications"></textarea>
                <div class="validate"></div>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="newsletter" class="control-label col-lg-2 col-sm-3">Agree to Terms and conditions</label>
                    <div class="col-lg-10 col-sm-9">
                      <input type="checkbox" style="width: 20px" class="checkbox form-control" id="newsletter" name="newsletter" />
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button class="btn btn-theme" type="submit" name ="save"  data-rel="back" >Save</button>
                      <button class="btn btn-theme04" type="button">Cancel</button>
                    </div>
                  </div>
                </form>
			</div>
		</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->
    <?=template_footer()?>