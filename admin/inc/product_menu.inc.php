<li><a href="product_detail.php?id=<?=$parent;?>" <?=(FS==1)?'class="active"':'';?>)>商品基本設定</a></li>  
						<?php if($parent!=''){?>
                        <li><a href="product_detail_photo.php?myParent=<?=$parent;?>" <?=(FS==2)?'class="active"':'';?>>商品圖片設定</a></li>
                        <li><a href="product_detail_color.php?myParent=<?=$parent;?>" <?=(FS==3)?'class="active"':'';?>>商品顏色設定</a></li>
                        <li><a href="product_detail_spec.php?myParent=<?=$parent;?>" <?=(FS==4)?'class="active"':'';?>>商品樣式設定</a></li>
                        <li><a href="product_detail_package.php?myParent=<?=$parent;?>" <?=(FS==5)?'class="active"':'';?>>商品包裝設定</a></li>
						<?php }?>