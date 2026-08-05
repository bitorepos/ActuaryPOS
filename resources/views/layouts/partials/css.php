<!-- OneDash Template CSS -->
<link href="<?php echo e(asset('onedash/plugins/simplebar/css/simplebar.css'), false); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('onedash/plugins/perfect-scrollbar/css/perfect-scrollbar.css'), false); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('onedash/plugins/metismenu/css/metisMenu.min.css'), false); ?>" rel="stylesheet" />
<!-- Bootstrap 5 (OneDash bundled) -->
<link href="<?php echo e(asset('onedash/css/bootstrap.min.css'), false); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('onedash/css/bootstrap-extended.css'), false); ?>" rel="stylesheet" />
<!-- OneDash Core Styles -->
<link href="<?php echo e(asset('onedash/css/style.css'), false); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('onedash/css/icons.css'), false); ?>" rel="stylesheet" />
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="<?php echo e(asset('vendor/bootstrap-icons/bootstrap-icons.css'), false); ?>">
<!-- Pace Loader -->
<link href="<?php echo e(asset('onedash/css/pace.min.css'), false); ?>" rel="stylesheet" />
<!-- OneDash Theme Variants -->
<link href="<?php echo e(asset('onedash/css/light-theme.css'), false); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('onedash/css/dark-theme.css'), false); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('onedash/css/semi-dark.css'), false); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('onedash/css/header-colors.css'), false); ?>" rel="stylesheet" />

<!-- Custom vendor CSS (existing project plugins) -->
<link rel="stylesheet" href="<?php echo e(asset('css/vendor.css?v='.$asset_v), false); ?>">

<?php if( in_array(session()->get('user.language', config('app.locale')), config('constants.langs_rtl')) ): ?>
	<link rel="stylesheet" href="<?php echo e(asset('css/rtl.css?v='.$asset_v), false); ?>">
<?php endif; ?>

<!-- OneDash ↔ Legacy compatibility layer -->
<link rel="stylesheet" href="<?php echo e(asset('css/onedash-compat.css?v='.$asset_v), false); ?>">
<!-- Truckmate Module Modern Design -->
<link rel="stylesheet" href="<?php echo e(asset('css/truckmate-modern.css?v='.$asset_v), false); ?>">

<?php echo $__env->yieldContent('css'); ?>

<!-- app css -->
<link rel="stylesheet" href="<?php echo e(asset('css/app.css?v=' . $asset_v . '.' . filemtime(public_path('css/app.css'))), false); ?>">

<!-- Bootstrap 5 Theme Overrides (must load after app.css) -->
<link rel="stylesheet" href="<?php echo e(asset('css/bootstrap5-theme.css?v='.$asset_v), false); ?>">
<?php if(!empty(session()->get('business.common_settings')['enable_urdu_typing'] ?? false)): ?>
<style type="text/css">
	@font-face {
		font-family: 'NooriNastaleeq';
		src: url('/fonts/noori-nastaleeq-regular.ttf') format('truetype');
		font-weight: normal;
		font-style: normal;
	}
	input, b, p, i, th, td, .product_box_menu_item {
		font-family: 'NooriNastaleeq';
	}
	/* #search_product, #products_search_text, #search_product_for_purchase_return, .product_box_menu_item, #product_table_filter > label > input, td {
		font-family: 'NooriNastaleeq';
	} */
</style>
<?php endif; ?>
<?php if(isset($pos_layout) && $pos_layout): ?>
	<style type="text/css">
		.content{
			padding-bottom: 0px !important;
		}
	</style>
<?php endif; ?>
<style type="text/css">
	/*
	* Pattern lock css
	* Pattern direction
	* http://ignitersworld.com/lab/patternLock.html
	*/
	.patt-wrap {
	  z-index: 10;
	}
	.patt-circ.hovered {
	  background-color: #cde2f2;
	  border: none;
	}
	.patt-circ.hovered .patt-dots {
	  display: none;
	}
	.patt-circ.dir {
	  background-image: url("<?php echo e(asset('/img/pattern-directionicon-arrow.png'), false); ?>");
	  background-position: center;
	  background-repeat: no-repeat;
	}
	.patt-circ.e {
	  -webkit-transform: rotate(0);
	  transform: rotate(0);
	}
	.patt-circ.s-e {
	  -webkit-transform: rotate(45deg);
	  transform: rotate(45deg);
	}
	.patt-circ.s {
	  -webkit-transform: rotate(90deg);
	  transform: rotate(90deg);
	}
	.patt-circ.s-w {
	  -webkit-transform: rotate(135deg);
	  transform: rotate(135deg);
	}
	.patt-circ.w {
	  -webkit-transform: rotate(180deg);
	  transform: rotate(180deg);
	}
	.patt-circ.n-w {
	  -webkit-transform: rotate(225deg);
	   transform: rotate(225deg);
	}
	.patt-circ.n {
	  -webkit-transform: rotate(270deg);
	  transform: rotate(270deg);
	}
	.patt-circ.n-e {
	  -webkit-transform: rotate(315deg);
	  transform: rotate(315deg);
	}
</style>
<?php if(!empty($__system_settings['additional_css'])): ?>
    <?php echo $__system_settings['additional_css']; ?>

<?php endif; ?>
