<?php
	$is_mobile = isMobile();
	$bg_colors = config('constants.menu_bg_colors');
	$business_id = session()->get('user.business_id');
	$data_path = config('constants.data_path');
	$first_non_hidden_menu = true;
	$quick_menu_image_url = function ($menu_id, $file_name) use ($business_id, $data_path) {
		if (empty($file_name)) {
			return null;
		}

		$paths = [
			'uploads/' . $data_path . $business_id . '/quick_menu/' . $menu_id . '/' . $file_name,
			'uploads/' . $business_id . '/quick_menu/' . $menu_id . '/' . $file_name,
			'uploads/quick_menu/' . $menu_id . '/' . $file_name,
		];

		foreach (array_unique($paths) as $path) {
			if (file_exists(public_path($path))) {
				return asset($path);
			}
		}

		return null;
	};
	$quick_menu_product_image_url = function ($file_name) use ($business_id, $data_path) {
		if (empty($file_name)) {
			return null;
		}

		$paths = [
			'uploads/' . $data_path . $business_id . '/img/' . $file_name,
			'uploads/' . $business_id . '/img/' . $file_name,
			'uploads/img/' . $file_name,
		];

		foreach (array_unique($paths) as $path) {
			if (file_exists(public_path($path))) {
				return asset($path);
			}
		}

		return null;
	};
?>

<div class="col-md-12 quick_menu quick_menu_<?php echo e($qm->id, false); ?>" id="quick_menu_<?php echo e($qm->location_id, false); ?>" data-loc="<?php echo e($qm->location_id, false); ?>" 
	data-current_id="<?php echo e($qm->id, false); ?>" data-qm_name="<?php echo e($qm->name, false); ?>">
	<ul class="nav nav-tabs qm-menu-tabs">

		<?php for($mh=1;$mh<=$qm->no_of_menu;$mh++): ?>
			<?php if(!empty($menu_heads[$mh-1]) && $menu_heads[$mh-1]->exists): ?>
			<?php
			$menu_head = $menu_heads[$mh-1]; 
			$menu_head->settings = json_decode($menu_head->settings) ?: (object) [];
			$menu_head_hide = '';
			if(!empty($menu_head->settings->hide_menu)){
				$menu_head_hide = 'hide';
			}
			$is_active = ($first_non_hidden_menu && $menu_head_hide == '');
            if ($is_active) {
                $first_non_hidden_menu = false;
			}
			// $mh_bg_color = (!empty($menu_head->settings->color)) ? $bg_colors[$menu_head->settings->color][1] : $bg_colors[$mh][1];
			$mh_bg_color = (!empty($menu_head->settings->menu_color)) ? $menu_head->settings->menu_color : $bg_colors[$mh][1];
			$mh_font_size = (!empty($menu_head->settings->font_size)) ? $menu_head->settings->font_size.'px' : '14px';
			$mh_font_weight = (!empty($menu_head->settings->is_bold)) ? 800 : 400;
			?>
			
			<li class="<?php if($is_active): ?> active <?php endif; ?> menu_head_tab text-center p-0 col-1 <?php echo e($menu_head_hide, false); ?>" id="menu_no_<?php echo e($mh, false); ?>">				
				<a href="#menu-<?php echo e($qm->id, false); ?>-<?php echo e($mh, false); ?>" data-bs-toggle="tab" class="nav-link nav-link-quick-menu <?php if($is_active): ?> active <?php endif; ?>"
					style="
						background-color:<?php echo e($mh_bg_color, false); ?>;font-size:<?php echo e($mh_font_size, false); ?> !important;font-weight:<?php echo e($mh_font_weight, false); ?> !important;color:white;
						display: inline-flex;justify-content: center;align-items: center;flex-wrap: wrap;gap: 0px;
						height:70px;width:100%;max-height:100px;text-wrap:wrap;padding-top:5px;
					"> 
					<?php if(Auth::user()->can('edit_quick_menu_buttons')): ?>
					<i class="fa fa-edit hide float-end edit_quick_menu_btn" style="font-size:20px;width:100%"
					id="edit_quick_menu_btn" data-menu-id='<?php echo e($menu_head->id, false); ?>' data-menu-number="<?php echo e($mh, false); ?>" data-menu-color-hex='<?php echo e($mh_bg_color, false); ?>'><br></i>
					<?php endif; ?>
					<?php $__menu_head_image_url = $quick_menu_image_url($qm->id, $menu_head->image ?? null); ?>
					<?php if(!empty($__menu_head_image_url)): ?>
						<span style="height:50px;width:50px">
							<img src="<?php echo e($__menu_head_image_url, false); ?>" style="width: 100%;height:100%">
						</span>
					<?php endif; ?>
					<span style='width: 95%;'><?php echo e($menu_head->name, false); ?></span>
				</a>
			</li>
			<?php endif; ?>
		<?php endfor; ?>
		
	</ul>
	
	<div class="tab-content">
		<?php
		$first_non_hidden_menu = true;
		?>
		<?php for($mt=1;$mt<=$qm->no_of_menu;$mt++): ?>
			<?php if(!empty($menu_heads[$mt-1]) && $menu_heads[$mt-1]->exists): ?>
				<?php
				$menu_head = $menu_heads[$mt-1];
				$menu_head_hide = '';
				if(!empty($menu_head->settings->hide_menu)){
					$menu_head_hide = 'hide';
				}
				$is_active = ($first_non_hidden_menu && $menu_head_hide == '');
				if ($is_active) {
					$first_non_hidden_menu = false;
				}
				?>
				<div class="tab-pane <?php if($is_active): ?> active show  <?php endif; ?>" id="menu-<?php echo e($qm->id, false); ?>-<?php echo e($mt, false); ?>">
					<div class="row g-0 qm-items-grid">
						
						<?php for($tc=1;$tc<=$qm->no_of_menu_items;$tc++): ?>
							<?php
							$menu_item = $menu_items[$menu_head->id][$tc] ?? null;
							$menu_item_settings = !empty($menu_item) ? (json_decode($menu_item->settings) ?: (object) []) : (object) [];
							?>
							<?php if(!empty($menu_item) && $menu_item->position == $tc && $menu_item->parent_id == $menu_head->id): ?>
								
								<?php if($menu_item->item_type == 'Product'): ?>
									<?php
										if(!empty($menu_item_settings->color)){
											$item_bg_color = $menu_item_settings->color;
											if(!empty($bg_colors[$menu_item_settings->color][1])){
												$item_bg_color = $bg_colors[$menu_item_settings->color][1];
											}
										} elseif(!empty($menu_head->settings->menu_color)){
											$item_bg_color = $menu_head->settings->menu_color;
										} else{
											$item_bg_color = $bg_colors[$mt][1];
										}
										$item_font_size = (!empty($menu_item_settings->font_size)) ? $menu_item_settings->font_size.'px' : '14px';
										$item_font_weight = (!empty($menu_item_settings->is_bold)) ? 800 : 400;
									?>
									<div class="btn col-md-1 col-4 col-sm-4 product_box_menu_item p-0 m-0 qm-item-box" data-variation_id="<?php echo e($menu_item->item_type_id, false); ?>" data-quantity="<?php echo e($menu_item->quantity, false); ?>" data-edit_price_on_sale="<?php echo e(!empty($menu_item->edit_price_on_sale) ? 1 : 0, false); ?>"
										style="height:70px;background-color:<?php echo e($item_bg_color, false); ?>;font-size:<?php echo e($item_font_size, false); ?> !important;font-weight:<?php echo e($item_font_weight, false); ?> !important;text-wrap:wrap">
										
										<?php if(Auth::user()->can('edit_quick_menu_buttons')): ?>
											<i class="fa fa-edit hide float-end edit_quick_menu_btn" style="font-size:20px;width:50%"
											id="edit_quick_menu_item_btn" data-quick-menu-id='<?php echo e($qm->id, false); ?>' data-menu-id='<?php echo e($menu_head->id, false); ?>' data-menu-number="<?php echo e($mt, false); ?>" data-item-color-hex='<?php echo e($item_bg_color, false); ?>'
											data-type='<?php echo e($menu_item->type, false); ?>' data-item-type='<?php echo e($menu_item->item_type, false); ?>' data-position='<?php echo e($tc, false); ?>' data-menu-item-id='<?php echo e($menu_item->id, false); ?>'><br></i>
											<i class="fa fa-trash hide float-end edit_quick_menu_btn" style="font-size:20px;width:50%"
											id="delete_quick_menu_item_btn" data-del-href='/quick-menu-items/<?php echo e($menu_item->id, false); ?>' data-menu-item-id='<?php echo e($menu_item->id, false); ?>' 
											data-quick-menu-id='<?php echo e($qm->id, false); ?>'><br></i>
										<?php endif; ?>

										<?php
											$__menu_item_image_url = $quick_menu_image_url($qm->id, $menu_item->image ?? null)
												?: $quick_menu_product_image_url($menu_item->image ?? null);
										?>
										<?php if(!empty($__menu_item_image_url)): ?>
											<span style="height:50px;width:50px">
												<img src="<?php echo e($__menu_item_image_url, false); ?>" style="width: 100%;height:100%">
											</span>
										<?php endif; ?>
										<span style='width: 95%;'><?php echo e($menu_item->name, false); ?></span>
										<?php if(!empty($show_prices) && !empty($menu_item->price)): ?>
											<small style='width:95%;display:block;opacity:0.85;'><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $menu_item->price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></small>
										<?php endif; ?>
									</div>
								<?php elseif($menu_item->item_type == 'Product Set'): ?>
									<?php
										if(!empty($menu_item_settings->color)){
											$item_bg_color = $menu_item_settings->color;
											if(!empty($bg_colors[$menu_item_settings->color][1])){
												$item_bg_color = $bg_colors[$menu_item_settings->color][1];
											}
										} elseif(!empty($menu_head->settings->menu_color)){
											$item_bg_color = $menu_head->settings->menu_color;
										} else{
											$item_bg_color = $bg_colors[$mt][1];
										}
										$item_font_size = (!empty($menu_item_settings->font_size)) ? $menu_item_settings->font_size.'px' : '14px';
										$item_font_weight = (!empty($menu_item_settings->is_bold)) ? 800 : 400;
									?>
<div class="btn col-md-1 col-4 col-sm-4 product_set_box_menu_item p-0 m-0 qm-item-box" data-name="<?php echo e($menu_item->name, false); ?>"  data-set_products="<?php echo e(json_encode($menu_item_settings->set_products), false); ?>" data-set_addon_products="<?php echo e(json_encode($menu_item_settings->set_addon_products), false); ?>" 
										style="height:70px;background-color:<?php echo e($item_bg_color, false); ?>;font-size:<?php echo e($item_font_size, false); ?> !important;font-weight:<?php echo e($item_font_weight, false); ?> !important;text-wrap:wrap">
										
										<?php if(Auth::user()->can('edit_quick_menu_buttons')): ?>
											<i class="fa fa-edit hide float-end edit_quick_menu_btn" style="font-size:20px;width:50%"
											id="edit_quick_menu_item_btn" data-quick-menu-id='<?php echo e($qm->id, false); ?>' data-menu-id='<?php echo e($menu_head->id, false); ?>' data-menu-number="<?php echo e($mt, false); ?>" data-item-color-hex='<?php echo e($item_bg_color, false); ?>'
											data-type='<?php echo e($menu_item->type, false); ?>' data-item-type='<?php echo e($menu_item->item_type, false); ?>' data-position='<?php echo e($tc, false); ?>' data-menu-item-id='<?php echo e($menu_item->id, false); ?>'><br></i>
											<i class="fa fa-trash hide float-end edit_quick_menu_btn" style="font-size:20px;width:50%"
											id="delete_quick_menu_item_btn" data-del-href='/quick-menu-items/<?php echo e($menu_item->id, false); ?>' data-menu-item-id='<?php echo e($menu_item->id, false); ?>' 
											data-quick-menu-id='<?php echo e($qm->id, false); ?>'><br></i>
										<?php endif; ?>

										<?php
											$__menu_item_image_url = $quick_menu_image_url($qm->id, $menu_item->image ?? null)
												?: $quick_menu_product_image_url($menu_item->image ?? null);
										?>
										<?php if(!empty($__menu_item_image_url)): ?>
											<span style="height:50px;width:50px">
												<img src="<?php echo e($__menu_item_image_url, false); ?>" style="width: 100%;height:100%">
											</span>
										<?php endif; ?>
										<span style='width: 95%;'><?php echo e($menu_item->name, false); ?></span>
										<?php if(!empty($show_prices) && !empty($menu_item->price)): ?>
											<small style='width:95%;display:block;opacity:0.85;'><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $menu_item->price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></small>
										<?php endif; ?>
									</div>


								<?php elseif($menu_item->item_type == 'Table'): ?>
									<?php
										if(!empty($menu_item_settings->color)){
											$item_bg_color = $menu_item_settings->color;
											if(!empty($bg_colors[$menu_item_settings->color][1])){
												$item_bg_color = $bg_colors[$menu_item_settings->color][1];
											}
										} elseif(!empty($menu_head->settings->menu_color)){
											$item_bg_color = $menu_head->settings->menu_color;
											if(!empty($bg_colors[$menu_head->settings->menu_color][1])){
												$item_bg_color = $bg_colors[$menu_head->settings->menu_color][1];
											}
										} else{
											$item_bg_color = $bg_colors[$mt][1];
										}
										$item_bg_class = '';
										if($menu_item->status == 'reserved'){
											$item_bg_class = 'bg-green';
										}else if($menu_item->status == 'out_of_order'){
											$item_bg_class = 'bg-danger';
										}
										if(!$menu_item->table_has_bill){
											if($menu_item->table_orders){
												$item_bg_class = 'bg-yellow';
											}
										}else{
											$item_bg_class = 'bg-red';
										}
										$restrict_on_security = (!empty($menu_item_settings->restrict_on_security) && !auth()->user()->can('table.view_restricted_table')) ? 1 : 0;
										$item_font_size = (!empty($menu_item_settings->font_size)) ? $menu_item_settings->font_size.'px' : '14px';
										$item_font_weight = (!empty($menu_item_settings->is_bold)) ? 800 : 400;
									?>
									<div class="btn col-md-1 col-4 col-sm-4 table_box_menu_item qm-item-box <?php echo e($item_bg_class, false); ?>" data-table_name="<?php echo e($menu_item->name, false); ?>" data-table_id="<?php echo e($menu_item->item_type_id, false); ?>" 
										data-table_has_orders="<?php echo e($menu_item->table_orders, false); ?>" data-table_has_bill="<?php echo e($menu_item->table_has_bill, false); ?>" data-restrict_on_security="<?php echo e($restrict_on_security, false); ?>"
										<?php if($menu_item_settings->ask_guest_count): ?> data-ask_guest_count='true' data-guest_count='<?php echo e(($menu_item->quantity > 0) ? $menu_item->quantity : 0, false); ?>' <?php endif; ?>
										<?php if($menu_item->reserved_by): ?> data-reserved_by='<?php echo e($menu_item->reserved_by, false); ?>' <?php endif; ?>
										<?php if($menu_item_settings->ask_token_no): ?> data-ask_token_no='1' data-token_no='' <?php endif; ?>
										style="height:70px;background-color:<?php echo e($item_bg_color, false); ?>;font-size:<?php echo e($item_font_size, false); ?> !important;font-weight:<?php echo e($item_font_weight, false); ?> !important;text-wrap:wrap;">
										
										<?php if(Auth::user()->can('edit_quick_menu_buttons')): ?>
											<i class="fa fa-edit hide float-end edit_quick_menu_btn" style="font-size:20px;width:50%"
											id="edit_quick_menu_item_btn" data-quick-menu-id='<?php echo e($qm->id, false); ?>' data-menu-id='<?php echo e($menu_head->id, false); ?>' data-menu-number="<?php echo e($mt, false); ?>" data-item-color-hex='<?php echo e($item_bg_color, false); ?>'
											data-type='<?php echo e($menu_item->type, false); ?>' data-item-type='<?php echo e($menu_item->item_type, false); ?>' data-position='<?php echo e($tc, false); ?>' data-menu-item-id='<?php echo e($menu_item->id, false); ?>'><br></i>
											<i class="fa fa-trash hide float-end edit_quick_menu_btn" style="font-size:20px;width:50%"
											id="delete_quick_menu_item_btn" data-del-href='/quick-menu-items/<?php echo e($menu_item->id, false); ?>' data-menu-item-id='<?php echo e($menu_item->id, false); ?>' 
											data-quick-menu-id='<?php echo e($qm->id, false); ?>'><br></i>
										<?php endif; ?>
										
										<?php
											$__menu_item_image_url = $quick_menu_image_url($qm->id, $menu_item->image ?? null)
												?: $quick_menu_product_image_url($menu_item->image ?? null);
										?>
										<?php if(!empty($__menu_item_image_url)): ?>
											<span style="height:50px;width:50px">
												<img src="<?php echo e($__menu_item_image_url, false); ?>" style="width: 100%;height:100%">
											</span>
										<?php endif; ?>
										<span style='width: 95%;'>
											<span id="reserved_by_name"><?php if($menu_item->contact_name): ?> <?php echo e($menu_item->contact_name, false); ?><br> <?php endif; ?></span>
											<span id="table_token_no"></span> 
											<?php echo e($menu_item->name, false); ?>

											<br><span id="menu_item_status"></span>
										</span>
									</div>
								<?php endif; ?>
							<?php else: ?>

								<?php
									if(!empty($menu_head->settings->menu_color)){
										$item_bg_color = $menu_head->settings->menu_color;
									} else{
										$item_bg_color = $bg_colors[$mt][1];
									}
								?>
								<div type="button" class="btn col-md-1 col-4 col-sm-4 p-0 m-0 qm-item-box" style="height:70px;background-color:<?php echo e($item_bg_color, false); ?>;">
									<?php if(Auth::user()->can('edit_quick_menu_buttons')): ?>
										<i class="fa fa-edit hide float-end edit_quick_menu_btn" style="font-size:20px;"
										id="edit_quick_menu_item_btn" data-quick-menu-id='<?php echo e($qm->id, false); ?>' data-menu-id='<?php echo e($menu_head->id, false); ?>' 
										data-menu-number="<?php echo e($mt, false); ?>" data-item-color-hex='<?php echo e($item_bg_color, false); ?>'
										data-type='Item' data-item-type='Product' data-position='<?php echo e($tc, false); ?>' data-menu-item-id=''><br></i>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						
						<?php endfor; ?>

					</div>
				</div>
			<?php endif; ?>	
		<?php endfor; ?>
	  </div>
</div>
