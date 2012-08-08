<?php
/*
 Send the HTML to the screen.
*/
@header('Content-Type: text/html; charset=UTF-8');?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:dc="http://purl.org/dc/terms/" dir="ltr" lang="en-US">
<head profile="http://gmpg.org/xfn/11">
	<title>Search and replace DB.</title>
	<style type="text/css">
	body {
		background-color: #E5E5E5;
		color: #353231;
	        font: 14px/18px "Gill Sans MT","Gill Sans",Calibri,sans-serif;
	}

	p {
	    line-height: 18px;
	    margin: 18px 0;
	    max-width: 520px;
	}

	p.byline {
	    margin: 0 0 18px 0;
	    padding-bottom: 9px;
            border-bottom: 1px dashed #999999;
	    max-width: 100%;
	}

	h1,h2,h3 {
	    font-weight: normal;
	    line-height: 36px;
	    font-size: 24px;
	    margin: 9px 0;
	    text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.8);
	}

	h2 {
	    font-weight: normal;
	    line-height: 24px;
	    font-size: 21px;
	    margin: 9px 0;
	    text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.8);
	}

	h3 {
	    font-weight: normal;
	    line-height: 18px;
	    margin: 9px 0;
	    text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.8);
	}

	a {
	    -moz-transition: color 0.2s linear 0s;
	    color: #DE1301;
	    text-decoration: none;
	    font-weight: normal;
	}

	a:visited {
	   -moz-transition: color 0.2s linear 0s;
	    color: #AE1301;
	}

	a:hover, a:visited:hover {
	    -moz-transition: color 0.2s linear 0s;
	    color: #FE1301;
	    text-decoration: underline;
}

	#container {
		display:block;
		width: 768px;
		padding: 10px;
		margin: 0px auto;
		border:solid 10px 0px 0px 0px #ccc;
		border-top: 18px solid #DE1301;
		background-color: #F5F5F5;
	}

	fieldset {
		border: 0 none;
	}

	.error {
		border: solid 1px #c00;
		padding: 5px;
		background-color: #FFEBE8;
		text-align: center;
		margin-bottom: 10px;
	}

	label {
		display:block;
		line-height: 18px;
		cursor: pointer;
	}

	select.multi,
	input.text {
		margin-bottom: 1em;
		display:block;
		width: 90%;
	}

	select.multi {
		height: 144px;
	}


	input.button {
	}

	div.help {
		border-top: 1px dashed #999999;
		margin-top: 9px;
	}

	</style>
</head>
<body>
	<div id="container"><?php
		if ( ! empty( $errors ) && is_array( $errors ) ) {
			echo '<div class="error">';
			foreach( $errors as $error )
				echo '<p>' . $error . '</p>';
			echo '</div>';
		}?>


	<h1>Safe Search Replace</h1>
	<p class="byline">by interconnect/<strong>it</strong></p>
	<?php
/*
 The bit that does all the work.
*/
switch ( $step ) {
	case 1:
		// Prompt for the loading of WordPress or not.	?>
		<h2>Load DB connection values from WordPress?</h2>
		<form action="<?php icit_srdb_form_action( ); ?>" method="post">
			<fieldset>
				<p><label for="loadwp"><input type="checkbox" checked="checked" value="1" name="loadwp" id="loadwp" /> Pre-populate the DB values form with the ones used in wp-config?  It is possible to edit them later.</label></p> <?php
				icit_srdb_submit( 'Submit' ); ?>
			</fieldset>
		</form>	<?php
		break;


	case 2:
		// Ask for db username password. ?>
		<h2>Database details</h2>
		<form action="<?php icit_srdb_form_action( ); ?>" method="post">
			<fieldset>
				<p>
					<label for="host">Server Name:</label>
					<input class="text" type="text" name="host" id="host" value="<?php esc_html_attr( $host, true ) ?>" />
				</p>

				<p>
					<label for="data">Database Name:</label>
					<input class="text" type="text" name="data" id="data" value="<?php esc_html_attr( $data, true ) ?>" />
				</p>

				<p>
					<label for="user">Username:</label>
					<input class="text" type="text" name="user" id="user" value="<?php esc_html_attr( $user, true ) ?>" />
				</p>

				<p>
					<label for="pass">Password:</label>
					<input class="text" type="password" name="pass" id="pass" value="<?php esc_html_attr( $pass, true ) ?>" />
				</p>
				
				<p>
					<label for="pass">Charset:</label>
					<input class="text" type="text" name="char" id="char" value="<?php esc_html_attr( $char, true ) ?>" />
				</p>
				<?php icit_srdb_submit( 'Submit DB details' ); ?>
			</fieldset>
		</form>	<?php
		break;


	case 3:
		// Ask which tables to deal with ?>
		<h2>Which tables do you want to scan?</h2>
		<form action="<?php icit_srdb_form_action( ); ?>" method="post">

			<fieldset>

				<input type="hidden" name="host" value="<?php esc_html_attr( $host, true ) ?>" />
				<input type="hidden" name="data" value="<?php esc_html_attr( $data, true ) ?>" />
				<input type="hidden" name="user" value="<?php esc_html_attr( $user, true ) ?>" />
				<input type="hidden" name="pass" value="<?php esc_html_attr( $pass, true ) ?>" />
				<input type="hidden" name="char" value="<?php esc_html_attr( $char, true ) ?>" />
				<p>
					<label for="tables">Tables:</label>
					<select id="tables" name="tables[]" multiple="multiple" class="multi"><?php
					foreach( $all_tables as $table ) {
						echo '<option selected="selected" value="' . esc_html_attr( $table ) . '">' . $table . '</option>';
					} ?>
					</select>
					<em>Multiple tables can be selected with ( CTRL/CMD + click ).</em>
				</p>

				<p>
					<label for="guid">
					<input type="checkbox" name="guid" id="guid" value="1" <?php echo $guid == 1 ? 'checked="checked"' : '' ?>/> Leave GUID column unchanged? </label>
					<em>If the values in the GUID column from the WordPress posts table change RSS readers and other tools will be under the impression that the posts are new and may show them in feeds again. <br />
					All columns titled <?php echo eng_list( $exclude_cols ) ?> will be skipped if this it ticked.</em>
				</p>

				<?php icit_srdb_submit( 'Continue', 'Do be sure that you have selected the correct tables - especially important on multi-sites installs.' );	?>
			</fieldset>
		</form>	<?php
		break;


	case 4:
		// Ask for the search replace strings. ?>
		<h2>What to replace?</h2>
		<form action="<?php icit_srdb_form_action( ); ?>" method="post">
			<fieldset>
				<input type="hidden" name="host" id="host" value="<?php esc_html_attr( $host, true ) ?>" />
				<input type="hidden" name="data" id="data" value="<?php esc_html_attr( $data, true ) ?>" />
				<input type="hidden" name="user" id="user" value="<?php esc_html_attr( $user, true ) ?>" />
				<input type="hidden" name="pass" id="pass" value="<?php esc_html_attr( $pass, true ) ?>" />
				<input type="hidden" name="char" id="char" value="<?php esc_html_attr( $char, true ) ?>" />
				<input type="hidden" name="guid" id="guid" value="<?php esc_html_attr( $guid, true ) ?>" /> <?php

				foreach( $tables as $i => $tab ) {
					printf( '<input type="hidden" name="tables[%s]" value="%s" />', esc_html_attr( $i, false ), esc_html_attr( $tab, false ) );
				} ?>

				<p>
					<label for="srch">Search for (case sensitive string):</label>
					<input class="text" type="text" name="srch" id="srch" value="<?php esc_html_attr( $srch, true ) ?>" />
				</p>

				<p>
					<label for="rplc">Replace with:</label>
					<input class="text" type="text" name="rplc" id="rplc" value="<?php esc_html_attr( $rplc, true ) ?>" />
				</p>

				<?php icit_srdb_submit( 'Submit Search string', 'Are you REALLY sure you want to go ahead and do this?' ); ?>
			</fieldset>
		</form>	<?php
		break;


	case 5:

		@ set_time_limit( 60 * 10 );
		// Try to push the allowed memory up, while we're at it
		@ ini_set( 'memory_limit', '1024M' );

		// Process the tables
		if ( isset( $connection ) )
			$report = icit_srdb_replacer( $connection, $srch, $rplc, $tables );

		// Output any errors encountered during the db work.
		if ( ! empty( $report[ 'errors' ] ) && is_array( $report[ 'errors' ] ) ) {
			echo '<div class="error">';
			foreach( $report[ 'errors' ] as $error )
				echo '<p>' . $error . '</p>';
			echo '</div>';
		}

		// Calc the time taken.
		$time = array_sum( explode( ' ', $report[ 'end' ] ) ) - array_sum( explode( ' ', $report[ 'start' ] ) ); ?>

		<h2>Completed</h2>
		<p><?php printf( 'In the process of replacing <strong>"%s"</strong> with <strong>"%s"</strong> we scanned <strong>%d</strong> tables with a total of <strong>%d</strong> rows, <strong>%d</strong> cells were changed and <strong>%d</strong> db update performed and it all took <strong>%f</strong> seconds.', $srch, $rplc, $report[ 'tables' ], $report[ 'rows' ], $report[ 'change' ], $report[ 'updates' ], $time ); ?></p> <?php
		break;


	default: ?>
		<h2>No idea how we got here.</h2>
		<p>Something strange has happened.</p> <?php
		break;
}

if ( isset( $connection ) && $connection )
	mysql_close( $connection );


// Warn if we're running in safe mode as we'll probably time out.
if ( ini_get( 'safe_mode' ) ) {
	echo '<h4>Warning</h4>';
	printf( '<p style="color:red;">Safe mode is on so you may run into problems if it takes longer than %s seconds to process your request.</p>', ini_get( 'max_execution_time' ) );
}
/*
 Close out the html and exit.
*/ ?>
		<div class="help">
			<h4><a href="http://interconnectit.com/">interconnect/it</a> <a href="http://interconnectit.com/124/search-and-replace-for-wordpress-databases/">Safe Search and Replace on Database with Serialized Data v2.0.0</a></h4>
			<p>This developer/sysadmin tool helps solve the problem of doing a search and replace on a
			WordPress site when doing a migration to a domain name with a different length.</p>

			<p><style="color:red">WARNING!</strong> Take a backup first, and carefully test the results of this code.
			If you don't, and you vape your data then you only have yourself to blame.
			Seriously.  And if you're English is bad and you don't fully understand the
			instructions then STOP.  Right there.  Yes.  Before you do any damage.

			<h2>Don't Forget to Remove Me!</h3>

			<p style="color:red">Delete this utility from your
			server after use.  It represents a major security threat to your database if
			maliciously used.</p>

			<h2>Use Of This Script Is Entirely At Your Own Risk</h2>

			<p> We accept no liability from the use of this tool.</p>

			<p>If you're not comfortable with this kind of stuff, get an expert, like us, to do
			this work for you.  You do this ENTIRELY AT YOUR OWN RISK!  We accept no responsibility
			if you mess up your data.  There is NO UNDO here!</p>

			<p>The easiest way to use it is to copy your site's files and DB to the new location.
			You then, if required, fix up your .htaccess and wp-config.php appropriately.  Once
			done, run this script, select your tables (in most cases all of them) and then
			enter the search replace strings.  You can press back in your browser to do
			this several times, as may be required in some cases.</p>

			<p>Of course, you can use the script in many other ways - for example, finding
			all references to a company name and changing it when a rebrand comes along.  Or
			perhaps you changed your name.  Whatever you want to search and replace the code will help.</p>

			<p><a href="http://interconnectit.com/124/search-and-replace-for-wordpress-databases/">Got feedback on this script? Come tell us!</a>

		</div>
	</div>
</body>
</html>

