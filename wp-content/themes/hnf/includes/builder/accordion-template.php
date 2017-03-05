<div<?php FLBuilder::render_row_attributes( $row ); ?>>
	<div class="bbrow-tab-title">
		<?php echo esc_html( $row->settings->accordion_title ); ?>
	</div>
	<div class="fl-row-content-wrap bbrow-tab-content">
		<div class="tab-content-inner">
			<?php FLBuilder::render_row_bg( $row ); ?>
			<div class="<?php FLBuilder::render_row_content_class( $row ); ?>">
				<?php
				// $groups received as a magic variable from template loading.
				foreach ( $groups as $group ) {
					FLBuilder::render_column_group( $group );
				}

				?>
			</div>
		</div>
	</div>
</div>
