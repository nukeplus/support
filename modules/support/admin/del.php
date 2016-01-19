<?php

/**
 * @Project PaCorp 1x
 * @Author PaCorp Co.,Ltd (contact@pacorp.vn)
 * @Copyright (C) 2014 PaCorp Co.,Ltd. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 2-1-2010 15:23
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$id = $nv_Request->get_int( 'id', 'post', 0 );
$checkss = $nv_Request->get_string( 'checkss', 'post', '' );

if( md5( $id . $global_config['sitekey'] . session_id() ) == $checkss )
{
	$content = 'NO_' . $id;

	$sql = 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id = ' . $id;
	if( $db->exec( $sql ) )
	{
		nv_insert_logs( NV_LANG_DATA, $module_name, 'Delete', 'ID: ' . $id, $admin_info['userid'] );

		$sql = 'SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . ' ORDER BY weight ASC';
		$result = $db->query( $sql );
		$weight = 0;
		while( $row = $result->fetch() )
		{
			++$weight;
			$sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET weight=' . $weight . ' WHERE id=' . $row['id'];
			$db->query( $sql );
		}
		nv_del_moduleCache( $module_name );

		$content = 'OK_' . $id;
	}
}
else
{
	$content = 'ERR_' . $id;
}
die( $content );
