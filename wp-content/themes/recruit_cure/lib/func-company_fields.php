<?php
/* 会社情報設定 */
add_action('admin_menu', 'company_menu');
function company_menu() {
	add_options_page('会社情報管理', '会社情報管理', 8, 'company_menu', 'company_options_page');
	add_action('admin_init', 'register_company_option');
}
function register_company_option() {
	register_setting('company-option-group', 'company_option_name');
	register_setting('company-option-group', 'company_option_place');
	register_setting('company-option-group', 'company_option_tel');
	register_setting('company-option-group', 'company_option_tel_contact');
    register_setting('company-option-group', 'company_option_web');
    register_setting('company-option-group', 'company_option_logo');
	register_setting('company-option-group', 'company_option_business');
}
function company_options_page() {
	?>
	<style>
	.wrap .form-table {
        background: #fff;
        box-shadow: 0 5px 10px rgba(0,0,0,.26);
	}
	.wrap .form-table tbody tr {
		border-bottom: 1px dotted #ccc;
	}
	.wrap .form-table tbody tr:last-of-type {
		border-bottom: none;
	}
	.wrap .form-table tbody th {
        padding: 0 10px;
        background-color: #ddd;
        vertical-align: middle;
    }
    .wrap .form-table tbody td {
        padding: 0;
    }
	.wrap .form-table tbody input {
        width: 100%;
        margin: 0;
        padding: 15px 10px;
        border: none;
        border-radius: 0;
	}
	.wrap textarea {
        width: 100%;
        min-height: 300px;
        margin: 0;
        padding: 15px 10px;
        border: none;
        border-radius: 0;
	}
	</style>
	<div class="wrap">
		<h2>会社情報管理</h2>
		<form method="post" action="options.php">
			<?php
			settings_fields('company-option-group');
			do_settings_sections('company-option-group');
			?>
			<table class="form-table">
				<col width=15%><col width=85%>
				<tbody>
					<tr>
						<th>会社名・屋号</th>
						<td>
							<input type="text" name="company_option_name" value="<?php echo get_option('company_option_name'); ?>">
						</td>
					</tr>
					<tr>
						<th>所在地</th>
						<td>
							<input type="text" name="company_option_place" value="<?php echo get_option('company_option_place'); ?>">
						</td>
					</tr>
					<tr>
						<th>電話番号</th>
						<td>
							<input type="text" name="company_option_tel" value="<?php echo get_option('company_option_tel'); ?>">
						</td>
					</tr>
					<tr>
						<th>応募用電話番号</th>
						<td>
							<input type="text" name="company_option_tel_contact" value="<?php echo get_option('company_option_tel_contact'); ?>">
						</td>
					</tr>
					<tr>
						<th>ウェブサイト</th>
						<td>
							<input type="text" name="company_option_web" value="<?php echo get_option('company_option_web'); ?>">
						</td>
                    </tr>
                    <tr>
						<th>ロゴ画像URL</th>
						<td>
							<input type="text" name="company_option_logo" value="<?php echo get_option('company_option_logo'); ?>">
						</td>
					</tr>
					<tr>
						<th>事業内容</th>
						<td>
							<textarea name="company_option_business" cols="80" row="20"><?php echo get_option('company_option_business'); ?></textarea>
						</td>
					</tr>
				</tbody>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
<?php
}